<?php


    // in a real app, this data would come from the DB
    $methodType = $_SERVER['REQUEST_METHOD'];
    $data = array("status" => "fail", "msg" => "On $methodType");

//$search = trim($_GET["searchitem"]);
$name = $_GET["username"];
$pwd = $_GET["password"];

echo "name=" . $name . "<br>";
echo "password=" . $pwd . "<br>";
echo "methodtype=" . $methodType . "<br>";

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
                        if ($name == $item['user_name'] 
                            && $pwd == $item['password']){
                            echo "This user is valid. <br>";
                            echo "id=" . $item['ID']
                                . "name=" . $item['user_name']
                                . "password=" . $item['password'];
                        }
                    }

    } else {
        echo $data;
    }



?>
