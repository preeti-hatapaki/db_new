<?php
// Include the database connection file
include "db_connection.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data using $_POST
    $scholarship_name = $_POST['scholarship_name'];
    $state = $_POST['state'];
    $caste = $_POST['caste'];
    $gender = $_POST['gender'];
    $tenth_score = $_POST['tenth_score'];
    $twelfth_score = $_POST['twelfth_score'];
    $nationality = $_POST['nationality'];
    $annual_income = $_POST['annual_income'];
    $grant_amount = $_POST['grant_amount'];
    $scholarship_desc = $_POST['scholarship_desc'];

    // Retrieve company email from session
    session_start();
    $company_email = $_SESSION['email'];

    // SQL query to insert data into the criteria table
    $sql = "INSERT INTO criteria (scholarship_name, state, caste, gender, tenth_score, twelfth_score, nationality, annual_income, grant_amount, company_id, scholarship_desc) 
            VALUES ('$scholarship_name', '$state', '$caste', '$gender', '$tenth_score', '$twelfth_score', '$nationality', '$annual_income', '$grant_amount', '$company_email', '$scholarship_desc')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // Redirect back to the form page with success message
        header("Location: company_home.php");
        exit();
    } else {
        // Display error message if insertion fails
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
