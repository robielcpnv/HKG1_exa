<?php
namespace App;
use Flight;
use Exception;

use App\Offer;
use App\User;

class OfferController extends Controller
{
  function index()
  {
    Flight::view()->set('offers', Offer::findAll());
    $this->render('index');
  }

  function indexUser($user_id)
  {
    $user = User::find($user_id);
    Flight::view()->set('offers', Offer::findAllBy('author_id', $user_id));
    Flight::view()->set('user', $user);
    Flight::view()->set('title', "Propositions de $user->name");
    $this->render('indexUser');
  }
  
  function show($id)
  {
    Flight::view()->set('offer', Offer::find($id));
    $this->render('show');
  }
  
  function create()
  {
    Flight::view()->set('offer', new Offer(['available_on' => '', 'address' => '', 'description' => '']));
    $this->render('create');
    
  }
  
  function store()
  {
    if (!isset($_SESSION['token']) || !isset($_POST['token'])) {
      exit("Token not set!");
    }
    if ($_POST['token'] == $_SESSION['token']) {
    // Create and fill the offer
    $offer = new Offer([
      'available_on' => trim(Flight::request()->data['available_on']),
      'address'      => trim(Flight::request()->data['address']),
      'description'  => trim(Flight::request()->data['description']),
      'published_on' => date('Y-m-d', time()),
      'author_id'    => Flight::get('current_user')->id
    ]);
    
    if ($this->validateForm($offer)) {
      // Validate images count
      $has_errors = false;
      if (0 == array_reduce($_FILES['images']['tmp_name'], function($memo, $name) { return $memo + (empty($name) ? 0 : 1); }, 0)) {
        Flight::view()->set('images_error', "Vous devez joindre au minimum une photo");
        $has_errors = true;
      }

      // Validate images formats
      $extensions = array_filter(array_map(function($path) { return pathinfo($path, PATHINFO_EXTENSION); }, $_FILES['images']['name']));
      if (!empty(array_diff($extensions, ['jpg', 'jpeg', 'png', 'gif']))) {
        Flight::view()->set('images_error', "Vos photos doivent être dans un des formats suivants: jpg, png, gif");
        $has_errors = true;
      }
    
      // Store the offer
      if (!$has_errors) {
        if ($offer->save()) {
          // Now move the uploaded images
          $images_dir = BASE_DIR . "/public/offers/{$offer->id}/";
          if (!is_dir($images_dir)) {
            mkdir($images_dir, 0777, true);
          }
          foreach ($_FILES['images']['tmp_name'] as $index => $tmp_name) {
            if (empty($tmp_name)) continue;
        
            $name = $_FILES['images']['name'][$index];
            move_uploaded_file($tmp_name, $images_dir . $name);
          }

          Flight::redirect("/offer/".$offer->id);
        }
        else {
          throw new Exception("Impossible d'ajouter la nouvelle proposition!", 500);
        }
      }
    }
    
    Flight::view()->set('offer', $offer);
    $this->render('create');
  }
  else {
    exit("Invalid Token!");
  }
  }
  
  public function edit($id)
  {
    Flight::view()->set('offer', Offer::find($id));
    $this->render('update');
  }

  public function update($id)
  {
    // Grab the offer
    $offer = Offer::find($id);
    $offer->available_on = trim(Flight::request()->data['available_on']);
    $offer->address      = trim(Flight::request()->data['address']);
    $offer->description  = trim(Flight::request()->data['description']);
    
    // Check if authenticated user is the owner
    $current_user = Flight::get('current_user');
    if ($current_user->id != $offer->author_id) {
      throw new Exception("Vous n'êtes pas l'auteur de cette proposition!", 403);
    }
  
    if ($this->validateForm($offer)) {
      // Store the offer
      if ($offer->save()) {
        // Now move the uploaded images
        $images_dir = BASE_DIR . "/public/offers/{$offer->id}/";
        foreach ($_FILES['images']['tmp_name'] as $index => $tmp_name) {
          if (empty($tmp_name)) continue;
        
          $name = $_FILES['images']['name'][$index];
          move_uploaded_file($tmp_name, $images_dir . $name);
        }
      
        Flight::redirect("/offer/".$offer->id);
      }
      else {
        throw new Exception("Impossible de modifier cette proposition!", 500);
      }
    }
    
    Flight::view()->set('offer', $offer);
    $this->render('update');
  }

  public function destroy($id)
  {
    if (!isset($_SESSION['token']) || !isset($_POST['token'])) {
      exit("Token not set!");
    }
    if ($_POST['token'] == $_SESSION['token']) {
     // Destroy the offer
      Offer::destroy($id);

      $current_user = Flight::get('current_user');
      Flight::redirect("/user/{$current_user->id}/offer");
    }
    else {
      exit("Invalid Token!");
    }
  }
  
  protected function validateForm($offer)
  {
    // Validate fields
    $has_errors = false;
    if (empty($offer->address)) {
      Flight::view()->set('address_error', "L'adresse doit être remplie");
      $has_errors = true;
    }
    if (empty($offer->description)) {
      Flight::view()->set('description_error', "La description doit être remplie");
      $has_errors = true;
    }
    if (!preg_match("/^20\d\d-\d\d-\d\d$/", $offer->available_on)) {
      Flight::view()->set('available_on_error', "La date de disponibilité est invalide");
      $has_errors = true;
    }
    else {
      if ($offer->available_on < date('Y-m-d')) {
        Flight::view()->set('available_on_error', "La date de disponibilité doit être dans le futur");
        $has_errors = true;
      }
    }

    // Valid?
    return !$has_errors;
  }
  
}
