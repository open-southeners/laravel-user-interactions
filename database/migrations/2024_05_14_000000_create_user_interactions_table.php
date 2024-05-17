<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('user-interactions.table_name', 'users_interactions'), function (Blueprint $table) {
            $table->id();
            $table->string('interaction_type')->index();
            $table->morphs('causer');
            $table->morphs('subject');
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
        Schema::dropIfExists(config('user-interactions.table_name', 'users_interactions'));
    }
};
