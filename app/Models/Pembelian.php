<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    //
    protected $table = 'purchases';
    protected $fillable = ['purchase_number', 'purchase_date', 'supplier', 'total'];

    public function purchaseItems()
    {
        return $this->hasMany(PembelianItem::class, 'purchase_id');
    }

}
