@extends('layouts.admin')

@section('title')
 <title>Setting</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  @include('element.content_header', ['object' => 'Setting', 'action' => 'Add'])
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
        <div class="col-12">

        </div>
      <div class="row">
          <div class="col-8">
              <form action="{{ route('settings.store') .'?type=' . request()->type }}" method="post">
                  @csrf
               <div class="form-group">
                 <label> Config Key</label>
                 <input type="text" class="form-control @error('config_key') is-invalid @enderror" name="config_key" placeholder="Config Key">
                 @error('config_key')
                    <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
               </div>

               @if(request()->type === 'Text')

               <div class="form-group">
                 <label> Config Value</label>
                 <input type="text" class="form-control @error('config_value') is-invalid @enderror" name="config_value" placeholder="Config Key">
                 @error('config_value')
                    <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
               </div>
                  @elseif(request()->type === 'Textarea')
               <div class="form-group">
                   <label> Config Value</label>
                   <textarea name="config_value"class="form-control @error('config_value') is-invalid @enderror" placeholder="Config Key"  rows="3"></textarea>
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
