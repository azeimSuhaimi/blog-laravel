<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\order;
use App\Models\order_items;
use App\Models\payments;
use Illuminate\Http\Request;


class ordersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    
        $data = [
            'orders' => order::all()
        ];
        return view('orders.index',$data);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $reference = $request->input('reference');
        if(!$reference)
        {
            return redirect()->back()->with('error', 'no referene data.');
        }

        $data = [
            'order' => order::firstWhere('reference',$reference),
            'order_items' => order_items::where('reference',$reference)->get(),
            'payment' => payments::firstWhere('reference',$reference),
        ];
        return view('orders.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $order = order::firstWhere('reference',$request->input('reference'));
        $order->pack = true;
        $order->save();

        return redirect()->back()->with('success', 'finish edit pack.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
