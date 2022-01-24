<?php


class User {
    private $username; 
    private $firstName; 
    private $lastName; 
    private $email; 
    private $password; 
    private $passwordRepeat; 
    protected $role; 

    function __construct($username, $firstName, $lastName,  $email, $password, $passwordRepeat) { 

        $this->username = $username;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->passwordRepeat = $passwordRepeat;
        
    }

    // Getters and setters: 

    public function getUsername()
    {
        return $this->username;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getPasswordRepeat()
    {
        return $this->passwordRepeat;
    }

    public function getRole()
    {
        return $this->role;
    }

}