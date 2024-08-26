<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesOrderStall extends Model
{
    protected $table = 'sales_order_stalls'; // Explicitly define the table name

    protected $fillable = [
        'sales_order_id',
        'stall_id',
    ];

}

