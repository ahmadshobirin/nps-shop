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
            border: 2px solid #808080;
            text-align: center;
            padding: 8px;
        }

        td {
            border: 1px solid #808080;
            //text-align: right;
            padding: 8px 8px 0px 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
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
    <p align="center" style="font-size: 12px;font-family: arial; margin-bottom:2px;">Periode {{$tglmulai}} - {{$tglsampai}}</p>
    <br>
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
            <?php $total = 0;?>
            @foreach($results as $result)
                <?php 
                    $subTotal = $result->subTotal - $result->purchase_price;
                    $total = $total +   $subTotal;
                ?>
                <tr>
                    <td width="10%">{{ date('d-m-Y',strtotime($result->date_transaction)) }}</td>
                    <td>{{ $result->customer }}</td>
                    <td>{{ ($result->type == 'paid') ? 'Lunas' : 'Hutang' }}</td>
                    <td width="10%">{{ ($result->payment_date != null) ? date('d-m-Y',strtotime($result->payment_date)) : '-'  }}</td>
                    <td>{{ ucfirst($result->source) }}</td>
                    <td>{{ ucfirst($result->kategori) }}</td>
                    <td>{{ ucfirst($result->produk) }}</td>
                    <td width="10%" style="text-align:right;">Rp.{{ number_format($result->purchase_price,0,'.','.') }}</td>
                    <td width="10%" style="text-align:right;">Rp.{{ number_format($result->subTotal,0,'.','.') }}</td>
                    <td width="15%" style="text-align:right;">Rp. {{ number_format($subTotal)}}</td>
                    <td>{{ ucfirst($result->deskripsi) }}</td>
                </tr>
            @endforeach
        </tbody>
        <br>
        <tfoot >
            <tr>
                <td style="border:none; text-align:right" colspan="11">Total : <b> Rp. {{ number_format($total)}} </b></td>
                
            </tr>
        </tfoot>
    </table>
    <table>
        
    </table>
</body>
</html>