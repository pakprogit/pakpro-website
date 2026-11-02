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
        if (!Schema::hasTable('highlights')) {
            Schema::create('highlights', function (Blueprint $table) {
                $table->id();
                $table->string('type'); // policy | projects | bcc
                $table->date('month'); // First day of the month YYYY-MM-01
                $table->string('title');
                $table->text('summary');
                $table->string('media_type')->default('image'); // image | video
                $table->string('video_url')->nullable();
                $table->string('poster')->nullable();
                $table->string('alt_text')->nullable();
                $table->string('link_url')->nullable();
                $table->string('status')->default('draft'); // draft | published
                $table->timestamp('published_at')->nullable();
                $table->unsignedInteger('created_by')->nullable();
                $table->boolean('is_placeholder')->default(false);
                $table->timestamps();

                $table->foreign('created_by')
                    ->references('id')
                    ->on('users')
                    ->onDelete('set null');

                $table->index(['type', 'month', 'status']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('highlights');
    }
};

