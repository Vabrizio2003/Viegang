<?php
require 'connect.php';

// (1) Mulai session
session_start();

// function untuk melakukan login
function login($input) {
    global $koneksi;

    $email = $input['email'];
    $password = $input['password'];

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($koneksi));
    }

    if(mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);

        if(password_verify($password, $data['password'])) {
            $_SESSION["login"] = true;
            $_SESSION["id"] = $data['id'];

            // cek apakah checkbox "remember me" terisi
            if (isset($input["remember"])) {
                // set cookie "remember" dengan nilai email dan id
                setcookie("remember_email", $data['email'], time() + 3600, '/');
                setcookie("remember_password", $data['password'], time() + 3600, '/');
            }
        } else {
            $_SESSION['message'] = 'Password salah';
            $_SESSION['color'] = 'danger';
        }
    } else {
        $_SESSION['message'] = 'Email tidak ditemukan';
        $_SESSION['color'] = 'danger';
    }
}

// function untuk fitur "Remember Me"
function rememberMe($cookie) {
    global $koneksi;

    $email = $cookie['remember_email'];
    $password = $cookie['remember_password'];

    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($koneksi, $query);

    if(mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $_SESSION["login"] = true;
        $_SESSION["id"] = $data['id'];
    }
}
?>
LoginController.php