<?php

function createController($controller_name)
{
  $controller_class = ucwords($controller_name, '_');
  $controller_class = "App\\${controller_class}Controller";
  return new $controller_class;
}

// Custom routes
Flight::route('GET /', function() {
  createController('offer')->index();
});

Flight::route('GET /login', function() {
  createController('session')->create();
});
Flight::route('POST /login', function() {
  createController('session')->store();
});
Flight::route('/logout', function() {
  createController('session')->destroy();
});

Flight::route('GET /register', function() {
  createController('user')->create();
});
Flight::route('POST /register', function() {
  createController('user')->store();
});

Flight::route('GET /user/@user_id:[0-9]+/offer', function($user_id) {
  createController('offer')->indexUser($user_id);
});

Flight::route('POST /offer/@offer_id:[0-9]+/star/@count', function($offer_id, $count) {
  \App\Star::setCountForOfferAndUser($offer_id, Flight::get('current_user')->id, $count);
});

// RESTful routes for any controller
Flight::route('GET /@controller', function($controller_name) {
  createController($controller_name)->index();
});
Flight::route('GET /@controller/create', function($controller_name) {
  createController($controller_name)->create();
});
Flight::route('POST /@controller/create', function($controller_name) {
  createController($controller_name)->store();
});
Flight::route('GET /@controller/@id', function($controller_name, $id) {
  createController($controller_name)->show($id);
});
Flight::route('GET /@controller/@id/update', function($controller_name, $id) {
  createController($controller_name)->edit($id);
});
Flight::route('POST /@controller/@id/update', function($controller_name, $id) {
  createController($controller_name)->update($id);
});
Flight::route('POST /@controller/@id/destroy', function($controller_name, $id) {
  createController($controller_name)->destroy($id);
});
