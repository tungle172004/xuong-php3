<?php

use App\Models\department;
use App\Models\manager;
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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name',100);
            $table->string('last_name',100);
            $table->string('email',150)->unique();
            $table->string('phone',15);
            $table->date('date_of_birth');
            $table->date('hire_date');
            $table->decimal('salary');
            $table->tinyInteger('is_active')->default(1);
            $table->string('department_id');
            $table->string('manager_id');
            $table->string('address');
            $table->longText('profile_picture')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
