<?php
date_default_timezone_set('Europe/Vilnius');
include 'config.php';


require __DIR__ . '/mailer.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (empty($_POST["email"])) {
        die("Proszę podać adres e-mail.");
    }

    $email = $_POST["email"];

    
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        die("Użytkownik z tym adresem e-mail nie istnieje.");
    }


    $token = bin2hex(random_bytes(16));
    $token_hash = hash("sha256", $token);
    $expiry = date("Y-m-d H:i:s", time() + 60 * 5);

    
    $update = "UPDATE users 
               SET reset_token_hash = ?, reset_token_expires_at = ? 
               WHERE email = ?";
    $stmt = $conn->prepare($update);
    $stmt->bind_param("sss", $token_hash, $expiry, $email);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        
        $mail->setFrom("noreply@example.com", "Sklep albumow");
        $mail->addAddress($email);
        $mail->Subject = "Reset hasla";
        $mail->isHTML(true);

        $reset_link = "http://localhost/miniprojekt/reset_password.php?token=$token";

        $mail->Body = <<<END
            <p><a href="$reset_link">$reset_link</a></p>
        END;

        try {
            $mail->send();
            echo "Wysłano wiadomosc e-mail z linkiem do resetu hasla.";
        } catch (Exception $e) {
            echo "Nie udało się wysłać wiadomości: {$mail->ErrorInfo}";
        }
    } else {
        echo "Błąd podczas generowania linku resetującego.";
    }
}
?>

