<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\activity_log;
use App\Models\subscribe;
use App\Models\contact_messege;
use App\Models\products;
use App\Models\order;
use App\Models\order_items;
use App\Models\payments;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

use App\Mail\order_status;

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
        $products->where('status', true);

        return view('indexs.list_product',['products'=>$products->paginate(1)->withQueryString()]);
    }

    public function list_product_add(Request $request)
    {
        

        if ($request->has('id')) 
        {
            $id = $request->input('id');
            $price = $request->input('price');
            $name = $request->input('name');
            $quantity = $request->input('quantity');

            if($quantity <= 0)
            {
                return redirect()->back()->with('error', 'Item not have stock .');
            }

            if (!session()->has('cart')) {
                session()->put('cart', []);
            }

            foreach (session('cart') as $data )
            {
                
                if($data['id'] == $id)
                {
                    return redirect()->back()->with('error', 'Item added already in cart.');
                }

            }
            
            $cart = session()->get('cart', []);
            $data = ['id'=>$id,'name' => $name, 'price' => $price,'quantity'=> 1];
            array_push($cart,$data);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Item added to cart.');

           // dd(session('cart'));
        }

     

        $products = products::latest();

        return view('indexs.list_product',['products'=>$products->paginate(1)->withQueryString()]);
    }

    public function cart_product()
    {
        return view('indexs.cart_product');
    }

    public function cart_product_add(Request $request)
    {
        if($request->has('id'))
        {
            if($request->input('quantity') > 0)
            {
                $id = $request->input('id');
                $quantity = $request->input('quantity');

                $products = products::where('id',$id)->first();
                if($products->quantity >= $quantity)
                {

                    
    
                    $cart = session()->get('cart', []);
    
                    foreach ($cart as $key => $product) {
                        if ($product['id'] == $id) {
                            // Update the quantity of the product in the cart
                            $cart[$key]['quantity'] = $quantity;
                            break;
                        }
    
                    }
                    session()->put('cart', $cart);
    
                    return redirect()->back()->with('success', 'finish.');
                }
                return redirect()->back()->with('error', 'quantity cannot in stock not macth.');
            }
            return redirect()->back()->with('error', 'quantity cannot negetif added have a problem.');
        }

        return redirect()->back()->with('error', 'Item added have a problem.');
    }

    public function cart_product_remove(Request $request)
    {
        if($request->has('id'))
        {
            $id = $request->input('id');
            $cart = session()->get('cart', []);

            foreach ($cart as $key => $product) {
                if ($product['id'] == $id) {
                    // Remove the product from the cart
                    unset($cart[$key]);
                    break;
                }
            }

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product removed from cart.');
        }

        return redirect()->back()->with('error', 'Item remove have a problem.');
    }

    public function checkout()
    {
        return view('indexs.checkout');
    }

    public function checkout_post(Request $request)
    {
        $validated = $request->validate([
            'emailCheck' => 'required|email',
            'name' => 'required|string',
            'phone' => 'required|numeric|starts_with:01',
            'address' => 'required',

            ]);

            if(!session()->has('cart'))
            {
                return redirect()->back()->with('error', 'no Item was add.');
            }

            $total = 0;
            $reference = time();

            $order = new order;
            $order->email = $validated['emailCheck'];
            $order->name = $validated['name'];
            $order->phone = $validated['phone'];
            $order->address = $validated['address'];
            $order->reference = $reference;
            $order->save();

            foreach(session('cart') as $data)
            {
                $order_items = new order_items;
                $order_items->reference = $reference;
                $order_items->product_id = $data['id'];
                $order_items->product_name = $data['name'];
                $order_items->price = $data['price'];
                $order_items->quantity = $data['quantity'];
                $order_items->save();

                $total += $data['price'] * $data['quantity'];
            }


            $some_data = array(
                'userSecretKey'=> env('toyyip_key'), // your secret key here in accout
                'catname' => 'toyyibPay General 2',
                'catdescription' => 'toyyibPay General Category, For toyyibPay Transactions 2',
                'categoryCode'=> env('toyyip_cat'),
                'billName'=>'product on the list',
                'billDescription'=>'multiple product add to cart to pay',
                'billPriceSetting'=>0,
                'billPayorInfo'=>0,
                'billAmount'=>$total * 100,
                'billReturnUrl'=>route('payment_status'), //tukar link disini
                'billCallbackUrl'=>'http://bizapp.my/paystatus',
                'billExternalReferenceNo' => $reference , // reference number sendiri bukan toyyyipay punya macam number resit
                'billTo'=>''.$request->input('name'),
                'billEmail'=>''.$request->input('emailCheck'),
                'billPhone'=>''.$request->input('phone'),
                'billSplitPayment'=>0,
                'billSplitPaymentArgs'=>'',
                'billPaymentChannel'=>'0',
                'billContentEmail'=>'Thank you for purchasing our product!',
                //'billExpiryDate'=>'17-12-2020 17:00:00',
                'billChargeToCustomer'=>'',
                'billExpiryDays'=>1
                ); 

                $curl = curl_init();

                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_URL, 'https://dev.toyyibpay.com/index.php/api/createBill');  //PROVIDE API LINK HERE
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

                $result = curl_exec($curl);
                $info = curl_getinfo($curl);  
                curl_close($curl);
                $obj = json_decode($result);

                return redirect('http://dev.toyyibpay.com/'.$obj[0]->BillCode.'');
                

    }

    public function payment_status(Request $request)
    {
        $total = 0;
        $order_id = $request->input('order_id');
        $billcode = $request->input('billcode');


        if($request->input('status_id') == 1)
        {
            if(session()->has('cart'))
            {

                foreach(session('cart') as $data)
                {
                    $total += $data['price'] * $data['quantity'];

                    $product = products::firstWhere('id', $data['id']);

                        
                        products::firstWhere('id', $data['id'])->update(['quantity' => $product->quantity - $data['quantity'] ]);
                    
                    
                }
                
                $orders = order::firstWhere('reference', $order_id);
                Mail::to($orders->email)->send(new order_status($order_id,$billcode, $request->input('status_id')));

                $payments = new payments;
                $payments->amount = $total;
                $payments->billcode = $billcode;
                $payments->payment_date = time();
                $payments->reference = $order_id;
                $payments->save();

                $request->session()->forget('cart');
            }

        }

        $datas = [
            'status_id' => $request->input('status_id'),
            'billcode' => $billcode,
            'order_id' => $order_id,
            'order' => order::firstWhere('reference', $order_id),
            'order_items' => order_items::where('reference', $order_id)->get()
        ];
        
        return view('indexs.payment_status',$datas);
    }


}
