<?php
session_start();

include('db_connection.php');


if (isset($_POST['submit'])) {
    $company_name = $_POST['company_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO company (company_name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $company_name, $email, $password);

    if ($stmt->execute()) {
        $_SESSION['username'] = $company_name;
        $_SESSION['loggedin'] = true;
        header("Location: clogin.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Signup</title>
</head>
<body>
    <h2>Company Signup</h2>
    <form action="csignup.php" method="POST">
        <label for="company_name">Company Name:</label><br>
        <input type="text" id="company_name" name="company_name" required><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" name="submit" value="Signup">
    </form>
</body>
</html>
