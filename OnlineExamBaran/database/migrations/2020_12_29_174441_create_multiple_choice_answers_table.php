<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultipleChoiceAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multiple_choice_answers', function (Blueprint $table) {
            $table->id();
            $table->string('answer')->nullable(false);
            $table->boolean('is_true')->nullable(false)->default(false);
            $table->char('value');
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users');
            $table->unique(['question_id', 'value']);
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
        Schema::dropIfExists('multiple_choice_answers');
    }
}
