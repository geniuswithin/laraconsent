<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsentOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consent_options', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->unsignedBigInteger('version')->nullable()->default(null);
            $table->string('title')->nullable()->default(null);
            $table->string('label')->nullable()->default(null);
            $table->text('text')->nullable()->default(null);
            $table->boolean('is_mandatory')->default(0);
            $table->boolean('is_current')->default(0);
            $table->boolean('enabled')->default(0);
            $table->boolean('force_user_update')->default(0);
            $table->integer('sort_order')->default(0);
            $table->json('models')->default(null);
            $table->dateTime('published_at')->default(null);
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
        Schema::dropIfExists('consent_options');
    }
}
