<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultipleChoiceSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multiple_choice_submissions', function (Blueprint $table) {
            $table->id();
            $table->char('answer_value')->nullable(false);
            $table->integer('given_by');
            $table->foreignId('question_id')->constrained();
            $table->boolean('is_graded')->nullable(false)->default(false);
            $table->float('grade')->nullable();
            $table->foreignId('answer_id')->constrained('multiple_choice_answers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('multiple_choice_submissions');
    }
}
