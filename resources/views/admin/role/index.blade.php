
@extends('layouts.admin')

@section('title')
 <title>Role</title>
@endsection

@section('custom_css')
 <link rel="stylesheet" href="{{ asset ('assetadmin/style.css')}}">
@endsection

@section('content')

<div class="content-wrapper">

  @include('element.content_header',['object' => 'Role', 'action' => 'List'])

  <div class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-md-12">
              <a href="{{ route('roles.create')}}" class="btn btn-success float-right m-2">Add</a>
          </div>

          <div class="col-md-12">
              <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Description</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                       @foreach($roles as $role)
                    <tr>
                      <th scope="row">{{ $role->id }}</th>
                      <td>{{ $role->name }}</td>
                      <td>{{ $role->display_name }}</td>
                      <td>
                          <a href="{{ route('roles.edit',['id'=>$role->id] )}}" class="btn btn-warning"> Edit</a>
                          <a href="" data-url="{{ route('roles.delete',['id'=>$role->id])}}" class="btn btn-danger" id="action_delete"> Delete</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
          </div>
          {{ $roles->links() }}
      </div>
    </div>
  </div>
</div>
@endsection

@section('custom_js')
<script src="{{ asset('vendor/sweetalert2/sweetalert2@10.js')}}"></script>
<script src="{{ asset('assetadmin/main.js')}}"></script>
@endsection
