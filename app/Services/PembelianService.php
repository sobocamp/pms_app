<?php

namespace App\Services;

use App\Models\Pembelian;
use App\Models\PembelianItem;
use App\Services\StokService;
use Illuminate\Support\Facades\DB;

class PembelianService
{
    public function store(array $data): Pembelian
    {
        return DB::transaction(function () use ($data) {
            $purchase = Pembelian::create([
                'purchase_number' => $data['purchase_number'],
                'purchase_date' => $data['purchase_date'],
                'supplier' => $data['supplier'] ?? null,
                'total' => $data['total'],
            ]);

            foreach ($data['items'] as $item) {
                $subtotal = $item['quantity'] * $item['price'];

                PembelianItem::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $subtotal,
                ]);

                app(StokService::class)
                    ->increaseStock(
                        $item['product_id'],
                        $item['quantity'],
                        'purchase',
                        $purchase->id
                    );
            }

            return $purchase;
        });
    }

    public function update(Pembelian $pembelian, array $data): Pembelian
    {
        return DB::transaction(function () use ($pembelian, $data) {
            $pembelian->update([
                'purchase_number' => $data['purchase_number'],
                'purchase_date' => $data['purchase_date'],
                'supplier' => $data['supplier'] ?? null,
                'total' => $data['total'],
            ]);

            $pembelian->purchaseItems()->delete();

            foreach ($data['items'] as $item) {
                $subtotal = $item['quantity'] * $item['price'];

                PembelianItem::create([
                    'purchase_id' => $pembelian->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $subtotal,
                ]);

                app(StokService::class)
                    ->increaseStock(
                        $item['product_id'],
                        $item['quantity'],
                        'purchase',
                        $pembelian->id
                    );
            }

            return $pembelian;
        });
    }
    
    public function destroy(Pembelian $pembelian)
    {
        return DB::transaction(function () use ($pembelian) {
            $pembelian->purchaseItems()->delete();
            $pembelian->delete();
        });
    }
}
