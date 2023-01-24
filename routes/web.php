<?php

use App\Http\Controllers\DemandeController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DossierController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\UserController;
use App\Models\Dossier;
use App\Models\Entreprise;

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
    return view('acceuil');
});

Route::post('/creerCompte',[EntrepriseController::class,'store'])->name('entreprises.store');

Route::post('/loginPost',[UserController::class,'login'])->name('users.login');


Route::post('/ajouterEmp',[UserController::class,'ajouterEmp'])->name('ajouterEmp');


Route::post('/creerSection',[SectionController::class,'creerSection'])->name('creerSection');


Route::post('/uploader/{section_id}',[DocumentController::class,'uploaderDoc'])->name('uploaderDoc');


Route::post('/creerDossier/{section_id}',[DossierController::class,'creerDossier'])->name('creerDossier');

Route::post('/uploader/{section_id}/{dossier_id}',[DocumentController::class,'uploaderDocInFolder']);

Route::get('/download/{id_doc}',[DocumentController::class,'download'])->name('download');

Route::get('/delete/{id_doc}',[DocumentController::class,'delete'])->name('delete');


Route::get('/deleteEmp/{id}',[DocumentController::class,'deleteEmp'])->name('deleteEmp');

Route::get('/deleteFolder/{id_folder}',[DossierController::class,'deleteFolder']);

Route::get('/page',[UserController::class,'page']);

Route::get('/users',[UserController::class,'show']);


Route::post('/changeImage',[UserController::class,'changeImage'])->name('changeImage');


Route::post('/updateUser',[UserController::class,'update'])->name('updateEmployee');


Route::get('/sections',[SectionController::class,'section']);

Route::post('/updateEntreprise',[EntrepriseController::class,'updateEntreprise'])->name('updateEntreprise');

Route::get('/sections/{sections_id}',[SectionController::class,'selectSection']);

Route::get('/sections/{section_id}/{dossier_id}',[DossierController::class,'show']);

Route::get('/deleteSection/{section_id}',[SectionController::class,'deleteSection']);

Route::get('/compte',[EntrepriseController::class,'compte']);


Route::get('/liste',[EntrepriseController::class,'listeUsers'])->name('listeUsers');

Route::get('/liste/{user_id}',[EntrepriseController::class,'supprimerUser'])->name('listeUsers');

Route::get('/DeleteUser/{user_id}',[EntrepriseController::class,'oui']);
Route::get('/ajouter',[UserController::class,'ajouter']);


Route::get('/details/{id}',[UserController::class,'detaille'])->name('details');


Route::get('/documents/{employee_id}',[DocumentController::class,'documents']);


Route::get('/demandes',[DemandeController::class,'demandes']);


Route::get("/settings",[DocumentController::class,'settings']);



Route::get('/edit',[DocumentController::class,'editDoc']);


Route::get("/searchNbDoc",[UserController::class,'searchNbDoc']);

Route::get("/searchDoc",[UserController::class,'searchDoc']);

Route::get("/searchNbEmp",[UserController::class,'searchNbEmp']);

Route::get("/searchEmp",[UserController::class,'searchEmp']);

Route::get('/detailDocument',[DocumentController::class,'detailDocument']);

Route::get('/envoyerDemande',[DemandeController::class,'envoyerDemande']);


Route::get('/annulerDemande',[DemandeController::class,'annulerDemande']);


Route::get('/accepterDemande',[DemandeController::class,'accepterDemande']);

Route::get('/refuserDemande',[DemandeController::class,'refuserDemande']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
