<?php

use App\Http\Controllers\ProfileController;
use App\Models\Clip;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

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

Route::get('/{slug}', function () {

    $slug = request()->route()->parameter('slug');

    $clip = Clip::where('slug', $slug)->select(['body'])->first();

// dd(Clip::all());

    return Inertia::render('Welcome', [
        'slug' => $slug,
        'clip' => $clip,
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::post('/clip', function () {
    $validated = request()->validate([
        'body' => ['required', 'min:1'],
        'slug' => ['required', 'min:1'],
    ]);

    Clip::updateOrInsert(
        ['slug' => $validated["slug"]],
        $validated
    );

    return back()->withInput();
});
