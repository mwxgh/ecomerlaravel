@extends('layouts.admin')

@section('title')
 <title>Slider</title>
@endsection
@section('custom_css')
<link rel="stylesheet" href="{{ asset ('assetadmin/style.css')}}">
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  @include('element.content_header', ['object' => 'Slider', 'action' => 'Edit'])
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
        <div class="col-12">

        </div>
      <div class="row">
          <div class="col-8">
              <form action="{{ route('sliders.update',['id'=>$slider->id]) }}" method="post" enctype="multipart/form-data">
                  @csrf
               <div class="form-group">
                 <label> Slider Title</label>
                 <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"  value="{{ $slider->name }}" placeholder="Slider">
                 @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
               </div>
               <div class="form-group">
                 <label>Description</label>
                 <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5" placeholder="Description" >{{ $slider->description }}</textarea>
                 @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
               </div>


               <div class="form-group">
                 <label>Image</label>
                 <input type="file" class="form-control-file @error('image_path') is-invalid @enderror" name="image_path"value="{{ old('image_path') }}">
                 <div class="col-md-4 container_image_slider">
                     <div class="row">
                         <img class="image_slider" src="{{ $slider->image_path }}" alt="">
                     </div>
                 </div>
                 @error('image_path')
                    <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
               </div>
               <button type="submit" class="btn btn-primary">Submit</button>
             </form>
          </div>


      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
