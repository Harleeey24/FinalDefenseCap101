<?php

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
        Schema::create('fms_g18_formdetails', function (Blueprint $table) {
            $table->id();
            $table->uuid('order_id')->unique();
            $table->foreignId('user_id')->constrained('fms_g18_tbuseracc')->onDelete('cascade');
            $table->string('firstname'); // Add firstname column
            $table->string('lastname'); // Add lastname column
            $table->string('email'); // Add email column
            $table->string('contact'); // Add contact column
            $table->enum('item', [
                'ElectronicAndGadget', 
                'FoodAndBeverages', 
                'MedicalSupply',
                'AutomobileAndMachinery', 
                'ChemicalsAndDrugs', 
                'FurnitureAndKitchenware', 
                'Others'
            ]);
            $table->enum('dimensions', [
                'KB Mini (9 X 5 X 3) Inch', 
                'KB Small (12 X 10 X 5) Inch', 
                'KB Slim (16 X 10 X 3) Inch',
                'KB Medium (14 X 10.5 X 7) Inch', 
                'KB Large (18 X 12 X 9) Inch', 
                'KB XL (20 X 16 X 12) Inch'
            ]);
            $table->enum('LocationFrom', ['Andres Soriano Avenue Barangay 655, Manila, Philippines']);
            $table->enum('LocationTo', ['MetroManila', 'Luzon', 'Visayas', 'Mindanao']); 
            $table->enum('DropOffWarehouse', [
                '150 D. Aquino St, Grace Park West, Caloocan, 1406 Metro Manila', 
                'BLK 15 LOT 1, BRIÑAS CORNER BANZON ST, BF Resort Dr, Las Piñas, 1747 Metro Manila', 
                'Silangan Warehousing, Calamba, 4027 Laguna', 
                '5 Daisy Panacal Vill. P.C. 3500, Tuguegarao City, Cagayan', 
                '14 Lavilles Street, Mj Cuenco Avenue. P.C. 6000, Cebu City, Cebu', 
                '347115 Rizal St, Lapuz, Iloilo City, Iloilo', 
                'Door No. 2, Luzviminda Building, Km. 9 Old Arpt Rd, Sasa, Davao City, 8000 Davao del Sur', 
                'Kasanyangan Rd, Zamboanga, 7000 Zamboanga del Sur'
            ]); 
            $table->string('consigneeName');
            $table->string('receiverContact');
            $table->string('receiveraddress');
            $table->enum('modeSelection', ['Land', 'Air', 'Sea']);
            $table->date('deliveryDate');
            $table->integer('price');
            $table->integer('fee');
            $table->integer('totalAmount');
            $table->enum('status', ['Pending', 'Ongoing']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fms_g18_formdetails');
    }
};
