<?php

use Illuminate\Support\Facades\Route;
// Frontend Routes:
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\AboutController;
use App\Http\Controllers\Front\BlogController;
use App\Http\Controllers\Front\ContactController;
// Admin Routes:
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\HomePageController;
use App\Http\Controllers\Admin\AboutPageController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\LiveChatController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PageMangerController;
use App\Http\Controllers\PhotoGalaryController;


Route::get('/register', function () {
    return redirect('/login'); // Redirect from register to login
})->name('register');

// Admin routes
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    Route::get('/blog-posts', [BlogPostController::class, 'index'])->name('admin.blog');
    Route::get('/blog-posts/create', [BlogPostController::class, 'create'])->name('admin.blog.create');
    Route::post('/blog-posts', [BlogPostController::class, 'store'])->name('admin.blog.store');
    Route::get('/blog-posts/{id}', [BlogPostController::class, 'edit'])->name('admin.blog.edit');
    Route::put('/blog-posts/{id}', [BlogPostController::class, 'update'])->name('admin.blog.update');
    Route::delete('/blog-posts/{id}', [BlogPostController::class, 'destroy'])->name('admin.blog.destroy');
    Route::delete('/blog-posts/{id}/image', [BlogPostController::class, 'deleteImage'])->name('admin.blog.deleteImage');
    

    Route::get('/home-page', [HomePageController::class, 'index'])->name('admin.home');
    Route::get('/home-page/create', [HomePageController::class, 'create'])->name('admin.home.create');
    Route::post('/home-page', [HomePageController::class, 'store'])->name('admin.home.store');
    Route::get('/home-page/{id}', [HomePageController::class, 'edit'])->name('admin.home.edit');
    Route::put('/home-page/{id}', [HomePageController::class, 'update'])->name('admin.home.update');
    Route::delete('/home-page/{id}', [HomePageController::class, 'destroy'])->name('admin.home.destroy');
    Route::delete('/home-page/{id}/image', [HomePageController::class, 'deleteImage'])->name('admin.home.deleteImage');
    

    Route::get('/about-page', [AboutPageController::class, 'index'])->name('admin.about');
    Route::get('/about-page/create', [AboutPageController::class, 'create'])->name('admin.about.create');
    Route::post('/about-page', [AboutPageController::class, 'store'])->name('admin.about.store');
    Route::get('/about-page/{id}', [AboutPageController::class, 'edit'])->name('admin.about.edit');
    Route::put('/about-page/{id}', [AboutPageController::class, 'update'])->name('admin.about.update');
    Route::delete('/about-page/{id}', [AboutPageController::class, 'destroy'])->name('admin.about.destroy');

    Route::get('/messages', [ContactMessageController::class, 'index'])->name('admin.messages');
    Route::get('/messages/{id}', [ContactMessageController::class, 'show'])->name('admin.messages.show');
    Route::delete('/messages/{id}', [ContactMessageController::class, 'destroy'])->name('admin.messages.destroy');
});

Route::middleware(['auth:sanctum', 'verified'])->prefix('manager')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('manager');
    Route::get('/page-manager', [PageMangerController::class, 'index'])->name('page_manager');
    Route::get('/edit/{slug}', [PageMangerController::class, 'edit'])->name('page_manager.modify');
    Route::post('/edit/{slug}', [PageMangerController::class, 'modifyed'])->name('page_manager.modifyed');
    Route::get('page/create', [PageMangerController::class, 'viewCreate'])->name('page_manager.create');
    Route::post('page/created', [PageMangerController::class, 'storeCreate'])->name('page_manager.created');
    Route::get('page/delete/{page_id}', [PageMangerController::class, 'destroy'])->name('page.destroy');
    Route::get('blogs', [BlogController::class, 'ListBlogs'])->name('manager.blogs.list');
    Route::get('/galary', [PhotoGalaryController::class, 'Lists'])->name('manager.galary');
    Route::get('/api/galary', [PhotoGalaryController::class, 'ApiFetch'])->name('manager.galary.fechtApi');
    Route::post('/upload-image', [PhotoGalaryController::class, 'uploadImage'])->name('manager.uploadImage');
    Route::post('/upload-url', [PhotoGalaryController::class, 'uploadUrl'])->name('uploadUrl');
    Route::post('/remove-item', [PhotoGalaryController::class, 'removeItem'])->name('removeItem');
});




// Frontend routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('demo/{sluge}', [HomePageController::class, 'pageRender'])->name('page_demo');

Route::get('blog/view/{slug}', [BlogController::class, 'View'])->where('slug', '.*');

// Frontend Routes for Blog Posts
Route::prefix('blogs')->name('blog.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Front\BlogController::class, 'index'])->name('index');
//     Route::get('/{slug}', [\App\Http\Controllers\Front\BlogController::class, 'show'])->name('show');
});

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


Route::post('/telegram/webhook', [TelegramController::class, 'handleWebhook']);

Route::post('/live-chat/send', [LiveChatController::class, 'sendMessage']);
Route::get('/live-chat/messages', [LiveChatController::class, 'getMessages']);
Route::get('language/{lang}', [LanguageController::class, 'switchLang'])->name('language.switch');

