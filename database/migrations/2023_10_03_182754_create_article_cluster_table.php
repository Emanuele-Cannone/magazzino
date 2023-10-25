<?php

use App\Models\Article;
use App\Models\Cluster;
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
        Schema::create('article_cluster', function (Blueprint $table) {
            $table->foreignIdFor(Article::class)->references('id')->on('articles')->onDelete('cascade');
            $table->foreignIdFor(Cluster::class)->references('id')->on('clusters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_cluster');
    }
};
