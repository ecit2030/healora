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
        Schema::create('pharmacy_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('target_department')->default('Pharmacy');
            $table->string('recipient_email');
            $table->string('title');
            $table->text('message');
            $table->string('severity')->default('medium');
            $table->boolean('sent_via_mail')->default(false);
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacy_notifications');
    }
};
