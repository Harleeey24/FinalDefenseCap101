@extends('layout.master')
 
@section('title', 'Create Order')

@section('content')
 <div class="container mt-1">
  <h1>Create Order</h1>
  <h6>Sender's Form | FROM</h6><br>
    <form id="orderForm" method="POST" action="{{ route('place.StoreOrder') }}">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" name="firstname" id="firstName" value="{{ Auth::user()->firstname }}" readonly>
            </div>
            <div class="form-group col-md-6">
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" name="lastname" id="lastName" value="{{ Auth::user()->lastname }}" readonly>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ Auth::user()->email }}" readonly>
            </div>
            <div class="form-group col-md-6">
                <label for="contactNumber">Contact Number</label>
                <input type="tel" class="form-control" name="contactNumber" id="contactNumber" value="{{ Auth::user()->contact }}" readonly>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
            <label for="item">Type of Item</label>
            <select class="form-control" id="item" name="item" required>
                <option value="">Select Type</option>
                <option value="ElectronicAndGadget">Electronic and Gadget</option>
                <option value="FoodAndBeverages">Food and Beverages</option>
                <option value="MedicalSupply">Medical Supply</option>
                <option value="AutomobileAndMachinery">Automobile and Machinery</option>
                <option value="ChemicalsAndDrugs">Chemicals and Drugs</option>
                <option value="FurnitureAndKitchenware">Furniture and kitchenware</option>
                <option value="Others">Others</option>



            </select>
            </div>
            <div class="form-group col-md-4">
              <label for="dimensions" class="form-label">Dimensions</label>
              <select class="form-control" id="Dimensions" name="Dimensions" onchange="updateDimensions()" required>
              <option value="">Select Dimensions</option>
              <option value="KB Mini (9 X 5 X 3) Inch">KB Mini (9 X 5 X 3) Inch</option>
              <option value="KB Small (12 X 10 X 5) Inch">KB Small (12 X 10 X 5) Inch</option>
              <option value="KB Slim (16 X 10 X 3) Inch">KB Slim (16 X 10 X 3) Inch</option>
              <option value="KB Medium (14 X 10.5 X 7) Inch">KB Medium (14 X 10.5 X 7) Inch</option>
              <option value="KB Large (18 X 12 X 9) Inch">KB Large (18 X 12 X 9) Inch</option>
              <option value="KB XL (20 X 16 X 12) Inch">KB XL (20 X 16 X 12) Inch</option>
            </select>
            </div>
            
            <div class="form-group col-md-4">
                <label for="LocationFrom">Warehouse Location( FROM )</label>
                <select class="form-control" id="LocationFrom" name="LocationFrom" required>
                <option value="Andres Soriano Avenue Barangay 655, Manila, Philippines">Andres Soriano Avenue Barangay 655, Manila, Philippines</option>
                </select>
            </div>
        </div>
        
        <hr></hr>
        <h6>Receiver's Form | TO</h6>
        <div class="form-row">
    <div class="form-group col-md-4">
        <label for="LocationTo">Receiver Location</label>
        <select class="form-control" id="LocationTo" name="LocationTo" onchange="updateWarehouseLocations()" required>
            <option value="">Select To</option>
            <option value="MetroManila">Metro Manila</option>
            <option value="Luzon">Luzon</option>
            <option value="Visayas">Visayas</option>
            <option value="Mindanao">Mindanao</option>
            <!-- Add options as needed -->
        </select>
    </div>
    <div class="form-group col-md-4">
        <label for="DropOffWarehouse">Warehouse Drop off Location | TO</label>
        <select class="form-control" id="DropOffWarehouse" name="DropOffWarehouse" required>
            <option value="">Select</option>
            <!-- DropOffWarehouse options will be dynamically populated based on the receiver location -->
        </select>
    </div>
            <div class="form-group col-md-4">
                <label for="receiverName">Receiver's Name</label>
                <input type="text" class="form-control" name ="consigneeName" id="consigneeName" placeholder="Enter Consignee Name" required>
            </div>
            <div class="form-group col-md-4">
                <label for="receiverContact">Receiver's Contact Number</label>
                <input type="tel" class="form-control" name="receiverContact" id="receiverContact" placeholder="Enter Receiver's Contact Number" required>
            </div>
            <div class="form-group col-md-4">
            <label for="address">Address</label>
            <textarea class="form-control" id="receiveraddress" name="receiveraddress" placeholder="Enter Address" required></textarea>
        </div>
        </div>

    <h6>Carrier Selection</h6>
    <div class="form-row">
    <div class="form-group col-md-4">
        <label for="modeSelection">Select Mode of Transport</label>
        <select class="form-control" id="modeSelection" name="modeSelection" required>
            <option value="">Select Mode of Transport</option>
            <option value="Air">AIR</option>
            <option value="Land">LAND</option>
            <option value="Sea">SEA</option>
            <!-- Add options as needed -->
        </select>
    </div>
</div>
<br>

        <div class="form-group">
            <label for="deliveryDate">Shipping Date</label>
            <input type="text" class="form-control" id="deliveryDate" name="deliveryDate" placeholder="Estimated Shipping Date" readonly>
            <label for="price">Sub Total</label>
            <input type="text" class="form-control" id="price" name="price" placeholder="Sub Total" readonly>
            <label for="fee">Shipping Fee</label>
            <input type="text" class="form-control" id="fee" name="fee" placeholder="Shipping Fee" readonly>
            <label for="totalAmount">Total Payment</label>
            <input type="text" class="form-control" id="totalAmount" name="totalAmount" placeholder="Total Payment" readonly>
        </div>

        <div id="confirmationModal" class="modal">
  <div class="modal-content">
    <p>Are you sure you want to place this order?</p>
    <button id="confirmBtn" class="btn btn-primary">Book for Now</button>
    <a href="https://www.youtube.com/" class="btn btn-success">Proceed to Payment</a>
    <button id="cancelBtn" class="btn btn-danger">Cancel</button>
  </div>
    </div>

    <!-- Button to trigger the modal -->
    <button type="submit" id="placeOrderBtn" name="placeOrderBtn" class="btn btn-primary">Place Order</button>

</form>
</div>

<style>
    /* CSS for the modal */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto; /* Enable scroll if needed */
  background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
}

/* Modal content */
.modal-content {
  background-color: #fefefe;
  margin: 15% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 50%;
  text-align: center;
}

/* Modal buttons */
.modal-content button {
  margin: 5px;
}
</style>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>

var modal = document.getElementById("confirmationModal");
var btn = document.getElementById("placeOrderBtn");

// Get the Yes and Cancel buttons in the modal
var confirmBtn = document.getElementById("confirmBtn");
var cancelBtn = document.getElementById("cancelBtn");

// When the user clicks the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on Yes, close the modal and submit the form
confirmBtn.onclick = function() {
  modal.style.display = "none";
  document.getElementById("orderForm").submit(); // Submit the form
}

// When the user clicks on Cancel, close the modal
cancelBtn.onclick = function() {
    modal.style.display = "none";
    document.getElementById("placeOrderBtn").disabled = false; // Re-enable the "Place Order" button
    return false; // Prevent form submission
}
    //mode of transport and carrier selection
    // Update carrier selection and delivery date based on dropdownTo and modeSelection
function updateCarrierSelectionAndDeliveryDate() {
    var currentDate = new Date();
    var LocationTo = $("#LocationTo").val();
    var modeSelection = $("#modeSelection").val();
    var deliveryDate = new Date(currentDate);

    // Hide air and sea options for Metro Manila
    if (LocationTo === "MetroManila") {
        $("#modeSelection option[value='Air']").hide();
        $("#modeSelection option[value='Sea']").hide();
        $("#modeSelection option[value='Land']").show();
    } 
    else  if (LocationTo === "Luzon"){
        $("#modeSelection option[value='Land']").show();
        $("#modeSelection option[value='Air']").hide();
        $("#modeSelection option[value='Sea']").hide();
    } 
    else  if (LocationTo === "Visayas"){
        $("#modeSelection option[value='Land']").hide();
        $("#modeSelection option[value='Air']").show();
        $("#modeSelection option[value='Sea']").show();
    } 
    else  {
        $("#modeSelection option[value='Land']").hide();
        $("#modeSelection option[value='Air']").show();
        $("#modeSelection option[value='Sea']").show();
    } 

    // Calculate delivery date based on mode of transport
    if (modeSelection === "Air") {
        deliveryDate.setDate(currentDate.getDate() + 1); // Air transport takes 1 day
    } else if (modeSelection === "Land") {
        deliveryDate.setDate(currentDate.getDate() + 2); // Land transport takes 2 days
    } else if (modeSelection === "Sea") {
        deliveryDate.setDate(currentDate.getDate() + 4); // Sea transport takes 4 days
    }

    // Update delivery date input value
    $("#deliveryDate").val(deliveryDate.toDateString());
}


// Call the function initially and whenever LocationTo or modeSelection changes
$(document).ready(function () {
    // Call the function initially
    updateCarrierSelectionAndDeliveryDate();

    // Call the function whenever LocationTo or modeSelection changes
    $("#LocationTo, #modeSelection").change(function () {
        updateCarrierSelectionAndDeliveryDate();
    });
});

    //warehouse location
    function updateWarehouseLocations() {
        var LocationTo = document.getElementById("LocationTo").value;
        var DropOffWarehouse = document.getElementById("DropOffWarehouse");

        // Clear existing options
        DropOffWarehouse.innerHTML = '<option value="">Select Drop-off Warehouse Location</option>';

        // Add warehouse locations based on LocationTo
        if (LocationTo === "MetroManila") {
            DropOffWarehouse.innerHTML += '<option value="150 D. Aquino St, Grace Park West, Caloocan, 1406 Metro Manila">150 D. Aquino St, Grace Park West, Caloocan, 1406 Metro Manila</option>';
            DropOffWarehouse.innerHTML += '<option value="BLK 15 LOT 1, BRIÑAS CORNER BANZON ST, BF Resort Dr, Las Piñas, 1747 Metro Manila">BLK 15 LOT 1, BRIÑAS CORNER BANZON ST, BF Resort Dr, Las Piñas, 1747 Metro Manila</option>';
        } else if (LocationTo === "Luzon") {
            DropOffWarehouse.innerHTML += '<option value="Silangan Warehousing, Calamba, 4027 Laguna">Silangan Warehousing, Calamba, 4027 Laguna</option>';
            DropOffWarehouse.innerHTML += '<option value="5 Daisy Panacal Vill. P.C. 3500, Tuguegarao City, Cagayan">5 Daisy Panacal Vill. P.C. 3500, Tuguegarao City, Cagayan</option>';
        } else if (LocationTo === "Visayas") {
            DropOffWarehouse.innerHTML += '<option value="14 Lavilles Street, Mj Cuenco Avenue. P.C. 6000, Cebu City, Cebu">14 Lavilles Street, Mj Cuenco Avenue. P.C. 6000, Cebu City, Cebu</option>';
            DropOffWarehouse.innerHTML += '<option value="347115 Rizal St, Lapuz, Iloilo City, Iloilo">347115 Rizal St, Lapuz, Iloilo City, Iloilo</option>';
        } else if (LocationTo === "Mindanao") {
            DropOffWarehouse.innerHTML += '<option value="Door No. 2, Luzviminda Building, Km. 9 Old Arpt Rd, Sasa, Davao City, 8000 Davao del Sur">Door No. 2, Luzviminda Building, Km. 9 Old Arpt Rd, Sasa, Davao City, 8000 Davao del Sur</option>';
            DropOffWarehouse.innerHTML += '<option value="Kasanyangan Rd, Zamboanga, 7000 Zamboanga del Sur">Kasanyangan Rd, Zamboanga, 7000 Zamboanga del Sur</option>';
        }
    }

    function calculatePrice() {
    // Check if all required dropdowns have been selected
    var item = $("#item").val();
    var dimensions = $("#Dimensions").val();
    var LocationFrom = $("#LocationFrom").val();
    var LocationTo = $("#LocationTo").val();
    var DropOffWarehouse = $("#DropOffWarehouse").val();
    var modeSelection = $("#modeSelection").val();

    // Only calculate if all required dropdowns have been selected
    if (item && dimensions && LocationFrom && LocationTo && DropOffWarehouse && modeSelection) {
        // Perform your price calculation logic here
        var price = 0;

        // Sample price calculation logic (replace with your own logic)
        if (item === "ElectronicAndGadget") {
            price += 100;
        } else if(item === "FoodAndBeverages"){
            price += 110
        } else if(item === "MedicalSupply"){
            price += 115
        } else if(item === "AutomobileAndMachinery"){
            price += 120
        } else if(item === "ChemicalsAndDrugs"){
            price += 125
        } else if(item === "FurnitureAndKitchenware"){
            price += 130
        } else if(item === "Others"){
            price += 135
        }

        // Additional logic based on LocationTo
        if (LocationTo == "MetroManila") {
            price += 300;
        } else if (LocationTo == "Luzon") {
            price += 400;
        } else if (LocationTo == "Visayas") {
            price += 500;
        } else if (LocationTo == "Mindanao") {
            price += 600;
        }

        // Calculate fee based on dimensions or other factors
        // Sample fee calculation logic (replace with your own logic)
        var fee = 0;
        if (dimensions == "KB Mini (9 X 5 X 3) Inch") {
            fee += 10; // Adjust the fee based on the dimensions (replace with your own logic)
        } else if(dimensions == "KB Small (12 X 10 X 5) Inch"){
            fee += 15;
        } else if(dimensions == "KB Slim (16 X 10 X 3) Inch"){
            fee += 20;
        } else if(dimensions == "KB Medium (14 X 10.5 X 7) Inch"){
            fee += 25;
        } else if(dimensions == "KB Large (18 X 12 X 9) Inch"){
            fee += 30;
        } else if(dimensions == "KB XL (20 X 16 X 12) Inch"){
            fee += 35;
        }

        // Calculate total amount (price + fee)
        var totalAmount = price + fee;

        // Display the calculated values
        // Assign values to inputs
        $("#price").val(price);
        $("#fee").val(fee);
        $("#totalAmount").val(totalAmount);

        // Calculate and display estimated delivery date
        var deliveryDate = calculateDeliveryDate();
        $("#deliveryDate").val(deliveryDate);
    }
}

    //Delivery Date
    function calculateDeliveryDate() {
    // Get the current date
    var currentDate = new Date();

    // Add a certain number of days based on the selected mode of transport
    var modeSelection = $("#modeSelection").val();
    var deliveryDate = new Date(currentDate);

    if (modeSelection === "Air") {
        // Air transport takes 1 day
        deliveryDate.setDate(currentDate.getDate() + 1);
    } else if (modeSelection === "Land") {
        // Land transport takes 2 days
        deliveryDate.setDate(currentDate.getDate() + 2);
    } else if (modeSelection === "Sea") {
        // Sea transport takes 4 days
        deliveryDate.setDate(currentDate.getDate() + 4);
    }

    // Format the delivery date as a string in a desired format
    var formattedDeliveryDate = deliveryDate.toDateString();

    return formattedDeliveryDate;
}

// Disable "Place Order" button until all required dropdowns are selected
$(document).ready(function () {
    $("#placeOrderBtn").prop("disabled", true);

    $("#item, #LocationFrom, #LocationTo, #Dimensions, #DropOffWarehouse, #modeSelection").change(function () {
        // Enable the button only if all required dropdowns have been selected
        if ($("#item").val() && $("#Dimensions").val() && $("#LocationFrom").val() && $("#LocationTo").val() && $("#DropOffWarehouse").val() && $("#modeSelection").val()) {
            $("#placeOrderBtn").prop("disabled", false);
            calculatePrice();
        } else {
            $("#placeOrderBtn").prop("disabled", true);
        }
    });
});

document.getElementById("placeOrderBtn").addEventListener("click", function() {
        // Disable the button to prevent multiple submissions
        this.disabled = true;});


//ACTIVELINK FUNCTION
document.addEventListener('DOMContentLoaded', function () {
        var indicator = document.getElementById('nav-indicator');
        var activeLink = document.querySelector('.side-menu a.active');
        if (activeLink) {
            var linkRect = activeLink.getBoundingClientRect();
            indicator.innerHTML = activeLink.textContent;
            indicator.style.width = linkRect.width + 'px';
            indicator.style.left = linkRect.left + 'px';
        }
    });
</script>
@endsection