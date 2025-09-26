<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - PHP Project</title>
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
                    <a href="profile.php" class="nav-link active">Profile</a>
                    <a href="logout.php" class="nav-link">Logout</a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <?php
            session_start();
            require_once 'connect.php';

            // Check if user is logged in
            if (!isset($_SESSION['user_id'])) {
                header("Location: login.php");
                exit();
            }

            $user_id = $_SESSION['user_id'];

            // Get user information
            $stmt = $conn->prepare("SELECT username, email, first_name, last_name, created_at, updated_at FROM users WHERE id = ?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();
            } else {
                echo '<div class="message error">User not found.</div>';
                exit();
            }

            // Handle profile update
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
                $first_name = trim($_POST['first_name']);
                $last_name = trim($_POST['last_name']);
                $email = trim($_POST['email']);

                $errors = [];

                if (empty($first_name)) $errors[] = "First name is required";
                if (empty($last_name)) $errors[] = "Last name is required";
                if (empty($email)) $errors[] = "Email is required";

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors[] = "Invalid email format";
                }

                // Check if email is already taken by another user
                $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
                $stmt->bind_param("si", $email, $user_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $errors[] = "Email is already taken";
                }

                if (empty($errors)) {
                    $stmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ? WHERE id = ?");
                    $stmt->bind_param("sssi", $first_name, $last_name, $email, $user_id);

                    if ($stmt->execute()) {
                        $_SESSION['first_name'] = $first_name;
                        $_SESSION['last_name'] = $last_name;
                        echo '<div class="message success">Profile updated successfully!</div>';

                        // Refresh user data
                        $user['first_name'] = $first_name;
                        $user['last_name'] = $last_name;
                        $user['email'] = $email;
                    } else {
                        echo '<div class="message error">Failed to update profile. Please try again.</div>';
                    }
                } else {
                    foreach ($errors as $error) {
                        echo '<div class="message error">' . htmlspecialchars($error) . '</div>';
                    }
                }
            }
            ?>

            <div class="profile-container">
                <div class="profile-header">
                    <h2>Welcome, <?php echo htmlspecialchars($user['first_name']); ?>!</h2>
                    <p>Manage your account information below.</p>
                </div>

                <div class="profile-info">
                    <div class="info-group">
                        <span class="info-label">Username:</span>
                        <span class="info-value"><?php echo htmlspecialchars($user['username']); ?></span>
                    </div>

                    <div class="info-group">
                        <span class="info-label">Email:</span>
                        <span class="info-value"><?php echo htmlspecialchars($user['email']); ?></span>
                    </div>

                    <div class="info-group">
                        <span class="info-label">Full Name:</span>
                        <span class="info-value"><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></span>
                    </div>

                    <div class="info-group">
                        <span class="info-label">Member Since:</span>
                        <span class="info-value"><?php echo date('F j, Y', strtotime($user['created_at'])); ?></span>
                    </div>

                    <div class="info-group">
                        <span class="info-label">Last Updated:</span>
                        <span class="info-value"><?php echo date('F j, Y', strtotime($user['updated_at'])); ?></span>
                    </div>
                </div>

                <h3 style="margin-top: 2rem;">Update Profile Information</h3>

                <form method="POST" action="">
                    <div class="form-group">
                        <label for="first_name">First Name:</label>
                        <input type="text" id="first_name" name="first_name" required
                               value="<?php echo htmlspecialchars($user['first_name']); ?>">
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name:</label>
                        <input type="text" id="last_name" name="last_name" required
                               value="<?php echo htmlspecialchars($user['last_name']); ?>">
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required
                               value="<?php echo htmlspecialchars($user['email']); ?>">
                    </div>

                    <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>
                </form>
            </div>
        </div>
    </main>

   

    <script src="script.js"></script>
</body>
</html>
