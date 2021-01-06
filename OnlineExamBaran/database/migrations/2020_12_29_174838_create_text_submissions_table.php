<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTextSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('text_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('given_by')->constrained('users')->onDelete('cascade');
            $table->string('answer');
            $table->boolean('is_graded')->nullable(false)->default(false);
            $table->float('grade')->nullable();
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            $table->integer('evaluated_by');
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
        Schema::dropIfExists('text_submissions');
    }
}
