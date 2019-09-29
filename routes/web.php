<?php

use App\Role;
use App\User;

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

Route::get('/create/{id}/{name}', function ($id, $name) {
  $user = User::find($id);
  $user->roles()->save( new Role(['name' => $name]) );
});

Route::get('/read/{id}', function ($id) {
  $user = User::findOrFail($id);
  foreach ($user->roles as $role) {
    //dd($role);
    echo $role->name . '</br>';
  }
});

Route::get('/update/{id}/{role_name}', function ($id, $role_name) {
  $user = User::findOrFail($id);
  if ($user->has('roles')) {
    foreach($user->roles as $role) {
      if ($role->name == $role_name) {
        $role->name = $role_name . '1';
        $role->save();
      }
    }
  }
});
