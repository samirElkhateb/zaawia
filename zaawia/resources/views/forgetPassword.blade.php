<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email for Password Change</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Garamond', serif;
            background-color: #1e1e1e;
            /* Dark background */
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .container {
            text-align: center;
            max-width: 90%;
            margin: auto;
        }

        .success-container {
            background-color: #2c2c2c;
            /* Darker container */
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            /* Increased shadow */
        }

        .success-icon {
            width: 120px;
            height: 120px;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 20px;
            color: #ffcc00;
            /* Golden yellow */
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 30px;
            color: #ffffff;
            /* White text */
        }

        .btn {
            display: inline-block;
            padding: 15px 40px;
            font-size: 18px;
            text-decoration: none;
            color: #ffffff;
            background-color: #ffcc00;
            /* Golden yellow button */
            border-radius: 30px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #ffb400;
            /* Darker yellow on hover */
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #cccccc;
            /* Light gray */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="success-container">
            <img src="https://emojicdn.elk.sh/🔮" alt="Crystal Ball Icon" class="success-icon">
            <h1>Magical Password Change</h1>
            <p>Unlock the power of your new password! Click below to complete the transformation:</p>
            <a href="{{ $data['url'] }}" class="btn">Change Password</a>
            <p class="footer">If you didn't request this change, please ignore this email or contact support.</p>
        </div>
    </div>
</body>

</html>
