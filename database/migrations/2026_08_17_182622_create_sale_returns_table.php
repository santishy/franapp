<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("sale_returns", function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId("original_sale_id")
                ->constrained("sales")
                ->cascadeOnDelete();
            $table
                ->foreignId("replacement_sale_id")
                ->nullable()
                ->constrained("sales")
                ->nullOnDelete();
            $table->foreignId("inventory_id")->constrained();
            $table->foreignId("user_id")->constrained();
            $table->decimal("total", 10, 2)->default(0);
            $table->enum("resolution", ["exchange", "refund"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("sale_returns");
    }
};
