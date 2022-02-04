<?php
class User {
    protected $username; 
    protected $firstName; 
    protected $lastName; 
    protected $email; 
    protected $password; 
    protected $passwordRepeat; 
    protected $role; 

    function __construct() {
        $args = func_get_args(); 
        switch(func_num_args())
        {
            case 0: 
                $this->construct0();
            break; 
            case 6: 
                $this->construct6($args[0], $args[1], $args[2], $args[3], $args[4], $args[5]); 
            break; 
            default: 
                trigger_error("Incorrect number of arguments for User::__construct",  E_USER_WARNING);
        }
    }

    private function construct0() {
    }

    private function construct6($username, $firstName, $lastName,  $email, $password, $passwordRepeat) { 

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