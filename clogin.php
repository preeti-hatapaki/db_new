<?php
session_start();

include('db_connection.php');

// Login Logic
if (isset($_POST['submit'])) {
    $company_name = $_POST['company_name'];
    $password = $_POST['password'];

    // Prepared statement to prevent SQL injection
    $sql = "SELECT * FROM company WHERE company_name = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $company_name, $company_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (isset($row["password"]) && password_verify($password, $row["password"])) {
            $_SESSION['username'] = $row['company_name'];
            $_SESSION['loggedin'] = true;
            header("Location: company_home.php");
            exit();
        } else {
            echo '<script>alert("Invalid company name or password");</script>';
        }
    } else {
        echo '<script>alert("Invalid company name or password");</script>';
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <br><br>
    <div id="form">
        <h1 id="heading">Login Form</h1>
        <form name="form" action="clogin.php" method="POST" onsubmit="return isValid()">
            <label>Enter Company Name/Email: </label>
            <input type="text" id="company_name" name="company_name" required><br><br>
            <label>Password: </label>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" id="btn" value="Login" name="submit">
        </form>
    </div>
    <script>
        function isValid() {
            var company_name = document.getElementById('company_name').value;
            var password = document.getElementById('password').value;
            if(company_name.length == 0 || password.length == 0) {
                alert("Enter company name or email id and password!");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
