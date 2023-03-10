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
Route::redirect('/youtube', '/pzn');

// menampilkan halaman 404 ke route yang tidak ada tujuan
Route::fallback(function () {
    return '404 by Febri Ananda Lubis';
});

// melakukan view melalui file blade
Route::view('/hello', 'hello', ['name' => 'Febri']);

Route::get('hello-again', function () {
    return view('hello', ['name' => 'Febri']);
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
Route::get('/controller/hello/request', [\App\Http\Controllers\HelloController::class, 'request']);
Route::get('/controller/hello/{name}', [\App\Http\Controllers\HelloController::class, 'hello']);

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
Route::post('/file/upload', [\App\Http\Controllers\FileController::class, 'upload'])->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

// Get Response
Route::get('/response/hello', [\App\Http\Controllers\ResponseController::class, 'response']);
Route::get('/response/header', [\App\Http\Controllers\ResponseController::class, 'header']);

// Response type
// Route group
Route::prefix("/response/type")->group(function () {
    Route::get('/view', [\App\Http\Controllers\ResponseController::class, 'responseView']);
    Route::get('/json', [\App\Http\Controllers\ResponseController::class, 'responseJson']);
    Route::get('/file', [\App\Http\Controllers\ResponseController::class, 'responseFile']);
    Route::get('/download', [\App\Http\Controllers\ResponseController::class, 'responseDownload']);
});

// Route controller group
Route::controller(\App\Http\Controllers\CookieController::class)->group(function () {
    // Cookie
    Route::get('/cookie/set', 'createCookie');
    Route::get('/cookie/get', "getCookie");
    Route::get('/cookie/clear', "clearCookie");
});

// Redirect
Route::get("/redirect/from", [\App\Http\Controllers\RedirectController::class, 'redirectFrom']);
Route::get("/redirect/to", [\App\Http\Controllers\RedirectController::class, 'redirectTo']);
Route::get("/redirect/name", [\App\Http\Controllers\RedirectController::class, "redirectName"]);

Route::get("/redirect/name/{name}", [\App\Http\Controllers\RedirectController::class, "redirectHello"])
    ->name("redirect-hello");
Route::get("/redirect/named", function () {
    // return \route('redirect-hello', ["name" => "Febri"]);
    // return url()->route('redirect-hello', ["name" => "Febri"]);
    return \Illuminate\Support\Facades\URL::route('redirect-hello', ["name" => "Febri"]);
});

Route::get("/redirect/action", [\App\Http\Controllers\RedirectController::class, "redirectAction"]);
Route::get("/redirect/away", [\App\Http\Controllers\RedirectController::class, "redirectAway"]);

// Group midlleware
Route::middleware(['contoh:RYZ,401'])->prefix("/middleware")->group(function () {
    // Contoh menggunakan middleware
    Route::get('/api', function () {
        return "OK";
    });
    // Middleware Group
    Route::get("/group", function () {
        return "GROUP";
    });
});

// csrf
// url action
Route::get('/url/action', function () {
    // return action([\App\Http\Controllers\FormController::class, 'form'], []);
    // return url()->action([\App\Http\Controllers\FormController::class, 'form'], []);
    return \Illuminate\Support\Facades\URL::action([\App\Http\Controllers\FormController::class, 'form'], []);
});
Route::get('/form', [\App\Http\Controllers\FormController::class, 'form']);
Route::post('/form', [\App\Http\Controllers\FormController::class, 'submitForm']);

// Url Generation
Route::get("/url/current", function () {
    return \Illuminate\Support\Facades\URL::full();
});

// Membuat session
Route::get("/session/create",[\App\Http\Controllers\SessionController::class, 'createSession']);
Route::get("/session/get",[\App\Http\Controllers\SessionController::class, 'getSession']);

// Error Handling
Route::get("/errors/sample", function () {
   throw new Exception("Sample Error");
});

Route::get("/errors/manual", function () {
   report(new Exception("Sample Error"));
   return "OK";
});

Route::get('/errors/validation', function () {
    throw new \App\Exceptions\ValidationException("Validation Error");
});

// HTTP Exception
Route::get('abort/400', function () {
   abort(400, "Ups Validation Error");
});
Route::get('abort/401', function () {
    abort(401);
});
Route::get('abort/500', function () {
    abort(500);
});
