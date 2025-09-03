<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
    {
         Schema::create('cashflow_expense_entries', function (Blueprint $table) {
            $table->id(); // bigint unsigned auto_increment primary key
            $table->string('expense_name', 255); // varchar(255) not null
            $table->decimal('amount', 10, 2); // decimal(10,2) not null
            $table->timestamps(); // created_at, updated_at

            $table->index('expense_name', 'cashflow_expense_entries_expense_name_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cashflow_expense_entries'); 
    }
};
