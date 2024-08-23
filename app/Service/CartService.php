<?php

namespace App\Service;

use App\Constant;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class CartService
{
    static protected function getIndexCart($cartItems, $productId)
    {
        foreach ($cartItems as $key => $item) {
            if ($item->product_id == $productId) {
                return $key;
            }
        }
        return null;
    }

    static protected function addNewItem($productId): array
    {
        $product = Product::where('id', $productId)->select(['id', 'name', 'price', 'images', 'in_stock'])->first();
        if (!$product || !$product->in_stock) {
            return [];
        }
        $cartItems[] = (object)[
            'product_id' => $productId,
            'name' => $product->name,
            'image' => $product->images[0],
            'quantity' => 1,
            'unit_price' => (float)$product->price,
            'total_price' => (float)$product->price,
        ];
        return $cartItems;
    }

    static function addItemToCart($productId, $qty = 1)
    {
        $cartItems = self::getCartItemFromCookie();
        $existingItem = self::getIndexCart($cartItems, $productId);

        if ($existingItem !== null) {
            $cartItems[$existingItem]->quantity = $qty;
            $cartItems[$existingItem]->total_price = $cartItems[$existingItem]->quantity * $cartItems[$existingItem]->unit_price;
        } else {
            $product = Product::where('id', $productId)->select(['id', 'name', 'price', 'images', 'in_stock'])->first();
            if (!$product || !$product->in_stock) {
                return count($cartItems);
            }
            $cartItems[] = [
                'product_id' => $productId,
                'name' => $product->name,
                'image' => $product->images[0],
                'quantity' => $qty,
                'unit_price' => (float)$product->price,
                'total_price' => (float)$product->price,
            ];
        }

        self::addCartItemsToCookie($cartItems);
        return count($cartItems);
    }

    static function getQuantity($productId): int
    {
        $cartItems = self::getCartItemFromCookie();
        $existingItem = self::getIndexCart($cartItems, $productId);
        if ($existingItem === null) return 0;
        return $cartItems[$existingItem]->quantity;
    }

    static function removeCartItem($productId): array
    {
        $cartItems = self::getCartItemFromCookie();
        $existingItem = self::getIndexCart($cartItems, $productId);
        if ($existingItem === null) return $cartItems;
        unset($cartItems[$existingItem]);
        self::addCartItemsToCookie($cartItems);
        return $cartItems;
    }

    static function addCartItemsToCookie($cartItems)
    {
        Cookie::queue('cart_items', json_encode($cartItems), 60 * 24 * 30);
    }

    static function clearCartItems()
    {
        Cookie::queue(Cookie::forget('cart_items'));
    }

    static function getCartItemFromCookie(): array
    {
        $cartItems = json_decode(Cookie::get('cart_items', '[]'));
        if (!$cartItems) return [];
        return (array)$cartItems;
    }

    static function incrementQuantityToCartItem($productId)
    {
        $cartItems = self::getCartItemFromCookie();
        $existingItem = self::getIndexCart($cartItems, $productId);
        if ($existingItem === null) {
            $existingItem = count($cartItems);
            $cartItems = array_merge($cartItems, self::addNewItem($productId));
        } else {
            if ($cartItems[$existingItem]->quantity === Constant::MAX_PRODUCT) return [Constant::MAX_PRODUCT, $cartItems];
            $cartItems[$existingItem]->quantity += 1;
            $cartItems[$existingItem]->total_price = $cartItems[$existingItem]->quantity * $cartItems[$existingItem]->unit_price;
        }

        self::addCartItemsToCookie($cartItems);
        return [$cartItems[$existingItem]->quantity, $cartItems];
    }

    static function decrementQuantityToCartItem($productId)
    {
        $cartItems = self::getCartItemFromCookie();
        $existingItem = self::getIndexCart($cartItems, $productId);
        if ($existingItem === null) return [0, $cartItems];
        $cartItems[$existingItem]->quantity -= 1;
        $cartItems[$existingItem]->total_price = $cartItems[$existingItem]->quantity * $cartItems[$existingItem]->unit_price;
        $isEmpty = $cartItems[$existingItem]->quantity == 0;
        if ($isEmpty) {
            unset($cartItems[$existingItem]);
        }
        self::addCartItemsToCookie($cartItems);
        return [$isEmpty ? 0 : $cartItems[$existingItem]->quantity, $cartItems];
    }

    static function calculateTotalPrice(Collection $cartItems): float
    {
        return $cartItems->sum('total_price');
    }
}
