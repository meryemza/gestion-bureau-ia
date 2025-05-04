<?php 
// database/migrations/XXXX_XX_XX_create_absences_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function up()
{
    Schema::create('absences', function (Blueprint $table) {
        $table->id();
        $table->foreignId('employee_id')->constrained()->onDelete('cascade');
        $table->enum('status', ['Présent', 'Absent']);
        $table->text('reason')->nullable();
        $table->string('type');
        $table->timestamps();
    
    });
}
    public function down(): void
    {
        Schema::dropIfExists('absences');
    }
};
