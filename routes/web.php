<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CategoriesController;

use App\Http\Controllers\StatsadminController;

use App\Http\Controllers\SubscriberController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FluxRSSController;
use App\Http\Controllers\test;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use \App\Http\Controllers\FavorisController;
use App\Http\Controllers\Post;
use App\Models\post as ModelsPost;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', function () {
    return view('authentication.login');
})->name('login');

Route::get('/register', function () {
    return view('authentication.register');
})->name('register');

Route::get('/forget', function () {
    return view('authentication.forget');
})->name('forget');

Route::post('/forget/send', [AuthController::class, 'send_email'])->name('send_email');
Route::get('/reset/{email}/{token}', [AuthController::class, 'reset'])->name('reset');
Route::post('/reset/password', [AuthController::class, 'reset_password'])->name('reset_password');



// Route::get('/reset/{token}',function (){
//     return view('authentication.reset');
// });

Route::get('/',[UserController::class , 'index'])->name('home');
Route::get('/favoris' ,[UserController::class , 'getFavoritePosts']);


Route::get('/dashboard',function(){
    return view('admin.dashboard');
})->name('dashboard');

Route::post('/register/send', [AuthController::class, 'register'])->name('register.send');
Route::post('/login/send', [AuthController::class, 'login'])->name('login.send');




/**--- fati ----**/
Route::get('/categories',[CategoriesController::class,'index'])->name('categories');
Route::post('/categories',[CategoriesController::class,'store'])->name('add-category');
Route::put('/categories',[CategoriesController::class,'update'])->name('update-category');
Route::delete('/categories',[CategoriesController::class,'delete'])->name('delete-category');

/**--- fati ----**/

Route::post('/home' ,[subscriberController::class, 'addSubscriber'])->name('add_subscriber');


/** ---- Mohammed ---- **/

Route::get('/addRss', [FluxRSSController::class, 'addRssPage'])->name('addRss.index');
Route::post('/addRss', [FluxRSSController::class, 'store'])->name('addRss.store');

Route::get('/showRss', [FluxRSSController::class, 'showRss'])->name('rss.index');
Route::post('/showRss', [FluxRSSController::class, 'showRss'])->name('rss.send');

/** ---- Mohammed ---- **/




/*======================  mohammed elghanam  =======================*/
Route::get('/display',[UserController::class, 'displayUsers'])->name('users');

/*======================  mohammed elghanam  =======================*/

//Route::get('/dashboard',function(){
//    return view('admin.dashboard');
//})->name('dashboard');



/*============================== Walid Saifi ============================*/

Route::get('/api/donnees-graphique', [StatsadminController::class, 'tendanceEnregistrementUtilisateur']);
Route::get('/api/nbrUser', [StatsadminController::class, 'nombreUtilisateurs']);
Route::get('/api/tendances', [StatsadminController::class, 'tendancePosts'])->name('tendances');
Route::get('/api/nbrUser', [StatsadminController::class, 'nombreUtilisateursPost']);

Route::get('/api/getNombreJours', [StatsadminController::class, 'getNombreJours']);

Route::get('/api/getNombrePostsJours', [StatsadminController::class, 'getNombrePostsJours']);


Route::get('/Trends',[Post::class,'displayTrendingNews']);
Route::get('/post/{postId}', [Post::class, 'getPostByidNotAuth']);

// Route::get('/newData',[Post::class,'getPosts']);




route::get('page/{categorie}',[CategoriesController::class,'GetPostsByCategory'])->name('page');
route::get('detail/{id}',[Post::class,'GetPostsById'])->name('detail');

