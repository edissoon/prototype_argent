<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
{
    Schema::create('cashflow', function (Blueprint $table) {
        $table->id(); 
        $table->date('record_date');
        $table->decimal('total_income', 12, 2)->default(0);
        $table->decimal('total_tithes', 12, 2)->default(0);
        $table->decimal('total_offering', 12, 2)->default(0);
        $table->decimal('total_others', 12, 2)->default(0);
        $table->decimal('total_expenses', 12, 2)->default(0);
        $table->decimal('net_balance', 12, 2)->default(0);
        $table->json('income_records')->nullable();
        $table->timestamps();
    });
}

    public function down(): void
{
    Schema::dropIfExists('cashflow');
}
};