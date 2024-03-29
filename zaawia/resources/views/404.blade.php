<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Not Found</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Cursive', fantasy;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: radial-gradient(circle, #1a1a1a, #000000);
            color: #fff;
        }

        .container {
            text-align: center;
        }

        .error-container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .error-icon {
            width: 120px;
            height: 120px;
            margin-bottom: 30px;
            filter: drop-shadow(2px 2px 4px rgba(255, 255, 255, 0.2));
        }

        h1 {
            font-size: 48px;
            margin-bottom: 20px;
            letter-spacing: 2px;
            color: #ff57a1;
            /* Magenta color for the header */
        }

        p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 40px;
            color: #ff9999;
            /* Light pink color for the text */
        }

        .btn {
            display: inline-block;
            padding: 15px 30px;
            font-size: 18px;
            text-decoration: none;
            color: #fff;
            background: linear-gradient(to right, #ff57a1, #ff9999);
            border-radius: 30px;
            box-shadow: 0 4px 6px rgba(255, 87, 161, 0.2);
            transition: background 0.3s, transform 0.2s;
            cursor: pointer;
        }

        .btn:hover {
            background: linear-gradient(to right, #ff0055, #ff5757);
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="error-container">
            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23ff57a1' width='120px' height='120px'%3E%3Cpath d='M0 0h24v24H0z' fill='none'/%3E%3Cpath d='M19 5v2h-3v2h3v6h-2v2H7v-2H5v-6h3V7H5V5h14zm-7 10h2v2h-2v-2z'/%3E%3C/svg%3E"
                alt="Magic Wand Icon" class="error-icon">
            <h1>404 - Not Found</h1>
            <p>Oops! It seems like you've wandered into a magical realm that doesn't exist. The enchanted path you're
                seeking might be hidden.</p>
            <a href="#" class="btn">Return to Reality</a>
        </div>
    </div>
</body>

</html>
