<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->text('subtitle')->nullable();
            $table->text('about_text')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('logo_image')->nullable();
            $table->string('cv_file')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('skills_headline')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('github')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
