<?php
      $username = $_POST["username"];
      $password = $_POST["password"];
      
      $conn = new mysqli("localhost", "root", "", "lovelee");

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }else{
          $sql = "SELECT * FROM users WHERE name = ?";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("s", $username);
          $stmt->execute();
          $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if ($user['password'] === $password) {
                header("Location:home.php");
            } if ($username == "admin" && $password == "admin123") {
              header("Location: admin.php");}
            else {
                echo '<script>
                alert("Login failed. Incorrect password!");
                window.location.href = "logindex.php";
                </script>';
            }
          } else {
            echo '<script>
            alert("Login failed. User not found!");
            window.location.href = "logindex.php";
            </script>';
          }

          $stmt->close();
        }
      ?>