<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->timestamps();
        });
        Schema::create('couriers', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('name');
            $table->string('password');
            $table->timestamps();
        });
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('webhook_address');
            $table->string('api_key');
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->double('start_latitude');
            $table->double('start_longitude');
            $table->string('delivery_address');
            $table->string('delivery_provider_name');
            $table->string('delivery_provider_mobile');
            $table->double('destination_latitude');
            $table->double('destination_longitude');
            $table->string('destination_address');
            $table->string('recipient_name');
            $table->string('recipient_mobile');
            $table->string('status');

            $table->unsignedBigInteger('courier_id')->nullable();
            $table->unsignedBigInteger('company_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('courier_id')->references('id')->on('couriers');
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
        Schema::dropIfExists('couriers');
        Schema::dropIfExists('companies');
        Schema::dropIfExists('orders');
    }
};
