<?php

namespace App\Observers;

use App\Models\Product;

class ProductObserver
{
    public function deleting(Product $product)
    {
        $product->preview->delete();

        $product->attachment->each->delete();
    }
}
