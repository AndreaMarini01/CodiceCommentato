<?php

use App\Http\Controllers\aziendaController;
use App\Http\Controllers\faqController;
use App\Http\Controllers\filterController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\promozioniController;
use App\Http\Controllers\publicController;
use App\Http\Controllers\staffController;
use App\Http\Controllers\statsController;
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

//Alcune rotte dell'area pubblica
Route::get('/', [publicController::class, 'home'])->name('home');
Route::get('/home', [publicController::class, 'home'])->name('home');

//Rotte per il login, signup e logout
Route::get('/login', [loginController::class, 'login'])->name('login');
Route::post('/login', [loginController::class, 'loginPost'])->name('loginPost');
Route::get('/signup', [loginController::class, 'signup'])->name('signup');
Route::post('/signup', [loginController::class, 'signupPost'])->name('signupPost');
Route::post('/logout', [loginController::class, 'logout'])->name('logout');


//Rotta per i filtri
Route::get('/listaPromozioni/filtered', [filterController::class, 'filter'])->name('filtri');


//Rotte per il CRUD delle promozioni
Route::get('/listaPromozioni', [promozioniController::class, 'listaPromozioni'])->name('listaPromozioni');
Route::get('/visualPromozione', [promozioniController::class, 'visualPromozione'])->name('visualPromozione');
Route::post('/eliminaPromozione', [promozioniController::class, 'eliminaPromozione'])->name('eliminaPromozione')
    ->middleware('can:isStaff');
Route::post('/editPromozione', [promozioniController::class, 'editPromozione'])->name('editPromozione')
    ->middleware('can:isStaff');
Route::post('/creaPromozione', [promozioniController::class, 'creaPromozione'])->name('creaPromozione')
    ->middleware('can:isStaff');
Route::get('/promozioneCreator', [promozioniController::class, 'promozioneCreator'])->name('promozioneCreator')
    ->middleware('can:isStaff');
Route::get('/modificaPromozione', [promozioniController::class, 'modificaPromozione'])->name('modificaPromozione')
    ->middleware('can:isStaff');


//Rotte per il profilo
Route::get('/profile', [profileController::class, 'profilo'])->name('profile')->middleware('can:isUserOrisStaff');
Route::get('/modificaProfilo', [profileController::class, 'modificaProfilo'])->name('modificaProfilo')
   ->middleware('can:isUserOrisStaff');
Route::post('/modificaProfilo',[profileController::class, 'modificaProfiloPost'])->name('modificaProfiloPost');

//Rotte per il CRUD delle aziende
Route::get('/listaAziende', [aziendaController::class, 'listaAziende'])->name('listaAziende'); //Lista delle Aziende
Route::get('/azienda', [aziendaController::class, 'visualAzienda'])->name('azienda'); //Visualizzazione Azienda Singola
#Route::post('/aziendaDiego', [aziendaController::class, 'visualAzienda'])->name('aziendaDiego');
Route::get('/aziendaCreator', [aziendaController::class, 'aziendaCreator'])->name('aziendaCreator')
    ->middleware('can:isAdmin'); //va alla pagina di creazione dell'azienda
Route::post('/aziendaCreator', [aziendaController::class, 'creaAzienda'])->name('createAzienda')
    ->middleware('can:isAdmin'); //crea l'azienda
Route::post('/aziendaDelete/{idAzienda}', [aziendaController::class, 'eliminaAzienda'])->name('aziendaDelete')
    ->middleware('can:isAdmin'); //Eliminazione Azienda
Route::post('/saveAzienda/{idAzienda}', [aziendaController::class, 'editAzienda'])->name('saveAzienda')
    ->middleware('can:isAdmin');//salva le modifiche per l'azienda (sarebbe (ModificaAziendaDiego in metodo Post)
Route::get('/modificaAzienda', [aziendaController::class, 'modificaAzienda'])->name('modificaAzienda')
    ->middleware('can:isAdmin'); //va alla pagina di modifica dell'azienda

//faq
Route::get('/faq', [faqController::class, 'faq'])->name('faq');
Route::get('/faqedit/{id}', [faqController::class, 'faqedit'])->name('faqedit')->middleware('can:isAdmin');
Route::get('/faqdelete/{id}', [faqController::class, 'faqdelete'])->name('faqdelete')->middleware('can:isAdmin');
Route::get('/saveFaq/{id}', [faqController::class, 'savefaq'])->name('salvaFaq')->middleware('can:isAdmin');
Route::get('/createfaq', [faqController::class, 'faqCreate'])->name('creaFaq')->middleware('can:isAdmin');

//Statistiche
Route::get('/statistiche',[statsController::class, 'stats'])->name('statistiche')
    ->middleware('can:isAdmin');

//Promozione Utente liv1
Route::get('/salvaCoupon', [promozioniController::class, 'salvaCoupon'])->name('salvaCoupon')
    ->middleware('can:isUser');
Route::get('/couponSalvati', [promozioniController::class, 'couponSalvati'])->name('couponSalvati')
    ->middleware('can:isUser');


//CRUDStaff
Route::get('/listaStaff', [staffController::class, 'listaStaff'])->name('listaUtenti')
    ->middleware('can:isAdmin');
Route::get('/eliminaStaff', [staffController::class, 'eliminaStaff'])->name('eliminaStaff')
    ->middleware('can:isAdmin');
Route::post('/editStaff', [staffController::class, 'editStaff'])->name('editStaff')
    ->middleware('can:isAdmin');
Route::post('/creaStaff', [staffController::class, 'creaStaff'])->name('creaStaff')
    ->middleware('can:isAdmin');
Route::get('/staffCreator', [staffController::class, 'staffCreator'])->name('staffCreator')
    ->middleware('can:isAdmin');
Route::get('/modificaStaff', [staffController::class, 'modificaStaff'])->name('modificaStaff')
    ->middleware('can:isAdmin');
