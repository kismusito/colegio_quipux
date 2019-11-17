<?php

class auth
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }

    public function getUser($datos) 
    {
        $this->db->query('SELECT username , password FROM estudiantes WHERE username = :user');
        $this->db->bind(':user' , $datos['user']);
        return $this->db->register();
    }

    public function comfirmUser($datos) 
    {
        $this->db->query('SELECT username FROM estudiantes WHERE username = :user');
        $this->db->bind(':user' , $datos['user']);
        $this->db->execute();
        if ($this->db->rowCount()) {
            return true;
        } else {
            return false;
        }
    }

    public function comfirmPassword($datosLogin , $datosBase) {
        if (password_verify($datosLogin['password'] , $datosBase->password )) {
            return true;
        } else {
            return false;
        }
    }
}