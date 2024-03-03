<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"> <!-- Include CSS file -->
    <title>Sign in & Sign up Form</title>
</head>
<body>
<div class="container">
    <div class="forms-container">
        <div class="signin-signup">
        <form method="POST" action="{{ route('signin.action') }}" class="sign-in-form">
  @csrf
    <h2 class="title">Sign in</h2>
    <div class="input-field">
        <i class="fas fa-user"></i>
        <input type="text" name="username" id="username" placeholder="Username" />
    </div>
    <div class="input-field">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" id="signin-password" placeholder="Password" />
        <span class="toggle-password" id="toggle-signin-password">
            <i class="fas fa-eye"></i>
        </span>
    </div>
    <button type="submit" class="btn btn-primary">Sign in</button>
    </form>

    <form method="POST" action="{{ route('signup.action') }}" class="sign-up-form" enctype="multipart/form-data" id="signupForm">
    @csrf
    <h2 class="title">Sign up</h2>
    <div class="input-field">
        <i class="fas fa-user"></i>
        <input type="text" name="firstname" id="firstname" placeholder="Firstname" required>
    </div>
    <div class="input-field">
        <i class="fas fa-user"></i>
        <input type="text" name="lastname" id="lastname" placeholder="Lastname" required>
    </div>
    <div class="input-field">
        <i class="fas fa-phone-alt"></i>
        <input type="text" name="contact" id="contact" placeholder="Contact Number" required>
    </div>

    <h6>Please provide any valid ID</h6>
    <div class="input-field">
        <i class="far fa-image"></i>
        <input type="file" class="form-control" id="image" name="image" required>
    </div>
    <div class="input-field">
        <i class="fas fa-envelope"></i>
        <input type="email" name="email" id="email" placeholder="Email" required>
    </div>
    <div class="input-field">
        <i class="fas fa-user"></i>
        <input type="text" name="username" id="username" placeholder="Username" required>
    </div>
    <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="signin-password" placeholder="Password" />
                    <span class="toggle-password" id="toggle-signin-password">
                        <i class="fas fa-eye"></i>
                    </span>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="termsCheckbox" required>
        <label class="form-check-label" for="termsCheckbox">
            I agree to the <a href="#" id="termsLink">terms and conditions</a>
        </label>
    </div>
    <button type="submit" class="btn btn-primary">Sign up</button>
</form>

        </div>
    </div>

    <div class="panels-container">
        <div class="panel left-panel">
            <div class="content">
                <h3>New here ?</h3>
                <p>
                    Ready to ship with ease? Sign up now and experience seamless freight management!
                </p>
                <button class="btn transparent" id="sign-up-btn">
                    Sign up
                </button>
            </div>
            <img src="img/log.svg" class="image" alt="">
        </div>
        <div class="panel right-panel">
            <div class="content">
                <h3>One of us ?</h3>
                <p>
                    Welcome aboard the kargada freight services! Join us and experience seamless shipping like never before.
                </p>
                <button class="btn transparent" id="sign-in-btn">
                    Sign in
                </button>
            </div>
            <img src="img/register.svg" class="image" alt="">
        </div>
    </div>
</div>



<!-- Include JS file -->
<script src="{{ asset('js/login.js') }}"></script>

<!-- Popup for terms and conditions -->
<div class="popup" id="termsPopup">
    <div class="popup-content">
        <span class="close" id="closePopup">&times;</span>
        <h2>Terms and Conditions</h2>
        <p>User Account Terms and Conditions<br>
        User Account Terms and Conditions
        <br>
These terms and conditions ("Account Terms") govern the use of user accounts on https://oms.kargadafreightservices.com. By creating an account on the Website, you agree to be bound by these Account Terms. If you do not agree with any part of these Account Terms, you may not create an account on the Website.
<br>
1. Account Creation
<br>
1.1. In order to create an account on the Website, you must provide accurate and complete information as prompted by the account registration form.
<br>
1.2. You must be at least 18 years old to create an account on the Website. By creating an account, you represent and warrant that you are at least 18 years old.
<br>
1.3. You are responsible for maintaining the confidentiality of your account and password and for restricting access to your account. You agree to accept responsibility for all activities that occur under your account or password.
<br>
2. Account Usage
<br>
2.1. You agree to use your account only for lawful purposes and in accordance with these Account Terms and all applicable laws and regulations.
<br>
2.2. You may not share your account credentials with any third party or allow any third party to access your account.
<br>
2.3. You agree to notify https://oms.kargadafreightservices.com immediately of any unauthorized use of your account or any other breach of security.
    <br>
3. Account Termination
<br>
3.1. https://oms.kargadafreightservices.com reserves the right to suspend or terminate your account at any time and for any reason, without prior notice or liability.
<br>
3.2. You may terminate your account at any time by contacting https://oms.kargadafreightservices.com or by using the account termination option available on the Website.
<br>
3.3 Admin has a chance to delete all suspicious accounts, such as
<br>
•  Improper valid ID attaches
<br>
•  Mismatch and name in the form and in the ID attach
<br>
•  Having a lot of booking orders (the limit is 50 bookings per account)
<br>
•  Systematic abuse of features
<br>
•  Illegal Activities
<br>
•  and Impersonation
<br>
4. User Content
<br>
4.1. You retain ownership of any content that you upload, submit, or otherwise make available through your account ("User Content").
<br>
4.2. By uploading, submitting, or making User Content available through your account, you grant https://oms.kargadafreightservices.com a non-exclusive, royalty-free, worldwide, perpetual, and irrevocable license to use, reproduce, modify, adapt, publish, translate, distribute, and display such User Content on the Website and for any other purposes deemed necessary by https://oms.kargadafreightservices.com.
    <br>
5. Privacy
<br>
5.1. Your use of your account is subject to https://oms.kargadafreightservices.com Privacy Policy, which is incorporated by reference into these Account Terms. By creating an account, you consent to the collection, use, and disclosure of your information as described in the Privacy Policy.
<br>
6. Modifications
<br>
6.1. https://oms.kargadafreightservices.com reserves the right to modify or update these Account Terms at any time without prior notice. Any changes to these Account Terms will be effective immediately upon posting on the Website.
<br>
<br>
<br>
Freight Order Management System Terms and Conditions
<br>
These terms and conditions govern your use of the System. By accessing or using the System, you agree to be bound by these Terms. If you do not agree with any part of these Terms, you may not order or book on the system.
<br>
1. Use of the System
<br>
1.1. You agree to use the System only for the purpose of placing freight orders and managing shipments in accordance with applicable laws and regulations.
<br>
1.2. You agree not to use the System to:
<br>
a. Submit false, inaccurate, or misleading information;
<br>
b. Violate any laws, regulations, or industry standards related to freight transportation;
<br>
c. Interfere with the operation of the System or the services provided through the System;
<br>
d. Attempt to gain unauthorized access to the System or its related systems or networks; or
<br>
e. Use the System for any unlawful or fraudulent purpose.
<br>
2. Freight Orders
<br>
2.1. By placing a freight order through the System, you agree to provide accurate and complete information about the shipment, including origin, destination, dimensions, weight, and any special handling requirements.
<br>
2.2. You acknowledge that all freight orders placed through the System are subject to acceptance by the freight carrier, and that the availability of transportation services may vary based on factors such as capacity, equipment availability, and regulatory restrictions.
<br>
2.3. You agree to comply with any additional terms and conditions imposed by the freight carrier, including but not limited to tariffs, rules tariffs, and service agreements.
<br>
3. Booking and Confirmation
<br>
3.1. Upon submission of a freight order through the System, you may receive a booking confirmation indicating that the order has been received by the freight carrier. However, such confirmation does not constitute acceptance of the order, and the freight carrier reserves the right to reject or modify any order in its sole discretion.
<br>
3.2. The availability of transportation services is not guaranteed, and the freight carrier may cancel or reschedule bookings at any time due to factors such as weather conditions, equipment failures, or operational constraints.
<br>
4. Liability
<br>
4.1. The freight carrier shall not be liable for any loss, damage, or delay arising from or related to the use of the System, including but not limited to errors or omissions in the transmission of data, unauthorized access to the System, or disruptions in service.
<br>
4.2. You agree to indemnify and hold harmless the freight carrier from any claims, damages, losses, liabilities, costs, and expenses (including attorneys' fees) arising from or related to your use of the System or any breach of these Terms.
<br>
5. Governing Law
<br>
5.1. These Terms shall be governed by and construed in accordance with the laws of [Your Jurisdiction], without regard to its conflict of law provisions.
<br>
6. Changes to Terms
<br>
6.1. The freight carrier reserves the right to revise these Terms at any time without prior notice. By using the System, you are agreeing to be bound by the then-current version of these Terms.
<br>
Contact Us
<br>
If you have any questions about these Terms, please contact us at kargadadelivery@gmail.com.


    </div>
</div>

<style>
  .popup {
    display: none;
    position: fixed;
    z-index: 9999; /* Adjust the z-index to make sure it's above other elements */
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
}

.popup-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 600px;
    text-align: center;
    position: relative;
    z-index: 10000; /* Ensure the content is above other elements */
}
</style>

<script>
    // Get the terms and conditions link and the popup
    var termsLink = document.getElementById("termsLink");
    var termsPopup = document.getElementById("termsPopup");

    // Show the popup when the link is clicked
    termsLink.addEventListener("click", function(event) {
        event.preventDefault(); // Prevent default link behavior
        termsPopup.style.display = "block";
    });

    // Close the popup when the close button is clicked
    var closePopup = document.getElementById("closePopup");
    closePopup.addEventListener("click", function() {
        termsPopup.style.display = "none";
    });

    // Close the popup when the user clicks outside of it
    window.addEventListener("click", function(event) {
        if (event.target == termsPopup) {
            termsPopup.style.display = "none";
        }
    });
</script>

</body>
</html>
