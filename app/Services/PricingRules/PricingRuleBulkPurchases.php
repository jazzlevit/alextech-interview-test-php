<?php

namespace App\Services\PricingRules;

use App\Models\Product;

/**
 * Class PricingRuleBulkPurchases
 */
class PricingRuleBulkPurchases implements PricingRule
{
    /**
     * Price rule requires to specify
     * - the product
     * - the quantity when discount will be applied
     * - the discount will be applied to each product
     *
     * @param Product $product
     * @param int $quantity
     * @param float $discount
     */
    public function __construct(
        readonly Product $product,
        readonly int $quantity,
        readonly float $discount
    ) {

    }

    /**
     * @param Product[] $items
     *
     * @return float
     */
    public function applyDiscount(array $items): float
    {
        $discount = 0;

        $count = 0;
        foreach ($items as $item) {
            if ($item->id === $this->product->id) {
                $count++;
            }
        }

        if ($count >= $this->quantity) {
            $discount = $count * $this->discount;
        }

        return (float)$discount;
    }
}
