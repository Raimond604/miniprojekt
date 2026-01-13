<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $inputUsername = trim($_POST['username']);
    $inputPassword = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $inputUsername);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $plainPassword, $role);
        $stmt->fetch();

        if (password_verify($inputPassword,$plainPassword)) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $inputUsername;
            $_SESSION['role'] = $role;

            header("Location: index.php");
            exit;
        } else {
            echo "<script>alert('Nieprawidłowe hasło');</script>";
        }
    } else {
        echo "<script>alert('Użytkownik nie istnieje');</script>";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="login.css">
</head>
<body>

<h1>Logowanie</h1>

<div class="form-box">
    <form method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Hasło" required><br>
        <button type="submit">Zaloguj się</button>
    </form>
</div>
  <a href ="register.php"> Nie masz konta? Zarejstruj się! </a>
<br>
<br>
  <a href = "forgot_password.php"> Zaponiałem hasło </a>
</br>
</br>
</body>
</html>
