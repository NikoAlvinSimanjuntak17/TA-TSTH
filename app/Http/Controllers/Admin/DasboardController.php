<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Feedback;
use App\Models\ResearchData;
use App\Notifications\OrderNotification;
use App\Notifications\ReservationNotification;
use Illuminate\Http\Request;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Symfony\Component\HttpFoundation\StreamedResponse;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Database\Eloquent\Relations\MorphMany;

class DasboardController extends Controller
{
       public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }
    public function export()
    {
        $fileName = 'export.xlsx';
        $data = Order::all();

        $response = new StreamedResponse(function() use ($data) {
            $writer = SimpleExcelWriter::streamDownload('php://output');

            // Set headers (optional)
            $writer->addRow([
                'Header 1',
                'Header 2',
                // ... Add more headers as needed
            ]);

            foreach ($data as $item) {
                $writer->addRow([
                    $item->field1,
                    $item->field2,
                    // ... Add more fields as needed
                ]);
            }
        });

        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment;filename="' . $fileName . '"');
        $response->headers->set('Cache-Control', 'max-age=0');

        return $response;
    }


    public function index()
    {
        $year = now()->year;
        $feedbackCount = Feedback::count();
        $productCount = ResearchData::count();
        $categoryCount = Category::count();
        $reservationCount = Reservation::count();
        $orderCount = Order::count();
        $today = Carbon::today();

        $januaryOrders = DB::table('orders')
            ->whereMonth('created_at', '=', 1)
            ->whereYear('created_at', '=', $year)
            ->where('status', 'selesai')
            ->get();

        $januarySum = $januaryOrders->sum(function ($order) {
            $totalprice = json_decode($order->totalprice, true);
            return array_sum($totalprice);
        });

        $februaryOrders = DB::table('orders')
            ->whereMonth('created_at', '=', 2)
            ->whereYear('created_at', '=', $year)
            ->where('status', 'selesai')
            ->get();

        $februarySum = $februaryOrders->sum(function ($order) {
            $totalprice = json_decode($order->totalprice, true);
            return array_sum($totalprice);
        });

        $marchOrders = DB::table('orders')
            ->whereMonth('created_at', '=', 3)
            ->whereYear('created_at', '=', $year)
            ->where('status', 'selesai')
            ->get();

        $marchSum = $marchOrders->sum(function ($order) {
            $totalprice = json_decode($order->totalprice, true);
            return array_sum($totalprice);
        });

        $aprilOrders = DB::table('orders')
            ->whereMonth('created_at', '=', 4)
            ->whereYear('created_at', '=', $year)
            ->where('status', 'selesai')
            ->get();

        $aprilSum = $aprilOrders->sum(function ($order) {
            $totalprice = json_decode($order->totalprice, true);
            return array_sum($totalprice);
        });

        $mayOrders = DB::table('orders')
            ->whereMonth('created_at', '=', 5)
            ->whereYear('created_at', '=', $year)
            ->where('status', 'selesai')
            ->get();

        $maySum = $mayOrders->sum(function ($order) {
            $totalprice = json_decode($order->totalprice, true);
            return array_sum($totalprice);
        });

        $juneOrders = DB::table('orders')
            ->whereMonth('created_at', '=', 6)
            ->whereYear('created_at', '=', $year)
            ->where('status', 'selesai')
            ->get();

        $juneSum = $juneOrders->sum(function ($order) {
            $totalprice = json_decode($order->totalprice, true);
            return array_sum($totalprice);
        });

        $julyOrders = DB::table('orders')
            ->whereMonth('created_at', '=', 7)
            ->whereYear('created_at', '=', $year)
            ->where('status', 'selesai')
            ->get();

        $julySum = $julyOrders->sum(function ($order) {
            $totalprice = json_decode($order->totalprice, true);
            return array_sum($totalprice);
        });

        $augustOrders = DB::table('orders')
            ->whereMonth('created_at', '=', 8)
            ->whereYear('created_at', '=', $year)
            ->where('status', 'selesai')
            ->get();

        $augustSum = $augustOrders->sum(function ($order) {
            $totalprice = json_decode($order->totalprice, true);
            return array_sum($totalprice);
        });

        $septemberOrders = DB::table('orders')
            ->whereMonth('created_at', '=', 9)
            ->whereYear('created_at', '=', $year)
            ->where('status', 'selesai')
            ->get();

        $septemberSum = $septemberOrders->sum(function ($order) {
            $totalprice = json_decode($order->totalprice, true);
            return array_sum($totalprice);
        });

        $octoberOrders = DB::table('orders')
            ->whereMonth('created_at', '=', 10)
            ->whereYear('created_at', '=', $year)
            ->where('status', 'selesai')
            ->get();

        $octoberSum = $octoberOrders->sum(function ($order) {
            $totalprice = json_decode($order->totalprice, true);
            return array_sum($totalprice);
        });

        $novemberOrders = DB::table('orders')
            ->whereMonth('created_at', '=', 11)
            ->whereYear('created_at', '=', $year)
            ->where('status', 'selesai')
            ->get();

        $novemberSum = $novemberOrders->sum(function ($order) {
            $totalprice = json_decode($order->totalprice, true);
            return array_sum($totalprice);
        });

        $decemberOrders = DB::table('orders')
            ->whereMonth('created_at', '=', 12)
            ->whereYear('created_at', '=', $year)
            ->where('status', 'selesai')
            ->get();

        $decemberSum = $decemberOrders->sum(function ($order) {
            $totalprice = json_decode($order->totalprice, true);
            return array_sum($totalprice);
        });

        $yeartotalOrders = DB::table('orders')
            ->whereYear('created_at', '=', $year)
            ->where('status', 'selesai')
            ->get();

        $yeartotal = $yeartotalOrders->sum(function ($order) {
            $totalprice = json_decode($order->totalprice, true);
            return array_sum($totalprice);
        });

    $januaryReservation = DB::table('reservations')
        ->whereMonth('created_at', '=', 1)
        ->whereYear('created_at', '=', $year)
        ->count();


    $februaryReservation = DB::table('reservations')
        ->whereMonth('created_at', '=', 2)
        ->whereYear('created_at', '=', $year)
        ->count();

    $marchReservation = DB::table('reservations')
        ->whereMonth('created_at', '=', 3)
        ->whereYear('created_at', '=', $year)
        ->count();

    $aprilReservation = DB::table('reservations')
        ->whereMonth('created_at', '=', 4)
        ->whereYear('created_at', '=', $year)
        ->count();

    $mayReservation = DB::table('reservations')
        ->whereMonth('created_at', '=', 5)
        ->whereYear('created_at', '=', $year)
        ->count();

    $juneReservation = DB::table('reservations')
        ->whereMonth('created_at', '=', 6)
        ->whereYear('created_at', '=', $year)
        ->count();

    $julyReservation = DB::table('reservations')
        ->whereMonth('created_at', '=', 7)
        ->whereYear('created_at', '=', $year)
        ->count();

    $augustReservation = DB::table('reservations')
        ->whereMonth('created_at', '=', 8)
        ->whereYear('created_at', '=', $year)
        ->count();

    $septemberReservation = DB::table('reservations')
        ->whereMonth('created_at', '=', 9)
        ->whereYear('created_at', '=', $year)
        ->count();

    $octoberReservation = DB::table('reservations')
        ->whereMonth('created_at', '=', 10)
        ->whereYear('created_at', '=', $year)
        ->where('status', 'selesai')
        ->count();

    $novemberReservation = DB::table('reservations')
        ->whereMonth('created_at', '=', 11)
        ->whereYear('created_at', '=', $year)
        ->count();

    $decemberReservation = DB::table('reservations')
        ->whereMonth('created_at', '=', 12)
        ->whereYear('created_at', '=', $year)
        ->count();

    $yeartotalReservation = DB::table('reservations')
        ->whereYear('created_at', '=', $year)
        ->count();


        // Menghitung jumlah feedback yang masuk hari ini
        $feedbackToday = Feedback::whereDate('created_at', $today)->count();

        // Menghitung total penjualan
        $totalSales = Order::where('status', 'selesai')
        ->selectRaw('JSON_UNQUOTE(JSON_EXTRACT(totalprice, "$[0]")) as price1')
        ->selectRaw('JSON_UNQUOTE(JSON_EXTRACT(totalprice, "$[1]")) as price2')
        ->selectRaw('JSON_UNQUOTE(JSON_EXTRACT(totalprice, "$[2]")) as price3')
        ->get();

        $totalSales = $totalSales->sum('price1') + $totalSales->sum('price2') + $totalSales->sum('price3');


        $totalSalesToday = Order::where('status', 'selesai')
        ->whereDate('created_at', today())
        ->selectRaw('JSON_UNQUOTE(JSON_EXTRACT(totalprice, "$[0]")) as price1')
        ->selectRaw('JSON_UNQUOTE(JSON_EXTRACT(totalprice, "$[1]")) as price2')
        ->selectRaw('JSON_UNQUOTE(JSON_EXTRACT(totalprice, "$[2]")) as price3')
        ->get();

        $totalSalesToday = $totalSalesToday->sum('price1') + $totalSalesToday->sum('price2') + $totalSalesToday->sum('price3');

        $ordersData = Order::selectRaw('DATE(created_at) as date, COUNT(id) as total_orders')
        ->where('status', 'selesai')
        ->groupBy('date')
        ->get();

    // Membuat array labels dan data untuk chart
    $labels = $ordersData->pluck('date')->map(function ($date) {
        return Carbon::parse($date)->format('Y-m-d');
    });

    $data = $ordersData->pluck('total_orders');
        // Menghitung jumlah order yang sedang diproses atau selesai hari ini
        $ordersToday = Order::whereDate('time', $today)->whereIn('status', ['in progress', 'selesai'])->count();

        // Menghitung jumlah reservasi yang berhasil hari ini
        $reservationToday = Reservation::whereDate('time', $today)->where('status', 'success')->count();

        // Mengambil data admin yang sedang login
        $admin = Auth::user();


        // Mengambil data order yang belum dibaca notifikasinya oleh admin dan membuat notifikasi untuk setiap order tersebut
        $orders = Order::get();
        foreach ($orders as $order) {
            $notification = $admin->notifications()->where('data->id', $order->id)->first();
            if (!$notification) {
                $save = new OrderNotification($order);
                $admin->notify($save);
            }
        }

        // Mengambil data reservasi yang belum dibaca notifikasinya oleh admin dan membuat notifikasi untuk setiap reservasi tersebut
        $reservations = Reservation::where('status', 'success')->get();
        foreach ($reservations as $reservation) {
            $notification = $admin->notifications()->where('data->id', $reservation->id)->first();
            if (!$notification) {
                $save = new ReservationNotification($reservation);
                $admin->notify($save);
            }
        }

        return view('admin.dasboard', compact('labels', 'data','orderCount','feedbackCount', 'productCount', 'categoryCount', 'feedbackToday', 'totalSales','totalSalesToday', 'ordersToday','reservationCount', 'reservationToday', 'januarySum',
        'februarySum',
        'marchSum',
        'aprilSum',
        'maySum',
        'juneSum',
        'julySum',
        'augustSum',
        'septemberSum',
        'octoberSum',
        'novemberSum',
        'decemberSum',
        'year',
        'yeartotal',
        'januaryReservation',
        'februaryReservation',
        'marchReservation',
        'aprilReservation',
        'mayReservation',
        'juneReservation',
        'julyReservation',
        'augustReservation',
        'septemberReservation',
        'octoberReservation',
        'novemberReservation',
        'decemberReservation','yeartotalReservation'));
    }



    public function read($id){
        if($id){
            Auth::user()->notifications()->where('id',$id)->first()->markAsRead();
        }
        return redirect()->back();
    }
    public function editprofileadmin(){
        return view('admin.editprofile');
    }
}