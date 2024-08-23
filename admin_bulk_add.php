<?php
// Database connection
$host = 'localhost';
$db = 'wallet_checker';
$user = 'root'; // Replace with your database username
$pass = ''; // Replace with your database password

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] == 0) {
        $file = fopen($_FILES['csv_file']['tmp_name'], 'r');

        while (($data = fgetcsv($file)) !== FALSE) {
            $wallet_address = trim($data[0]);

            // Insert wallet into database, ignore if already exists
            $stmt = $conn->prepare("INSERT IGNORE INTO whitelisted_wallets (wallet_address) VALUES (?)");
            $stmt->bind_param("s", $wallet_address);
            $stmt->execute();
        }

        fclose($file);
        echo "Wallets added successfully!";
    } else {
        echo "Error uploading file.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Bulk Add Wallets</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 50px;
        }
        .container {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Admin Bulk Add Wallets</h2>
    <form action="admin_bulk_add.php" method="POST" enctype="multipart/form-data">
        <label for="csv_file">Upload CSV file with wallet addresses:</label>
        <input type="file" id="csv_file" name="csv_file" accept=".csv" required>
        <input type="submit" value="Upload">
    </form>
</div>

</body>
</html>
