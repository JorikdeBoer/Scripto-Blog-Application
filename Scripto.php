<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: *");

    $verb = $_SERVER['REQUEST_METHOD'];

    // code om met POST (nieuwe) blogs in de sql database te zetten
    if ($verb == 'POST'){
        if (isset( $_POST["myblog"] )){
            
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "scripto"; 
                $text = $_POST["myblog"];
                //console.log($_POST["myblog"]);
                //echo $_POST["myblog"];
            
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);}
                $sql = "INSERT INTO scriptoblog (Tekst)".
                "VALUES ('$text')";
                if ($conn->query($sql) === TRUE) {
                    echo "New record created successfully";} 
                else {
                    echo "Error: " . $sql . "<br>" . $conn->error;}
                $conn->close();        
        }
          else {
            die("Error: the required parameters are missing.");    
        }
    }

    // code om met GET (nieuwe) blogs uit de sql database te halen
    if ($verb == 'GET'){
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "scripto"; 

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);}
                $sql = "SELECT ID, Tekst FROM scriptoblog";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                    echo "                                                                                                             
                    ID: " . $row["ID"]. " - Blog: " . $row["Tekst"]. 
                    "    ";
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
     }
?>