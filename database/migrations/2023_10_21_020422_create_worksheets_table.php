<?php

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\User;
use App\Models\WorksheetStatus;
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
        Schema::create('worksheets', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Customer::class)->references('id')->on('customers');
            $table->foreignIdFor(User::class)->references('id')->on('users');
            $table->foreignIdFor(WorksheetStatus::class)->references('id')->on('worksheet_status');
            $table->foreignIdFor(Appointment::class)->references('id')->on('appointments')->nullable();
            $table->json('description')->nullable();
            $table->string('payment_type');
            $table->double('amount',8,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('worksheets');
    }
};
