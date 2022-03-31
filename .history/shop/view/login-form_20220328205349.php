<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

        echo<title>' . $title . '</title>
</head>

<body>
    <form name="login-form" id="login-form" action="login.php" method="post">
    <fieldset><legend>login</legend>
            <p>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" size="60" required>

            </p>
            <label for="pass">Password</label>
            <input type="password" id="pass" name="pass" minlength="1" maxlength="15" size="25" required> 
            <p>

            <b

            </p>
        </fieldset>
    </form>
</body>
<html>