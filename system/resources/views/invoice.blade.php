<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('public') }}/logo/sir_1.png">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }

        .invoice-container {
            width: 100%;
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 100px;
            /* margin-top: -500px; */
        }

        .header img {
            max-width: 150px;
        }

        .header .company-details {
            text-align: right !important;
        }

        .company-details p {
            /* max-width: 300px; */
            padding-left: 55%;
            word-wrap: break-word;
        }

        .customer-details,
        .invoice-details {
            margin-bottom: 20px;
            font-size: 12pt;
        }

        .detail td{
            font-size: 10pt;
        }

        .company-logo{
            float: right;
            margin-top: -50px;
        }

        .invoice-details {
            /* text-align: left; */
            margin-top: -50px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 11pt;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .total {
            text-align: right;
        }

        .total td {
            border: none;
        }

        .total .amount {
            font-size: 1.2em;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="header">

            <div class="company-logo">
                <img src="http://localhost/sirinap/public/landing/assets/images/custom/SIR.jpg" alt="Gambar">
            </div>

            <div class="invoice-details">
                <h3>INVOICE</h3>
                <span>Nomor Invoice: {{ $invoice['number'] }}</span><br>
                <span>Tanggal: {{ \Carbon\Carbon::parse($invoice['date'])->translatedFormat('l, d F Y') }}</span>
                {{-- <p>Jatuh Tempo: {{ $invoice['due_date'] }}</p> --}}
            </div>

            
            
            {{-- <div class="company-details">
                <h2>{{ $company }}</h2>
                <p>{{ $address }}</p>
                <p>{{ $phone }}</p>
                <p>{{ $email }}</p>
            </div> --}}
        </div>
        <div class="customer-details">
            <table class="detail" style="width: 100%">
                <tr>
                    <td colspan="2"><h3>Detail Konsumen</h3></td>
                    <td colspan="3"><h3>Detail Pembayaran</h3></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>: {{ $customer['name'] }}</td>

                    {{-- <td>Nama</td>
                    <td>: {{ $customer['name'] }}</td> --}}

                    <td>Status</td>
                    <td>: {{ $invoice['status'] }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>: {{ $customer['email'] }} / {{ $customer['phone'] }}</td>

                    <td>Metode</td>
                    <td>: Transfer Bank</td>
                </tr>
            </table>
            {{-- <p>Nama :{{ $customer['name'] }}</p> --}}
            {{-- <p>Email :{{ $customer['email'] }}</p> --}}
            {{-- <p>{{ $customer['address'] }}</p> --}}
            {{-- <p>{{ $customer['phone'] }}</p> --}}
        </div>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Deskripsi</th>
                    <th>Check IN</th>
                    <th>Check Out</th>
                    <th>Harga/Malam</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice['items'] as $item)
                    <tr>
                        <td>{!! $item['description'] !!}</td>
                        <td>{{ $item['dateIn'] }}</td>
                        <td>{{ $item['dateOut'] }}</td>
                        <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($item['total'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="total">
            <table>
                {{-- <tr>
                    <td>Subtotal</td>
                    <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                </tr> --}}
                {{-- <tr> --}}
                {{-- <td>Pajak (10%)</td> --}}
                {{-- <td>Rp {{ number_format($tax, 0, ',', '.') }}</td> --}}
                {{-- <td>-</td> --}}
                {{-- </tr> --}}
                {{-- <tr class="amount">
                    <td>Total</td>
                    <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
                </tr> --}}
            </table>
        </div>
        <div class="footer">
            <p>Terima kasih telah berbisnis dengan kami!</p>
        </div>
    </div>
</body>

</html>
