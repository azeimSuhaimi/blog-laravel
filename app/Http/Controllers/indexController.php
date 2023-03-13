<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\activity_log;
use App\Models\subscribe;
use App\Models\contact_messege;
use App\Models\products;
use Illuminate\Support\Facades\DB;

class indexController extends Controller
{
    //

    public function index()
    {
        $post_all = posts::latest();
        
        return view('indexs.index',['posts' => posts::where('pick', true)->first(),'post_all'=>$post_all->paginate(1)->withQueryString()]);
    }

    public function read(Request $request)
    {
        $id = $request->input('id');
        $post = posts::find($id);
        $post->count++;
        $post->save();

        return view('indexs.read',['post' => $post ]);
    }

    public function list_post(Request $request)
    {
        $post_all = posts::latest();

        if(request('search') !== '')
        {
            $post_all->where('title', 'like', '%'.request('search').'%')
                        ->orWhere('content', 'like', '%'.request('search').'%')
                        ->orWhere('created_at', 'like', '%'.request('search').'%')
                        ->orWhere('editor', 'like', '%'.request('search').'%');
        }

        if(request('category') !== '')
        {
            $post_all->where('category', request('category'));
        }

        return view('indexs.lists_post',['post_all'=>$post_all->paginate(1)->withQueryString()]);
    }

    public function subscribe(Request $request)
    {
       

        $validated = $request->validate([
            'email' => 'required|email|unique:subscribe,email',
            ],[
            'email.unique' => 'This email address has already been used.',
            ]);

            $subscribe = new subscribe;
            $subscribe->email = $validated['email'];
            $subscribe->time = time();
            $subscribe->save();

            return back()->with('success', 'Action successful!');

    }

    public function unsubscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required'
            ]);

            $deleted = DB::table('subscribe')->where('email', $validated['email'])->delete();

            if($deleted)
            {

                return back()->with('success', 'Action successful!');
            }
            return back()->with('error', 'Action fail!');
    }

    public function about_us()
    {
        return view('indexs.about_us');
    }
    

    public function contact_us()
    {
        return view('indexs.contact_us');
    }

    public function contact_us_post(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'name' => 'required|string',
            'phone' => 'required|numeric|starts_with:01',
            'messege' => 'required|string',
            'email' => 'required|email',
            ]);

            $contact_messege = new contact_messege;
            $contact_messege->email = $validated['email'];
            $contact_messege->name = $validated['name'];
            $contact_messege->phone = $validated['phone'];
            $contact_messege->messege = $validated['messege'];
            $contact_messege->time = time();
            $contact_messege->open = false;
            $contact_messege->save();

            return back()->with('success', 'messege send success');

    }

    public function list_product()
    {
        $products = products::latest();

        return view('indexs.list_product',['products'=>$products->paginate(1)->withQueryString()]);
    }

    public function list_product_add(Request $request)
    {
        if ($request->has('id')) 
        {
            $id = $request->input('id');
            $price = $request->input('price');
            $name = $request->input('name');

            //dd(session('cart' , ['id' => $id,'price' => $price, 'name' => $name,'quantity' => 1]));
            $data = $request->session()->all();
            dd($data);
        }
        

        $products = products::latest();

        return view('indexs.list_product',['products'=>$products->paginate(1)->withQueryString()]);
    }

    public function cart_product()
    {
        return view('indexs.cart_product');
    }


}
