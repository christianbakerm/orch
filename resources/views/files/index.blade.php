@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New File
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New File Form -->
                    <form action="/file" method="post" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <!-- File Name -->
                        <div class="form-group">
                            <label for="file-name" class="col-sm-3 control-label">File</label>

                            <div class="col-sm-6">
                                <input type="file" name="name" id="name" class="form-control" value="{{ old('file') }}">
                            </div>
                        </div>

                        <!-- Add File Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Upload File
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Files -->
            @if (count($files) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Files
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped file-table">
                            <thead>
                                <th>File</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($files as $file)
                                    <tr>
                                        <td class="table-text"><div>{{ $file->name }}</div></td>

                                        <!-- File Delete Button -->
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
        </div>
    </div>
@endsection
