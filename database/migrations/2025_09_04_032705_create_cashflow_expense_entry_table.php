<?php

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
        Schema::create('cashflow_expense_entry', function (Blueprint $table)
        {
            $table->id();
            $table->foreignId('cashflow_id')->constrained('cashflow')->onDelete('cascade');
            $table->string('expense_name');
            $table->decimal('amount', 12, 2)->default(0);
            $table->boolean('is_auto')->default(false); // added
            $table->string('note')->nullable(); // added
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cashflow_expense_entry');
    }
};
