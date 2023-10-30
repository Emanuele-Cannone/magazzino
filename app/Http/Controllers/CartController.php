<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartStoreRequest;
use App\Models\Article;
use App\Models\Customer;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{


    public function __construct()
    {
        $this->cartService = new CartService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();

        if ((session()->get('cart')->count() <= 0)) {
            return Redirect::route('articles.index', [
                'articles' => Article::all()
            ]);
        } else {
            return view('cart.index', [
                'cartItems' => $this->cartService->cartResolve(),
                'customers' => $customers->map(fn($customer) => [
                    'id' => $customer->id,
                    'text' => $customer->name
                ])->toArray()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CartStoreRequest $request)
    {
        $this->cartService->store($request);

        return Redirect::route('articles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $cart)
    {
        $this->cartService->removeFromCart($cart);

        return session()->get('cart')->count() > 0 ?
            Redirect::route('cart.index') :
            Redirect::route('articles.index');

    }
}
