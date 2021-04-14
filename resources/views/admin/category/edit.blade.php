@extends('layouts.admin')

@section('title')
 <title>Category</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  @include('element.content_header', ['object' => 'Category', 'action' => 'Edit'])
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
        <div class="col-12">

        </div>
      <div class="row">
          <div class="col-8">
              <form action="{{ route ('categories.update',['id' => $category->id])}}" method="post">
                  @csrf
               <div class="form-group">
                 <label> Category Title</label>
                 <input type="text" class="form-control" name="name" value="{{ $category->name }}"placeholder="Category">
               </div>
               <div class="form-group">
                   <label>Category Recursion</label>
                    <select class="form-control" name="parent_id">
                      <option value="0">Itself</option>
                      {!! $optionCategory !!}
                    </select>
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
