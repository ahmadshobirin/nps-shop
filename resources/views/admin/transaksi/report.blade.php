<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        
        //table {
           //font-family: arial, sans-serif;
           //border-collapse: collapse;
            //width: 100%;
        //}

        #myTbl th {
            border: 2px solid #808080;
            text-align: center;
            padding: 8px;
        }

        #myTbl td {
            border: 1px solid #808080;
            //text-align: right;
            padding: 8px 8px 0px 8px;
        }

        #myTbl tr:nth-child(even) {
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

        #myTbl tfoot tr td{
            //font-weight: bold;
            padding-top: 15px;
        }

    </style>
</head>
<body>
    <p align="center" style="font-size: 24px;font-family: arial; margin-bottom:2px;">Laporan Penjualan<br> <small> </small></p>
    <p align="center" style="font-size: 12px;font-family: arial; margin-bottom:2px;">Periode {{$tglmulai}} - {{$tglsampai}}</p>
    <br>
    <table id="myTbl" style="border-collapse:collapse; width:100%; table-layout: fixed; font-size: 12px;font-family: arial">
        <thead>
            <tr>
                <th>Tanggal Beli</th>
                <th>Nama Customer</th>
                <th>Status Bayar</th>
                <th>Tanggal Bayar</th>
                <th>Rincian</th>
                <th>Produk</th>
                <th>Harga Jual</th>
                <th>Harga Beli</th>
                <th>Laba</th>
                <th>Sumber</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php $totalLaba = 0; $totalJual = 0; $totalBeli = 0; ?>
            @foreach($results as $result)
                <?php 
                    $subTotal = $result->subTotal - $result->purchase_price;
                    $totalBeli = $totalBeli + $result->purchase_price;
                    $totalJual = $totalJual + $result->subTotal;
                    $totalLaba = $totalLaba +   $subTotal;
                ?>
                <tr>
                    <td width="9%">{{ date('d-m-Y',strtotime($result->date_transaction)) }}</td>
                    <td width="7%">{{ $result->customer }}</td>
                    <td width="7%">{{ ($result->type == 'paid') ? 'Lunas' : 'Hutang' }}</td>
                    <td width="9%">{{ ($result->payment_date != null) ? date('d-m-Y',strtotime($result->payment_date)) : '-'  }}</td>
                    {{--  <td>{{ ucfirst($result->source) }}</td>  --}}
                    <td width="7%" style="word-wrap: break-word;">{{ ucfirst($result->rincian) }}</td>
                    <td width="7%" style="word-wrap: break-word;">{{ ucfirst($result->produk) }}</td>
                    <td width="13%" style="text-align:right;">Rp.{{ number_format($result->subTotal,0,'.','.') }}</td>
                    <td width="13%" style="text-align:right;">Rp.{{ number_format($result->purchase_price,0,'.','.') }}</td>
                    <td width="13%" style="text-align:right;">Rp. {{ number_format($subTotal)}}</td>
                    <td width="7%" style="word-wrap: break-word;">{{ ucfirst($result->source) }}</td>                    
                    <td width="7%" style="word-wrap: break-word;">{{ ucfirst($result->deskripsi) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot >
            <tr>
                <td style="border:none; text-align:right; padding-right:12px;" colspan="6">Grand Total </b></td>
                <td style="border:none; text-align:right; padding-right:12px;"><b> Rp. {{ number_format($totalBeli)}} </b></td>
                <td style="border:none; text-align:right; padding-right:12px;"> <b> Rp. {{ number_format($totalJual)}} </b></td>
                <td style="border:none; text-align:right; padding-right:12px;"> <b> Rp. {{ number_format($totalLaba)}} </b></td>
                <td style="border-right:none; border-bottom:none; border-left:none; border-top:1px solid #000000;"></td>
                <td style="border-right:none; border-bottom:none; border-left:none;  border-top:1px solid #000000;"></td>
            </tr>
        </tfoot>
    </table>
    {{--  <table align="right" style="border:none; border-collapse:collapse; margin-top: 20px; font-family: arial, sans-serif; line-height:25px;">

        <tr>
            <td>Total Jual</td>
            <td>&nbsp;&nbsp;</td>
            <td><b> Rp. {{ number_format($totalJual)}} </b></td>
        </tr>
        <tr>
            <td>Total Beli</td>
            <td>&nbsp;&nbsp;</td>
            <td><b> Rp. {{ number_format($totalBeli)}} </b></td>
        </tr>
        <tr>
            <td>Total Laba</td>
            <td>&nbsp;&nbsp;</td>
            <td><b> Rp. {{ number_format($totalLaba)}} </b></td>
        </tr>
    </table>  --}}
</body>
</html>