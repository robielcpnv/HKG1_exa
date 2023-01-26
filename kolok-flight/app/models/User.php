<?php
namespace App;

class User extends Model
{
  public function __construct($attributes = [])
  {
    if (array_key_exists('password', $attributes)) {
      $attributes['password'] = password_hash($attributes['password'], PASSWORD_DEFAULT);
    }
    parent::__construct($attributes);
  }
}
