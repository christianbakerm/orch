@extends('layouts.app')

@section('content')
<div class="container">
  <div class="panel panel-primary">
    <div class="panel-heading"><h2>Upload your ansible repository</h2></div>
    <div class="panel-body">
      <!-- Display Validation Errors -->
      @include('common.errors')


      <!--<form action="{{ route('file.store') }}" method="POST" enctype="multipart/form-data">-->
      <form action="{{ url('file') }}" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="row">
              <div class="col-md-6">
                  <input type="file" name="file" class="form-control">
              </div>

              <div class="col-md-6">
                  <button type="submit" class="btn btn-success">Upload</button>
              </div>
          </div>
      </form>
     </div>
  </div>
    <!--Current Files-->
    @if (count($files) > 0)
      <div class="panel panel-default">
          <div class="panel-heading">
            Available Files
          </div>
          <div class="panel-body">
            <table class="table table-striped task-table">
              <thead>
                <th>Files</th>
                <th>&nbsp;</th>
              </thead>
              <tbody>
              @foreach ($files as $file)
                 <tr>
                     <td class="table-text"><div>{{ $file->name }}</div></td>
                     <td>
                       <form action="{{url('file/' . $file->id)}}" method="POST">
                           {{ csrf_field() }}
                           {{ method_field('DELETE') }}
                         <button type="submit" id="delete-file-{{ $file->id }}" class="btn btn-danger">
                           <i class="fa fa-btn fa-trash"></i>Delete
                         </button>
                       </form>
                     </td>
                 </tr>
              @endforeach
              </tbody>
            </table>
      </div>
</div>
@endif
@endsection
