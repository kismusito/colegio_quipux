<?php

class Nota extends Controller
{
    public function __construct()
    {
        $this->nota = $this->model('notas');
        $this->estudiante = $this->model('estudiante');
        if (!isset($_SESSION['auth'])) {
            redirect('/Autentication');
        }
    }

    public function index($grupo = null, $estudiante = null)
    {
        if (!is_null($grupo) && !is_null($estudiante)) {

            $datos = [
                'grupo' => $grupo,
                'notas' => $this->nota->notasDisponibles($grupo),
                'estudiante' => $this->nota->estudianteNota($estudiante),
            ];

            $this->view('/pages/partials/agregarNotas', $datos);
        } else {
            redirect('/registrar/grupos');
        }
    }

    public function agregarNota()
    {
        $estudiante = $_POST['estudiante'];
        $materia = $_POST['materia'];
        $nota = $_POST['nota'];
        $grupo = $_POST['grupo'];

        if ($this->nota->verificarNota($estudiante, $materia)) {
            if ($this->nota->agregarNota($estudiante, $materia, $nota)) {
                $_SESSION['notaAgregada'] = 'nota agregada';
                redirect('/nota/' . $grupo . '/' . $estudiante);
            }
        } else {
            if ($this->nota->agregarNotaEstudiante($estudiante, $materia)) {
                if ($this->nota->agregarNota($estudiante, $materia, $nota)) {
                    $_SESSION['notaAgregada'] = 'nota agregada';
                    redirect('/nota/' . $grupo . '/' . $estudiante);
                }
            }
        }
    }

    public function agregarParcial()
    {
        $estudiante = $_POST['estudiante'];
        $materia = $_POST['materia'];
        $nota = $_POST['parcial'];
        $grupo = $_POST['grupo'];

        if ($this->nota->verificarNota($estudiante, $materia)) {
            if ($this->nota->agregarParcial($estudiante, $materia, $nota)) {
                $_SESSION['notaAgregada'] = 'nota agregada';
                redirect('/nota/' . $grupo . '/' . $estudiante);
            }
        } else {
            if ($this->nota->agregarNotaEstudiante($estudiante, $materia)) {
                if ($this->nota->agregarParcial($estudiante, $materia, $nota)) {
                    $_SESSION['notaAgregada'] = 'nota agregada';
                    redirect('/nota/' . $grupo . '/' . $estudiante);
                }
            }
        }
    }

    public function agregarExaFinal()
    {
        $estudiante = $_POST['estudiante'];
        $materia = $_POST['materia'];
        $nota = $_POST['exaFinal'];
        $grupo = $_POST['grupo'];

        if ($this->nota->verificarNota($estudiante, $materia)) {
            if ($this->nota->agregarexaFinal($estudiante, $materia, $nota)) {
                $_SESSION['notaAgregada'] = 'nota agregada';
                redirect('/nota/' . $grupo . '/' . $estudiante);
            }
        } else {
            if ($this->nota->agregarNotaEstudiante($estudiante, $materia)) {
                if ($this->nota->agregarexaFinal($estudiante, $materia, $nota)) {
                    $_SESSION['notaAgregada'] = 'nota agregada';
                    redirect('/nota/' . $grupo . '/' . $estudiante);
                }
            }
        }
    }

    public function terminarProceso($materia = null, $estudiante = null, $grupo = null)
    {
        if (!is_null($materia) && !is_null($estudiante) && !is_null($grupo)) {
            $i = 0;
            $sumaNotas = 0;
            $nota = [
                'notas' => $this->nota->notasDelEstudiante($materia, $estudiante)
            ];
            var_dump($nota);
            $notas = $this->nota->notasExaDelEstudiante($materia, $estudiante);
            $numeroNotas = count($nota['notas']) - 1;

            for ($i; $i <= $numeroNotas; $i++) {
                $sumaNotas  = $sumaNotas + $nota['notas'][$i]->nota;
            }
            $promedioSeguimiento = ($sumaNotas / ($numeroNotas + 1)) * 0.6;

            $notaParcial = ($notas->parcial) * 0.2;
            $notaExaFinal = ($notas->final) * 0.2;

            $notaFinal = $promedioSeguimiento + $notaParcial + $notaExaFinal;
            $notaFinal = round($notaFinal , 1);

            $insertarPromedioMateria = $this->nota->insertarPromedioMateria($materia, $estudiante , $notaFinal);

            if ($notaFinal >= 3.0 && $notaFinal <= 5.0) {
                if ($this->nota->terminarProceso($estudiante, $notaFinal)) {
                    if ($this->estudiante->aprobarGrado($estudiante)) {
                        $_SESSION['accionCompleta'] = 'operacion completa';
                        redirect('/registrar/administrarGrupo/' . $grupo);
                    } else {
                        $_SESSION['accionFallida'] = 'no se recibio la peticion';
                        redirect('/registrar/administrarGrupo/' . $grupo);
                    }
                }
            } else {
                if ($this->nota->terminarProceso($estudiante, $notaFinal)) {
                    if ($this->estudiante->reprobarGrado($estudiante)) {
                        $_SESSION['accionCompleta'] = 'operacion completa';
                        redirect('/registrar/administrarGrupo/' . $grupo);
                    } else {
                        $_SESSION['accionFallida'] = 'no se recibio la peticion';
                        redirect('/registrar/administrarGrupo/' . $grupo);
                    }
                }
            }
        } else {
            redirect('/registrar/grupos');
        }
    }

    public function calificaciones($grupo)
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $datos = [
                'materia' => trim($_POST['materia']),
                'estudiantes' => $this->nota->getEstudiantesFinalGrupo($grupo , $_POST['materia'])
            ];
            $this->view('/pages/partials/calificacionesRegistro' , $datos);
        } else {
            $datos = [
                'materias' => $this->nota->getMateriasDisponiblesGrupo($grupo),
                'grupo' => $grupo
            ];
    
            $this->view('/pages/partials/calificaciones' , $datos);
        }
    }
}
