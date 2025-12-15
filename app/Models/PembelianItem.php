<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembelianItem extends Model
{
    //
    protected $table = 'purchase_items';
    protected $fillable = ['purchase_id', 'product_id', 'quantity', 'price', 'subtotal'];

    public function purchase()
    {
        return $this->belongsTo(Pembelian::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
