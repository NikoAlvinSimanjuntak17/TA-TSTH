<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px; /* Added padding to the body */
            background-color: #f4f4f4; /* Added background color */
        }
        .container {
            max-width: 700px; /* Changed width to be responsive */
            margin: 0 auto;
            padding: 20px;
            border-radius: 8px; /* Added border radius for container */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Added box shadow */
        }
        h1 {
            text-align: center;
            margin-top: 0; /* Added to remove default margin */
        }
        h4 {
            margin-top: 0; /* Added to remove default margin */
            text-align: center;
        }
        p {
            margin-top: 0; /* Added to remove default margin */
            margin-bottom: 10px;
        }
        .info {
            margin-bottom: 20px; /* Increased margin for better separation */
        }
        ul {
            margin-top: 0; /* Added to remove default margin */
            padding-left: 20px; /* Added to create indentation for list */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Struk Pembelian</h1>
        <h4>Restaurant Pizza Andaliman Balige</h4>
        <center><p>Jln. Patuan Nagari No.Kelurahan, Pardede Onan, <br>Kec. Balige, Toba, Sumatera Utara 22313</p></center><br><br><br>


        <div class="info">
            <p><strong>Nama Penerima:</strong> {{ $order->nama }}</p>
            <p><strong>NO HP:</strong> {{ $order->shipping_phonenumber }}</p>
        </div>

        <div class="info">
            <p><strong>Nama Barang:</strong></p>
            <ul>
                @foreach(json_decode($order->product_nama) as $productName)
                    <li>{{ $productName }}</li>
                @endforeach
            </ul>
        </div>

        <div class="info">
            <?php
            // Misalkan $order->totalprice adalah string JSON
            $totalprice_json = $order->totalprice;

            // Mengubah string JSON menjadi array
            $totalprice_array = json_decode($totalprice_json);

            // Jika berhasil mengubah ke array, maka hitung total harga
            if ($totalprice_array !== null) {
                // Menghitung total harga
                $total = array_sum($totalprice_array);

                // Memformat total harga dengan rupiah
                $total_formatted = number_format($total, 0, ',', '.');

                // Output
                echo "<p><strong>Total Harga:</strong> Rp $total_formatted</p>";
            } else {
                echo "<p><strong>Error:</strong> Total harga tidak valid.</p>";
            }
            ?>
            <p>@if($order->status == 'pending')
                <strong>Status:</strong>Belum Dibayar
            @elseif($order->status == 'paid')
            <strong>Status:</strong>Telah Dibayar
            @elseif($order->status == 'in progress')
            <strong>Status:</strong>Diproses
            @endif
            </p>
        </div>

        <div class="info">
            <p>
                <strong>Tanggal Pembelian:</strong> {{ $order->created_at }}</p>
            <p><strong>Nomor Transaksi:</strong> #{{ $order->id }}</p>
        </div>
        <br><br>
        <p style="text-align: center;">Terima kasih atas pembeliannya!</p>
    </div>
</body>
</html>
