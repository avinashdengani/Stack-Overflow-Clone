<?php

use App\Http\Controllers\AnswersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VotesController;
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


Route::get('/', [DashboardController::class, 'index'])->name('index');

Auth::routes();

Route::resource('questions', QuestionsController::class)->except('show');
Route::get('questions/favorites', [FavoritesController::class, 'index'])->name('questions.favorites')->middleware(['auth']);
Route::get('questions/your-questions', [QuestionsController::class, 'yourQuestions'])->name('questions.your-questions')->middleware(['auth']);
Route::get('questions/{slug}', [QuestionsController::class, 'show'])->name('questions.show');
Route::resource('questions.answers', AnswersController::class)->except(['index', 'create', 'show']);
Route::put('answers/{answer}/mark-best-answer', [AnswersController::class, 'markbestAnswer'])->name('answers.markBestAnswer');
Route::put('answers/{answer}/unmark-best-answer', [AnswersController::class, 'unmarkBestAnswer'])->name('answers.unmarkBestAnswer');
Route::put('questions/{question}/favorite',[FavoritesController::class, 'favorite'] )->name('questions.favorite');
Route::put('questions/{question}/unfavorite',[FavoritesController::class, 'unfavorite'] )->name('questions.unfavorite');
Route::post('questions/{question}/vote/{vote}',[VotesController::class, 'voteQuestion'])->name('questions.vote');
Route::post('answers/{answer}/vote/{vote}',[VotesController::class, 'voteAnswer'])->name('answers.vote');
Route::get('users/notifications', [UsersController::class, 'notifications'])->name('users.notifications');
