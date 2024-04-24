<?php
    // Include database connection
    include("db_connection.php");

    // Error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Initialize variables
    $username = $email = $password = $cpassword = $dob = $state = $caste = "";
    $tenth_score = $twelfth_score = $annual_income = $nationality = $gender = "";

    // Processing form data when form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
        $dob = mysqli_real_escape_string($conn, $_POST['dob']);
        $state = mysqli_real_escape_string($conn, $_POST['state']);
        $caste = mysqli_real_escape_string($conn, $_POST['caste']);
        $tenth_score = mysqli_real_escape_string($conn, $_POST['tenth_score']);
        $twelfth_score = mysqli_real_escape_string($conn, $_POST['twelfth_score']);
        $annual_income = mysqli_real_escape_string($conn, $_POST['annual_income']);
        $nationality = mysqli_real_escape_string($conn, $_POST['nationality']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);

        // Validate form data (you can add more validation if needed)

        // Check if passwords match
        if ($password != $cpassword) {
            echo "Passwords do not match.";
            exit;
        }

        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and bind SQL statement (use prepared statements)
        $sql = "INSERT INTO users (username, email, password, dob, state, caste, tenth_score, twelfth_score, annual_income, nationality, gender) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssss", $username, $email, $hashed_password, $dob, $state, $caste, $tenth_score, $twelfth_score, $annual_income, $nationality, $gender);

        // Execute SQL statement
        if ($stmt->execute()) {
            // Redirect to login page after successful registration
            header("Location: student_login.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Signup</title>
</head>
<body>
    <h2>User Signup</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        <label for="cpassword">Confirm Password:</label><br>
        <input type="password" id="cpassword" name="cpassword" required><br>
        <label for="dob">Date of Birth:</label><br>
        <input type="date" id="dob" name="dob" required><br>
        <label for="state">State:</label><br>
        <select id="state" name="state" required>
            <option value="">Select State</option>
            <option value="Andhra Pradesh">Andhra Pradesh</option>
            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
            <!-- Add more states as needed -->
        </select><br>
        <label for="caste">Caste:</label><br>
        <select id="caste" name="caste" required>
            <option value="">Select Caste</option>
            <option value="General">General</option>
            <option value="OBC">OBC</option>
            <option value="SC">SC</option>
            <option value="ST">ST</option>
            <!-- Add more castes as needed -->
        </select><br>
        <label for="tenth_score">10th Score:</label><br>
        <input type="number" id="tenth_score" name="tenth_score" step="0.01" required><br>
        <label for="twelfth_score">12th Score:</label><br>
        <input type="number" id="twelfth_score" name="twelfth_score" step="0.01" required><br>
        <label for="annual_income">Annual Income:</label><br>
        <input type="number" id="annual_income" name="annual_income" step="0.01" required><br>
        <label for="nationality">Nationality:</label><br>
        <select id="nationality" name="nationality" required>
            <option value="Indian">Indian</option>
            <option value="Other">Other</option>
        </select><br>
        <label for="gender">Gender:</label><br>
        <select id="gender" name="gender" required>
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select><br>
        <input type="submit" value="Signup">
    </form>
</body>
</html>


