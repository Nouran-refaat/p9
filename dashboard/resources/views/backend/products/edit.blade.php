@extends('backend.layout.app')
@section('title', 'Edit Product')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Product Data</h3>
                </div>
                @include('backend.messages.message')
                <form method="post" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-4">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter Name" value="{{ $product->name }}">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label for="exampleInputEmail1">Price</label>
                                <input type="number" name="price" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter PRice" value="{{ $product->price }}">

                                @error('price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label for="exampleInputEmail1">Quantity</label>
                                <input type="number" name="quantity" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter Quantity" value="{{ $product->quantity }}">
                                @error('quantity')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-6">
                                <label for="exampleInputEmail1">Status</label>
                                <select name="status" class="form-control" id="">
                                    <option {{ $product->status ? 'selected' : '' }} value="1">Active</option>
                                    <option {{ $product->status == 0 ? 'selected' : '' }} value="0">Not Active</option>
                                </select>
                                @error('status')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="exampleInputEmail1">Brand</label>
                                <select name="brand_id" class="form-control" id="">
                                    @foreach ($brands as $brand)
                                        <option {{ $product->brand_id == $brand->id ? 'selected' : '' }}
                                            value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-6">
                                <label for="exampleInputEmail1">Subcategory</label>
                                <select name="subcategory_id" class="form-control" id="">
                                    @foreach ($subcategories as $sub)
                                        <option {{ $product->subcategory_id == $sub->id ? 'selected' : '' }}
                                            value="{{ $sub->id }}">{{ $sub->name }}</option>
                                    @endforeach
                                </select>
                                @error('subcategory_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="exampleInputEmail1">Supplier</label>
                                <select name="supplier_id" class="form-control" id="">
                                    @foreach ($suppliers as $supplier)
                                        <option {{ $product->supplier_id == $supplier->id ? 'selected' : '' }}
                                            value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12">
                                <label for="exampleInputEmail1">Details</label>
                                <textarea name="details" class="form-control" id="" cols="30"
                                    rows="5">{{ $product->details }}</textarea>
                            </div>
                            @error('details')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="col-4">
                                <img src="{{ url('/images/products/' . $product->image) }}" class="w-100" alt="">
                            </div>
                            <div class="col-12">
                                <label for="exampleInputFile">File input</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                </div>
                                @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
