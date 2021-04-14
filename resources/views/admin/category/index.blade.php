
@extends('layouts.admin')

@section('title')
 <title>Category</title>
@endsection

@section('content')

<div class="content-wrapper">

  @include('element.content_header',['object' => 'Category', 'action' => 'List'])

  <div class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-md-12">
              <a href="{{ route('categories.create') }}" class="btn btn-success float-right m-2">Add</a>
          </div>

          <div class="col-md-12">
              <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($categories as $category)
                    <tr>
                      <th scope="row">{{ $category->id}}</th>
                      <td>{{ $category->name }}</td>
                      <td>
                          <a href="{{ route ('categories.edit', ['id' => $category->id] )}}" class="btn btn-warning"> Edit</a>
                          <a href="" data-url="{{ route('categories.delete',['id'=>$category->id])}}" class="btn btn-danger" id="action_delete"> Delete</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
          </div>
          {{ $categories->links() }}
      </div>
    </div>
  </div>
</div>


@endsection
@section('custom_js')
<script src="{{ asset('vendor/sweetalert2/sweetalert2@10.js')}}"></script>
<script src="{{ asset('assetadmin/main.js')}}"></script>
@endsection
