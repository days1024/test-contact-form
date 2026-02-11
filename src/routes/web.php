<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Validation\ValidationException;
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

Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/thanks', [ContactController::class, 'thanks']);
Route::get('/search', [ContactController::class, 'search']);
Route::delete('/delete', [ContactController::class, 'delete']);
Route::middleware('auth')->group(function () {
Route::get('/admin', [ContactController::class, 'admin']);});
Route::post('/reset', [ContactController::class, 'reset']);
Route::get('/export', [ContactController::class, 'export']);

Route::post('/register', function(RegisterRequest $request){
    $input = $request->validated();
    $user = app(\App\Actions\Fortify\CreateNewUser::class)->create($input);
     Auth::login($user);
    return redirect('/admin');
});

Route::post('/login', function(LoginRequest $request) {
    $credentials = $request->only('email', 'password');

    if (!Auth::attempt($credentials)) {
        throw ValidationException::withMessages([
            'password' => [$request->messages()['credentials']], // email に紐付ける
        ]);
    }

    $request->session()->regenerate();
    return redirect()->intended('/admin');
})->name('login');


Route::post('/logout', function () {
    auth()->logout();                       
    request()->session()->invalidate();     
    request()->session()->regenerateToken();
    return redirect('/login');              
})->name('logout');