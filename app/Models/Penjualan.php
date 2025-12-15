<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    //
    protected $table = 'sales';
    protected $fillable = ['sale_number', 'sale_date', 'customer', 'total'];

    // public function saleItems()
    // {
    //     return $this->hasMany(PenjualanItem::class, 'sale_id');
    // }
}
