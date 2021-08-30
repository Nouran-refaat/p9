<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\traits\generalTrait;
class ProductController extends Controller
{
    use generalTrait;
    public function index()
    {
        $products = DB::table('products')->select('id', 'name', 'price', 'quantity', 'status')->orderBy('id', 'desc')->get();
        // $products = DB::select("SELECT `products`.`id`,`products`.`name`,`products`.`status`,`products`.`price`,`products`.`quantity` FROM `products` ORDER BY `products`.`id` DESC");
        return view('backend.products.index', compact('products'));
    }


    public function create()
    {
        $brands = DB::table('brands')->select('name', 'id')->orderBy('name')->get();
        $subcategories =  DB::table('subcategories')->select('name', 'id')->orderBy('name')->get();
        $suppliers = DB::table('suppliers')->select('name', 'id')->orderBy('name')->get();
        return view('backend.products.create', compact('brands', 'subcategories', 'suppliers'));
    }


    public function edit($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        // $product = DB::select("SELECT `products`.* FROM `products` WHERE `products`.`id` = $id")[0];
        $brands = DB::table('brands')->select('name', 'id')->orderBy('name')->get();
        $subcategories =  DB::table('subcategories')->select('name', 'id')->orderBy('name')->get();
        $suppliers = DB::table('suppliers')->select('name', 'id')->orderBy('name')->get();
        return view('backend.products.edit', compact('product', 'brands', 'subcategories', 'suppliers'));
    }

    public function store(StoreProductRequest $request)
    {
        // uplaod photo
        $photoName = $this->uploadPhoto($request->image,'products');
        // insert to db
        $data = $request->except('_token', 'image');
        $data['image'] = $photoName;

        DB::table('products')->insert($data);
        // redirect to index page
        return redirect()->route('products.index')->with('success', 'Product Created Successfully');
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $data = $request->except('_token', '_method', 'image');
        // upload photo if exists
        if ($request->has('image')) {
            $photoName = $this->uploadPhoto($request->image,'products');
            $data['image'] = $photoName;
            $this->deletePhoto('products',$id);
        }
        // update data in db
        DB::table('products')->where('id', $id)->update($data);
        // redirect back
        return redirect()->back()->with('success', 'Product Updated Successfully');
    }

    public function destroy($id)
    {
        $this->deletePhoto('products',$id);
        DB::table('products')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Product Deleted Successfully');
    }
}
