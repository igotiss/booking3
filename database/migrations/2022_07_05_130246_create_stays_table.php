<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stays', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('image')->nullable();
            $table->text('description');
            $table->text('amenities')->nullable();
            $table->integer('rooms')->default(1);
            $table->integer('beds')->default(1);
            $table->enum('status', ['active', 'pending', 'inactive'])->default('inactive');
            $table->enum('type', ['hotel', 'apartment', 'resort', 'villa', 'cottage']);
            $table->string('location');
            $table->integer('price');
            $table->softDeletes();
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
        Schema::dropIfExists('stays');
    }
}
