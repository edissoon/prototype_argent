<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashflowIncomeEntriesTable extends Migration
{
    public function up()
    {
        Schema::create('cashflow_income_entries', function (Blueprint $table) {
            $table->id();
            $table->date('record_date');
            $table->string('name');
            $table->decimal('tithes', 10, 2)->default(0);
            $table->decimal('offering', 10, 2)->default(0);
            $table->decimal('others', 10, 2)->default(0);
            $table->text('note')->nullable();
            $table->timestamps();
            
            // Index for faster queries
            $table->index(['record_date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('cashflow_income_entries');
    }
}