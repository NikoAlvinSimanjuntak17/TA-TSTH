<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Notifications\OrderNotification;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;

class OrderController extends Controller
{
    public function index(){
        $pending_orders = Order::whereIn('status', ['pending', 'in progress', 'paid'])
            ->orderByRaw("CASE
                            WHEN status = 'paid' THEN 1
                            WHEN status = 'in progress' THEN 2
                            WHEN status = 'pending' THEN 3
                        END, created_at DESC")
            ->get();
        $pending_selesai = Order::where('status', 'selesai')->latest()->get();

        $admin = Auth::user();

        $order = Order::get();
        foreach ($order as $item) {
            $notif = $admin->notifications()->where('data->id',$item->id)->first();
            if(!$notif){
                $save = new OrderNotification($item);
                $admin->notify($save);
            }
        }

        return view('admin.peddingorders',compact('pending_orders','pending_selesai','admin'));
}

public function exportExcel()
{
    // Query data produk dari database untuk tahun sekarang
    $orders = Order::where('status', 'selesai')
                   ->whereYear('created_at', now()->year)
                   ->get();

    // Buat spreadsheet baru
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Tambahkan judul besar di atas tabel
    $title = "Laporan Penjualan Pesanan Restoran";
    $sheet->setCellValue('A1', $title);
    $sheet->mergeCells('A1:F1');

    // Atur gaya judul
    $titleStyle = [
        'font' => [
            'bold' => true,
            'size' => 16,
        ],
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER,
        ],
    ];
    $sheet->getStyle('A1:F1')->applyFromArray($titleStyle);

    // Tambahkan space 2 baris di bawah judul
    $sheet->mergeCells('A2:F2');
    $sheet->mergeCells('A3:F3');

    // Mengelompokkan pesanan berdasarkan bulan
    $ordersByMonth = $orders->groupBy(function($order) {
        return $order->created_at->format('m'); // Format bulan dengan dua digit
    });

    // Center alignment style
    $centerStyle = [
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER,
        ],
    ];

    $rowNumber = 4; // Start from row 4

    foreach ($ordersByMonth as $month => $orders) {
        // Tambahkan header bulan
        $monthName = \Carbon\Carbon::create()->month($month)->format('F'); // Nama bulan
        $sheet->setCellValue('A' . $rowNumber, 'Bulan: ' . $monthName);
        $sheet->mergeCells('A' . $rowNumber . ':F' . $rowNumber);
        $sheet->getStyle('A' . $rowNumber . ':F' . $rowNumber)->applyFromArray([
            'font' => ['bold' => true, 'size' => 14],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT],
        ]);
        $rowNumber++;

        // Header kolom
        $sheet->setCellValue('A' . $rowNumber, 'Nomor Pesanan');
        $sheet->setCellValue('B' . $rowNumber, 'Nama Pemesan');
        $sheet->setCellValue('C' . $rowNumber, 'Nama Produk');
        $sheet->setCellValue('D' . $rowNumber, 'Kuantitas');
        $sheet->setCellValue('E' . $rowNumber, 'Total Pesanan');
        $sheet->setCellValue('F' . $rowNumber, 'Tanggal Pesanan');

        // Atur lebar kolom
        $sheet->getColumnDimension('A')->setWidth(20);
        $sheet->getColumnDimension('B')->setWidth(26);
        $sheet->getColumnDimension('C')->setWidth(30);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('E')->setWidth(22);
        $sheet->getColumnDimension('F')->setWidth(22);

        // Atur gaya header kolom
        $headerStyle = [
            'font' => ['bold' => true, 'size' => 14],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ];
        $sheet->getStyle('A' . $rowNumber . ':F' . $rowNumber)->applyFromArray($headerStyle);
        $rowNumber++;

        // Data produk
        foreach ($orders as $order) {
            $productNames = json_decode($order->product_nama, true);
            $quantities = json_decode($order->quantity, true);
            $totalPrices = json_decode($order->totalprice, true);
            $totalPembelian = array_sum($totalPrices);

            $numProducts = count($productNames);
            $startRow = $rowNumber;
            for ($i = 0; $i < $numProducts; $i++) {
                // Set product-specific data
                $sheet->setCellValue('C' . $rowNumber, $productNames[$i]);
                $sheet->setCellValue('D' . $rowNumber, $quantities[$i]);
                $sheet->getStyle('D' . $rowNumber)->applyFromArray($centerStyle);
                $rowNumber++;
            }
            $endRow = $rowNumber - 1;

            // Merge cells and set order-specific data
            $sheet->mergeCells('A' . $startRow . ':A' . $endRow);
            $sheet->setCellValue('A' . $startRow, '#' . $order->id);
            $sheet->getStyle('A' . $startRow . ':A' . $endRow)->applyFromArray($centerStyle);

            $sheet->mergeCells('B' . $startRow . ':B' . $endRow);
            $sheet->setCellValue('B' . $startRow, $order->nama);
            $sheet->getStyle('B' . $startRow . ':B' . $endRow)->applyFromArray($centerStyle);

            $sheet->mergeCells('E' . $startRow . ':E' . $endRow);
            $sheet->setCellValue('E' . $startRow, $totalPembelian);
            $sheet->getStyle('E' . $startRow . ':E' . $endRow)->applyFromArray($centerStyle);
            $sheet->getStyle('E' . $startRow . ':E' . $endRow)->getNumberFormat()->setFormatCode('"Rp "#,##0');

            $sheet->mergeCells('F' . $startRow . ':F' . $endRow);
            $sheet->setCellValue('F' . $startRow, $order->created_at->format('d-m-Y H:i'));
            $sheet->getStyle('F' . $startRow . ':F' . $endRow)->applyFromArray($centerStyle);
        }

        // Center align all cells except column C
        $sheet->getStyle('A' . ($rowNumber - $numProducts) . ':A' . ($rowNumber - 1))->applyFromArray($centerStyle);
        $sheet->getStyle('B' . ($rowNumber - $numProducts) . ':B' . ($rowNumber - 1))->applyFromArray($centerStyle);
        $sheet->getStyle('D' . ($rowNumber - $numProducts) . ':D' . ($rowNumber - 1))->applyFromArray($centerStyle);
        $sheet->getStyle('E' . ($rowNumber - $numProducts) . ':E' . ($rowNumber - 1))->applyFromArray($centerStyle);
        $sheet->getStyle('F' . ($rowNumber - $numProducts) . ':F' . ($rowNumber - 1))->applyFromArray($centerStyle);

        // Tambahkan total penjualan per bulan di bawah tabel bulan
        $totalRow = $rowNumber + 1;
        $sheet->mergeCells('A' . $totalRow . ':D' . $totalRow);
        $sheet->setCellValue('A' . $totalRow, 'Total Penjualan Bulan ' . $monthName . ':');
        $sheet->setCellValue('E' . $totalRow, '=SUM(E' . ($rowNumber - $numProducts) . ':E' . ($rowNumber - 1) . ')');
        $sheet->getStyle('E' . $totalRow)->getNumberFormat()->setFormatCode('"Rp "#,##0');

        // Gaya untuk total penjualan per bulan
        $totalStyle = [
            'font' => [
                'bold' => true,
                'size' => 13,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ];
        $sheet->getStyle('A' . $totalRow . ':E' . $totalRow)->applyFromArray($totalStyle);

        // Tambahkan space setelah total penjualan per bulan
        $rowNumber = $totalRow + 4;
    }

    // Buat writer untuk menulis spreadsheet ke file output
    $writer = new Xlsx($spreadsheet);

    // Set header untuk download file
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="order.xlsx"');
    header('Cache-Control: max-age=0');

    // Tulis file ke output
    $writer->save('php://output');
    exit;
}


    public function detail($id){
        $pedding = Order::findOrFail($id);
// $peding_orders = Order::where('status', 'pending')->latest()->get();
return view('admin.peddingorderdetail', compact('pedding'));

    }
    public function orderadmin($id){
        $pedding = Order::findOrFail($id);

return view('admin.peddingorderdetail', compact('pedding'));

    }
    public function approveOrder($id)
{
    $order = Order::findOrFail($id);
    $order->status = 'in progress';
    $order->save();

    // Redirect ke halaman yang tepat atau tampilkan pesan sukses
    return redirect()->back()->with('success', 'Order has been approved.');
}
    public function rejectOrder($id)
    {
        $order = Order::findOrFail($id);

        // Mengurangi quantity produk yang tersedia
        $productIds = json_decode($order->product_id);
        $quantities = json_decode($order->quantity);

        foreach ($productIds as $index => $productId) {
            $product = Product::findOrFail($productId);
            $product->quantity += $quantities[$index];
            $product->save();
        }

        // Hapus pesanan
        $order->delete();

        // Redirect ke halaman yang tepat atau tampilkan pesan sukses
        return redirect()->route('pendingorder')->with('success', 'Order has been rejected.');
    }
    public function cancelOrder($id)
{
    $order = Order::findOrFail($id);
    $order->status = 'pending';
    $order->save();

    // Redirect ke halaman yang tepat atau tampilkan pesan sukses
    return redirect()->back()->with('success', 'Order has been cancel.');
}
}
