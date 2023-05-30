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
        Schema::create('steps', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->json('message');
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->foreign('entity_id')->references('id')->on('entities')->nullable()->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('condition_id')->nullable();
            $table->foreign('condition_id')->references('id')->on('conditions')->nullable()->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('display_id')->nullable();
            $table->foreign('display_id')->references('id')->on('displays')->nullable()->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('reaction_id')->nullable();
            $table->foreign('reaction_id')->references('id')->on('reactions')->nullable()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('steps');
    }
};
