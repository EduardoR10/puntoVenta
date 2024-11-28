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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('contactname');
            $table->string('address');
            $table->string('city');
            $table->string('country');
            $table->string('phonenumber');
            $table->string('razonsocial');
            $table->string('regimenfiscal');
            $table->string('rfc')->unique();
            $table->string('email')->unique();
            $table->timestamps();
            $table->boolean('is_active')->default(true);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
