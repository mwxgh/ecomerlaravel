
@extends('layouts.admin')

@section('title')
 <title>Product</title>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{ asset ('assetadmin/style.css')}}">
@endsection

@section('content')

<div class="content-wrapper">

  @include('element.content_header',['object' => 'Product', 'action' => 'List'])

  <div class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-md-12">
              <a href="{{ route('products.create') }}" class="btn btn-success float-right m-2">Add</a>
          </div>

          <div class="col-md-12">
              <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Price</th>
                      <th scope="col">Image</th>
                      <th scope="col">Category</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($products as $product)
                    <tr>
                      <th scope="row">{{ $product->id }}</th>
                      <td>{{ $product->name }}</td>
                      <td>{{ number_format($product->price) }}</td>
                      <td>
                          <img class="product_img_150_100" src="{{ $product->feature_image_path }}" alt="">
                      </td>
                      <td>{{ optional($product->categoryProduct)->name }}</td>
                      <td>
                          <a href="{{ route('products.edit',['id'=>$product->id]) }}" class="btn btn-warning"> Edit</a>
                          <a href="" data-url="{{ route('products.delete',['id'=>$product->id])}}" class="btn btn-danger" id="action_delete"> Delete</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
          </div>
           {{ $products->links() }}
      </div>
    </div>
  </div>
</div>


@endsection

@section('custom_js')
<script src="{{ asset('vendor/sweetalert2/sweetalert2@10.js')}}"></script>
<script src="{{ asset('assetadmin/main.js')}}"></script>
@endsection
