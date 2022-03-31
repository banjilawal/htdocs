<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

        echo<title>' . $title . '</title>
</head>

<body>
    <form name="login-form" id="login-form" action="login.php" method="post">
    <fieldset><legend>Contact Methods</legend>
            <p>
                <label for="phone">Phone</label>
                <input type="tel" id="phone" name="phone">
            </p>

            <p>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" size="60" required>
            </p>
        </fieldset>
    </form>
</body>
<html>