<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\activity_log;
use App\Models\products;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class productsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:products,name',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);

        $products = new products;
 
        $products->name = $validated['name'];
        $products->description = $validated['description'];
        $products->price = $validated['price'];
        $products->quantity = $validated['quantity'];
        $products->save();


        $activity_log = new activity_log;
        $result = $activity_log->record_activity('create products item');

        return back()->with('success','add item');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('products.show',['products'=> products::all()]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id =$request->has('id');
        if($id == '')
        {
           
            return back()->with('error','product id is empty now');
        }

        $id = $request->input('id');

        return view('products.edit',['product'=> products::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $name = $request->input('name_unique');
        $id = $request->input('id');

        $validated = $request->validate([
            'name' => [
                'required','string',Rule::unique('products')->ignore( $name,'name')],
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);

        $products = products::find($id);
 
        $products->name = $validated['name'];
        $products->description = $validated['description'];
        $products->price = $validated['price'];
        $products->quantity = $validated['quantity'];
        $products->save();

        $activity_log = new activity_log;
        $result = $activity_log->record_activity('update product content');

        return redirect(route('products.edit').'?id='.$id)->with('success','edit product success');
    }

    public function active(Request $request)
    {
        $id =$request->has('id');
        if($id == '')
        {
           
            return back()->with('error','post id is empty now');
        }

        $product =products::find($id);
        $product->status = true;
        $product->save();

        $activity_log = new activity_log;
        $result = $activity_log->record_activity('active the product id =  '.$id);

        return back()->with('success','post is active now');
    }

    public function deactive(Request $request)
    {
        $id =$request->has('id');
        if($id == '')
        {
           
            return back()->with('error','post id is empty now');
        }

        $product =products::find($id);
        $product->status = false;
        $product->save();

        $activity_log = new activity_log;
        $result = $activity_log->record_activity('deactive the product id ='.$id);

        return back()->with('success','post is active now');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
