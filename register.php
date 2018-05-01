<?php

    // in a real app, this data would come from the DB
    $methodType = $_SERVER['REQUEST_METHOD'];
    $data = array("status" => "fail", "msg" => "On $methodType");

//$search = trim($_GET["searchitem"]);
$name = $_GET["username"];
$pwd1 = $_GET["password1"];
$pwd2 = $_GET["password2"];

/*
echo "name=" . $name . "<br>";
echo "password1=" . $pwd1 . "<br>";
echo "password2=" . $pwd2 . "<br>";
echo "methodtype=" . $methodType . "<br>";
*/

if ($pwd1 != $pwd2){
//    echo "Error: Password not equal!";
    header('Location: signup.html');   
}

//////////////////////////////////////////////////////////////

    $servername = "localhost";
    $dblogin = "root";
    $password = "root";
    $dbname = "waave";

    $data = array("msg" => "Nothing");

    if ($methodType === 'GET') {

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dblogin, $password);

            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM customer";

            $statement = $conn->prepare($sql);
            $statement->execute();
            $count = $statement->rowCount();

            /*$sql2 = "SELECT * FROM address";

            $statement2 = $conn->prepare($sql2);
            $statement2->execute();
            $count2 = $statement2->rowCount();

            $data = array("status" => "success", "customers" => $statement->fetchAll(PDO::FETCH_ASSOC), "addresses" => $statement2->fetchAll(PDO::FETCH_ASSOC));
*/
            $data = array("status" => "success", "customers" => $statement->fetchAll(PDO::FETCH_ASSOC));

        } catch(PDOException $e) {
            $data = array("error", $e->getMessage());
        }
    } else {
        $data = array("msg" => "Error: only GET allowed");
    }

//////////////////////////////////////////////////////////////


    // attach the transaction to the data
    //$data['transaction'] = $transaction;

    //echo $methodType;
    //var_dump($transaction);

    // to see you will need to type this in the URL bar of your browser:
    // http://localhost/lab_7/lab_07_GetTable.php?output=json
    // Note: you may also need to include a port (check XAMPP/WAMP/LAMP/MAMP for the port)
    if ($methodType === 'GET') {
        
        
        // Output customer table
        $customer = $data['customers'];
        foreach($customer as $key => $item) {
            if ($name == $item['user_name']){
                echo "This user is already exist. <br>";
                return;
            }
        }
        
             // Insert new user info into database

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dblogin, $password);

            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO customer (user_name, password) VALUES ('" . $name . "', '" . $pwd1 . "')";

            //$sql = "INSERT INTO customer (user_name, password) VALUES ('pt', '123456')";

            echo $sql;
            
            $statement = $conn->prepare($sql);
            $statement->execute();

          } catch(PDOException $e) {
            $data = array("error", $e->getMessage());
        }

        header('Location: login.html');
        //////////////////////////////////////
        
    } else {
        echo $data;
    }


?>
