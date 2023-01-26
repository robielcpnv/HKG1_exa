<?php
use App\User;

function getCurrentUser() {
  return isset($_SESSION['current_user']) ? User::find($_SESSION['current_user']) : null;
}

function loginUser($username, $password) {
  if ($user = User::findBy('username', $username)) {
    // Check credential
    if (password_verify($password, $user->password)) {
      $_SESSION['current_user'] = $user->id;
      $_SESSION['token'] = bin2hex(random_bytes(32));
    }else
      $user = null;
  }
  return $user;
}

function logoutUser() {
  unset($_SESSION['current_user']);
  unset($_SESSION['token']);
}


session_start();
Flight::set('current_user', getCurrentUser());
