<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodTransaction extends Model
{
    use HasFactory;

    protected $table = 'food_transactions';
    protected $fillable = ['user_id','total_price'];

    public function details()
    {
        return $this->hasMany(FoodTransactionDetail::class, 'food_transaction_id');
    }
}
