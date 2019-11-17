<?php

class grupo 
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }

    public function registrarGrupo($datos)
    {
        $this->db->query('INSERT INTO grupos (codigo_grupo , nombre_profesor , jornada) VALUES (:codigo , :profesor , :jornada)');
        $this->db->bind(':codigo' , $datos['codigo']);
        $this->db->bind(':profesor' , $datos['maestro']);
        $this->db->bind(':jornada' , $datos['jornada']);
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getCodeGrupos()
    {
        $this->db->query('SELECT * FROM grupos');
        return $this->db->registers();
    }

    public function getMateriasCode()
    {
        $this->db->query('SELECT * FROM materias');
        return $this->db->registers();
    }

    public function getUltimeId()
    {
        $this->db->query('SELECT codigo_materia FROM materias order by codigo_materia desc LIMIT 1');
        return $this->db->register();
    }

    public function registrarMaterias($datos)
    {
        $this->db->query('INSERT INTO materias (codigo_materia , nombre , profesor) VALUES (:codigo_materia , :nombre , :profesor)');
        $this->db->bind(':codigo_materia' , $datos['codigo']);
        $this->db->bind(':nombre' , $datos['asignature']);
        $this->db->bind(':profesor' , $datos['teacher']);
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function registrarMateriasGrupos($grupo , $materia)
    {
        $this->db->query('INSERT INTO  materias_has_grupos (materias_codigo_materia , grupos_codigo_grupo) VALUES (:materia , :grupo)');
        $this->db->bind(':grupo' , $grupo);
        $this->db->bind(':materia' , $materia);
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function eliminarMateria($codigo)
    {
        $this->db->query('DELETE FROM materias WHERE codigo_materia = :codigo');
        $this->db->bind(':codigo' , $codigo);
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function eliminarMateriaGrupo($codigo)
    {
        $this->db->query('DELETE FROM materias_has_grupos WHERE materias_codigo_materia = :codigo');
        $this->db->bind(':codigo' , $codigo);
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function actualizarDatosGrupo($datos)
    {
        $this->db->query('UPDATE grupos SET nombre_profesor = :teacher , jornada = :jornada WHERE codigo_grupo = :codigo');
        $this->db->bind(':teacher' , $datos['maestro']);
        $this->db->bind(':jornada' , $datos['jornada']);
        $this->db->bind(':codigo' , $datos['codigo']);
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


   
}