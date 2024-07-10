<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transactions;
use Illuminate\Support\Facades\DB;


class IndexController extends Controller
{
    public function Index(Request $request) {

        return view('index');
    }

    public function IndexData(Request $request) {
        $data = Transactions::select(DB::raw("transactions.id, transactions.no_transaction ,COUNT(transaction_details.item) as total_item,SUM(transaction_details.quantity) as total_quantity"))
        ->leftJoin('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
        ->groupBy('transactions.id','transaction_details.transaction_id')
        ->orderBy('transactions.id')
        ->get();
$html="
<table>
<tr>
<th>Transaksi</th>
<th>Total Item</th>
<th>Total Quantity </th>
<th>Action </th>
</tr>";
        foreach ($data as $key => $value) {
            $html.="
            <tr>
            <th>$value->no_transaction</th>
            <th>$value->total_item</th>
            <th>$value->total_quantity</th>
            <th><button type='button' value='button' onclick='edit($value->id)'>Edit</button> | <button type='button' value='button' onclick='deletedata($value->id)'>Delete</button> </th>
          </tr>";
        }
        $html.="
        </table>";
        return response()->json([
            'data' => $html,
        ]);
    }


    public function Cetak(Request $request) {

        $data = [
            [
                'no_transaction' => '001',
                'items' => [
                    ['name' => 'Milk', 'total' => 4],
                    ['name' => 'Coffee', 'total' => 2],
                ]
            ],
            [
                'no_transaction' => '002',
                'items' => [
                    ['name' => 'Tea', 'total' => 7],
                    ['name' => 'Sugar', 'total' => 1],
                    ['name' => 'Coffee', 'total' => 5],
                ]
            ]
        
        ];
$cetak="";
        foreach ($data as $key => $value1) {
            $cetak.="<span>".$value1['no_transaction']."<span><br>";
            foreach ($value1['items'] as $key => $value2) {
                $cetak.="&nbsp;&nbsp;".$value2['name']." (".$value2['total'].")<br>";
            }
        }

        echo $cetak;



        $customers = ['rio', 'ari', 'yuki'];

        $contacts = [
            'ari' => '84684646',
            'dewi' => '47464524',
            'beni' => '4734526',
            'rio' => '4774525',
            'fitri' => '74563734',
        ];

        $cetak="<br><br><br>";
        foreach ($customers as $key => $value1) {
            if (isset($contacts[$value1])) {
                    $cetak.=$value1." : ".$contacts[$value1]."<br>";
            }
        }

        echo $cetak;
    }
}
