<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Listing;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_id')->constrained()->onDelete('cascade');
            $table->string('image_name')->nullable();
            // $table->string('img_one')->nullable();
            // $table->string('img_two')->nullable();
            // $table->string('img_three')->nullable();
            // $table->string('img_four')->nullable();
            // $table->string('img_five')->nullable();
            // $table->string('img_six')->nullable();
            // $table->string('img_seven')->nullable();
            // $table->string('img_eight')->nullable();
            // $table->string('img_nine')->nullable();
            // $table->string('img_ten')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
};
