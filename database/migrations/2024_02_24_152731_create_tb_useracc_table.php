<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use App\Models\TbUserAcc;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class CreateTbUserAccTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('fms_g18_tbuseracc', function (Blueprint $table) {
            $table->id();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('contact')->nullable();
            $table->string('image')->nullable();
            $table->string('email')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('role', ['user', 'admin', 'employee'])->default('user');
            $table->rememberToken();
            $table->timestamps();
        });

        // Create default admin
        $admin = new TbUserAcc([
            'firstname' => 'admin',
            'lastname' => 'admin',
            'contact' => '09123456789',
            'email' => 'super_admin@gmail.com',
            'username' => 'superAdmin',
            'password' => Hash::make('superAdmin#17'),
            'role' => 'admin',
        ]);
        $admin->save();

        // Create default employee
        $employee = new TbUserAcc([
            'firstname' => 'employee',
            'lastname' => 'employee',
            'contact' => '09123456789',
            'email' => 'kargada_employee@gmail.com',
            'username' => 'employee',
            'password' => Hash::make('Employee#17'),
            'role' => 'employee',
        ]);
        $employee->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('fms_g18_tbuseracc');
    }
}
