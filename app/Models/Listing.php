<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    // To prevent fillable error you can add below line or unguard Model in appServicePorivider.php file
    // protected $fillable = ['title', 'company', 'location', 'email', 'website', 'tags', 'description'];

    public function scopeFilter($query, array $filters) {
        if($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }

    //Relationship to User
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship with images
    public function images(){
        return $this->hasMany(Image::class, 'listing_id');
    }

    // Relationship with images
    public function images_col(){
        return $this->hasMany(Images_cols::class, 'listing_id');
    }
}
