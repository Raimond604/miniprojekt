<?php
date_default_timezone_set('Europe/Vilnius');
include 'config.php';

// Sprawdzenie tokenu z linku
if (!isset($_GET["token"]) || empty($_GET["token"])) {
    die("Brak tokenu w adresie URL.");
}

$token = $_GET["token"];
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
    die("Token wygasł. Poproś o nowy link resetu hasła.");
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Nowe hasło</title>
</head>
<body>
    <h1>Ustaw nowe hasło</h1>
    <form method="post" action="process_reset_password.php">
        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

        <label for="password">Nowe hasło:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="password_confirm">Powtórz hasło:</label>
        <input type="password" id="password_confirm" name="password_confirm" required><br><br>

        <button type="submit">Zmień hasło</button>
    </form>
</body>
</html>
