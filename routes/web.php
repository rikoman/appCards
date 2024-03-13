<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Models\Card;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('project.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


/**
 * model project
 */
Route::prefix('/app/projects')->group(function () {
    Route::get('/', [ProjectController::class,'index'])->name('project.index');
    Route::get('/create', [ProjectController::class, 'create'])->name('project.create')->middleware('auth');
    Route::post('/', [ProjectController::class, 'store'])->name('project.store')->middleware('auth');
    Route::get('/home', [ProjectController::class, 'home'])->name('project.home')->middleware('auth');
    Route::get('/sub', [ProjectController::class, 'subProjects'])->name('project.sub')->middleware('auth');

    Route::prefix('/{project}')->group(function () {
        Route::get('/', [ProjectController::class, 'show'])->name('project.show');

        Route::get('/edit', [ProjectController::class, 'edit'])->name('project.edit')->middleware(['auth', 'can:update,project']);
        Route::patch('/', [ProjectController::class, 'update'])->name('project.update')->middleware(['auth', 'can:update,project']);
        Route::delete('/', [ProjectController::class, 'destroy'])->name('project.destroy')->middleware(['auth', 'can:delete,project']);

        Route::post('/sub', [ProjectController::class, 'subscribed'])->name('project.subscribed');
        Route::post('/unsub', [ProjectController::class, 'unsubscribed'])->name('project.unsubscribed');

    });
});

/**
 * model category
 */
Route::prefix('/app/projects/{project}/categories')->group(function () {
    Route::get('/create', [CategoryController::class, 'create'])->name('category.create')->middleware('auth')->can('create', [Category::class, 'project']);
    Route::post('/', [CategoryController::class, 'store'])->name('category.store')->middleware('auth')->can('create', [Category::class, 'project']);

    Route::prefix('/{category}')->group(function () {
        Route::get('/', [CategoryController::class, 'show'])->name('category.show');
        Route::get('/edit', [CategoryController::class, 'edit'])->name('category.edit')->middleware(['auth', 'can:update,category']);
        Route::patch('/', [CategoryController::class, 'update'])->name('category.update')->middleware(['auth', 'can:update,category']);
        Route::delete('/', [CategoryController::class, 'destroy'])->name('category.destroy')->middleware(['auth', 'can:delete,category']);
    });
});

/**
 * model card
 */
Route::prefix('/app/projects/{project}/categories/{category}/cards')->group(function () {
    Route::get('/create', [CardController::class, 'create'])->name('card.create')->middleware('auth')->can('create', [Card::class, 'project']);
    Route::post('/', [CardController::class, 'store'])->name('card.store')->middleware('auth')->can('create', [Card::class, 'project']);

    Route::prefix('/{card}')->group(function () {
        Route::get('/edit', [CardController::class, 'edit'])->name('card.edit')->middleware(['auth', 'can:update,card']);
        Route::patch('/', [CardController::class, 'update'])->name('card.update')->middleware(['auth', 'can:update,card']);
        Route::delete('/', [CardController::class, 'destroy'])->name('card.destroy')->middleware(['auth', 'can:delete,card']);
    });
});

/**
 * model comment for project
 */
Route::prefix('/app/projects/{project}/comments')->group(function () {
    Route::post('/', [CommentController::class, 'storeForProject'])->name('project.comment.store');
    Route::get('/{comment}/edit', [CommentController::class, 'edit'])->name('project.comment.edit');
    Route::patch('/{comment}', [CommentController::class, 'updateForProject'])->name('project.comment.update');
    Route::delete('/{comment}', [CommentController::class, 'destroyForProject'])->name('project.comment.destroy');
});

/**
 * model comment for category
 */
Route::prefix('/app/projects/{project}/categories/{category}/comments')->group(function () {
    Route::post('/', [CommentController::class, 'storeForCategory'])->name('category.comment.store');
    Route::get('/{comment}/edit', [CommentController::class, 'edit'])->name('category.comment.edit');
    Route::patch('/{comment}', [CommentController::class, 'updateForCategory'])->name('category.comment.update');
    Route::delete('/{comment}', [CommentController::class, 'destroyForCategory'])->name('category.comment.destroy');
});

/**
 * export and import model card
 */
Route::prefix('/app/projects/{project}/categories/{category}/cards')->group(function (){
    Route::get('/export', [CardsController::class, 'export'])->name('card.export');
    Route::post('/import', [CardsController::class, 'import'])->name('card.import');
});
