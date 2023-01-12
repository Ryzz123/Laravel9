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
Route::get('/controller/hello/request',[\App\Http\Controllers\HelloController::class, 'request']);
Route::get('/controller/hello/{name}',[\App\Http\Controllers\HelloController::class, 'hello']);

// menambahkan request input
Route::get('/input/hello', [\App\Http\Controllers\InputController::class, 'hello']);
Route::post('/input/hello', [\App\Http\Controllers\InputController::class, 'hello']);

// menambahkan nested input
Route::post('/input/hello/first', [\App\Http\Controllers\InputController::class, 'helloFirstName']);

// mengambil semua input
Route::post('/input/hello/input', [\App\Http\Controllers\InputController::class, 'helloInput']);

// mengambil array input
Route::post('/input/hello/array', [\App\Http\Controllers\InputController::class, 'helloArray']);

// menambah input type
Route::post('/input/hello/type', [\App\Http\Controllers\InputController::class, 'inputType']);

// meanmbah input filter
Route::post('/input/filter/only', [\App\Http\Controllers\InputController::class, 'filterOnly']);
Route::post('/input/filter/except', [\App\Http\Controllers\InputController::class, 'filterExcept']);
Route::post('/input/filter/merge', [\App\Http\Controllers\InputController::class, 'filterMerge']);

// File upload
Route::post('/file/upload', [\App\Http\Controllers\FileController::class, 'upload']);

// Get Response
Route::get('/response/hello', [\App\Http\Controllers\ResponseController::class, 'response']);
Route::get('/response/header', [\App\Http\Controllers\ResponseController::class, 'header']);

// Response type
Route::get('/response/type/view', [\App\Http\Controllers\ResponseController::class, 'responseView']);
Route::get('/response/type/json', [\App\Http\Controllers\ResponseController::class, 'responseJson']);
Route::get('/response/type/file', [\App\Http\Controllers\ResponseController::class, 'responseFile']);
Route::get('/response/type/download', [\App\Http\Controllers\ResponseController::class, 'responseDownload']);

// Cookie
Route::get('/cookie/set',[\App\Http\Controllers\CookieController::class, 'createCookie']);
Route::get('/cookie/get',[\App\Http\Controllers\CookieController::class, 'getCookie']);
Route::get('/cookie/clear',[\App\Http\Controllers\CookieController::class, 'clearCookie']);
