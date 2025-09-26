<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Test - PHP Project</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="nav-container">
                <div class="nav-logo">
                    <h1>PHP Project</h1>
                </div>
                <div class="nav-menu">
                    <a href="index.php" class="nav-link">Home</a>
                    <a href="register.php" class="nav-link">Register</a>
                    <a href="login.php" class="nav-link">Login</a>
                    <a href="phptest.php" class="nav-link active">PHP Test</a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <h1>PHP Test Page</h1>
            <p>Simple PHP functionality tests:</p>

            <?php
            // Basic PHP Info
            echo "<h3>PHP Version:</h3>";
            echo "<p>" . PHP_VERSION . "</p>";

            // Server Info
            echo "<h3>Server Info:</h3>";
            echo "<p>Server: " . $_SERVER['SERVER_SOFTWARE'] . "</p>";

            // Database Test
            echo "<h3>Database Test:</h3>";
            require_once 'connect.php';
            try {
                $result = $conn->query("SELECT COUNT(*) as count FROM users");
                $count = $result->fetch_assoc()['count'];
                echo "<p>Users in database: $count</p>";
            } catch (Exception $e) {
                echo "<p>Database error: " . $e->getMessage() . "</p>";
            }

            // Variables Test
            echo "<h3>Variables:</h3>";
            $name = "PHP Project";
            $number = 42;
            echo "<p>Name: $name</p>";
            echo "<p>Number: $number</p>";

            // Array Test
            echo "<h3>Array Test:</h3>";
            $fruits = array("Apple", "Banana", "Orange");
            echo "<p>Fruits: " . implode(", ", $fruits) . "</p>";

            // Date Test
            echo "<h3>Current Date:</h3>";
            echo "<p>" . date("Y-m-d H:i:s") . "</p>";
            ?>
        </div>
    </main>

   
</body>
</html>
