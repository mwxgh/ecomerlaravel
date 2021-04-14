
@extends('layouts.admin')

@section('title')
 <title>Setting</title>
@endsection

@section('custom_css')
 <link rel="stylesheet" href="{{ asset ('assetadmin/style.css')}}">
@endsection
@section('content')

<div class="content-wrapper">

  @include('element.content_header',['object' => 'Setting', 'action' => 'List'])

  <div class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-md-12">
              <div class="btn-group float-right m-2">
                  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                    Add
                    <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li> <a href="{{ route('settings.create') . '?type=Text' }}">Text</a> </li>
                    <li> <a href="{{ route('settings.create') . '?type=Textarea' }}">Textarea </a> </li>
                  </ul>
               </div>
          </div>

          <div class="col-md-12">
              <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Config key</th>
                      <th scope="col">Config value</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($settings as $setting)
                    <tr>
                      <th scope="row">{{ $setting->id }}</th>
                      <td>{{ $setting-> config_key }}</td>
                      <td>{{ $setting-> config_value }}</td>
                      <td>
                          <a href="{{ route('settings.edit',['id' => $setting->id]) . '?type='. $setting->type }}" class="btn btn-warning"> Edit</a>
                          <a href="" data-url="{{ route('settings.delete',['id'=>$setting->id])}}" class="btn btn-danger" id="action_delete"> Delete</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
          </div>
           {{ $settings->links() }}
      </div>
    </div>
  </div>
</div>


@endsection
@section('custom_js')
<script src="{{ asset('vendor/sweetalert2/sweetalert2@10.js')}}"></script>
<script src="{{ asset('assetadmin/main.js')}}"></script>
@endsection
