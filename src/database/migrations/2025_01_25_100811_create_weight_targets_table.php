<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeightTargetsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('weight_targets', function (Blueprint $table) {
            $table->bigIncrements('id'); // 主キー
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // 外部キー制約
            $table->decimal('target_weight', 4, 1); // 目標体重
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weight_targets');
    }
}

