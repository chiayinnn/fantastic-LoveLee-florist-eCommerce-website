<?php
    $username = $_POST["username"];
    $telephone = $_POST["tel"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    // Data connection
    $conn = new mysqli("localhost", "root", "", "lovelee");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        // Check if the username already exists
        $checkuser = "SELECT * FROM users WHERE name=?";
        $stmt = $conn->prepare($checkuser);
        if (!$stmt) {
            die("Error in preparing statement." . $conn->error);
        }
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if (!$result) {
            die("Error in getting result. " . $conn->error);
        }
        $count = $result->num_rows;

        if ($count > 0) {
            echo '<script>
            alert("User already exists! Please register with another username/password.");
            window.location.href = "logindex.php";
            </script>';
            exit; // Exit to prevent further execution
        }

        if ($password === $cpassword) {
            // Insert new user
            $stmt = $conn->prepare("INSERT INTO users(name, telephone, email, address, password) VALUES (?, ?, ?, ?, ?)");
            if (!$stmt) {
                die("Error in preparing statement. " . $conn->error);
            }
            $stmt->bind_param("sssss", $username, $telephone, $email, $address, $password);
            if (!$stmt->execute()) {
                die("Error in executing statement." . $stmt->error);
            }
            echo '<script>
            alert("Register Successfully! Welcome, ' . $username . '");
            window.location.href = "logindex.php";
            </script>';
        } else {
            echo '<script>
            alert("Invalid password! Please try to register again");
            window.location.href = "logindex.php";
            </script>';
        }

        // Close statements and connection
        $stmt->close();
        $conn->close();
    }
?>
