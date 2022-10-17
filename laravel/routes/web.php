<?php

use Illuminate\Support\Facades\Route;
use TheSeer\Tokenizer\Exception;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/iu', function(){
    return "Halo Informatika Unmul";
});

Route::redirect('/youtube', 'iu');

Route::fallback(function(){
    return "404";
});

Route::view('/hello', 'hello', ['name' => 'Tegar']);

Route::get('/hello-again', function(){
    return view('hello', ['name' => 'Tegar']);
});

Route::get('/hello-world', function(){
    return view('hello.world', ['name' => 'Tegar']);
});

Route::get('/products/{id}', function($productId){
    return "Products : ". $productId;
})->name('product.detail');

Route::get('/products/{product}/items/{item}', function($productId, $itemId){
    return "Products : ".$productId.", Items : ".$itemId;
})->name('product.item.detail');

Route::get('/categories/{id}', function(string $categoryId){
    return "Categories : ".$categoryId;
})->where('id', '[0-9]+')->name('category.detail');

Route::get('users/{id}', function (string $userId = '404') {
    return "Users : ".$userId;
})->name('user.detail');

Route::get('/produk/{id}', function ($id) {
    $link = route('product.detail',[
        'id' => $id
    ]);
    return "Link : ".$link;
});

Route::get('/produk-redirect/{id}', function ($id) {
    return redirect()->route('product.detail', [
        'id' => $id
    ]);
});

Route::get('/conflict/{name}', function (string $name) {
    return 'Conflict '.$name;
});

Route::get('/conflict/tegar', function () {
    return 'conflict Tegar Fitrah';
});

Route::get('/controller/hello/{name}', [\App\Http\Controllers\HelloController::class, 'hello']);

Route::get('/controller/hello/request', [\App\Http\Controllers\HelloController::class, 'request']);

Route::get('/input/hello/', [\App\Http\Controllers\InputController::class, 'hello']);
Route::post('/input/hello/', [\App\Http\Controllers\InputController::class, 'hello']);

Route::get('/input/hello/first', [\App\Http\Controllers\InputController::class, 'helloFirst']);

Route::get('/input/hello/input', [\App\Http\Controllers\InputController::class, 'helloInput']);

Route::post('/input/hello/array', [\App\Http\Controllers\InputController::class, 'arrayInput']);

Route::post('/input/type', [\App\Http\Controllers\InputController::class, 'inputType']);

Route::post('/input/filter/only', [\App\Http\Controllers\InputController::class, 'filterOnly']);
Route::post('/input/filter/except', [\App\Http\Controllers\InputController::class, 'filterExcept']);

Route::post('/input/filter/merge', [\App\Http\Controllers\InputController::class, 'filterMerge']);

Route::post('/file/upload', [\App\Http\Controllers\FileController::class, 'upload'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

Route::get('/response/hello', [\App\Http\Controllers\ResponseController::class, 'response']);

Route::get('/response/header', [\App\Http\Controllers\ResponseController::class, 'header']);

Route::prefix('response/type')->group(function(){
    Route::get('/view', [\App\Http\Controllers\ResponseController::class, 'responseView']);
    Route::get('/json', [\App\Http\Controllers\ResponseController::class, 'responseJson']);
    Route::get('/file', [\App\Http\Controllers\ResponseController::class, 'responseFile']);
    Route::get('/download', [\App\Http\Controllers\ResponseController::class, 'responseDownload']);
});

Route::controller(\App\Http\Controllers\CookieController::class)->group(function(){
    Route::get('/cookie/set', 'createCookie');
    Route::get('/cookie/get', 'getCookie');
    Route::get('/cookie/clear', 'clearCookie');
});


Route::get('/redirect/from', [\App\Http\Controllers\RedirectController::class, 'redirectFrom']);
Route::get('/redirect/to', [\App\Http\Controllers\RedirectController::class, 'redirectTo']);

Route::get('/redirect/name', [\App\Http\Controllers\RedirectController::class, 'redirectName']);
Route::get('/redirect/name/{name}', [\App\Http\Controllers\RedirectController::class, 'redirectHello'])
    ->name('redirect-hello');
Route::get('/url/named', function(){
    return route('redirect-hello', ['name' => 'Tegar']);
});
Route::get('/redirect/action', [\App\Http\Controllers\RedirectController::class, 'redirectAction']);

Route::get('/redirect/pzn', [\App\Http\Controllers\RedirectController::class, 'redirectAway']);

Route::middleware(['sample:PZN,401'])->prefix('/middleware')->group(function(){
    Route::get('/middleware/api', function () {
        return "OK";
    });
});

Route::get('/url/action', function () {
    return action([\App\Http\Controllers\FormController::class, 'form'], []);
});
Route::get('/form', [\App\Http\Controllers\FormController::class, 'form']);
Route::post('/form', [\App\Http\Controllers\FormController::class, 'submitform']);

Route::get('/url/current', function () {
    return \Illuminate\Support\Facades\URL::full();
});

Route::get('/session/create', [\App\Http\Controllers\SessionController::class, 'createSession']);

Route::get('/session/get', [\App\Http\Controllers\SessionController::class, 'getSesssion']);

Route::get('/error/sample', function () {
    throw new Exception("Sample Error");
});

Route::get('/error/manual', function () {
    report(new Exception("Sample Error"));
    return "OK";
});

Route::get('/error/validation', function () {
    throw new \App\Exceptions\ValidationException("Validation Error");
});

Route::get('/abort/400', function () {
    abort(400);
});
Route::get('/abort/401', function () {
    abort(401);
});
Route::get('/abort/500', function () {
    abort(500);
});
