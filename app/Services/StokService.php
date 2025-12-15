<?php

namespace App\Services;

use App\Models\Stock;
use App\Models\StockMovement;

class StokService
{
    public function increaseStock(
        int $productId,
        int $quantity,
        string $referenceType,
        int $referenceId
    ): void {
        $stock = Stock::firstOrCreate(
            ['product_id' => $productId],
            ['quantity' => 0]
        );

        $stock->increment('quantity', $quantity);

        StockMovement::create([
            'product_id' => $productId,
            'type' => 'in',
            'quantity' => $quantity,
            'reference_type' => $referenceType,
            'reference_id' => $referenceId,
        ]);
    }

    public function decreaseStock(
        int $productId,
        int $quantity,
        string $referenceType,
        int $referenceId
    ): void {
        $stock = Stock::where('product_id', $productId)->lockForUpdate()->first();

        if (!$stock || $stock->quantity < $quantity) {
            throw new \Exception('Stok tidak mencukupi');
        }

        $stock->decrement('quantity', $quantity);

        StockMovement::create([
            'product_id' => $productId,
            'type' => 'out',
            'quantity' => $quantity,
            'reference_type' => $referenceType,
            'reference_id' => $referenceId,
        ]);
    }
}
