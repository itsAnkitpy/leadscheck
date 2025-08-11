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
        Schema::create('tenant_form_fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('custom_field_id')->nullable();
            $table->string('field_key');
            $table->string('label');
            $table->string('type')->nullable();
            $table->json('options')->nullable();
            $table->boolean('is_enabled')->default(true);
            $table->boolean('is_required')->default(false);
            $table->integer('order')->default(0);
            $table->text('description')->nullable();
            $table->timestamps();
            
            $table->foreign('custom_field_id')->references('id')->on('custom_fields')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_form_fields');
    }
};
