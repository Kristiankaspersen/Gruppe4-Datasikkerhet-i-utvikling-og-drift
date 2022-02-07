<?php

class DatabaseConnection { 


    public function connect() { 
        try { 

            // Default password and username MAMP. Change these if you are working on WAMP, XAMPP or LAMP. 
            // The password we used for our connection: Don't remember. 
            $servername = "localhost:3307"; 
            $username = "root"; 
            $password = "root";  
            $databaseConnection = new PDO("mysql:host=$servername;dbname=GruppeFireDB", $username, $password);
            return $databaseConnection; 

        }
        catch (PDOException $e) { 
            print "Error!: ".$e->getMessage()."<br/>";
            die(); 

        }

    }

}