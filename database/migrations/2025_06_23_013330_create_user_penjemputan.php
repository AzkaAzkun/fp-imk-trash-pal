<?php

use App\Models\UserPenjemputan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\UserPenjemputanEnum;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_penjemputan', function (Blueprint $table) {
            $table->id();
            $table->integer('bank_sampah_id');
            $table->date('tanggal_penjemputan');
            $table->string('alamat_penjemputan');
            $table->enum('status', array_column(UserPenjemputanEnum::cases(), 'value'));
            $table->string('nomor_invoice');
            $table->float('volume')->default(0.0);
            $table->foreignId('user_id')->constrained('user')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_penjemputan');
    }
};
