<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table) {
            // Add the Table Columns here
            $table->id();
            // Relation / Foreign key
            $table->bigInteger('id_jenkel')->unsigned();
            // Defining the table relation
            $table->foreign('id_jenkel')->references('id')->on('jenis_kelamin')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama', 255);
            $table->string('nik', 12);
            $table->string('jurusan', 12);
            $table->string('angkatan', 4);
            $table->longText('alamat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
