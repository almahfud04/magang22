<?php
session_start();

if( isset($_SESSION["login"]) ) {
    header("Location: /magang/siswa/index.php");
    exit;
}

require 'db_connection.php';

if( isset($_POST["login"]) ) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE
    username = '$username'");

    //cek username
    if( mysqli_num_rows($result) === 1 ) {

    //cek password
    $row = mysqli_fetch_assoc($result);
    if( password_verify($password, $row["password"]) ) {
        // set session
        $_SESSION["login"] = true;


        header("Location: /magang/siswa");
        exit;
    }

    }

    $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e9ecef;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        h1 {
            color: #343a40;
            margin-bottom: 30px;
        }
        label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 16px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }
        button {
            background-color: #28a745;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #218838;
        }
        .error {
            color: red;
            font-style: italic;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Halaman Login</h1>

    <?php if( isset($error) ) : ?>
        <p class="error">username / password salah</p>
    <?php endif; ?>

    <form action="" method="post">
        <label for="username">Username :</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Password :</label>
        <input type="password" name="password" id="password" required>

        <button type="submit" name="login">Login</button>
    </form>
</div>

</body>
</html>
