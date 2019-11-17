<?php

class Registrar extends Controller
{
    public function __construct()
    {
        $this->estudiante = $this->model('estudiante');
        $this->grupo = $this->model('grupo');
        if (!isset($_SESSION['auth'])) {
            redirect('/Autentication');
        }
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $ultimoId = $this->estudiante->getUltimeId();

            if (empty($ultimoId)) {
                $id = date('Y') . 001;
            } else {
                $idStr = strval($ultimoId->codigo_estudiante);
                $id = substr($idStr, -3);
                $codigo = date('Y' . $id);
                $code = $codigo + 1;
            }

            $datos = [
                'codigo' => trim($code),
                'role' => trim($_POST['rol']),
                'username' => trim($_POST['username']),
                'password' => password_hash($_POST['pass'], PASSWORD_BCRYPT),
                'type_documento' => trim($_POST['type_documento']),
                'document' => trim($_POST['document']),
                'name' => trim($_POST['name']),
                'lastname' => trim($_POST['lastname']),
                'gender' => trim($_POST['gender']),
                'birthday' => trim($_POST['birthday']),
                'address' => trim($_POST['address']),
                'city' => trim($_POST['city']),
                'phone' => trim($_POST['phone']),
                'email' => trim($_POST['email']),

            ];

            if ($this->estudiante->registrarEstudiante($datos)) {
                $_SESSION['registroCompleto'] = 'registroCompleto';
                redirect('/registrar');
            } else {
                $_SESSION['error'] = 'error registro';
                redirect('/registrar');
            }
        } else {
            $this->view('pages/auth/register_students');
        }
    }

    public function materias()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            try {
                $ultimoId = $this->grupo->getUltimeId();

                if (!empty($ultimoId)) {

                    
                        $passId = strval($ultimoId->codigo_materia);
                        $verificar = substr($passId, 0, 3);
                        if ($verificar == $_POST['area']) {
                            $ultimeDigits = substr($passId, -3) + 1;
                            if ($ultimeDigits >= 2 && $ultimeDigits <= 9) {
                                $codigoMateria = $verificar . '00' . $ultimeDigits;
                            } elseif ($ultimeDigits >= 10 && $ultimeDigits <= 99) {
                                $codigoMateria = $verificar . '0' . $ultimeDigits;
                            } else {
                                $codigoMateria = $verificar . $ultimeDigits;
                            }
                        } else {
                            $codigoMateria = $_POST['area'] . '001';
                        }
                    
                } else {
                    $codigoMateria = $_POST['area'] . '001';
                }

                $i = 0;
                $grupo = $_POST['grupo'];
                $num = count($grupo);

                $datos = [
                    'codigo' => $codigoMateria,
                    'asignature' => $_POST['asignature'],
                    'teacher' => $_POST['teacher']
                ];

                if ($this->grupo->registrarMaterias($datos)) {
                    for ($i; $i < $num; $i++) {
                        if ($this->grupo->registrarMateriasGrupos($grupo[$i], $datos['codigo'])) {
                            $_SESSION['materiaSuccess'] = 'materia registrado';
                            redirect('/registrar/materias');
                        }
                    }
                }
            } catch (Exception $e) {
                $_SESSION['errorMateria'] = 'materia registrado';
                redirect('/registrar/materias');
            }
        } else {

            $datos = [
                'grupos' => $this->grupo->getCodeGrupos(),
                'materias' => $this->grupo->getMateriasCode(),
                
            ];

            $this->view('pages/partials/registrar_materias', $datos);
        }
    }

    public function grupos()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $codigo = date('Y') . $_POST['grado'] . $_POST['grupo'];

            $datos = [
                'codigo' => $codigo,
                'maestro' => trim($_POST['profesor']),
                'jornada' => trim($_POST['jornada'])
            ];

            if ($this->grupo->registrarGrupo($datos)) {
                $_SESSION['grupoSuccess'] = 'Grupo registrado';
                redirect('/registrar/grupos');
            }
        } else {
            $datos = [
                'grupos' => $this->grupo->getCodeGrupos()
            ];

            $this->view('pages/partials/registrar_grupos' , $datos);
        }
    }

    public function eliminarMaterias($codigo)
    {
        if($this->grupo->eliminarMateriaGrupo($codigo)) {
            if($this->grupo->eliminarMateria($codigo)) {
                $_SESSION['materiaDeleteSuccess'] = 'materia eliminada';
                redirect('/registrar/materias');
            }
        } else {
            $_SESSION['materiaDeleteError'] = 'materia error';
            redirect('/registrar/materias');
        }
    }

    public function administrarGrupo($code)
    {
        $datos = [
            'estudiantes' => $this->estudiante->getEstudiantesGrupo($code),
            'maestro' => $this->estudiante->getTeacher($code)
        ];
        $this->view('/pages/partials/administrarGrupo' , $datos);
    }

    public function actualizarGrupo()
    {
        $datos = [
            'codigo' => trim($_POST['codigo']),
            'maestro' => trim($_POST['maestro']),
            'jornada' => trim($_POST['jornada']),
        ];

        if ( $this->grupo->actualizarDatosGrupo($datos)) {
            $_SESSION['grupoActualizado'] = 'Grupo actualizado';
            redirect('/registrar/grupos');
        }
    }

    public function gradoReprobado($codigo , $grupo)
    {
        if ($this->estudiante->reprobarGrado($codigo)) {
            $_SESSION['accionCompleta'] = 'operacion completa';
            redirect('/registrar/administrarGrupo/' . $grupo);
        } else {
            $_SESSION['accionFallida'] = 'no se recibio la peticion';
            redirect('/registrar/administrarGrupo/' . $grupo);
        }
    }

    public function gradoAprobado($codigo , $grupo)
    {
        if ($this->estudiante->aprobarGrado($codigo)) {
            $_SESSION['accionCompleta'] = 'operacion completa';
            redirect('/registrar/administrarGrupo/' . $grupo);
        } else {
            $_SESSION['accionFallida'] = 'no se recibio la peticion';
            redirect('/registrar/administrarGrupo/' . $grupo);
        }
    }
}
