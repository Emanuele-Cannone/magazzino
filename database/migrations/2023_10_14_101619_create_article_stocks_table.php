<?php

use App\Models\Article;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('article_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Article::class)->references('id')->on('articles')->onDelete('cascade');
            $table->bigInteger('current_stock');
            $table->unsignedSmallInteger('min_stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_stocks');
    }
};
