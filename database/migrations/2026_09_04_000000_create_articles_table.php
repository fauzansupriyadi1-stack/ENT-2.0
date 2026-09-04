<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->default('Lifestyle');
            $table->string('secondary_tag')->nullable();
            $table->string('author_name')->default('Admin Editor');
            $table->string('author_avatar')->nullable();
            $table->string('author_role')->default('Editor');
            $table->string('date')->nullable();
            $table->string('read_time')->default('5 min read');
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->text('image')->nullable();
            $table->integer('likes')->default(100);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
