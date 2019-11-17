<?php

class adminEstudiante 
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }

    public function getEstudiantes()
    {
        $this->db->query('SELECT * FROM estudiantes');
        return $this->db->registers();
    }

    public function getGrupos()
    {
        $this->db->query('SELECT * FROM grupos');
        return $this->db->registers();
    }

    public function agregarGrupo($datos)
    {
        $this->db->query('INSERT INTO grupos_has_estudiantes (grupos_codigo_grupo , estudiantes_codigo_estudiante) VALUES (:grupo , :codigo)');
        $this->db->bind(':grupo' , $datos['grupo']);
        $this->db->bind(':codigo' , $datos['codigo_estudiante']);
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function verificarGrupo($datos)
    {
        $this->db->query('SELECT * FROM grupos_has_estudiantes WHERE estudiantes_codigo_estudiante = :codigo');
        $this->db->bind(':codigo' , $datos['codigo_estudiante']);
        $this->db->execute();
        if($this->db->rowCount()) {
            return true;
        } else {
            return false;
        }
    }

    public function registrarGrado ($datos)
    {
        $this->db->query('INSERT INTO grados (codigo_estudiante , year_grado , grado , estado) VALUES (:codigo_estudiante , :year_grado , :grado , :estado)');
        $this->db->bind(':codigo_estudiante' , $datos['codigo']);
        $this->db->bind(':year_grado' , $datos['year']);
        $this->db->bind(':grado' , $datos['grado']);
        $this->db->bind(':estado' , $datos['estado']);
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}