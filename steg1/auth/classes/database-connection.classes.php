<?php

class DatabaseConnection { 


    protected function connect() { 
        try { 
            $username = "root"; 
            $password = "root"; 
            $databaseConnection = new PDO('mysql:host=localhost;dbname=gruppefiredb', $username, $password); 
            return $databaseConnection; 

        }
        catch (PDOException $e) { 
            print "Error!: ".$e->getMessage()."<br/>";
            die(); 

        }

    }

}