<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('user_notification_preferences', function (Blueprint $table) {
            $table->json('preferred_job_functions')->nullable()->after('preferred_locations');
        });
    }

    public function down()
    {
        Schema::table('user_notification_preferences', function (Blueprint $table) {
            $table->dropColumn('preferred_job_functions');
        });
    }
};
