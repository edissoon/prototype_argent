<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('church_savings', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['add', 'deduct']);
            $table->decimal('amount', 10, 2);
            $table->text('note');
            $table->decimal('balance_after', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('church_savings');
    }

};
