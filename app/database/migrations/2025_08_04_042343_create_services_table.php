<?php

use App\Enums\ServiceEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('uid', 36)->unique();
            $table->string('name', 100);
            $table->string('image_url')->nullable();
            $table->string('description');
            $table->decimal('prise', 10, 2);
            $table->enum('status', ['active', 'inactive'])->default(ServiceEnum::ACTIVE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
