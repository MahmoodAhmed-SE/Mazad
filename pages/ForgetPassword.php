<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta content="en-us" http-equiv="Content-Language" />
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Forget Password</title>
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
        <h1>Forget Password</h1>
        <form action="" method="post">
            <table align="center">
                <tr>
                    <td colspan="2">
                        <strong>Email:</strong>
                        <input name="Text1" style="width: 180px" type="text" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <strong>Phone Number:</strong>
                        <input name="Text2" style="width: 181px" type="text" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <strong>Resident Card (Please upload):</strong>
                        <input name="File1" style="width: 305px" type="file" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <strong>Security Question:</strong>
                        <select name="Select1" style="width: 407px">
                            <option value="Who is your favorite person?">Who is your favorite person?</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <strong>Security Answer:</strong>
                        <input name="Text7" type="text" style="width: 223px" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input class="button" name="Submit1" type="submit" value="SUBMIT" />
                        <input class="button" name="Reset1" type="reset" value="CANCEL" />
                    </td>
                </tr>
            </table>
        </form>
        <div class="link-container">
            <a href="../pages/LoginPage.php">Log-in Page</a>
        </div>
    </div>
</body>

</html>
