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
        Schema::create('tools', function (Blueprint $table) {
            $table->id();
//            constrai otom sea to tb, on del cascad categ
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name_tools');
            $table->integer('stock');
            $table->enum('condition', ['baik', 'buruk']);
           $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tools_tb');
    }
};
