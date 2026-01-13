<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = "customer";


$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$numbers = preg_match('@[0-9]@', $password);
if (!$uppercase ) {
    echo "Hasło ma zawierać przynajmniej jedną wielką literę";
    exit;
}
elseif(!$lowercase) {
     echo "Hasło ma zawierać przynajmniej jedną małą literę";
    exit;
}
elseif(!$numbers) {
    echo "Hasło ma zawierać przynajmniej jedną cyfrę";
    exit;
}
elseif(strlen($password) < 8) {
    echo "Hasło ma być przynajmniej 8 dlugości";
    exit;
}
        // Hashowanie hasła
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, phone, address, username, password, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss",$first_name,$last_name,$email,$phone,$address, $username, $passwordHash, $role);
        $stmt->execute();
        $stmt->close();

        $_SESSION['user_id'] = $conn->insert_id;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;

        header("Location: index.php");
        exit;
    } else {
        
    }

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>

<h1>Rejestracja</h1>

<div class="form-box">
    <form method="post">
        <input type ="text" name ="first_name" placeholder = "Imię" required><br>
        <input type ="text" name = "last_name" placeholder = "Nazwisko" required> <br>
        <input type ="email" name ="email" placeholder = "E-mail" required> <br>
        <input type = "text" name= "phone" placeholder = "Numer telefonu" required> <br>
        <input type = "text" name = "address" placeholder = "Adres" required> <br> 
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Hasło" required><br>
        
        <button type="submit">Zarejestruj</button>

    </form>
  
</div>
  <a href ="login.php"> Masz Konto? Zaloguj się! </a>
</body>
</html>
