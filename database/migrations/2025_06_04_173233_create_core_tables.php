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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->unsignedInteger('sort_order');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');   // relacionameto para course_id
            $table->foreignId('user_id')->constrained()->onDelete('cascade');   // relacionamento para user_id (professor)
            $table->timestamps();
        });

        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('video_url');
            $table->unsignedInteger('sort_order');
            $table->foreignId('module_id')->constrained()->onDelete('cascade');   // relacionamento para module_id
            $table->timestamps();
        });

        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('file_url');
            $table->enum('type', ['pdf', 'video', 'image', 'link']);
            $table->foreignId('lesson_id')->constrained()->onDelete('cascade');   // relacionamento para lesson_id
            $table->timestamps();
        });

        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->integer('score');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');   // relacionamento para user_id (aluno)
            $table->foreignId('module_id')->constrained()->onDelete('cascade');   // relacionamento para modulo_id
            $table->timestamps();
        });

        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->dateTime('enrolled_at');
            $table->boolean('status')->default(true);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');   // relacionamento para user_id (aluno)
            $table->foreignId('course_id')->constrained()->onDelete('cascade');   // relacionamento para course_id
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
        Schema::dropIfExists('lessons');
        Schema::dropIfExists('grades');
        Schema::dropIfExists('enrollments');
        Schema::dropIfExists('modules');
        Schema::dropIfExists('courses');
    }

};
