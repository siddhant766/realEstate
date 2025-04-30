<?php
// Start session
session_start();

// Database connection
$host = 'localhost';
$dbname = 'j';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Function to sanitize input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $inquiry_type = sanitize_input($_POST['inquiryType']);
    $user_type = sanitize_input($_POST['userType']);
    $first_name = sanitize_input($_POST['firstName']);
    $last_name = sanitize_input($_POST['lastName']);
    $email = sanitize_input($_POST['email']);
    $phone = sanitize_input($_POST['phone']);
    $city = sanitize_input($_POST['city']);
    $zip_code = sanitize_input($_POST['zipCode']);
    $property_type = sanitize_input($_POST['propertyType']);
    $max_price = isset($_POST['maxPrice']) ? floatval($_POST['maxPrice']) : null;
    $bedrooms = isset($_POST['bedrooms']) ? intval($_POST['bedrooms']) : null;
    $bathrooms = isset($_POST['bathrooms']) ? intval($_POST['bathrooms']) : null;
    $message = sanitize_input($_POST['message']);

    // Validate required fields
    $errors = [];
    if (empty($inquiry_type)) $errors[] = "Inquiry type is required";
    if (empty($user_type)) $errors[] = "User type is required";
    if (empty($first_name)) $errors[] = "First name is required";
    if (empty($last_name)) $errors[] = "Last name is required";
    if (empty($email)) $errors[] = "Email is required";
    if (empty($phone)) $errors[] = "Phone is required";
    if (empty($city)) $errors[] = "City is required";
    if (empty($zip_code)) $errors[] = "Zip code is required";
    if (empty($property_type)) $errors[] = "Property type is required";

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    // If there are no errors, proceed with database insertion
    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO contact_submissions (
                inquiry_type, user_type, first_name, last_name, email, phone,
                city, zip_code, property_type, max_price, bedrooms, bathrooms, message
            ) VALUES (
                :inquiry_type, :user_type, :first_name, :last_name, :email, :phone,
                :city, :zip_code, :property_type, :max_price, :bedrooms, :bathrooms, :message
            )");

            $stmt->bindParam(':inquiry_type', $inquiry_type);
            $stmt->bindParam(':user_type', $user_type);
            $stmt->bindParam(':first_name', $first_name);
            $stmt->bindParam(':last_name', $last_name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':zip_code', $zip_code);
            $stmt->bindParam(':property_type', $property_type);
            $stmt->bindParam(':max_price', $max_price);
            $stmt->bindParam(':bedrooms', $bedrooms);
            $stmt->bindParam(':bathrooms', $bathrooms);
            $stmt->bindParam(':message', $message);

            $stmt->execute();

            // Send email notification
            $to = "admin@realestate.com";
            $subject = "New Contact Form Submission";
            $email_message = "A new contact form submission has been received:\n\n";
            $email_message .= "Name: $first_name $last_name\n";
            $email_message .= "Email: $email\n";
            $email_message .= "Phone: $phone\n";
            $email_message .= "Inquiry Type: $inquiry_type\n";
            $email_message .= "User Type: $user_type\n";
            $email_message .= "City: $city\n";
            $email_message .= "Property Type: $property_type\n";
            $email_message .= "Message: $message\n";

            $headers = "From: $email\r\n";
            $headers .= "Reply-To: $email\r\n";
            $headers .= "X-Mailer: PHP/" . phpversion();

            mail($to, $subject, $email_message, $headers);

            // Set success message
            $_SESSION['success_message'] = "Thank you for your submission! We will contact you soon.";
            header("Location: contact.php");
            exit();

        } catch(PDOException $e) {
            $_SESSION['error_message'] = "Error: " . $e->getMessage();
            header("Location: contact.php");
            exit();
        }
    } else {
        // Store errors in session and redirect back
        $_SESSION['errors'] = $errors;
        $_SESSION['form_data'] = $_POST;
        header("Location: contact.php");
        exit();
    }
} else {
    // If not a POST request, redirect to contact page
    header("Location: contact.php");
    exit();
}
?> 