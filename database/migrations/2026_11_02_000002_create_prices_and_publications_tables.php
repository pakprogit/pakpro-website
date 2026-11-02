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
        if (!Schema::hasTable('prices')) {
            Schema::create('prices', function (Blueprint $table) {
                $table->id();
                $table->string('material');
                $table->string('slug')->unique();
                $table->decimal('recycler_min', 8, 2)->nullable();
                $table->decimal('recycler_max', 8, 2)->nullable();
                $table->decimal('aggregator_min', 8, 2)->nullable();
                $table->decimal('aggregator_max', 8, 2)->nullable();
                $table->text('note')->nullable();
                $table->integer('sort_order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('price_publications')) {
            Schema::create('price_publications', function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('user_id')->nullable();
                $table->timestamp('published_at');
                $table->json('snapshot');
                $table->text('change_summary')->nullable();
                $table->timestamps();

                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_publications');
        Schema::dropIfExists('prices');
    }
};

