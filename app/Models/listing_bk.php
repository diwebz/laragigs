<?php

  namespace App\Models;

  class Listing {
    public static function all() {
      return [
        [
          'id' => 1,
          'title' => 'listing one',
          'description' => 'Lorem ipsum dolor sit amet 
          consectetur adipisicing elit. Officiis reprehenderit, 
          mollitia in minus facere consectetur consequatur 
          pariatur temporibus quae provident.'
        ],
        [
            'id' => 2,
            'title' => 'listing two',
            'description' => 'Lorem ipsum dolor sit amet 
            consectetur adipisicing elit. Officiis reprehenderit, 
            mollitia in minus facere consectetur consequatur 
            pariatur temporibus quae provident.'
        ]
      ];
    }

    public static function find($id) {
      $listings = self::all();

      foreach($listings as $listing) {
        if($listing['id'] == $id) {
          return $listing;
        }
      }
    }
  }