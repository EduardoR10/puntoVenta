<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
     
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orderid');
            $table->text('changed_by'); 
            $table->enum('action_type', ['INSERT', 'UPDATE', 'DELETE']);
            $table->timestamp('changed_at')->useCurrent();
            $table->text('old_values')->nullable(); 
            $table->text('new_values')->nullable(); 
            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
