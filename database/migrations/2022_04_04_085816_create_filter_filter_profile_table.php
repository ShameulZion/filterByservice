<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilterFilterProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filter_filter_profile', function (Blueprint $table) {
            $table->id();
            $table->foreignId('filter_id')->constrained('filters')->onDelete('cascade');
            $table->foreignId('filter_profile_id')->constrained('filter_profiles')->onDelete('cascade');
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
        Schema::dropIfExists('filter_filter_profile');
    }
}
