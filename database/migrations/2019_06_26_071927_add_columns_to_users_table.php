<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("users", function (Blueprint $table) {
            $table->integer("age")->nullable();
            $table->string("gender")->nullable();
            $table->string("image_url")->nullable();
            $table->integer("favorite_music_age")->nullable();
            $table->string("favorite_artist")->nullable();
            $table->string("comment")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("users", function (Blueprint $table) {
            $table->dropColumn(["age", "gender", "image_url", "favorite_music_age", "favorite_artist", "comment"]);
        });
    }
}
