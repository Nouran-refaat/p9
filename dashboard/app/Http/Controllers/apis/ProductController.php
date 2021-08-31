<?php

namespace App\Http\Controllers\apis;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Validator;
use App\traits\generalTrait;
class ProductController extends Controller
{
    use generalTrait;
    public function index()
    {
        $products = Product::all();
        return $this->returnData('product',$products);
    }

    public function create()
    {
        $brands = Brand::select('name', 'id')->orderBy('name')->get();
        $subcategories =  Subcategory::select('name', 'id')->orderBy('name')->get();
        $suppliers = Supplier::select('name', 'id')->orderBy('name')->get();
        return $this->returnData('data',['brands'=>$brands,'suppliers'=>$suppliers,'subcategories'=>$subcategories]);
    }

    public function edit($id)
    {
        // validation
        $brands = Brand::select('name', 'id')->orderBy('name')->get();
        $subcategories =  Subcategory::select('name', 'id')->orderBy('name')->get();
        $suppliers = Supplier::select('name', 'id')->orderBy('name')->get();
        $product = Product::find($id);
        $product = $product ? $product : (object)[];
        return $this->returnData('data',['product'=>$product,'brands'=>$brands,'suppliers'=>$suppliers,'subcategories'=>$subcategories]);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => ['required', 'max:1000', 'string'],
            'price' => ['required', 'numeric', 'min:1', 'max:10000000'],
            'quantity' => ['nullable', 'integer', 'min:1', 'max:1000'],
            'status' => ['nullable', 'integer', 'min:0', 'max:1'],
            'brand_id' => ['nullable', 'integer', 'exists:brands,id'],
            'subcategory_id' => ['required', 'integer', 'exists:subcategories,id'],
            'supplier_id' => ['required', 'integer', 'exists:suppliers,id'],
            'details' => ['nullable', 'string'],
            'image' => ['required', 'mimes:png,jpg,jpeg', 'max:1000']
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return $this->returnValidationError($validator);
        }
        // uplaod photo
        $photoName = $this->uploadPhoto($request->image,'products');
        // insert to db
        $data = $request->except('image');
        $data['image'] = $photoName;
        Product::create($data);
        return $this->returnSuccessMessage("Product Created Successfully");
    }

    public function update(Request $request)
    {

        $rules = [
            'id' =>['required','integer','exists:products'],
            'name' => ['required', 'max:1000', 'string'],
            'price' => ['required', 'numeric', 'min:1', 'max:10000000'],
            'quantity' => ['nullable', 'integer', 'min:1', 'max:1000'],
            'status' => ['nullable', 'integer', 'min:0', 'max:1'],
            'brand_id' => ['nullable', 'integer', 'exists:brands,id'],
            'subcategory_id' => ['required', 'integer', 'exists:subcategories,id'],
            'supplier_id' => ['required', 'integer', 'exists:suppliers,id'],
            'details' => ['nullable', 'string'],
            'image' => ['nullable', 'mimes:png,jpg,jpeg', 'max:1000']
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return $this->returnValidationError($validator);
        }

        $data = $request->except('image');
        // upload photo if exists
        if ($request->has('image')) {
            $photoName = $this->uploadPhoto($request->image,'products');
            $data['image'] = $photoName;
            $this->deletePhoto('products',$request->id);
        }
        // update data in db
        Product::where('id', $request->id)->update($data);
        return $this->returnSuccessMessage("Product updated Successfully");

    }

    public function destroy($id)
    {
        $data = ['id'=>$id];
        $rules = [
            'id' =>['required','integer','exists:products'],
        ];
        $validator = Validator::make($data,$rules);
        if($validator->fails()){
            return $this->returnValidationError($validator);
        }

        $this->deletePhoto('products',$id);
        $check = Product::where('id', $id)->delete();
        if($check){
            return $this->returnSuccessMessage("Product Deleted Successfully");
        }else{
            return $this->returnErrorMessage(null,'Something went wrong',500);
        }
    }
}
