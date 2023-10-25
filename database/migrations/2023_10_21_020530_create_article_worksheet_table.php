<?php

use App\Models\Article;
use App\Models\Worksheet;
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
        Schema::create('article_worksheet', function (Blueprint $table) {
            $table->foreignIdFor(Worksheet::class)->references('id')->on('worksheets');
            $table->foreignIdFor(Article::class)->references('id')->on('articles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_worksheet');
    }
};
