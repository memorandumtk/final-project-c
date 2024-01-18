<?php
header("Access-Control-Allow-Origin: *");
class user
{
    private $userid;
    private $name;
    private $email;
    private $pass;
    private $phone;
    private $type;

    function __construct($userid, $name, $email, $pass, $phone, $type)
    {
        $this->name = $name;
        $this->email = $email;
        $this->userid = $userid;
        $this->phone = $phone;
        $this->type = $type;
        $this->pass = $pass;
    }
    function displayInfo()
    {
        return ["userid" => $this->userid, "name" => $this->name, "useremail" => $this->email, "pass" => $this->pass, "type" => $this->type];
    }
}
?>