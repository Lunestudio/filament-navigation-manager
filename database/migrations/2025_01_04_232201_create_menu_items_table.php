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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->integer('order_column');
            $table->foreignId('menu_id');
            $table->foreignId('parent_item_id')->nullable();
            $table->string('name');
            $table->nullableMorphs('linkable');
            $table->string('icon')->nullable();
            $table->json('attributes')->nullable();
            $table->longText('custom_url')->nullable();
            $table->timestamps();

            $table->foreign('menu_id')->references('id')->on('menus')->cascadeOnDelete();
            $table->foreign('parent_item_id')->references('id')->on('menu_items')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
