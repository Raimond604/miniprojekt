<?php
date_default_timezone_set('Europe/Vilnius');
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Nieprawidłowe żądanie.");
}

if (empty($_POST["token"])) {
    die("Brak tokenu.");
}

$token = $_POST["token"];
$password = $_POST["password"] ?? '';
$password_confirm = $_POST["password_confirm"] ?? '';

if (empty($password) || empty($password_confirm)) {
    die("Proszę wprowadzić oba pola hasła.");
}

if ($password !== $password_confirm) {
    die("Hasła nie są identyczne.");
}

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

// Szukamy użytkownika po tokenie
$token_hash = hash("sha256", $token);
$sql = "SELECT * FROM users WHERE reset_token_hash = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $token_hash);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("Nieprawidłowy token.");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("Token wygasł.");
}

// Zmieniamy hasło
$new_password_hash = password_hash($password, PASSWORD_BCRYPT);

$update = "UPDATE users 
           SET password = ?, reset_token_hash = NULL, reset_token_expires_at = NULL 
           WHERE id = ?";
$stmt = $conn->prepare($update);
$stmt->bind_param("si", $new_password_hash, $user["id"]);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "<h3>Hasło zostało zmienione </h3>";
    echo "<a href='login.php'>Przejdź do logowania</a>";
} else {
    echo "Błąd podczas aktualizacji hasła.";
}
?>
