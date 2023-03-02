@extends('layauts.main')
@section('contenido')
    <div class="container"><br>
        <div class=row>
            <div class='col-md-12'>
                <div class="card">
                    <div class="card-header">
                        listado de productos

                        <a href="{{route('products.create')}}" class="btn btn-success btn-sm float-end"> nuevo producto </a>
                        <!-- En la ruta utilizamos el HELPER route -->
                    </div>
                    <div class="card-body">
                        @if(session('info'))
                            <div class="alert alert-success"> {{session('info')}}</div>
                            
                        @endif
                        <table class="table table-over table-sm">
                            <thead>
                                <th> Descripcion</th>
                                <th> precio </th>
                                <th> Accion </th>
                            </thead>
                            <tbody>
                                @foreach ($products as $product )
                                <tr>
                                    <td> 
                                        {{$product->description}}
                                    </td>
                                    
                                    <td>
                                        {{$product->price}}
                                    </td>
                                    <td>
                                            <a href="{{route('products.edit',$product->id)}} " class="btn btn-warning btn-sm"> 
                                            Editar
                                            </a>
                                            <a href="javascript: document.getElementById('delete-{{$product->id}}').submit()" class="btn btn-danger btn-sm" > Eliminar <a>
                                            <form id="delete-{{$product->id}}" action="{{route('products.destroy',$product->id)}}" method="POST" >
                                                @method('delete')
                                                @csrf
                                            </form>
                                            
                                        
                                    </td>
                                <tr>
                                @endforeach
                                

                            <tbody>
                        </table>

                    </div>
                    Bienvenido {{auth()->user()->name}}
                    <a href="javascript:document.getElementById('logout').submit()" class ="btn btn-danger btn-sm float-end"> Cerrar sesión </a>
                    <form action="{{route('logout')}}" id="logout"  style="display:none" method="post">
                    @csrf
                    </form>
                </div>
        </div>  
    </div>
@endsection
