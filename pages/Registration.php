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
    <title>Registration</title>
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
        <h1>Registration</h1>
        <form action="../handle/handleRegistrationForm.php" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Name:</td>
                    <td>
                        <input name="name" style="width: 246px" type="text" required />
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input name="password" style="width: 245px" type="text" required />
                    </td>
                </tr>
                <tr>
                    <td>Email Address:</td>
                    <td>
                        <input name="email" style="width: 243px" type="email" required/>
                    </td>
                </tr>
                <tr>
                    <td>Phone Number:</td>
                    <td>
                        <input name="phoneNumber" style="width: 242px" type="text" required/>
                    </td>
                </tr>
                <tr>
                    <td>Resident ID Number:</td>
                    <td>
                        <input name="idNumber" style="width: 172px" type="text" required/>
                    </td>
                </tr>
                <tr>
                    <td>Resident Card (Please upload):</td>
                    <td>
                        <input name="residentCard" style="width: 305px" type="file" required/>
                    </td>
                </tr>
                <tr>
                    <td>Security Question:</td>
                    <td>
                        <select name="securityQuestion" style="width: 407px" required>
                            <option value="Who is your favorite person?">Who is your favorite person?</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Security Answer:</td>
                    <td>
                        <input name="securityAnswer" type="text" style="width: 223px" required/>
                    </td>
                </tr>
                <tr>
                    <td>Role:</td>
                    <td>
                        <label class="radio-label">
                            <input checked="checked" name="role" type="radio" class="auto-style5" value="seller" required/><span class="auto-style5">Seller
                            </span>
                        </label>
                        <label class="radio-label">
                            <input name="role" type="radio" class="auto-style5" value="bidder" /><span class="auto-style5" required>Bidder
                            </span>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input class="button" name="submitButton" type="submit" value="REGISTER" />
                        <input class="button" name="resetButton" type="reset" value="CANCEL" />
                    </td>
                </tr>
            </table>
        </form>
        <div class="link-container">
            <a href="../pages/HomePage.php">Homepage</a>
        </div>
    </div>
</body>

</html>
