<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

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

        $stmt = $conn->prepare("INSERT INTO users (email, username, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss",$$email, $username, $passwordHash);
        $stmt->execute();
        $stmt->close();

        $_SESSION['user_id'] = $conn->insert_id;
        $_SESSION['username'] = $username;

        header("Location: index.php");
        exit;
    } else {
        
    }

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="frontend/register.css">
</head>
<body>

<h1>Rejestracja</h1>

<div class="form-box">
    <form method="post">
        <input type ="email" name ="email" placeholder = "E-mail" required> <br>
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Hasło" required><br>
        
        <button type="submit">Zarejestruj</button>

    </form>
  
</div>
  <a href ="login.php"> Masz Konto? Zaloguj się! </a>
</body>
</html>
