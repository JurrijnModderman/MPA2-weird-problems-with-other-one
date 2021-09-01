<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
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
        return redirect()->route('product.index');
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
        return redirect()->route('product.shoppingCart');
    }

    public function getRemoveItem(Request $request, $id) {
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);

        if (count($cart->items) > 0) {
            $request->session()->put('cart', $cart);
        } else {
            $request->session()->forget('cart');
        }
        return redirect()->route('product.shoppingCart');
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
            return view('shop.shopping-cart');
        }
        $oldCart = $request->session()->get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('shop.checkout' , ['total' => $total]);
    }

    public function postCheckout(Request $request) {
        if (!$request->session()->has('cart')) {
            return redirect()->route('shop.shoppingCart');
        }
        $oldCart = $request->session()->get('cart');
        $cart =  new Cart($oldCart);
        $order = new Order();
        $order->cart = serialize($cart);
        $order->address = $request->input('address');
        $order->name = $request->input('name');
        $order->save();
        $request->session()->forget('cart');
        return redirect()->route('product.index')->with('succes', 'Succesfully purchased products!');
    }
}
