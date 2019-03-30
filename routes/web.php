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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);



Route::middleware(['auth','verified'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/accounts', 'AccountController@showAddAccountForm')->name('addAccountForm');
    Route::post('/accounts','AccountController@addAccount')->name('addAccount');

    Route::get('/goals', 'GoalController@showAddGoalForm')->name('addGoalForm');
    Route::post('/goals', 'GoalController@addGoal')->name('addGoal');

    Route::get('/goals/complete','GoalController@completedGoalsForm')->name('completedGoals');
    Route::get('/goals/incomplete','GoalController@incompleteGoalsForm')->name('incompleteGoals');


    Route::get('/transactions','TransactionController@showAddTransactionForm')->name('addTransactionForm');
    Route::post('/transactions','TransactionController@addTransaction')->name('addTransaction');


    Route::get('/summary','SummaryController@showTransactionSummaryForm')->name('transactionSummaryForm');
    Route::post('/summary','SummaryController@transactionSummary')->name('transactionSummary');


    Route::get('/about', 'HomeController@aboutPage')->name('about');
    Route::get('/password/update', function(){
        \Illuminate\Support\Facades\Auth::logout();
       return redirect('/password/reset');
    })->name('pasword_update');

    Route::get('/mail', function () {

        $invoice = ["asdfa","asdfasd","asdfadfasdf"];

        return new App\Mail\GoalReached($invoice,"sdfasd");
    });

});