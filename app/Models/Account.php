<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class Account extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_name',
        'last_recon_month',
        'frequency',
        'status',
        'pending',
        'monthly_instructions',
        'month_id',
        'comment1',
        'comment2',
        'comment3',
        'customer_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
