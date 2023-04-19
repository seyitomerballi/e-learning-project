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
        if(!Schema::hasTable('courses'))
        {
            Schema::create('courses', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->integer('course_type');
                $table->integer('status');
                $table->date('release_date');
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasTable('courses'))
        {
            Schema::dropIfExists('courses');
        }
    }
};
