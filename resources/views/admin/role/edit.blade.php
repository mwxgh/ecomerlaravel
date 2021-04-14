@extends('layouts.admin')

@section('title')
 <title>Role</title>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{ asset ('assetadmin/style.css')}}">
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  @include('element.content_header', ['object' => 'Role', 'action' => 'Edit'])
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-12">
              <form action="{{ route('roles.update',['id'=>$role->id]) }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="col-12">
                      <div class="form-group">
                        <label> Role</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"  value="{{ $role->name }}" placeholder="Role">
                        @error('name')
                           <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label>Description</label>
                        <textarea name="display_name" class="form-control @error('display_name') is-invalid @enderror" rows="4" placeholder="Description" >{{ $role->display_name }}</textarea>
                        @error('display_name')
                           <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                  </div>
                  <div class="col-12">
                      <div class="row">
                          <div class="col-md-12">
                                  <label>
                                      <input type="checkbox" class="checkall" name="" value="">
                                      Checkall</label>
                          </div>
                          @foreach($permissionsParent as $permissionsParentItem)
                          <div class="card border-primary mb-3 col-12">
                             <div class="card-header" id="parent_permiss">
                                 <label>
                                     <input type="checkbox" name="" value="" class="checkbox_wrapper">
                                 </label>
                                Manage {{$permissionsParentItem->name}}
                             </div>
                             <div class="row">
                                 <!-- get class permissionsChildren from Permission model -->
                                 @foreach ($permissionsParentItem->permissionsChildren as $permissionsChildrenItem)
                                 <div class="card-body text-primary col-md-3">
                                   <h5 class="card-title">
                                       <label>
                                           <input type="checkbox" name="permission_id[]"
                                           {{ $permissionsChecked->contains('id',$permissionsChildrenItem->id) ? 'checked' : '' }}
                                           class="checkbox_children"
                                           value="{{ $permissionsChildrenItem->id }}">
                                       </label>
                                       {{$permissionsChildrenItem->name}}
                                   </h5>
                              </div>
                              @endforeach
                             </div>
                      </div>
                      @endforeach
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

@section('custom_js')
<script src="{{ asset('vendor/select2/select2.min.js')}}"></script>
<script src="{{ asset('vendor/tinymce/tinymce.min.js')}}"></script>
<script type="text/javascript"src="{{ asset ('assetadmin/main.js')}}">

</script>
@endsection
