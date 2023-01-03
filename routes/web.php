<?php

use Illuminate\Support\Facades\Route;

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

// route
Route::get('/', function () {
    return view('welcome');
});

Route::get('/pzn', function () {
    return "Hello Febri Ananda Lubis";
});

// redirect halaman dari halaman a ke halaman b
Route::redirect('/youtube','/pzn');

// menampilkan halaman 404 ke route yang tidak ada tujuan
Route::fallback(function () {
   return '404 by Febri Ananda Lubis';
});

// melakukan view melalui file blade
Route::view('/hello', 'hello',['name' => 'Febri']);

Route::get('hello-again', function () {
    return view('hello',['name' => 'Febri']);
});

// melakukan nested view
Route::get('/hello-world', function () {
    return view('hello.world', ['name' => 'Febri']);
});

// membuat routes paramater
Route::get('/products/{id}', function ($productId) {
    return "Product $productId";
})->name('product.detail');

Route::get('/products/{product}/items/{item}', function ($productId, $itemId) {
    return "Product $productId, Item $itemId";
})->name('product.item.detail');

// membuat route parameter dengan regex
Route::get('/categories/{id}', function ($categoryId) {
    return "Category $categoryId";
})->where('id', '[0-9]+')->name('category.detail');

// jika tidak wajib mengirimkan id, wajib memberi default value
Route::get('/users/{id?}', function ($userId = '404') {
    return "User $userId";
})->name('user.detail');

// jika terjadi 2 route conflict
// solusinya pindahkan ke atas yang di prioritasin
Route::get('/conflict/febri', function () {
    return "Conflict Febry Ananda Lubis";
});

Route::get('/conflict/{name}', function ($name) {
    return "Conflict $name";
});

// contoh fungsi named route sebagai balikan id
// sesuai tambahan name di route nya
Route::get('/produk/{id}', function ($id) {
    $link = route('product.detail', [
        'id' => $id
    ]);
    return "Link $link";
});

Route::get('/produk-redirect/{id}', function ($id) {
    return redirect()->route('product.detail', [
        'id' => $id
    ]);
});

// menambahkan route di controller
Route::get('/controller/hello/{name}',[\App\Http\Controllers\HelloController::class, 'hello']);
