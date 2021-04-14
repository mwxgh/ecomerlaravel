
@extends('layouts.admin')

@section('title')
 <title>Slider</title>
@endsection

@section('custom_css')
 <link rel="stylesheet" href="{{ asset ('assetadmin/style.css')}}">
@endsection

@section('content')

<div class="content-wrapper">

  @include('element.content_header',['object' => 'Slider', 'action' => 'List'])

  <div class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-md-12">
              <a href="{{ route('sliders.create') }}" class="btn btn-success float-right m-2">Add</a>
          </div>

          <div class="col-md-12">
              <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Description</th>
                      <th scope="col">Image</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                       @foreach($sliders as $slider)
                    <tr>
                      <th scope="row">{{ $slider->id }}</th>
                      <td>{{ $slider->name }}</td>
                      <td>{{ $slider->description }}</td>
                      <td>
                          <img class="slider_img_150_100" src="{{ $slider->image_path }}" alt=""></td>
                      <td>
                          <a href="{{ route('sliders.edit',['id'=>$slider->id]) }}" class="btn btn-warning"> Edit</a>
                          <a href="" data-url="{{ route('sliders.delete',['id'=>$slider->id])}}"class="btn btn-danger" id="action_delete"> Delete</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
          </div>
          {{ $sliders->links() }}
      </div>
    </div>
  </div>
</div>
@endsection

@section('custom_js')
<script src="{{ asset('vendor/sweetalert2/sweetalert2@10.js')}}"></script>
<script src="{{ asset('assetadmin/main.js')}}"></script>
@endsection
