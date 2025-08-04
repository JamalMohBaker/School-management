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
        Schema::table('exams', function (Blueprint $table) {
            //
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('question_num');
            $table->string('score');
            $table->string('final_score');
            $table->foreignId('subject_teacher_classroom_id')->constrained('subject_teacher_classroom')->cascadeOnDelete()->name('fk_exam_subj_teacher_classroom');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exams', function (Blueprint $table) {
            //
            $table->dropForeign(['user_id']); // حذف المفتاح الأجنبي
            $table->dropColumn('user_id');   
            $table->dropColumn('question_num');   
            $table->dropColumn('score');   
            $table->dropColumn('final_score');
            $table->dropColumn('subject_teacher_classroom_id')->constrained('subject_teacher_classroom')->cascadeOnDelete()->name('fk_exam_subj_teacher_classroom');
        });
    }
};
