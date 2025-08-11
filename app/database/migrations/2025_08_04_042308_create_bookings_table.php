<?php

use App\Enums\BookingEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('uid', 36)->unique();
            $table->string('user_id', 36);
            $table->string('service_uid', 36);
            $table->string('note', 400)->nullable();
            $table->decimal('price', 10, 2);
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->tinyInteger('status')->default(BookingEnum::PENDING);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('service_uid')->references('uid')->on('services');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
