<?php
    // Give permission for used request methods
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: *");

    $verb = $_SERVER['REQUEST_METHOD'];

    // Code to put new blogs in the database with author, title, text and category
    if ($verb == 'POST'){
        // Check if there is a blog to put in the database
        if (isset( $_POST["myblog"] )){
            
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "scripto"; 
                $posttext = $_POST["myblog"];
                $posttitle = $_POST["title"];
                $postauthor = $_POST["author"];
                $postcategory = $_POST["category"];
                
                // Translation to make blogs with ' in the text possible
                $text = str_replace("'", "''", "$posttext");
                $title = str_replace("'", "''", "$posttitle");
                $author = str_replace("'", "''", "$postauthor");
                $category = str_replace("'", "''", "$postcategory");
            
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);}
                $sql = "INSERT INTO scriptoblog (Tekst, Titel, Auteur, Categorie)".
                "VALUES ('$text', '$title', '$author', '$category')";
                // Check of a new entry in database has been created
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

    // Code to put blogs from the database to the webpage
    if ($verb == 'GET'){
        // Check if there is a category selection in the request: 
        // get blogs from certain category!
        if (isset( $_GET["category"] )){
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "scripto"; 
                $category = $_GET["category"];
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);}
                $sql = "SELECT ID, Tekst, Auteur, Titel, Categorie FROM scriptoblog WHERE Categorie='$category' ORDER BY ID DESC";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "\r\n Auteur: " . $row["Auteur"]. "\r\n";
                        echo "Titel: " . $row["Titel"]. "\r\n"; 
                        echo "Blog: " . $row["Tekst"]. "\r\n" ;
                    }
                } 
                else {
                    echo "0 results"; 
                }
                $conn->close(); 
        }
        
        // No category selection in the request: get all blogs!
        else {    
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "scripto"; 

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);}
                $sql = "SELECT ID, Tekst, Auteur, Titel, Categorie FROM scriptoblog ORDER BY ID DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "\r\n Auteur: " . $row["Auteur"]. "\r\n";
                        echo "Titel: " . $row["Titel"]. "\r\n"; 
                        echo "Blog: " . $row["Tekst"]. "\r\n" ;
                    }
                } 
                else {
                    echo "0 results";
                }
                $conn->close();
        }
    }
?>