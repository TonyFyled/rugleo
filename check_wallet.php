<?php
// Database connection
$host = 'localhost';
$dbname = 'wallet_checker';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
// Get the wallet address from the form
$wallet = isset($_POST['wallet']) ? trim($_POST['wallet']) : '';

// Query the database to check if the wallet is whitelisted
$stmt = $pdo->prepare("SELECT * FROM whitelisted_wallets WHERE wallet_address = :wallet");
$stmt->execute(['wallet' => $wallet]);
$wallet_found = $stmt->fetch();

if ($wallet_found) {
    header('Location: index.php?status=whitelisted');
} else {
    header('Location: index.php?status=not_whitelisted');
}

exit();
?>
