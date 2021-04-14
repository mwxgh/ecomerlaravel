@extends('layouts.admin')

@section('title')
 <title>Product</title>
@endsection

@section('custom_css')
<link rel="stylesheet" href="{{ asset ('assetadmin/style.css')}}">
<link href="{{ asset('vendor/select2/select2.min.css')}}" rel="stylesheet" />

@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  @include('element.content_header', ['object' => 'Product', 'action' => 'Edit'])
  <!-- /.content-header -->

  <!-- Main content -->
  <form action="{{ route ('products.update',['id'=>$product->id ])}}" method="post" enctype="multipart/form-data">
  <div class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-6">
                  @csrf
               <div class="form-group">
                 <label> Product Title</label>
                 <input type="text" class="form-control" name="name" value="{{ $product->name}}" placeholder="Product">
               </div>
               <div class="form-group">
                 <label> Price</label>
                 <input type="text" class="form-control" name="price" value="{{ $product->price }}"placeholder="Price">
               </div>
               <div class="form-group">
                 <label>Feature Image</label>
                 <input type="file" class="form-control-file" name="feature_image_path">
                 <div class="col-md-4 container_image_feature_product">
                     <div class="row">
                         <img class="image_feature_product" src="{{ $product->feature_image_path }}" alt="">
                     </div>
                 </div>
               </div>
               <div class="form-group">
                 <label>Detail Image</label>
                 <input type="file" multiple class="form-control-file" name="image_path[]">
                 <div class="col-md-12 container_image_detail_product" >
                     <div class="row">
                         @foreach($product->images as $productImageItem)
                             <div class="col-md-4">
                                 <img class="image_detail_product" src="{{ $productImageItem->image_path }}" alt="">
                             </div>
                         @endforeach
                     </div>
                 </div>
               </div>

               <div class="form-group">
                   <label>Category</label>
                    <select class="form-control" id="cat_select" name="category_id">
                      <option value="">Itself</option>
                        {!! $optionCategory !!}
                    </select>
               </div>
               <div class="form-group">
                    <label>Tags</label>
                    <select name="tags[]" class="form-control" id="tags_select_choose" multiple="multiple">
                        @foreach($product->tags as $tagItem)
                        <option value="{{ $tagItem->name }}" selected> {{ $tagItem->name }}</option>
                         @endforeach
                    </select>
                </div>
          </div>
          <div class="col-12">
              <div class="form-group">
               <label>Content</label>
               <textarea class="form-control tinymce_editor_init" name="contents" rows="15">{{ $product->content }}</textarea>
              </div>
          </div>
          <div class="col-12">
              <button type="submit" class="btn btn-primary">Submit</button>
          </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  </form>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('custom_js')
<script src="{{ asset('vendor/select2/select2.min.js')}}"></script>
<script src="{{ asset('vendor/tinymce/tinymce.min.js')}}"></script>
<script src="{{ asset ('assetadmin/main.js')}}"></script>
@endsection
