{{-- @if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif




<form method="post" action="{{ route('change.email') }}">
    @csrf
    <input type="hidden" name="id" value="{{ $user->id }}"><br>
    <input type="password" name="password" placeholder="new password"><br>
    <input type="password" name="password_confirmation" placeholder="confirm password"><br>

    <button type="submit">Submit</button>
</form> --}}
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
            max-width: 400px;
            margin: auto;
        }

        .form-container {
            background-color: #2c2c2c;
            /* Darker container */
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            /* Increased shadow */
        }

        h2 {
            font-size: 32px;
            margin-bottom: 20px;
            color: #ffcc00;
            /* Golden yellow */
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        input[type="password"] {
            width: calc(100% - 20px);
            padding: 15px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            background-color: #333333;
            /* Dark gray */
            color: #ffffff;
            /* White text */
            outline: none;
        }

        input[type="password"]:focus {
            box-shadow: 0 0 6px rgba(255, 204, 0, 0.5);
            /* Golden yellow shadow on focus */
        }

        button[type="submit"] {
            display: inline-block;
            padding: 15px 30px;
            font-size: 18px;
            text-decoration: none;
            color: #ffffff;
            background-color: #ffcc00;
            /* Golden yellow button */
            border: none;
            border-radius: 30px;
            box-shadow: 0 4px 6px rgba(255, 204, 0, 0.3);
            /* Golden yellow shadow */
            transition: transform 0.2s, box-shadow 0.3s;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(255, 204, 0, 0.5);
            /* Increased shadow on hover */
        }

        .error-container {
            background-color: #ff3333;
            /* Red for error messages */
            color: #ffffff;
            /* White text */
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .error-container ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .error-container li {
            margin-bottom: 5px;
        }

        .footer {
            font-size: 14px;
            color: #cccccc;
            /* Light gray */
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h2>Password Change Form</h2>

            {{-- Error Display Section --}}
            @if ($errors->any())
                <div class="error-container">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="post" action="{{ route('change.email') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}"><br>
                <input type="password" name="password" placeholder="New Password"><br>
                <input type="password" name="password_confirmation" placeholder="Confirm Password"><br>
                <button type="submit">Submit</button>
            </form>
            <p class="footer">If you didn't request this change, please ignore this email or contact support.</p>
        </div>
    </div>
</body>

</html>
