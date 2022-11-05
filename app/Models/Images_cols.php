<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images_cols extends Model
{
    use HasFactory;

    protected $fillable = [
        'img_one',
        'img_two',
        'img_three',
        'img_four',
        'img_five',
        'img_six',
        'img_seven',
        'img_eight',
        'img_nine',
        'img_ten',
    ];

    //Relationship to listing
    public function listing() {
        return $this->belongsTo(Listing::class, 'listing_id');
    }
}
