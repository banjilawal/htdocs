<?php
    require_once ('../bootstrap.php');
    require_once (MODEL_PATH . '/customer.php');

    print_r($_POST);

    if (isset($_POST['firstname'])) $firstname = $_POST['firstname']; 
    if (isset($_POST['lastname'])) $firstname = $_POST['lastname']; 
    if (isset($_POST['firstname'])) $firstname = $_POST['firstname']; 
    if (isset($_POST['lastname'])) $firstname = $_POST['lastname']; 
    if (isset($_POST['firstname'])) $firstname = $_POST['firstname']; 
    if (isset($_POST['lastname'])) $firstname = $_POST['lastname']; 
    if (isset($_POST['firstname'])) $firstname = $_POST['firstname']; 
    if (isset($_POST['lastname'])) $firstname = $_POST['lastname']; 


    echo '<p><p>';

    $email = $_POST["email"];

    function create_db_account ($email) {
        $account = substr($email, 0, (strpos($email,'@')));
        #$account = $email;

        echo '<br>' . $account . '<br>';

        $mysqli = new mysqli("localhost", "root", "", "mysql");
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }
        echo "Connected successfully" . '<br>';

        echo 

        $create_user = $mysqli->prepare("CREATE USER IF NOT EXISTS ?");
        $create_user->bind_param('s', $account);
        $create_user->execute();
/*
        $grant_db_access = $mysqli->prepare("GRANT ALL ON show.* TO ?");
        $grant_db_access->bind_param('s', $account);
        $grant_db_access->execute();

        $add_role = $mysqli->prepare("GRANT customer TO ?");
        $add_role->bind_param('s', $account);
        $add_role->execute(); 

        echo $account . ' has been granted access to the shop database.';

        $create_user->close();
        $grant_db_access->close();
        $add_role->close();

        $query = "SELECT d.db, r.role, u.user FROM mysql.roles_mapping r "
            . "INNER JOIN mysql.user u INNER JOIN mysql.db d "
            . "ON u.user = d.user ON r.user = u.user";
           
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('s', $email);  
        $stmt->execute();
        $stmt->close(); 
           
        $result = $mysqli->query($query);
        var_dump($result);
*/
    } // close create_db_account

    create_db_account($email);
?>