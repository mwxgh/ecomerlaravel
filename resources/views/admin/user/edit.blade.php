@extends('layouts.admin')

@section('title')
 <title>User</title>
@endsection

@section('custom_css')
<link href="{{ asset('vendor/select2/select2.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  @include('element.content_header', ['object' => 'User', 'action' => 'Edit'])
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-8">
              <form action="{{ route('users.update',['id'=>$user->id ])}}" method="post" enctype="multipart/form-data">
                  @csrf
               <div class="form-group">
                 <label> User Name</label>
                 <input type="text" class="form-control" name="name"  value="{{ $user->name }}" placeholder="Name">
               </div>
               <div class="form-group">
                 <label> Email</label>
                 <input type="text" class="form-control" name="email"  value="{{ $user->email }}" placeholder="Email">
               </div>
               <div class="form-group">
                 <label> Password</label>
                 <input type="password" class="form-control" name="password" placeholder="Password">
               </div>
               <div class="form-group">
                   <label>Role</label>
                   <select class="form-control" id="roles_select_choose" name="role_id[]" multiple>
                       <option value=""></option>
                       @foreach($roles as $role)
                       <option
                       {{  $roleOfUser->contains('id',$role->id) ? 'selected' : ''}}
                       value="{{ $role->id }}">{{$role->name}}</option>
                       @endforeach
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

@section('custom_js')
<script src="{{ asset('vendor/select2/select2.min.js')}}"></script>
<script src="{{ asset ('assetadmin/main.js')}}"></script>
@endsection
