<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('trajets', function (Blueprint $table) {
        $table->id();
        $table->string('depart');
        $table->string('arrivee');
        $table->date('date');
        $table->time('heure');
        $table->float('prix');
        $table->string('statut');
        $table->foreignId('chauffeur_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trajets');
    }
};
