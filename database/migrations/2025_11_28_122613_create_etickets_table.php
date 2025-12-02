<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('etickets', function (Blueprint $table) {
            $table->id('ticket_id');
            $table->unsignedBigInteger('registration_id');
            $table->string('qr_code')->unique();
            $table->timestamp('waktu_checkin')->nullable();
            $table->timestamps();

            $table->foreign('registration_id')
                  ->references('registration_id')
                  ->on('registrations')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('etickets');
    }
};
