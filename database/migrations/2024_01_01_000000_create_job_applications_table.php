<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('job_id')->index();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone', 20);
            $table->string('location')->nullable();
            $table->string('experience', 100);
            $table->string('notice_period', 100)->nullable();
            $table->string('current_ctc', 100)->nullable();
            $table->string('expected_ctc', 100);
            $table->string('linkedin')->nullable();
            $table->text('cover_letter')->nullable();
            $table->string('resume')->nullable();
            $table->string('status', 50)->default('pending')->index();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_applications');
    }
};
