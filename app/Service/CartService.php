<?php

namespace App\Service;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class CartService
{
    static function addItemToCart($productId, $qty = 1)
    {
        $cartItems = self::getCartItemFromCookie();
        $existingItem = null;
        foreach ($cartItems as $key => $item) {
            if ($item->product_id == $productId) {
                $existingItem = $key;
                break;
            }
        }

        if ($existingItem !== null) {
            $cartItems[$existingItem]->quantity = $qty;
            $cartItems[$existingItem]->total_price = $cartItems[$existingItem]->quantity * $cartItems[$existingItem]->unit_price;
        } else {
            $product = Product::where('id', $productId)->select(['id', 'name', 'price', 'images'])->first();
            $cartItems[] = [
                'product_id' => $productId,
                'name' => $product->name,
                'image' => $product->images[0],
                'quantity' => $qty,
                'unit_price' => (float) $product->price,
                'total_price' => (float) $product->price,
            ];
        }

        self::addCartItemsToCookie($cartItems);
        return count($cartItems);
    }

    static function removeCartItem($productId): array
    {
        $cartItems = self::getCartItemFromCookie();
        foreach ($cartItems as $key => $item) {
            if ($item->product_id == $productId) {
                unset($cartItems[$key]);
                break;
            }
        }

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
        if (!$cartItems) {
            return [];
        }
        return (array)$cartItems;
    }

    static function incrementQuantityToCartItem($productId)
    {
        $cartItems = self::getCartItemFromCookie();
        foreach ($cartItems as $key => $item) {
            if ($item->product_id == $productId) {
                $cartItems[$key]->quantity += 1;
                $cartItems[$key]->total_price = $cartItems[$key]->quantity * $cartItems[$key]->unit_price;
                break;
            }
        }

        self::addCartItemsToCookie($cartItems);
        return $cartItems;
    }

    static function decrementQuantityToCartItem($productId)
    {
        $cartItems = self::getCartItemFromCookie();
        foreach ($cartItems as $key => $item) {
            if ($item->product_id == $productId) {
                $cartItems[$key]->quantity -= 1;
                $cartItems[$key]->total_price = $cartItems[$key]->quantity * $cartItems[$key]->unit_price;
                if ($cartItems[$key]->quantity == 0) {
                    unset($cartItems[$key]);
                }
                break;
            }
        }

        self::addCartItemsToCookie($cartItems);
        return $cartItems;
    }

    static function calculateTotalPrice($items)
    {
        return array_sum(array_column($items, 'total_price'));
    }
}
