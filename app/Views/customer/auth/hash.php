<?php

// Menggunakan password_hash untuk menghasilkan hash
$password = 'password'; // Kata sandi yang akan di-hash
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Menampilkan hasil hash
echo 'Hash Kata Sandi: ' . $hashedPassword;
