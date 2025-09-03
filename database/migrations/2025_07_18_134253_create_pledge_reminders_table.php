<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pledge_reminders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('start_date');
            $table->enum('frequency', ['first-sunday', 'weekly', 'monthly']);
            $table->decimal('amount', 10, 2);
            $table->text('note')->nullable();
            $table->boolean('is_active')->default(true);
            $table->date('next_due_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pledge_reminders');
    }
};