<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['transaction_id', 'name', 'email', 'phone', 'amount', 'status', 'address', 'currency', 'bus_id', 'ticketlist'];
}
