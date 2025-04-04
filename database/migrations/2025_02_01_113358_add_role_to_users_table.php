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
        Schema::table('users', function (Blueprint $table) {
            // Check if role column already exists before adding it
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['user', 'admin', 'futsal_owner'])->default('user');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the 'role' column during rollback
            $table->dropColumn('role');
        });
    }
};
