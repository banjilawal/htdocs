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
                
    </form>

    <form name="forgot-credentials-form">
    <button type="button">Forgot Username</button>


    <button type="button">Forgot Password</button>
</form>
</p>
</fieldset>
</body>
<html>