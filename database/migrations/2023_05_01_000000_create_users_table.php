<?php

use phpStack\Database\Migration\Migration;

class Migration_2023_05_01_000000_create_users_table extends Migration
{
    public function up(): void
    {
        $this->createTable('users', function ($table) {
            $table->id();
            $table->string('name');
            $table->string('email')->index();
            $table->string('password');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    public function down(): void
    {
        $this->dropTable('users');
    }
}