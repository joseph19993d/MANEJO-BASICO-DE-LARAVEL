<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Product;
//esta es una clase para recoger todo lo que esta dentro del formulario-
// que se mandara , con esta clase capturaremos lo que nos mande todo-
// el formulario de creaccion de productos 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::middleware('auth')->group(function(){
    Route::get('/', function(){
        return 'esta es una url raiz';
    });
    // el / es ala url a la que va a responder ,
    // luego LE PASAMOS una funcion (funciones en php)
    
    Route::get('products', function(){
        $products= product::orderBy('created_at','desc')->get();
        return view('products.index',compact('products'));
    })->name('products.index');
    //cuando utilizamos el view, retorna una vista dontro de la carpeta resources/views
    
    Route::get('products/create',function(){
        return view('products.create');
    })->name('products.create');
    //restornar la VISTA products.create
     
    
    Route::post('products', function(Request $request){ //colocar el reques se llama inyeccion de dependencias 
        $request->all();
        $newProduc = new Product;
        $newProduc->description= $request->input('description'); 
        $newProduc->price= $request->input('price'); 
        $newProduc->save();
        
        return redirect()->route('products.index')->with('info','producto creado exitosamente');
    }
    )->name("products.store"); 
    //guardar datos, store data. 
    
    
    Route:: delete('products/{id}',function($id){
    $product= product::findOrFail($id);
    //devulve un json 
    $product->delete();
    return redirect()->route('products.index')->with('info',"producto - $product->description , con valor de $product->price eliminado exitosamente");
    })->name('products.destroy');
    
    
    Route::get('products/{id}/edit', function($id){
    $product= product::findOrFail($id);
    return view('products.edit',compact('product'));
    })->name("products.edit");
    
    
    Route::put('products/{id}',function( Request $request, $id){
    $product= product::findOrFail($id);
    $product->description= $request->input('description');
    $product->price= $request->input('price');
    $product->update();
    return redirect()->route('products.index')->with('info','Producto editado exitosamente');
    
    })->name('products.update');
    //update ok
});





/*
Route::post(); 
//para almacenar registros
Route::put();
//para actializarlos
Route::delete();
//para eliminar 
*/



Auth::routes();

/*
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
*/