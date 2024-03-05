
<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Your Project</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="index.php">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #fff;
            color: #000;
        }

        .welcome-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 60px;
            background-color: rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h1 {
            font-size: 36px;
            color: #000;
            margin-bottom: 30px;
        }

        p {
            font-size: 22px;
            color: #333;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .get-started-button {
            display: inline-block;
            padding: 16px 32px;
            margin: 20px;
            font-size: 24px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.3s;
        }

        .get-started-button:hover {
            background-color: #0056b3;
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <?php if (isset($_SESSION['cust_name'])) : ?>
            <h1>Welcome, <?php echo $_SESSION['cust_name']; ?>!</h1>
        <?php else : ?>
            <h1>Welcome!</h1>
        <?php endif; ?>
        <p>Welcome to BusBooking.com</p>
        <p><strong>Discover Convenience, Explore Comfort</strong></p>

            <img src="C:\Users\Admin\Downloads\LL5.PNG" >
        <p><strong>Book Your Bus Today and Let the Adventure Begin!!!</strong></p>
        <a href="index.php" class="get-started-button">GET STARTED</a>
    </div>
</body>
</html>
