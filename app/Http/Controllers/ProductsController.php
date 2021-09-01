<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Cart;
use App\Models\Order;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('index', compact('products', $products));
    }

    public function addToCart(Request $request, $id) {
        $product = Product::find($id);
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart =  new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        return redirect()->route('home');
    }

    public function getReduceByOne(Request $request, $id) {
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);

        if (count($cart->items) > 0) {
            $request->session()->put('cart', $cart);
        } else {
            $request->session()->forget('cart');
        }
        return redirect()->route('product.cart');
    }

    public function getRemoveItem(Request $request, $id) {
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if (count($cart->items) > 0) {
            $request->session()->put('cart', $cart);
        } else {
            $request->session()->forget('cart');
        }
        return redirect()->route('product.cart');
    }

    public function getCart(Request $request) {
        if (!$request->session()->has('cart')) {
            return view('cart', ['products' => null]);
        }
        $oldCart = $request->session()->get('cart');
        $cart =  new Cart($oldCart);
        return view('cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function getCheckout (Request $request) {
        if (!$request->session()->has('cart')) {
            return view('product.cart');
        }
        $oldCart = $request->session()->get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('shoppping-cart' , ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function postCheckout(Request $request) {
        $hasCart = $request->session()->has('cart');
        $oldCart = $request->session()->get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;

        if ( ! $hasCart)
        {
            return redirect()->route('shop.checkout');
        }

        $order = new Order();
        $order->cart = serialize($cart);
        $order->address = $request->input('address');
        $order->name = $request->input('name');
        $order->save();

        $request->session()->forget('product.cart');

        return redirect()->route('product')->with($request->session()->flash('success', 'Payment successful!'));
    }
}
