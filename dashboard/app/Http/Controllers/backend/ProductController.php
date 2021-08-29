<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = DB::table('products')->select('id','name','price','quantity','status')->orderBy('id','desc')->get();
        // $products = DB::select("SELECT `products`.`id`,`products`.`name`,`products`.`status`,`products`.`price`,`products`.`quantity` FROM `products` ORDER BY `products`.`id` DESC");
        return view('backend.products.index',compact('products'));
    }


    public function create()
    {
        $brands = DB::table('brands')->select('name','id')->orderBy('name')->get();
        $subcategories =  DB::table('subcategories')->select('name','id')->orderBy('name')->get();
        $suppliers = DB::table('suppliers')->select('name','id')->orderBy('name')->get();
        return view('backend.products.create',compact('brands','subcategories','suppliers'));
    }


    public function edit($id)
    {
        $product = DB::table('products')->where('id',$id)->first();
        // $product = DB::select("SELECT `products`.* FROM `products` WHERE `products`.`id` = $id")[0];
        $brands = DB::table('brands')->select('name','id')->orderBy('name')->get();
        $subcategories =  DB::table('subcategories')->select('name','id')->orderBy('name')->get();
        $suppliers = DB::table('suppliers')->select('name','id')->orderBy('name')->get();
        return view('backend.products.edit',compact('product','brands','subcategories','suppliers'));
    }

    public function store(Request $request)
    {
        // validation
        $rules = [
            'name'=>['required','max:1000','string'],
            'price'=>['required','numeric','min:1','max:10000000'],
            'quantity'=>['nullable','integer','min:1','max:1000'],
            'status'=>['nullable','integer','min:0','max:1'],
            'brand_id'=>['nullable','integer','exists:brands,id'],
            'subcategory_id'=>['required','integer','exists:subcategories,id'],
            'supplier_id'=>['required','integer','exists:suppliers,id'],
            'details'=>['nullable','string'],
            'image'=>['required','mimes:png,jpg,jpeg','max:1000'],
        ];
        $request->validate($rules);

        // uplaod photo
        $photoName = time() . '-'. $request->name . '.' .$request->image->extension();
        $request->image->move(public_path('images/products'),$photoName);
        // insert to db
        $data = $request->except('_token','image');
        $data['image'] = $photoName;

        DB::table('products')->insert($data);
        // redirect to index page
        return redirect()->route('products.index')->with('success','Product Created Successfully');
    }
}
