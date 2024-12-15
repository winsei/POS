<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Service Motor</title>
    <style>
        /* Ukuran dan margin untuk cetak A4 */
        @page {
            size: A4;
            margin: 20mm;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        header {
            text-align: left;
            margin-bottom: 20px;
        }

        header img {
            max-width: 100px;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin: 20px 0;
        }

        p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        table th {
            background-color: #f2f2f2;
        }

        .text-right {
            text-align: right;
        }

        footer {
            margin-top: 20px;
            font-size: 14px;
            text-align: center;
        }

        /* Layout cetak */
        @media print {
            body {
                margin: 0;
            }

            header {
                text-align: left;
            }

            h1 {
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <header>
        <h2>BRSpeed</h2>
        <p>Jl. Puncak Cikunir, RT.005/RW.015, Jakasampurna, Kec. Bekasi Bar., Kota Bks, Jawa Barat 17133</p>
        <img src="{{ asset('img/logo.jpg') }}" alt="Logo">
    </header>

    <h1>Invoice Service Motor</h1>

    <p><strong>No. Nota:</strong> #{{ $transaksi->no_nota }}</p>
    <p><strong>Customer:</strong> {{ $transaksi->customer }}</p>
    <p><strong>Tanggal:</strong> {{ $transaksi->tanggal }}</p>
    <p><strong>No. Polisi:</strong> {{ $transaksi->no_polisi }}</p>
    <p><strong>Jenis Pembayaran:</strong> {{ $transaksi->jenis_pembayaran }}</p>

    <h2>Detail Barang</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
            @php $totalBarang = 0; @endphp
            @foreach($transaksi->detailBarangs as $index => $detail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $detail->barang->nama_barang }}</td>
                    <td>{{ $detail->jumlah }}</td>
                    <td>Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                </tr>
                @php $totalBarang += $detail->subtotal; @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-right">Total Barang</th>
                <th>Rp {{ number_format($totalBarang, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

    <h2>Detail Jasa</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Jasa</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
            @php $totalJasa = 0; @endphp
            @foreach($transaksi->detailServices as $index => $detail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $detail->service->nama_jasa }}</td>
                    <td>{{ $detail->jumlah }}</td>
                    <td>Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                </tr>
                @php $totalJasa += $detail->subtotal; @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-right">Total Jasa</th>
                <th>Rp {{ number_format($totalJasa, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

    <table>
        <tr>
            <th class="text-right">Total Harga</th>
            <th>Rp {{ number_format($totalBarang + $totalJasa, 0, ',', '.') }}</th>
        </tr>
    </table>

    <footer>
        <p>Mohon untuk memeriksa kembali invoice yang telah kami kirimkan. Jika terdapat hal-hal yang perlu dikonfirmasi atau dikoreksi, jangan ragu untuk menghubungi kami. Terima kasih atas perhatian dan kerjasamanya.</p>
    </footer>
    <script>
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);  // Delay 500ms sebelum memunculkan dialog print
        };
    </script>
</body>
</html>
