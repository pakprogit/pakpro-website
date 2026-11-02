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
        if (!Schema::hasTable('form_submissions')) {
            Schema::create('form_submissions', function (Blueprint $table) {
                $table->id();
                $table->string('type', 40); // contact | agent_registration | grievance
                $table->json('data')->nullable(); // JSON data (field-level encrypted for grievance)
                $table->boolean('is_anonymous')->default(false);
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->string('status', 20)->default('pending'); // pending | reviewed | archived
                $table->timestamp('reviewed_at')->nullable();
                $table->unsignedInteger('reviewed_by')->nullable();
                $table->timestamps();

                $table->foreign('reviewed_by')
                    ->references('id')
                    ->on('users')
                    ->onDelete('set null');

                $table->index(['type', 'status', 'created_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_submissions');
    }
};

