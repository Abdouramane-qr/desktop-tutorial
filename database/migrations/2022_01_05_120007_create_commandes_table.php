<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_id');
            $table->string('article');
            $table->double("price");
            $table->string('quantite');
            $table->double("Ptotal")->nullable();
            $table->foreign('article_id')->references('id')->on('articles');
            $table->timestamps();
        });
    }

    /**public function setTotal() {
$this->total = $this->price * $this->quantity;
}
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commandes');
    }
}
