<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('new_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('communityforum_id')->constrained()->onDelete('cascade');
            $table->text('comment');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('new_comments'); // Drops the table if it exists
    }
};
