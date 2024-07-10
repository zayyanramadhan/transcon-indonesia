<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\TransactionDetails;

class Transactions extends Model
{
    protected $table = 'transactions';

    public function transdetail()
    {
        return $this->hasOne(TransactionDetails::class, 'transaction_id');
    }
}
