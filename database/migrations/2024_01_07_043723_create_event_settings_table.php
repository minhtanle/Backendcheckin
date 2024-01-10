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
        Schema::create('event_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')
                ->nullable();
            $table->foreignId('event_id')
                ->nullable(false);
            $table->string('description')
                ->nullable();
            $table->string('key')
                ->nullable(false);
            $table->text('value')
                ->nullable(false);
            $table->string('group')
                ->nullable(false);
            $table->string('type')
                ->nullable(false);
            $table->foreignId('created_by')
                ->nullable();
            $table->foreignId('updated_by')
                ->nullable();
            $table->timestamps();

            /* INDEX */
            $table->index('id', 'idx_id');
            $table->index('event_id', 'idx_event_id');
            $table->index('parent_id', 'idx_parent_id');

            /* RELATIONSHIP */
            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                ->onDelete('restrict');
            $table->foreign('parent_id')
                ->references('id')
                ->on('event_settings')
                ->onDelete('set null');
            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
            $table->foreign('updated_by')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_settings');
    }
};
