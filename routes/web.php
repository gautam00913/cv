<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\VisitController;
use App\Livewire\Competences\Index;
use App\Livewire\Competences\Subtitle;
use App\Livewire\Competences\Title;
use App\Livewire\Dashboard;
use App\Livewire\Educations\Index as EducationsIndex;
use App\Livewire\Experiences\Index as ExperiencesIndex;
use App\Livewire\HomePage;
use App\Livewire\Portfolios\Index as PortfoliosIndex;
use App\Livewire\Profile\CoverPicture;
use App\Livewire\Profile\ShowProfile;
use App\Livewire\Setting;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class);
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'authenticate')->name('authenticate');
    Route::delete('/logout', 'logout')->name('logout');
});
Route::middleware('auth')->group(function(){
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/cover-picture', CoverPicture::class)->name('cover_picture');
    Route::get('/profile', ShowProfile::class)->name('profile');
    Route::get('/competences', Index::class)->name('competences');
    Route::get('/competences/titles/{title}', Title::class)->name('competences.title');
    Route::get('/competences/subtitles/{subtitle}', Subtitle::class)->name('competences.subtitle');
    Route::get('/educations', EducationsIndex::class)->name('educations');
    Route::get('/experiences', ExperiencesIndex::class)->name('experiences');
    Route::get('/portfolios', PortfoliosIndex::class)->name('portfolios');
    Route::get('/setting', Setting::class)->name('setting');
});
Route::post('visits', VisitController::class)->name('visits.store');
