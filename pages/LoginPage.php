<?php
session_start();

$_SESSION = array();

session_destroy();

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta content="en-us" http-equiv="Content-Language" />
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>LOGIN PAGE</title>
    <style type="text/css">
        body {
            background-color: #9DC8C6;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border: 2px solid #000;
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            border: 2px solid #000;
            text-align: left;
        }

        .radio-label {
            margin-right: 20px;
            font-size: large;
        }

        .button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .button:hover {
            background-color: #45a049;
        }

        .link-container {
            text-align: center;
            margin-top: 20px;
        }

        .link-container a {
            font-size: x-large;
            text-decoration: none;
            color: #000;
            margin-right: 20px;
        }

        .link-container a:hover {
            color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>LOGIN PAGE</h1>
        <form action="../handle/handleLoginForm.php" method="post">
            <table>
                <tr>
                    <td>Name</td>
                    <td>
                        <input name="name" style="width: 186px" type="text" />
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>
                        <input name="password" style="width: 187px" type="password" />
                    </td>
                </tr>
                <tr>
                    <td>Role:</td>
                    <td>
                        <label class="radio-label">
                            <input checked="checked" name="role" type="radio" value="seller" />Seller
                        </label>
                        <label class="radio-label">
                            <input name="role" type="radio" value="bidder" />Bidder
                        </label>
                        <label class="radio-label">
                            <input name="role" type="radio" value="admin" />Administrator
                        </label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input class="button" name="submitButton" type="submit" value="LOG-IN" />
                        <input class="button" name="resetButton" type="reset" value="CANCEL" />
                    </td>
                </tr>
            </table>
        </form>
        <div class="link-container">
            <a href="../pages/ForgetPassword.php">Forget Password</a>
            <a href="Registration.php">Register Here</a>
        </div>
    </div>
</body>

</html>
