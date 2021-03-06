<?php

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

Route::get('/', 'MainController@home');
Route::get('/cart', 'ShoppingCartsController@index');
Route::get('/cart', 'ShoppingCartsController@checkout');
Route::get('/payments/store', 'PaymentsController@store');
Route::get('/redirect', function () {

    $query = http_build_query([
        'client_id' => '3',
        'redirect_uri' => 'http://client-server.test:8001/callback',
        'response_type' => 'code',
        'scope' => ''
    ]);

    return redirect('http://poll.test:8001/oauth/authorize?'.$query);
});

Route::get('/callback', function (Illuminate\Http\Request $request) {
    $http = new \GuzzleHttp\Client;

    $response = $http->post('http://poll.test:8001/oauth/token', [
        'form_params' => [
            'client_id' => '3',
            'client_secret' => '192HjRSsPrh3oV7rMTqZybKZ9RTA0BD26ev4Tgwa',
            'grant_type' => 'authorization_code',
            'redirect_uri' => 'http://client-server.test:8001/callback',
            'code' => $request->code,
        ],
    ]);
    return json_decode((string) $response->getBody(), true);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('products', 'ProductsController');
Route::resource('in_shopping_carts', 'InShoppingCartsController', [
    'only' => ['store', 'destroy']
]);

Route::resource('compras', 'ShoppingCartsController', [
    'only' => ['show']
]);
Route::resource('orders', 'OrdersController', [
    'only' => ['index', 'update']
]);
Route::get('products/images/{filename}', function ($filename) {
    $path = storage_path('/app/images/'.$filename);

    if (!\File::exists($path)) {
        abort(404);
    }

    $file = \File::get($path);
    $type = \File::mimeType($path);
    $response = Response::make($file,200);
    $response->header("Content-Type", $type);
    return $response;
});
