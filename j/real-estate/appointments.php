<?php
session_start();

// Connect to database
$conn = new mysqli("localhost", "root", "", "j");

// Initialize variables
$user_email = "";
$properties = [];
$success_message = "";
$error_message = "";

// Get email from session
if (isset($_SESSION['user_email'])) {
    $user_email = $_SESSION['user_email'];
} else {
    $error_message = "Please login to book appointments.";
}

// Fetch available properties
$property_query = "SELECT id, title, location FROM properties ORDER BY title";
$result = $conn->query($property_query);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $properties[] = $row;
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($user_email)) {
    $property = $_POST['property'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $message = $_POST['message'];

    // Validate date and time
    $current_date = date('Y-m-d');
    $current_time = date('H:i');
    $is_valid = true;
    
    if ($date < $current_date) {
        $is_valid = false;
        $error_message = "Please select a future date.";
    } else if ($date == $current_date && $time <= $current_time) {
        $is_valid = false;
        $error_message = "Please select a future time.";
    }
    
    // Check for existing appointments
    if ($is_valid) {
        $check_query = "SELECT COUNT(*) as count FROM appointments WHERE appointment_date = ? AND appointment_time = ?";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bind_param("ss", $date, $time);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();
        $row = $check_result->fetch_assoc();
        
        if ($row['count'] > 0) {
            $is_valid = false;
            $error_message = "This time slot is already booked. Please select another time.";
        }
        $check_stmt->close();
        
        if ($is_valid) {
            // Insert appointment
            $stmt = $conn->prepare("INSERT INTO appointments (user_email, property_name, appointment_date, appointment_time, message) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $user_email, $property, $date, $time, $message);
            
            if ($stmt->execute()) {
                $success_message = "Appointment booked successfully!";
                header("Location: appointments.php?success=1");
                exit();
            } else {
                $error_message = "Error booking appointment. Please try again.";
            }
            $stmt->close();
        }
    }
}

// Fetch existing appointments for logged-in user
$appointments = [];
$appointmentCount = 0;
if (!empty($user_email)) {
    $stmt = $conn->prepare("SELECT * FROM appointments WHERE user_email = ?");
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $result = $stmt->get_result();
    $appointments = $result->fetch_all(MYSQLI_ASSOC);
    $appointmentCount = count($appointments);
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>My Appointments</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 p-4">
<?php include 'includes/navbar.php'; ?>
  <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <?php if (isset($_GET['success'])): ?>
    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
      Appointment booked successfully!
    </div>
    <?php endif; ?>
    
    <?php if (!empty($error_message)): ?>
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
      <?php echo $error_message; ?>
    </div>
    <?php endif; ?>
    <h2 class="text-2xl font-bold mb-4">My Appointments (<?php echo $appointmentCount; ?>)</h2>

    <!-- Existing Appointments -->
    <?php if ($appointmentCount > 0): ?>
      <ul class="space-y-4 mb-6">
        <?php foreach ($appointments as $app): ?>
          <li class="p-4 border rounded bg-gray-50">
            <p><strong>Property:</strong> <?= $app['property_name'] ?></p>
            <p><strong>Email:</strong> <?= $app['user_email'] ?></p>
            <p><strong>Date:</strong> <?= $app['appointment_date'] ?></p>
            <p><strong>Time:</strong> <?= $app['appointment_time'] ?></p>
            <p><strong>Message:</strong> <?= $app['message'] ?></p>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
      <p class="mb-6 text-gray-500">No appointments found for <strong><?= htmlspecialchars($user_email) ?></strong>.</p>
    <?php endif; ?>

    <!-- Show form to book a new appointment -->
    <h3 class="text-xl font-semibold mb-2">Book a New Appointment</h3>
    <form method="POST" class="space-y-4">
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="property">Select Property</label>
        <select name="property" id="property" required class="w-full border p-2 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <option value="">Choose a property...</option>
          <?php foreach ($properties as $property): ?>
          <option value="<?php echo htmlspecialchars($property['title']); ?>">
            <?php echo htmlspecialchars($property['title'] . ' - ' . $property['location']); ?>
          </option>
          <?php endforeach; ?>
        </select>
      </div>
      
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="date">Appointment Date</label>
        <input type="date" name="date" id="date" required 
               min="<?php echo date('Y-m-d'); ?>" 
               class="w-full border p-2 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
      </div>
      
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="time">Appointment Time</label>
        <input type="time" name="time" id="time" required 
               class="w-full border p-2 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
      </div>
      
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="message">Message (Optional)</label>
        <textarea name="message" id="message" 
                  class="w-full border p-2 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                  rows="4" placeholder="Any specific requirements or questions?"></textarea>
      </div>
      
      <button type="submit" class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-200 ease-in-out transform hover:-translate-y-1 hover:shadow-lg">
        Book Appointment
      </button>
    </form>

    <?php if (empty($user_email)): ?>
      <p class="mb-6 text-gray-500">Please login to view or book appointments.</p>
    <?php endif; ?>
  </div>
</body>
</html>