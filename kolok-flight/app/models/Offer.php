<?php
namespace App;

class Offer extends Model
{
  public function author()
  {
    return User::find($this->author_id);
  }
  
  // Returns an array of images URLs
  public function images()
  {
    // Grab all images
    return array_map(function($item) { return substr($item, strlen(BASE_DIR.'/public')); }, glob(BASE_DIR . "/public/offers/{$this->id}/*"));
  }
}
