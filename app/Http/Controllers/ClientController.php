<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\ResearchData;
use App\Models\User;
use App\Models\ProductRating;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Midtrans\Notification;
use Midtrans\Snap;
use Midtrans\Config;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Order;
use App\Models\Gallery;
use App\Models\Feedback;
use Illuminate\Support\Facades\DB;
use App\Models\ShippingInfo;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function index()
    {
        $allproduct = ResearchData::latest()->get();

        $feedbacks = Feedback::all();

        $gallery = Gallery::all();

        return view('users.home', compact('allproduct', 'feedbacks','gallery'));
    }

    public function getFeedbacks()
{
    return Feedback::all();
}

     public function Dasboard(){
    $allproduct = ResearchData::latest()->get();
    return view('users.home',compact('allproduct'));
    }

    public function CategoryPage($id){
        $category = Category::findOrFail($id);
        $products = ResearchData::where('product_category_id',$id)->latest()->get();
    return view('users.category',compact('category','products'));
    }
        public function Product(){
    return view('users.allproduct');
    }
    public function PeddingOrdersDetil($id){
        $pedding = Order::findOrFail($id);

        return view('users.peddingorderdetil',compact('pedding'));
    }
    public function showPaymentForm($id)
{
    $pedding = Order::findOrFail($id);

    // Logic untuk menampilkan halaman pembayaran
    return view('users.payment', compact('pedding'));
}
    public function Payment(){
        $user = Auth::user();
    $pending_orders = Order::where('user_id', $user->id)
        ->whereIn('status', ['pending', 'in progress'])
        ->latest()
        ->get();

            return view('users.payment',compact('pending_orders'));
    }

    public function orderdelete($id)
    {
        $order = Order::findOrFail($id);

        // Menambahkan quantity produk yang tersedia
        $productIds = json_decode($order->product_id);
        $quantities = json_decode($order->quantity);

        foreach ($productIds as $index => $productId) {
            $product = ResearchData::findOrFail($productId);
            $product->quantity += $quantities[$index];
            $product->save();
        }

        // Hapus pesanan
        $order->delete();

        // Redirect ke halaman yang tepat atau tampilkan pesan sukses
        return redirect()->route('peddingorders')->with('message', 'Pesanan berhasil dihapus.');
    }

    public function SingleProduct($id)
    {

        $product = researchdata::findOrFail($id);
        $subcat_id = ResearchData::where('id', $id)->value('product_category_id');
        $related_products = researchdata::where('product_category_id', $subcat_id)->latest()->get();
//Mengambil semua pesanan (order) yang memiliki ID produk seperti yang diberikan dalam parameter $id,
// dan memiliki kolom ulasan yang tidak null. Hasilnya disimpan dalam variabel $orders.
        $orders = Order::where('product_id', 'LIKE', '%' . $id . '%')->whereNotNull('ulasan')->get();


        $comments = [];
        $userIds = [];
        $userNames = [];
        $createdDates = [];
        foreach ($orders as $order) {
            $productIds = json_decode($order->product_id);
//Memeriksa apakah ID produk yang diberikan ada dalam array $productIds menggunakan fungsi in_array.
//Jika iya, artinya pesanan tersebut terkait dengan produk yang sedang diproses dalam metode ini.
            if (in_array($id, $productIds)) {
                $comments[] = $order->ulasan;
                $userIds[] = $order->user_id;
                $userNames[] = User::where('id', $order->user_id)->value('name');
                $createdDates[] = $order->created_at;
            }

        }

        return view('users.productdetail', compact('product', 'related_products', 'comments', 'userIds', 'userNames', 'createdDates'));
    }

    public function AddToCart(){
        $userid = Auth::id();
        $cart_items = Cart::where('user_id',$userid)->get();
        return view('users.addtocart',compact('cart_items'));
    }

    public function getCartCount()
    {
        $userId = Auth::id();
        $cartCount = Cart::where('user_id', $userId)->count();

        return response()->json(['cartCount' => $cartCount]);
    }



    public function deletecart($id){
        Cart::findOrFail($id)->delete();
        return redirect()->back()->with('message','Keranjang berhasil Dihapus');
    }

    public function AddProductToCart(Request $request)
{
    if (!auth()->check()) {
        Session::flash('error', 'Silahkan login terlebih dahulu');
        return redirect()->route('login');
    }

    $product = researchdata::find($request->product_id);

    $userid = Auth::id();
    $totalQuantityInCart = Cart::where('user_id', $userid)
        ->where('product_id', $request->product_id)
        ->sum('quantity');

    $totalQuantityRequested = $totalQuantityInCart + $request->quantity;

    if ($totalQuantityRequested <= $product->quantity) {
        Cart::Insert([
            'product_id' => $request->product_id,
            'product_nama' => $request->product_name,
            'product_img' => $request->product_img,
            'user_id' => $userid,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ]);

        return redirect()->route('product')->with('message', 'Barang Berhasil Ditambahkan ke Keranjang');
    } else {
        return redirect()->route('product')->with('error', 'Stok tidak cukup. Jumlah yang diminta: ' . $request->quantity . ', Stok tersedia: ' . $product->quantity . ', Jumlah di keranjang: ' . $totalQuantityInCart);
    }

}


    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->quantity = $request->input('quantity');
        $cart->save();

        return redirect()->back()->with('success', 'Quantity updated successfully.');
    }


    public function GetShippingaddress(){
        return view('users.shipping');
    }
    public function RemoveCartItem($id){
        Cart::findOrFail($id)->delete();
        return redirect()->route('addtocart')->with('message','Barang Berhasil Dihapus dari keranjang');
    }

    public function CheckOut(Request $request)
    {
        $userid = Auth::id();
        $checkedItems = $request->input('ids', []);

        if (empty($checkedItems)) {
            return redirect()->back()->with('error', 'Pilih produk sebelum melanjutkan ke checkout.');
        }

        // Dapatkan hanya item yang dicentang dari keranjang
        $cart_items = Cart::whereIn('id', $checkedItems)->where('user_id', $userid)->get();

        // Kirim data checkbox yang dipilih ke halaman checkout
        return view('users.checkout', compact('cart_items', 'checkedItems'));

        }


        public function PlaceOrder(Request $request)
        {
            $userid = Auth::id();
            $checkedItems = $request->input('ids', []);

            if (empty($checkedItems)) {
                return redirect()->back()->with('error', 'Pilih produk sebelum melanjutkan ke checkout.');
            }

            // Dapatkan hanya item yang dicentang dari keranjang
            $cart_items = Cart::whereIn('id', $checkedItems)->where('user_id', $userid)->get();

            // Periksa validitas data pengiriman
            $validatedData = $request->validate([
                'shipping_phonenumber' => 'required',
                'shipping_city' => 'required',
                'nama' => 'required',
                'address' => 'required',
                'shipping_postalcode' => 'required',
            ]);

            // Mulai transaksi
            DB::beginTransaction();

            try {
                // Simpan pesanan dengan nilai sementara
                $order = new Order();
                $order->id = $request->input('order_id');
                $order->user_id = $userid;
                $order->shipping_phonenumber = $validatedData['shipping_phonenumber'];
                $order->shipping_city = $validatedData['shipping_city'];
                $order->nama = $validatedData['nama'];
                $order->address = $validatedData['address'];
                $order->shipping_postalcode = $validatedData['shipping_postalcode'];
                // Tambahkan nilai default untuk kolom yang tidak boleh null
                $order->snap_token = '';
                $order->product_id = '';
                $order->product_img = '';
                $order->product_nama = '';
                $order->quantity = '';
                $order->totalprice = '';
                $order->save();
                // Detail produk untuk Midtrans
                $productIds = [];
                $productimgs = [];
                $productnames = [];
                $quantities = [];
                $prices = [];

                foreach ($cart_items as $item) {
                    $productIds[] = $item->product_id;
                    $productimgs[] = $item->product_img;
                    $productnames[] = $item->product_nama;
                    $quantities[] = $item->quantity;
                    $prices[] = $item->price;

                    // Mengurangi jumlah produk yang tersedia
                    $product = ResearchData::findOrFail($item->product_id);
                    $product->quantity -= $item->quantity;
                    $product->save();

                    // Menghapus item keranjang yang telah diproses
                    Cart::where('id', $item->id)->where('user_id', $userid)->delete();
                }

                // Set konfigurasi Midtrans
                Config::$serverKey = config('services.midtrans.server_key');
                Config::$isProduction = false;
                Config::$isSanitized = true;
                Config::$is3ds = true;

                $total_price = 0;
                foreach ($cart_items as $item) {
                    $total_price += $item->price * $item->quantity; // Mengalikan harga dengan quantity
                }

                $transaction_details = [
                    'order_id' => $order->id,
                    'gross_amount' => $total_price, // Total harga produk
                ];

                $params = [
                    'transaction_details' => $transaction_details,
                    'customer_details' => [
                        'first_name' => $order->nama,
                        'user_id' => $userid,
                    ],
                ];

                $snapToken = Snap::getSnapToken($params);

                // Perbarui order dengan snapToken dan detail produk
                $order->snap_token = $snapToken;
                $order->product_id = json_encode($productIds);
                $order->product_img = json_encode($productimgs);
                $order->product_nama = json_encode($productnames);
                $order->quantity = json_encode($quantities);
                $order->totalprice = json_encode($prices);
                $order->save(); // Simpan kembali order setelah memperbarui snap_token dan detail produk

                // Commit transaksi
                DB::commit();

                return redirect()->route('peddingorders')->with(['message' => 'Berhasil Memesan', 'snap_token' => $snapToken]);

            } catch (\Exception $e) {
                // Rollback transaksi jika ada kesalahan
                DB::rollback();

                return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses pesanan. Silakan coba lagi.');
            }
        }

        public function updateOrderStatus($orderId)
        {
            // Temukan pesanan berdasarkan ID
            $order = Order::find($orderId);

            // Pastikan pesanan ditemukan
            if ($order) {
                // Ubah status pesanan menjadi "paid"
                $order->status = 'paid';
                $order->save();
                return redirect()->back()->with('message', 'Status pesanan berhasil diperbarui.');

            }
            dd($orderId);

            // Jika pesanan tidak ditemukan
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
        }




        public function PeddingOrders(){
            $user = Auth::user();
    $pending_orders = Order::where('user_id', $user->id)
        ->whereIn('status', ['pending', 'in progress','paid'])
        ->latest()
        ->get();


            return view('users.peddingorders',compact('pending_orders'));
    }
    public function storeReservation(Request $request)
{
    if (!auth()->check()) {
        Session::flash('error', 'Silahkan login terlebih dahulu');
        return redirect()->route('login');
    }
    $reservation = new Reservation();
    $reservation->user_id = auth()->id();
    $reservation->name = $request->name;
    $reservation->email = $request->email;
    $reservation->phone = $request->phone;
    $reservation->date = $request->date;
    $reservation->time = $request->time;
    $reservation->people = $request->people;
    $reservation->message = $request->message;
    $reservation->save();


    return redirect()->route('peddingreservations')->with('message', 'Reservasi berhasil disimpan.');
}
public function PeddingReservations(){
    $user = Auth::user();
    $pending_reservations = Reservation::where('user_id', $user->id)
        ->whereIn('status', ['pending', 'confirmed'])
        ->latest()
        ->get();


    $all_reservations = $pending_reservations->sortByDesc('created_at');

    return view('users.peddingreservation', compact('all_reservations'));
}
public function editReservation($id)
    {
        $reservation = Reservation::findOrFail($id);

        return view('users.editreservation', compact('reservation'));
    }

        public function updateReservation(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'date' => 'required',
            'time' => 'required',
            'people' => 'required|numeric',
            'message' => 'nullable',
        ]);

        $reservation->update($request->all());

        return redirect()->route('peddingreservations')->with('message', 'Reservasi berhasil diperbarui.');
    }
    public function confirmDeleteReservation($id)
{
    $reservation = Reservation::findOrFail($id);
    return view('users.confirmdelete', compact('reservation'));
}


    public function destroyReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('peddingreservations')->with('message', 'Reservasi berhasil dihapus.');
    }
public function storeFeedback(Request $request)
{
    if (!auth()->check()) {
        Session::flash('error', 'Silahkan login terlebih dahulu');
        return redirect()->route('login');
    }
    $feedback = new Feedback();
    $feedback->user_id = auth()->id();
    $feedback->message = $request->message;
    $feedback->save();

    return redirect()->route('feedback')->with('message', 'Feedback berhasil dikirim.');
}
public function Feedback(){
    $user = Auth::user();
    $feedback = Feedback::where('user_id', $user->id)
        ->latest()
        ->get();

    return view('users.feedback', compact('feedback'));
}

public function showFeedback()
{
    $feedbacks = Feedback::all();

    $swiperFeedbacks = [];
    foreach ($feedbacks as $feedback) {
        $swiperFeedbacks[] = [
            'message' => $feedback->message,
            'name' => $feedback->user->name, // jika ada relasi ke model user
            'title' => $feedback->user->title, // jika ada relasi ke model user
            'image' => $feedback->user->image, // jika ada relasi ke model user
        ];
    }

    return view('nama_view_anda', ['swiperFeedbacks' => $swiperFeedbacks]);
}

public function uploadPaymentProof(Request $request, $id)
{
    $order = Order::find($id);

    if (!$order) {
        return redirect()->back()->with('error', 'Order not found');
    }

    if ($request->hasFile('img_bayar')) {
        $image = $request->file('img_bayar');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('upload'), $imageName);

        // Update the order record with the image path
        $order->img_bayar = 'upload/' . $imageName;
        $order->save();

        return redirect()->back()->with('message', 'Bukti Pembayaran Berhasil Dikirim');
    }

    return redirect()->back()->with('error', 'kirim bukti pembayaran');
}



public function komentar(Request $request, $id)
{
    $order = Order::find($id);

    if (!$order) {
        return redirect()->back()->with('error', 'Order not found');
    }

    $ulasan = $request->input('ulasan');
    // Set nilai ulasan pada order

    $order->ulasan = $ulasan;

    // Simpan perubahan pada order
    $order->save();


    return redirect()->back()->with('message', 'Terimakasi atas Ulasannya');
}



    public function History(){
        $user = Auth::user();
    $completed_orders = Order::where('user_id', $user->id)
        ->whereIn('status', ['status', 'selesai'])
        ->latest()
        ->get();

        return view('users.history', compact('completed_orders'));
    }
        public function NewRelease(){
        return view('users.newrelease');
    }
    public function TodayDeal(){
        return view('users.todaydeal');
    }
    public function CustomerService(){
        return view('users.customerservice');
    }
    public function UserProfile(){
        return view('users.profile');
    }

    public function incrementQuantity($id)
    {
        $cartItem = Cart::find($id);
        if (!$cartItem) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        $product = Product::find($cartItem->product_id);
        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        $totalQuantityInCart = Cart::where('product_id', $cartItem->product_id)
            ->where('user_id', $cartItem->user_id)
            ->sum('quantity');

        $availableQuantity = $product->quantity - $totalQuantityInCart;
        if ($totalQuantityInCart >= $product->quantity) {
            return redirect()->back()->with('error', 'Jumlah produk melebihi stok '.$totalQuantityInCart);
        }

        $cartItem->quantity++;
        $cartItem->save();

        return redirect()->back()->with('success', 'Quantity berhasil diincrement.');
    }

        public function printStruk($id)
    {
        // Cari order berdasarkan ID
        $order = Order::findOrFail($id);

        // Data yang ingin Anda tampilkan dalam PDF struk
        $data = [
            'order' => $order,

        ];

        // Render view struk ke dalam HTML
        $html = view('users.exportPDF', $data)->render();

        // Konfigurasi DOMPDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        // Inisialisasi DOMPDF
        $dompdf = new Dompdf($options);

        // Load HTML struk ke DOMPDF
        $dompdf->loadHtml($html);

        // Rendering dan output PDF struk
        $dompdf->render();

        // Tampilkan PDF struk dalam browser
        return $dompdf->stream('Struk-Pesanan.pdf');
    }


    public function decrementQuantity($id)
    {
        $product = Cart::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        if ($product->quantity > 1) {
            $product->quantity--;
            $product->save();
        }
        else{
            return redirect()->back()->with('error', 'Pemesanan Tidak Boleh 0.');
        }

        return redirect()->back();
    }
    public function orderDelivered($id)
{
    $order = Order::findOrFail($id);
    $order->status = 'selesai';
    $order->save();

    // Redirect ke halaman yang tepat atau tampilkan pesan sukses
    return redirect()->route('history')->with('message', 'Pesanan Sudah Sampai');
}

public function HistoryDetil($id){
    $pedding = Order::findOrFail($id);
    return view('users.historydetil',compact('pedding'));
}
public function webdelete($id)
{
        Order::findOrFail($id)->delete();
        return redirect()->route('peddingorders')->with('message','order berhasil Dihapus');
}
public function delete($id)
{
    // Find the order record
    $order = Order::findOrFail($id);

    // Delete the image from storage
    Storage::delete($order->img_bayar);

    // Update the order record with a null value for the image
    $order->img_bayar = null;
    $order->save();

    // Redirect or return a response as needed
    return redirect()->back()->with('message', 'Berhasil Menghapus Bukti Pembayaran');
}
public function updateProfile(Request $request)
{
    $user = Auth::user(); // Mengambil data user yang sedang login

    if (!$user) {
        return redirect()->back()->with('error', 'User not found');
    }

    $date = $request->input('birth');
    $phone = $request->input('phone');
    $address = $request->input('address');

    // Menerapkan validasi pada inputan phone
    $validatedData = $request->validate([
        'phone' => 'numeric', // Mengharuskan inputan berupa angka
    ]);

    if ($validatedData) {
        $user->birthdate = $date;
        $user->address = $address;
        $user->phone = $phone;

        $user->save();

        return redirect()->back()->with('message', 'Berhasil Ditambah');
    } else {
        return redirect()->back()->with('error', 'Inputan phone harus berupa angka');
    }
}

public function editprofile(Request $request)
{
    $user = Auth::user(); // Mengambil data user yang sedang login

    if (!$user) {
        return redirect()->back()->with('error', 'User not found');
    }
    $name = $request->input('name');
    $email = $request->input('email');
    $date = $request->input('birth');
    $phone = $request->input('phone');
    $address = $request->input('address');

    // Menerapkan validasi pada inputan phone
    $validatedData = $request->validate([
        'phone' => 'numeric', // Mengharuskan inputan berupa angka
    ]);

    if ($validatedData) {
        $user->name = $name;
        $user->email = $email;
        $user->birthdate = $date;
        $user->address = $address;
        $user->phone = $phone;

        $user->save();

        return redirect()->back()->with('message', 'Profile Berhasil diubah');
    } else {
        return redirect()->back()->with('error', 'Inputan phone harus berupa angka');
    }
}

 public function editprofil(){
    return view('users.editprofile');
 }
 public function updategambar(Request $request)
{
    $user = Auth::user();

    if (!$user) {
        return redirect()->back()->with('error', 'User not found');
    }

    // Menerapkan validasi pada inputan user_img
    $request->validate([
        'user_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($request->hasFile('user_img')) {
        $image = $request->file('user_img');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('upload'), $imageName);

        // Menghapus gambar lama jika ada
        if ($user->user_img) {
            $oldImagePath = public_path($user->user_img);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        // Update the user's image path
        $user->user_img = 'upload/' . $imageName;
        $user->save();

        return redirect()->route('userprofile')->with('message', 'Berhasil Diupdate');
    } else {
        return redirect()->back()->with('error', 'Inputan foto harus berupa file gambar');
    }
}

public function search(Request $request)
{
    $keyword = $request->input('keyword');
    $categories = Category::latest()->get();
    $products = Product::where('product_name', 'like', '%'.$keyword.'%')->latest()->paginate(20);

    return view('users.search', compact('categories', 'products'));
}



}