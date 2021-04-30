<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldVotingendtimeToScheduleVotings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedule_votings', function (Blueprint $table) {
            $table->time('voting_end')->after('voting_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedule_votings', function (Blueprint $table) {
            $table->dropColumn('voting_end');
        });
    }
}
