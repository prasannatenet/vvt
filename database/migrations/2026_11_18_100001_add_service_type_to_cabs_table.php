<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cabs', function (Blueprint $table): void {
            $table->unsignedBigInteger('service_type_id')->nullable()->after('type');
            $table->foreign('service_type_id')->references('id')->on('service_types')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('cabs', function (Blueprint $table): void {
            $table->dropForeign(['service_type_id']);
            $table->dropColumn('service_type_id');
        });
    }
};
