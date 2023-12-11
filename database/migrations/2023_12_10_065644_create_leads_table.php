<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branchOfficeId');
            $table->string('number', 20);
            $table->string('fullName', 150);
            $table->string('email', 150)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('address', 250)->nullable();
            $table->string('latitude', 50)->nullable();
            $table->string('longitude', 50)->nullable();
            $table->string('companyName', 100)->nullable();
            $table->text('generalNotes')->nullable();
            $table->foreignId('statusId');
            $table->foreignId('probabilityId');
            $table->foreignId('typeId');
            $table->foreignId('channelId');
            $table->foreignId('mediaId');
            $table->foreignId('sourceId');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leads');
    }
}
