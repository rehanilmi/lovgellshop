<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\HeaderOrder;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Notification;
use App\Notifications\SendEmailNotification;
use Illuminate\Support\Facades\Auth;



class AdminController extends Controller
{
    public function view_category()
    {
        if(Auth::id())
        {
            $data=category::all();
            return view('admin.category',compact('data'));
        }
        else
        {
            return redirect ('login');
        }
    }

    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function add_category(Request $request)
    {
        $data=new category;
        $data->category_name=$request->category;
        $data->save();
        return redirect()->back()->with('message','Category Added Successfully');
    }



    public function delete_category($id)
    {
        $data=category::find($id);
        $data->delete();
        return redirect()->back()->with('message','Category Deleted Successfully');
    }



    public function view_product()
    {
        $category=category::all();
        return view('admin.product', compact('category'));
    }



    public function add_product(Request $request)
    {
        $product=new product;
        $product->title=$request->title;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->quantity=$request->quantity;
        $product->category=$request->category;

        $image=$request->image;
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product', $imagename);
        $product->image=$imagename;

        $product->save();
        return redirect()->back()->with('message','Product Added Successfully');
    }



        public function show_product()
        {
            $product=product::all();
            return view('admin.show_product', compact('product'));
        }



        public function delete_product($id)
        {
            $product=product::find($id);
            $product->delete();

            return redirect()->back()->with('message','Product Deleted Successfully');
        }



        public function update_product($id)
        {
            $product=product::find($id);
            $category=category::all();
            return view('admin.update_product', compact('product', 'category'));
        }



        public function update_product_confirm(Request $request, $id)
        {
            if(Auth::id())
            {
                $product=product::find($id);
                $product->title=$request->title;
                $product->description=$request->description;
                $product->price=$request->price;
                $product->category=$request->category;
                $product->quantity=$request->quantity;

                $image=$request->image;
                if($image)
                    {
                        $imagename=time().'.'.$image->getClientOriginalExtension();
                        $request->image->move('product', $imagename);

                        $product->image=$imagename;
                    }

                $product->save();
                return redirect()->back()->with('message','Product Updated Successfully');
            }
            else
            {
                return redirect('login');
            }
        }



        public function order_adm()
        {
            $pesanan=HeaderOrder::all();
            return view('admin.order_adm', compact('pesanan'));
        }

        public function detail_order_adm($id)
        {
          $order=Order::where('header_order_id','=',$id)->get();
          return view('admin.detail_order_adm', compact('order'));
        }

        public function bayar($id)
        {
            $order=HeaderOrder::find($id);
            $order->payment_status=2;
            $order->save();
            return redirect()->back();
        }

        public function proses($id)
        {
            $order=HeaderOrder::find($id);
            $order->status = 'Sudah Dikirim';
            $order->save();
            return redirect()->back();
        }

        public function selesai($id)
        {
            $order=HeaderOrder::find($id);
            $order->status = 'Diterima';
            $order->save();
            return redirect()->back();
        }



        public function print_pdf($id)
        {
            $order=HeaderOrder::find($id);
            $pdf=PDF::loadView('admin.pdf', compact('order'));
            return $pdf->setPaper('a4', 'landscape')->download('order_details.pdf');
        }



        public function send_email($id)
        {
            $order=order::find($id);
            return view('admin.email_info', compact('order'));
        }



        public function send_user_email(Request $request, $id)
        {
            $order=order::find($id);
            $details = [
                'greeting' => $request->greeting,
                'firstline' => $request->firstline,
                'body' => $request->body,
                'button' => $request->button,
                'url' => $request->url,
                'lastline' => $request->lastline,

            ];
            //Notification::send($order,new SendEmailNotification($details));
            //return redirect()->back();
        }



        public function searchdata(Request $request)
        {
            $searchText=$request->search;
            $order=order::where('name','LIKE', "%$searchText%")->
            orWhere('name','LIKE', "%$searchText%")->
            orWhere('phone','LIKE', "%$searchText%")->
            orWhere('product_title','LIKE', "%$searchText%")->get();

            return view ('admin.order', compact('order'));
        }
}
