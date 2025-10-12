<?php

use App\Models\Company;
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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('email2')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->string('logo')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkdin')->nullable();
            $table->string('twiter')->nullable();
            $table->string('instagram')->nullable();
            $table->text("footer_text")->nullable();
            $table->string('address')->nullable();
            $table->string('notic')->nullable();
            $table->text('map_url')->nullable();
            $table->timestamps();
        });

        Company::create([
            'name' => "company Name",
            'email' => "demo@gmail.com",
            'phone' => '01700000000'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
