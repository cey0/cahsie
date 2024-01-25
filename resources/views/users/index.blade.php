@extends('layout')
@section('content')
    <div class="containe">
        <div class="content"> 
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Data Table</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>username</th>
                                                <th>password</th>
                                                <th>role</th>
                                                <th>nama</th>
                                                <th>action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($akun as $akun)
                                            <tr>
                                                <td>{{$akun->id}}</td>
                                                <td>{{$akun->username}}</td>
                                                <td>{{$akun->password}}</td>
                                                <td>{{$akun->role}}</td>
                                                <td>{{$akun->nama}}</td>
                                                <td class="d-flex gap-5"><a class="btn btn-warning" href="{{route('user.edit', $akun->id)}}">Edit</a>
                                                    <form action="{{route('user.destroy', $akun->id)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>id</th>
                                                <th>username</th>
                                                <th>password</th>
                                                <th>role</th>
                                                <th>nama</th>
                                                <th>action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <button class="btn"><a href="{{route('user.create')}}" type="button" class="btn btn-primary">create</a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<link rel="stylesheet" href="{{ asset('/js/bootstrap.min.js') }}">
@endsection