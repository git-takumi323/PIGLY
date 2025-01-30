<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeightLogsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('weight_logs', function (Blueprint $table) {
            $table->bigIncrements('id'); // 主キー
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // 外部キー制約
            $table->date('date'); // 日付
            $table->decimal('weight', 4, 1); // 体重
            $table->integer('calories')->nullable(); // 食事量
            $table->time('exercise_time')->nullable(); // 運動時間
            $table->text('exercise_content')->nullable(); // 運動内容
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weight_logs');
    }
}
