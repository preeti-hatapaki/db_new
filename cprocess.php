<?php
// Start the session
session_start();

// Check if 'email' session variable is set
if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
    // Retrieve email from session
    $email = $_SESSION['email'];

    // Database connection
    $username = "preeti";
    $password = "admin";
    $database = "database1";

    $conn = mysqli_connect("localhost", $username, $password, $database);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve user's details from the users table
    $user_query = "SELECT * FROM users WHERE email = '$email'";
    $user_result = mysqli_query($conn, $user_query);

    if (!$user_result) {
        die("Error retrieving user details: " . mysqli_error($conn));
    }

    $user_row = mysqli_fetch_assoc($user_result);

    // Check if user details are fetched successfully
    if (!$user_row) {
        die("User details not found for email: $email");
    }

    // Extract user details
    $state = $user_row['state'];
    $caste = $user_row['caste'];
    $gender = $user_row['gender'];
    $tenth_score = $user_row['tenth_score'];
    $twelfth_score = $user_row['twelfth_score'];
    $annual_income = $user_row['annual_income'];
    $nationality = $user_row['nationality'];

    // Query to fetch eligible scholarships based on user's details
    $eligible_scholarships_query = "SELECT * FROM criteria WHERE 
                                    tenth_score <= '$tenth_score' AND 
                                    twelfth_score <= '$twelfth_score' AND 
                                    annual_income >= '$annual_income' AND 
                                    (caste LIKE '%$caste%' OR caste = 'General,OBC,SC,ST') AND 
                                    (gender LIKE '%$gender%' OR gender = 'Male,Female,Other')";

    // Check if the selected state is "All" or if it matches the state in the criteria table
    if ($state != "All") {
        $eligible_scholarships_query .= " AND (state LIKE '%$state%' OR state = 'All')";
    }

    $eligible_scholarships_query .= " AND nationality = '$nationality'";

    $eligible_scholarships_result = mysqli_query($conn, $eligible_scholarships_query);

    if (!$eligible_scholarships_result) {
        die("Error fetching eligible scholarships: " . mysqli_error($conn));
    }

    mysqli_close($conn);
} else {
    // Handle case where 'email' session variable is not set or empty
    die("Email not found in session.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eligible Scholarships</title>
</head>
<body>
    <h2>Eligible Scholarships</h2>
    <?php if (mysqli_num_rows($eligible_scholarships_result) > 0) : ?>
        <div class='scholarships-container'>
            <?php while ($row = mysqli_fetch_assoc($eligible_scholarships_result)) : ?>
                <div class='scholarship'>
                    <div class='scholarship-name'><?php echo $row['scholarship_name']; ?></div>
                    <div class='grant-amount'><?php echo $row['grant_amount']; ?></div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else : ?>
        <p>No scholarships available for your eligibility criteria.</p>
    <?php endif; ?>
</body>
</html>
