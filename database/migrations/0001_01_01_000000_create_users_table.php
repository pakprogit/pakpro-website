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
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('username', 50)->nullable()->unique();
                $table->string('name')->nullable();
                $table->string('email', 150)->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password_hash', 255)->nullable();
                $table->string('password', 255)->nullable();
                $table->string('role', 30)->default('employee');
                $table->boolean('is_active')->default(true);
                $table->text('two_factor_secret')->nullable();
                $table->text('two_factor_recovery_codes')->nullable();
                $table->timestamp('two_factor_confirmed_at')->nullable();
                $table->string('invitation_token', 64)->nullable()->unique();
                $table->timestamp('invitation_expires_at')->nullable();
                $table->timestamp('deactivated_at')->nullable();
                $table->rememberToken();
                $table->timestamps();
            });
        } else {
            Schema::table('users', function (Blueprint $table) {
                if (!Schema::hasColumn('users', 'name')) {
                    $table->string('name')->nullable()->after('username');
                }
                if (!Schema::hasColumn('users', 'email_verified_at')) {
                    $table->timestamp('email_verified_at')->nullable()->after('email');
                }
                if (!Schema::hasColumn('users', 'password')) {
                    $table->string('password')->nullable()->after('password_hash');
                }
                if (!Schema::hasColumn('users', 'remember_token')) {
                    $table->rememberToken()->after('is_active');
                }
                if (!Schema::hasColumn('users', 'two_factor_secret')) {
                    $table->text('two_factor_secret')->nullable();
                }
                if (!Schema::hasColumn('users', 'two_factor_recovery_codes')) {
                    $table->text('two_factor_recovery_codes')->nullable();
                }
                if (!Schema::hasColumn('users', 'two_factor_confirmed_at')) {
                    $table->timestamp('two_factor_confirmed_at')->nullable();
                }
                if (!Schema::hasColumn('users', 'invitation_token')) {
                    $table->string('invitation_token', 64)->nullable()->unique();
                }
                if (!Schema::hasColumn('users', 'invitation_expires_at')) {
                    $table->timestamp('invitation_expires_at')->nullable();
                }
                if (!Schema::hasColumn('users', 'deactivated_at')) {
                    $table->timestamp('deactivated_at')->nullable();
                }
            });
        }

        if (!Schema::hasTable('password_reset_tokens')) {
            Schema::create('password_reset_tokens', function (Blueprint $table) {
                $table->string('email')->primary();
                $table->string('token');
                $table->timestamp('created_at')->nullable();
            });
        }

        if (!Schema::hasTable('sessions')) {
            Schema::create('sessions', function (Blueprint $table) {
                $table->string('id')->primary();
                $table->foreignId('user_id')->nullable()->index();
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->longText('payload');
                $table->integer('last_activity')->index();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                $columns = [
                    'name',
                    'email_verified_at',
                    'password',
                    'remember_token',
                    'two_factor_secret',
                    'two_factor_recovery_codes',
                    'two_factor_confirmed_at',
                    'invitation_token',
                    'invitation_expires_at',
                    'deactivated_at'
                ];
                foreach ($columns as $column) {
                    if (Schema::hasColumn('users', $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
