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
                                                <th>id barang</th>
                                                <th>nama barang</th>
                                                <th>harga</th>
                                                <th>stok</th>
                                                <th>action</th>
                                               
                                            </tr>
                                        </thead>
                                       <Tbody>
                                        @foreach($items as $items)
                                        <tr>
                                            <td>{{$items->id}}</td>
                                            <td>{{$items->nama_barang}}</td>
                                            <td>{{$items->harga}}</td>
                                            <td>{{$items->stok}}</td>
                                            <td class="d-flex gap-5"><a class="btn btn-warning" href="{{route('barang.edit', $items->id)}}">Edit</a>
                                                <form action="{{route('barang.destroy', $items->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>

                                        </tr>
                                        @endforeach
                                       </Tbody>
                                        <tfoot>
                                            <tr>
                                                <th>id barang</th>
                                                <th>nama barang</th>
                                                <th>stok</th>
                                                <th>harga</th>
                                                <th>action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <button class="btn"><a href="{{route('barang.create')}}" type="button" class="btn btn-primary">create</a></button>
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