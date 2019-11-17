<?php

class notas
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }

    public function notasDisponibles($grupo)
    {
        $this->db->query('SELECT N.codigo_materia , N.nombre , N.profesor FROM materias_has_grupos M
        INNER JOIN materias N ON N.codigo_materia = M.materias_codigo_materia
        WHERE grupos_codigo_grupo = :grupo');
        $this->db->bind(':grupo' , $grupo);
        return $this->db->registers();
    }

    public function estudianteNota($estudiante)
    {
        $this->db->query('SELECT codigo_estudiante , nombres , apellidos FROM estudiantes WHERE codigo_estudiante = :codigo');
        $this->db->bind(':codigo' , $estudiante);
        return $this->db->register();
    }

    public function verificarNota($codigo , $materia) 
    {
        $this->db->query('SELECT idnota FROM notas WHERE codigo_materia = :materia AND codigo_estudiante = :estudiante');
        $this->db->bind(':materia' , $materia);
        $this->db->bind(':estudiante' , $codigo);
        $this->db->execute();
        if($this->db->rowCount()) {
            return true;
        } else {
            return false;
        }
    }

    public function agregarNotaEstudiante($codigo , $materia)
    {
        $this->db->query('INSERT INTO notas (codigo_materia	, codigo_estudiante) VALUES (:codigo_materia , :codigo_estudiante)');
        $this->db->bind(':codigo_materia' , $materia);
        $this->db->bind(':codigo_estudiante' , $codigo);
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function agregarNota($estudiante , $materia , $nota)
    {
        $this->db->query('INSERT INTO notas_has_notas (notas_materia , notas_estudiante , nota) VALUES (:notas_materia , :notas_estudiante , :nota)');
        $this->db->bind(':notas_materia' , $materia);
        $this->db->bind(':notas_estudiante' , $estudiante);
        $this->db->bind(':nota' , $nota);
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function agregarParcial($estudiante , $materia , $nota)
    {
        $this->db->query('UPDATE notas SET parcial = :nota WHERE codigo_materia = :notas_materia AND codigo_estudiante = :notas_estudiante');
        $this->db->bind(':nota' , $nota);
        $this->db->bind(':notas_materia' , $materia);
        $this->db->bind(':notas_estudiante' , $estudiante);
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function agregarexaFinal($estudiante , $materia , $nota)
    {
        $this->db->query('UPDATE notas SET final = :nota WHERE codigo_materia = :notas_materia AND codigo_estudiante = :notas_estudiante');
        $this->db->bind(':nota' , $nota);
        $this->db->bind(':notas_materia' , $materia);
        $this->db->bind(':notas_estudiante' , $estudiante);
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function notasDelEstudiante($materia , $codigo)
    {
        $this->db->query('SELECT id , nota FROM notas_has_notas WHERE notas_materia = :materia AND notas_estudiante = :codigo');
        $this->db->bind(':materia' , $materia);
        $this->db->bind(':codigo' , $codigo);
        return $this->db->registers();
    }

    public function notasExaDelEstudiante($materia , $codigo)
    {
        $this->db->query('SELECT NE.parcial , NE.final FROM notas_has_notas N
        INNER JOIN notas NE ON NE.codigo_materia = N.notas_materia AND N.notas_estudiante = NE.codigo_estudiante
        WHERE N.notas_materia = :materia AND N.notas_estudiante = :codigo');
        $this->db->bind(':materia' , $materia);
        $this->db->bind(':codigo' , $codigo);
        return $this->db->register();
    }

    public function terminarProceso($estudiante , $nota)
    {
        $this->db->query('UPDATE grados SET nota_promedio = :nota WHERE codigo_estudiante = :codigo');
        $this->db->bind(':nota' , $nota);
        $this->db->bind(':codigo' , $estudiante);
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function insertarPromedioMateria($materia,$estudiante,$nota)
    {
        $this->db->query('UPDATE notas SET promedio = :nota WHERE codigo_materia = :materia AND codigo_estudiante = :codigo');
        $this->db->bind(':nota' , $nota);
        $this->db->bind(':materia' , $materia);
        $this->db->bind(':codigo' , $estudiante);
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getMateriasDisponiblesGrupo($grupo)
    {
        $this->db->query('SELECT M.codigo_materia , M.nombre FROM materias_has_grupos N
        INNER JOIN materias M ON M.codigo_materia = N.materias_codigo_materia
        WHERE N.grupos_codigo_grupo = :grupo');
        $this->db->bind(':grupo' , $grupo);
        return $this->db->registers();
    }

    public function getEstudiantesFinalGrupo($grupo , $materia)
    {
        $this->db->query('SELECT E.nombres , E.apellidos , N.parcial , N.final , N.promedio FROM grupos_has_estudiantes G
        INNER JOIN estudiantes E ON E.codigo_estudiante = G.estudiantes_codigo_estudiante
        INNER JOIN notas N ON N.codigo_materia = :materia AND N.codigo_estudiante = G.estudiantes_codigo_estudiante
        WHERE grupos_codigo_grupo = :grupo');
        $this->db->bind(':materia' , $materia);
        $this->db->bind(':grupo' , $grupo);
        return $this->db->registers();
    }
}