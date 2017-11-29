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

Auth::routes();

Route::resource('users','UsersController')->middleware('auth'); //Esta opcion es para el administrador

Route::resource('files','FilesController')->middleware('auth');

Route::resource('folder','FoldersController')->middleware('auth');

Route::get('/files/destroy/{id}', [

        'uses'  => 'FilesController@destroy',
        'as'    => 'files.destroy'

])->middleware('auth');

Route::get('/folders/destroy/{id}', [

        'uses'  => 'FoldersController@destroy',
        'as'    => 'folders.destroy'

])->middleware('auth');

Route::get('storage/{archivo}', function ($archivo) {
     $public_path = public_path();
     $url = $public_path.'/storage/'.$archivo;
     if (Storage::exists($archivo))
     {
       return response()->download($url);
     }
     abort(404);
})->middleware('auth');

Route::get('/shared/files', 'SharedRecordsController@show')->name("showShared")->middleware('auth');

Route::post('/shared/files', 'SharedRecordsController@create')->name("sharedWith")->middleware('auth');

Route::get('/file/all','NotificationController@show')->name('allfiles')->middleware('auth');

Route::get('/file/admin','NotificationController@showAllFiles')->name('adminallfiles')->middleware('auth');
Route::get('/getFileByTagName','FilesController@mostrarArchivos');