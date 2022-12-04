<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('header_logo')->nullable();
            $table->string('footer_logo')->nullable();
            $table->string('dashboard_logo')->nullable();
            $table->string('minidashboard_logo')->nullable();
            $table->string('favicon')->nullable();
            $table->longtext('about_ar')->nullable();
            $table->longtext('about_en')->nullable();
            $table->longtext('privacy_ar')->nullable();
            $table->longtext('privacy_en')->nullable();
            $table->longtext('policy_ar')->nullable();
            $table->longtext('policy_en')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('snapchat')->nullable();
            $table->text('phone_numbers')->nullable();
            $table->text('google_play')->nullable();
            $table->text('app_store')->nullable();
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
        Schema::dropIfExists('settings');
    }
};
