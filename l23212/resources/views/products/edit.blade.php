@extends('layauts.main')
@section('contenido')
    <div class="container">
        <div class=row>
            <div class='col-md-12'>
                <div class="card">
                    <div class="card-header">
                        Editar producto

                            <!-- En la ruta utilizamos el HELPER route -->
                    </div>

                    <div class="card-body">
                        <form action="{{route('products.update',$product->id)}}" method="POST">
                            @method('put')
                            @csrf 
                            <!-- csrf es un toque que hace BLADE que laravel verificara la autentcacion del cliente que esta envienado el formulario -->
                            <div class="form-group">
                                <label for=""> Description </label>
                                <input type="text" class="form-control"  name="description" value='{{$product->description}}'> </label>
                            </div>

                            <div class="form-group">
                                <label for=""> Precio </label>
                                <input type="number" class=form-control name=price value='{{$product->price}}'> </label>
                            </div><br>
                                <button type= "submit" class="btn btn-primary" >Guardar</button>
                                <a href="{{route('products.index')}}" class="btn btn-danger"  > cancelar </a>
                                
                                
                        </form>
                    </div>

                </div>
           
        </div>  
    </div>
@endsection
