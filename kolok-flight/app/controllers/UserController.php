<?php
namespace App;
use Flight;

use App\User;

class UserController extends Controller
{
  function create()
  {
    $this->render('create');
  }
  
  function store()
  {
    $username  = trim(Flight::request()->data['username']);
    $name      = trim(Flight::request()->data['name']);
    $email     = trim(Flight::request()->data['email']);
    $password  = Flight::request()->data['password'];

    // Validate fields
    $has_errors = false;
    if (strlen($username) < 3) {
      Flight::view()->set('username_error', "Votre identifiant doit contenir au moins 3 caractères");
      $has_errors = true;
    }
    if (!preg_match("/^\w+$/", $username)) {
      Flight::view()->set('username_error', "Votre identifiant ne doit contenir que des caractères alphanumériques");
      $has_errors = true;
    }
    if (User::findBy('username', $username)) {
      Flight::view()->set('username_error', "Votre identifiant est déjà pris");
      $has_errors = true;
    }
    if (!preg_match("/^\S+@\S+$/", $email)) {
      Flight::view()->set('email_error', "Votre adresse email doit être valide");
      $has_errors = true;
    }
    if (strlen($password) < 10) {
      Flight::view()->set('password_error', "Votre mot de passe doit contenir au moins 10 caractères");
      $has_errors = true;
    }
    if (strlen($name) < 3) {
      Flight::view()->set('name_error', "Votre nom doit contenir au moins 3 caractères");
      $has_errors = true;
    }

    // Valid?
    if (!$has_errors) {
      $user = new User(['username' => $username, 'name' => $name, 'email' => $email, 'password' => $password]);
      $user->save();
      
      Flight::redirect('/');
    }
    else {
      Flight::view()->set('username', $username);
      Flight::view()->set('name', $name);
      Flight::view()->set('email', $email);
      $this->render('create');
    }
    
  }
  
}
