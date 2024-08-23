<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Matemasie&display=swap" rel="stylesheet">  
    <title>Whitelist Checker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('./600x200.jpeg');
            background-size: cover; 
            background-position: center;
            background-repeat: no-repeat;
            padding: 50px;
            height: 100vh;
            color: white;
            overflow: hidden;
            font-family: "Matemasie", sans-serif;
            font-weight: 400;
            font-style: normal;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: transparent;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        form{
           text-align: center;
           width: 400px;
        }
        .form-group{
            padding: 70px;
        }
        h2 {
            text-align: center;
            color: white;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            width: 90%;
            padding: 10px;
            margin: 10px;
        
            background-color: #E5AA70;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .result {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-group">
        <h2>Wallet Checker</h2>
        <form action="check_wallet.php" method="POST">
            <label for="wallet">Enter your Orai wallet address:</label>
            <input type="text" id="wallet" name="wallet" required>
            <input type="submit" value="Check">
        </form>
        <div class="result">
            <?php if(isset($_GET['status'])): ?>
                <p style="color: <?php echo $_GET['status'] == 'whitelisted' ? 'green' : 'red'; ?>;">
                    <?php echo $_GET['status'] == 'whitelisted' ? 'Your wallet is whitelisted!' : 'Your wallet is not whitelisted.'; ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>
