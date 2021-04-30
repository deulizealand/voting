<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldVotingenddateToScheduleVotings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedule_votings', function (Blueprint $table) {
            $table->date('voting_end_date')->after('voting_date')->nullable();
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
            $table->dropColumn('voting_end_date');
        });
    }
}
