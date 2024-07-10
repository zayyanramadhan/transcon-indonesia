<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Transactions;
use App\Models\TransactionDetails;
use Illuminate\Support\Facades\DB;

class TransactionsController extends Controller
{
    public function PostData(Request $request) {

        $fam = new Transactions;
        $fam->no_transaction = $request->transno;
        $fam->transaction_date = $request->transdate;
        $fam->save();

        foreach ($request->itemname as $key => $value) {
            $transDetail = new TransactionDetails;
            $transDetail->transaction_id = $fam->id;
            $transDetail->item = $value;
            $transDetail->quantity = $request->quantity[$key];
            $transDetail->save();
        }

        return response()->json([
            'success' => "success",
        ]);
    }

    public function EditData(Request $request) {

        $fam=Transactions::find($request->id);
        $fam->id = $request->id;
        $fam->no_transaction = $request->transno;
        $fam->transaction_date = $request->transdate;
        $fam->save();

        $transdetail=TransactionDetails::where('transaction_id', $request->id)->count();
        if ($transdetail>0) {
        $transdetail=TransactionDetails::where('transaction_id', $request->id)->delete();
        }

        foreach ($request->itemname as $key => $value) {
            $transDetail = new TransactionDetails;
            $transDetail->transaction_id = $fam->id;
            $transDetail->item = $value;
            $transDetail->quantity = $request->quantity[$key];
            $transDetail->save();
        }

        return response()->json([
            'success' => "success",
        ]);
    }

    public function Update(Request $request) {
        $transdetail=TransactionDetails::where('transaction_id', $request->id)->count();
        if ($transdetail>0) {
        $transdetail=TransactionDetails::where('transaction_id', $request->id)->get();
        }
        $trans=Transactions::where('id', $request->id)->first();

        $html="
        <span class='close'>&times;</span>
        <label for='fname'>Transaction No:</label><br>
        <input type='number' id='transno' value='$trans->no_transaction' name='fname'><br>
        <input type='hidden' id='idd' value='$trans->id' name='idd'><br>
        <label for='lname'>Transaction Date:</label><br>
        <input type='date' id='transdate' value='$trans->transaction_date' name='lname'><br><br>
        <label for='fname'>Detail Items</label>
        <button type='button' id='myBtndetail'>Add Item</button><br><div id='itemslist'>";
        foreach ($transdetail as $key => $value) {
            $html.="
            <div class='items'>
                <label for='fname'>Item Name:</label><br>
                <input type='text' value='$value->item' class='itemname' name='fname'><br>
                <label for='lname'>Quantity:</label><br>
                <input type='number' value='$value->quantity' class='quantity' name='lname'><br><br>
            </div>";
        }
        $html.="</div><button type='button' value='button' onclick='update()'>Update</button>";
        return response()->json([
            'data' => $html,
        ]);

    }

    public function Delete(Request $request) {
        $transdetail=TransactionDetails::where('transaction_id', $request->id)->count();
        if ($transdetail>0) {
        $transdetail=TransactionDetails::where('transaction_id', $request->id)->delete();
        }
        $trans=Transactions::where('id', $request->id)->delete();


        return response()->json([
            'response' => 'success deleted',
        ]);
    }
}