<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        th {
            //border: 2px solid #808080;
            text-align: center;
            padding: 8px;
        }

        td {
            //border: 1px solid #808080;
            //text-align: right;
            padding: 8px 8px 0px 8px;
        }

        tr:nth-child(even) {
            //background-color: #dddddd;
        }
        .ttd{
    	    margin-left: 2%;
		    width: 150px;
		    /*border: 1px solid #dddddd;*/
        }
        .line{
        	//border-top: 1px solid #000000;
        	width: 100%;
        }

    </style>
</head>
<body>
    <p align="center" style="font-size: 24px;font-family: arial; margin-bottom:2px;">Laporan Penjualan<br> <small> </small></p>
    <table>
        <thead>
            <tr>
                <th>Tanggal Beli</th>
                <th>Nama Customer</th>
                <th>Status Bayar</th>
                <th>Tanggal Bayar</th>
                <th>Sumber</th>
                <th>Kategori Produk</th>
                <th>Produk</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Laba</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $result)
                <tr>
                    <td>{{ date('d-m-Y',strtotime($result->date_transaction)) }}</td>
                    <td>{{ date('d-m-Y',strtotime($result->customer)) }}</td>
                    <td>{{ ucfirst($result->type) }}</td>
                    <td>{{ date('d-m-Y',strtotime($result->payment_date)) }}</td>
                    <td>{{ ucfirst($result->source) }}</td>
                    <td>{{ ucfirst($result->kategori) }}</td>
                    <td>{{ ucfirst($result->produk) }}</td>
                    <td >Rp.{{ number_format($result->purchase_price,0,'.','.') }}</td>
                    <td >Rp.{{ number_format($result->subTotal,0,'.','.') }}</td>
                    <td>{{ $result->subTotal - $result->purchase_price}}</td>
                    <td>{{ ucfirst($result->deskripsi) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>