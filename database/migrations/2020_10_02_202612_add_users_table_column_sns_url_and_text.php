<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsersTableColumnSnsUrlAndText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('insta_url')->after('image_path')->nullable();

            $table->string('youtube_url')->after('insta_url')->nullable();

            $table->string('twitter_url')->after('youtube_url')->nullable();
            $table->text('description')
            ->after('twitter_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('insta_url');
            $table->dropColumn('youtube_url');
            $table->dropColumn('twitter_url');
            $table->dropColumn('description');
        });
    }
}
