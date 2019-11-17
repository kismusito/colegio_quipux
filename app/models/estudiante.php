<?php

class estudiante 
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }

    public function totalestudiantes()
    {
        $this->db->query('SELECT codigo_estudiante FROM estudiantes');
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function totalmaterias()
    {
        $this->db->query('SELECT codigo_materia FROM materias');
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function totalgrupos()
    {
        $this->db->query('SELECT codigo_grupo FROM grupos');
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getUltimeId()
    {
        $this->db->query('SELECT codigo_estudiante FROM estudiantes ORDER by codigo_estudiante desc LIMIT 1');
        return $this->db->register();
    }

    public function registrarEstudiante($datos)
    {
        $this->db->query('INSERT INTO estudiantes (codigo_estudiante , id_rol , username ,password , tipo_documento , numero_documento , nombres , apellidos , sexo , fecha_nacimiento , direccion , ciudad , telefono, correo) VALUES (:codigo_estudiante , :id_rol , :username , :password , :tipo_documento , :numero_documento , :nombres , :apellidos , :sexo , :fecha_nacimiento , :direccion , :ciudad , :telefono, :correo)');
        $this->db->bind(':codigo_estudiante' , $datos['codigo']);
        $this->db->bind(':id_rol' , $datos['role']);
        $this->db->bind(':username' , $datos['username']);
        $this->db->bind(':password' , $datos['password']);
        $this->db->bind(':tipo_documento' , $datos['type_documento']);
        $this->db->bind(':numero_documento' , $datos['document']);
        $this->db->bind(':nombres' , $datos['name']);
        $this->db->bind(':apellidos' , $datos['lastname']);
        $this->db->bind(':sexo' , $datos['gender']);
        $this->db->bind(':fecha_nacimiento' , $datos['birthday']);
        $this->db->bind(':direccion' , $datos['address']);
        $this->db->bind(':ciudad' , $datos['city']);
        $this->db->bind(':telefono' , $datos['phone']);
        $this->db->bind(':correo' , $datos['email']);
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getEstudiantesGrupo($code)
    {
        $this->db->query('SELECT GE.grupos_codigo_grupo , GE.estudiantes_codigo_estudiante , E.nombres , E.apellidos , E.numero_documento , G.estado FROM grupos_has_estudiantes GE 
        INNER JOIN estudiantes E ON E.codigo_estudiante = GE.estudiantes_codigo_estudiante
        INNER JOIN grados G ON G.codigo_estudiante = GE.estudiantes_codigo_estudiante
        WHERE grupos_codigo_grupo = :codigo');
        $this->db->bind(':codigo' , $code);
        return $this->db->registers();
    }

    public function getTeacher($code)
    {
        $this->db->query('SELECT * FROM grupos WHERE codigo_grupo = :codigo');
        $this->db->bind(':codigo' , $code);
        return $this->db->register();
    }

    public function reprobarGrado($codigo)
    {
        $this->db->query('UPDATE grados SET estado = :nuevoEstado WHERE codigo_estudiante = :codigo');
        $this->db->bind(':nuevoEstado' , 3);
        $this->db->bind(':codigo' , $codigo);
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function aprobarGrado($codigo)
    {
        $this->db->query('UPDATE grados SET estado = :nuevoEstado WHERE codigo_estudiante = :codigo');
        $this->db->bind(':nuevoEstado' , 2);
        $this->db->bind(':codigo' , $codigo);
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    
}