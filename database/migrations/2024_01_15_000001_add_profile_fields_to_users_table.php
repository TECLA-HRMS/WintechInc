<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'job_title')) {
                $table->string('job_title')->nullable()->after('location');
            }
            if (!Schema::hasColumn('users', 'bio')) {
                $table->text('bio')->nullable()->after('job_title');
            }
            if (!Schema::hasColumn('users', 'linkedin_url')) {
                $table->string('linkedin_url')->nullable()->after('bio');
            }
            if (!Schema::hasColumn('users', 'portfolio_url')) {
                $table->string('portfolio_url')->nullable()->after('linkedin_url');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['job_title', 'bio', 'linkedin_url', 'portfolio_url']);
        });
    }
};
