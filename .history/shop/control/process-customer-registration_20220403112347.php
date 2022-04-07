<?php
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/customer.php');

    $email = $_POST["email"];




    function create_db_account ($email) {
        $account = substr($email, 0, (strpos($email,'@')));

        $mysqli = new mysqli("localhost", "root", "", "mysql");
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }
        echo "Connected successfully" . '<br>';

        $create_user = $mysqli->prepare("CREATE USER IF NOT EXISTS ?");
        $create_user->bind_param('s', $account);
        $create_user->execute();

        $grant_db_access = $mysqli->prepare("GRANT ALL ON show.* TO ?");
        $grant_db_access->bind_param('s', $account);
        $grant_db_access->execute();

        $grant_db_access = $mysqli->prepare("GRANT customer TO ?");
        $grant_db_access->bind_param('s', $account);
        $grant_db_access->execute(); 

} // close create_db_account
?>