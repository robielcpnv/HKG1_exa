<?php
namespace App;
use Flight;

class Controller
{
  function __construct()
  {
    Flight::set('flight.views.path', '../app/views');
  }
  
  protected function controllerName()
  {
    $class_name = get_class($this);
    preg_match('/\\\\(.+?)Controller$/', $class_name, $matches);
    return $matches[1];
  }
  
  protected function render($view_name)
  {
    Flight::render($this->controllerName().'/'.$view_name, [], 'action_content');
    Flight::render('layout');
  }
  
}
