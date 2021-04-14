@extends('layouts.admin')

@section('title')
 <title>Product</title>
@endsection

@section('custom_css')
<link href="{{ asset ('assetadmin/style.css')}}">
<link href="{{ asset('vendor/select2/select2.min.css')}}" rel="stylesheet" />

@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  @include('element.content_header', ['object' => 'Product', 'action' => 'Add'])
  <!-- /.content-header -->

  <!-- Main content -->
  <form action="{{ route ('products.store')}}" method="post" enctype="multipart/form-data">
  <div class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-8">
                  @csrf
               <div class="form-group">
                 <label> Product Title</label>
                 <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Product">
                 @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
               </div>
               <div class="form-group">
                 <label> Price</label>
                 <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" placeholder="Price">
                 @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
               </div>
               <div class="form-group">
                 <label>Feature Image</label>
                 <input type="file" class="form-control-file" name="feature_image_path">
               </div>
               <div class="form-group">
                 <label>Detail Image</label>
                 <input type="file" multiple class="form-control-file" name="image_path[]">
               </div>

               <div class="form-group">
                   <label>Category</label>
                    <select class="form-control @error('category_id') is-invalid @enderror" id="cat_select" name="category_id" value="{{ old('category_id') }}">
                      <option value="">Itself</option>
                        {!! $optionCategory !!}
                    </select>
                    @error('category_id')
                       <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
               </div>
               <div class="form-group">
                    <label>Tags</label>
                    <select name="tags[]" class="form-control " id="tags_select_choose" multiple="multiple">
                    </select>
                </div>
          </div>
          <div class="col-12">
              <div class="form-group">
               <label>Content</label>
               <textarea class="form-control tinymce_editor_init @error('contents') is-invalid @enderror" name="contents" rows="12">{{ old('contents') }}</textarea>
               @error('content')
                  <div class="alert alert-danger">{{ $message }}</div>
               @enderror
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
