<?php
include 'connect.php'; 

// --- Sign Up ---
if (isset($_POST['signUp'])) {
    $firstName = $_POST['fName']; 
    $lastName = $_POST['lName']; 
    $email = $_POST['email']; 
    $password = $_POST['password']; 
    $password = md5($password); 

    $checkEmail = "SELECT * FROM users WHERE email = '$email'"; 
    $result = $conn->query($checkEmail); 

    if ($result->num_rows > 0) {
        echo "Email Address Already Exists";
    } else {
        $insertQuery = "INSERT INTO users (firstName, lastName, email, password) 
                        VALUES ('$firstName', '$lastName', '$email', '$password')"; 

        if ($conn->query($insertQuery) === TRUE) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

// --- Sign In ---
if (isset($_POST['signIn'])) {
    $email = $_POST['email']; 
    $password = $_POST['password']; 
    $password = md5($password); 

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'"; 
    $result = $conn->query($sql); 

    if ($result->num_rows > 0) {
        session_start(); 
        $row = $result->fetch_assoc(); 
        $_SESSION['email'] = $row['email']; 
        header("Location: homepage.php");  
        exit(); 
    } else {
        echo "Incorrect Email or Password"; 
    }
}
?>
