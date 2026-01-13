<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <meta charset="UTF-8">
    
</head>
<body>
<link href ="forgot_password.css" rel="stylesheet">
    <h1>Odnowienie hasła</h1>

    <form method="post" action="send_password_reset.php">

        <label for="email">Adres e-mail</label>
        <input type="email" name="email" id="email">

        <button>Wyślij</button>

    </form>

</body>
</html>
