<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('skus', function (Blueprint $table) {
            $table->decimal('price', 8, 2)->change();
        });
    }

    public function down(): void
    {
        Schema::table('skus', function (Blueprint $table) {
            $table->decimal('price', 2, 0)->change();
        });
    }
};
