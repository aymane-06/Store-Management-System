<?php
namespace App\models;
abstract class User{
    protected $userID;
    protected $name;
    protected $email;
    protected $password;

    public function __construct($name,$email,$password)  {
        $this->name=$name;
        $this->email=$email;
        $this->password=$password;
    }
    public function getName(){
        return $this->name;
    }
    abstract public function insert();
    abstract public function select();
}