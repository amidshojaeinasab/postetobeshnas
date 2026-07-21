<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$host = "localhost";
$dbname = "postetob_delavar";
$username = "postetob_delavar";
$password = "3i3FsxQFiY4eQ1a1";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("خطا در اتصال به دیتابیس: " . $e->getMessage());
}

function is_login()
{
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }
}

$merchant_id = 'c1e751e5-8b24-4161-9de6-a1ba77eeafb5';
$callback_url = 'https://postetobeshnas.ir/callback.php';
