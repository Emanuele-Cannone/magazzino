<?php

use App\Models\Article;
use App\Models\Order;
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
        Schema::create('order_articles', function (Blueprint $table) {
            $table->foreignIdFor(Order::class)->references('id')->on('orders')->onDelete('cascade');
            $table->foreignIdFor(Article::class)->references('id')->on('articles');
            $table->integer('quantity')->index();
            $table->float('price')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_articles');
    }
};
