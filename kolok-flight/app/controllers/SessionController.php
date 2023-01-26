<?php
namespace App;
use Flight;

use App\User;

class SessionController extends Controller
{
  function create()
  {
    $this->render('create');
  }
  
  function store()
  {
    $username  = trim(Flight::request()->data['username']);
    $password  = Flight::request()->data['password'];

    // Validate fields
    $has_errors = false;
    if (empty($username)) {
      Flight::view()->set('username_error', "Votre identifiant ne doit pas être vide");
      $has_errors = true;
    }
    if (!preg_match("/^\w+$/", $username)) {
      Flight::view()->set('username_error', "Votre identifiant ne doit contenir que des caractères alphanumériques");
      $has_errors = true;
    }
    if (empty($password)) {
      Flight::view()->set('password_error', "Votre mot de passe ne doit pas être vide");
      $has_errors = true;
    }

    // Valid?
    if (!$has_errors) {
      // Yep, login the user
      if (loginUser($username, $password)) {
        Flight::redirect('/');
      }
      Flight::view()->set('login_error', "Votre identifiant et/ou mot de passe sont erronés");
    }
    $this->render('create');
  }

  function destroy()
  {
    logoutUser();
    Flight::redirect('/');
  }
  
}
