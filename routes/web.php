<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Post;

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

Route::redirect('/', '/posts');

Route::get('/sign-in', function() {
    return view('sign-in');
})
->name('login');

Route::post('/sign-in', function(Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        return redirect()->intended(route('posts.index'));
    }

    return back()->withErrors(['email' => 'E-mail or password do not match.']);
})
->name('authenticate');

Route::get('/sign-out', function(Request $request) {

    $request->session()->flush();

    return redirect('sign-in');
})
->name('logout');

Route::middleware('auth')->resource('posts', Post::class);
