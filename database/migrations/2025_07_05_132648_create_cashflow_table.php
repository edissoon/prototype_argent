<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cashflow', function (Blueprint $table) {
            $table->id();
            $table->date('record_date');
            $table->decimal('total_income', 10, 2)->default(0);
            $table->decimal('tithes', 10, 2)->default(0);
            $table->decimal('offering', 10, 2)->default(0);
            $table->decimal('others', 10, 2)->default(0);
            $table->decimal('total_expenses', 10, 2)->default(0);
            $table->decimal('balance', 10, 2)->default(0);
            $table->timestamps();
            
            // Ensure only one record per date
            $table->unique('record_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cashflow');
    }
};