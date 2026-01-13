<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}


if (isset($_POST['logout'])) {
    session_unset();     
    session_destroy();   
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Strona główna</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .box {
            background: white;
            padding: 30px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        button {
            margin-top: 20px;
            padding: 10px 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="box">
    <h1>Hello World 👋</h1>
    <p>Zalogowany jako: <b><?= htmlspecialchars($_SESSION['username']) ?></b></p>

    <form method="post">
        <button type="submit" name="logout">Wyloguj się</button>
    </form>
</div>

</body>
</html>
