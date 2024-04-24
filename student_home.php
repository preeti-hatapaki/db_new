<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Home</title>
    <!-- Add your CSS links here -->
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Scholarship Portal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    
                    <li class="nav-item">
                    <a href="eligiblity.php" class="btn btn-primary">View Eligible Scholarships</a>
                    </li>
                    <li class="nav-item">
                    <a href="about.php">About</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Delete Application</a>
                    </li>
                </ul>
            
                <form class="d-flex" action="logout.php" method="post">
    <button class="btn btn-outline-success" type="submit" name="logout">Logout</button>
</form>
                
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <h2>Welcome to Scholarship Portal</h2>
                <p>This is the home page for students. Here you can explore available scholarships, learn more about the portal, and manage your applications.</p>
            </div>
        </div>
    </div>

    <!-- Add your JavaScript links here -->
    <script src="script.js"></script>
</body>

</html>
