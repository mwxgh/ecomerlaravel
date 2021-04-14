@extends('layouts.admin')

@section('title')
 <title>Setting</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  @include('element.content_header', ['object' => 'Setting', 'action' => 'Edit'])
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-8">
              <form action="{{ route('settings.update',['id'=>$setting->id])}}" method="post">
                  @csrf
               <div class="form-group">
                 <label> Config Key</label>
                 <input type="text" class="form-control @error('config_key') is-invalid @enderror" value="{{$setting->config_key}}" name="config_key" placeholder="Config Key">
                 @error('config_key')
                    <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
               </div>

               @if(request()->type === 'Text')

               <div class="form-group">
                 <label> Config Value</label>
                 <input type="text" class="form-control @error('config_value') is-invalid @enderror"  value="{{ $setting->config_value }}" name="config_value" placeholder="Config Value">
                 @error('config_value')
                    <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
               </div>
                  @elseif(request()->type === 'Textarea')
               <div class="form-group">
                   <label> Config Value</label>
                   <textarea name="config_value"class="form-control @error('config_value') is-invalid @enderror"  placeholder="Config Value"  rows="3">{{$setting->config_value }}</textarea>
                   @error('config_value')
                      <div class="alert alert-danger">{{ $message }}</div>
                   @enderror
               </div>
               @endif
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
