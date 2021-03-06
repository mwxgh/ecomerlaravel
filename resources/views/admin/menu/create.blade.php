@extends('layouts.admin')

@section('title')
 <title>Menu</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  @include('element.content_header', ['object' => 'Menu', 'action' => 'Add'])
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
        <div class="col-12">

        </div>
      <div class="row">
          <div class="col-8">
              <form action="{{ route ('menus.store')}}" method="post">
                  @csrf
               <div class="form-group">
                 <label> Menu Title</label>
                 <input type="text" class="form-control" name="name" placeholder="Menu">
               </div>
               <div class="form-group">
                   <label>Menu Recursion</label>
                    <select class="form-control" name="parent_id">
                      <option value="0">Itself</option>
                        {!! $optionMenu !!}
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
