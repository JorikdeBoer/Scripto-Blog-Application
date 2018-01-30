<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: *");

    $verb = $_SERVER['REQUEST_METHOD'];

    // code om met GET (nieuwe) berichten te krijgen (met de parameters "minimumid" & mykey") 
    if ($verb == 'POST'){
        if (isset( $_POST["myblog"] )){
                //echo "Username: " .$_POST["username"]. "\n";
                //echo "Message: " .$_POST["message"]. "\n";

                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "scripto"; 
                $text = $_POST["myblog"];
                //console.log($_POST["myblog"]);
                echo $_POST["myblog"];
            
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

                //$new_content = "The username = " .$_POST["username"]. "\nThe message = " .$_POST["message"]. "\n";
                //echo $old_content;
                //echo $new_content;
                //fwrite($mytextfile, $new_content."\n".$old_content);
                //fclose($mytextfile);
                //$myfile = fopen("newfile2.txt", "w") or die("Unable to open file!");
                //$txt = $_POST['value'];
                //fwrite($myfile, $txt);
                //fclose($myfile);          
        }
          else {
            die("Error: the required parameters are missing.");    
        }
    }   
?>