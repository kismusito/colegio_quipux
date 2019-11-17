<?php

class AdministrarEstudiantes extends Controller
{
    public function __construct()
    {
        $this->adminEstudiante = $this->model('adminEstudiante');
        if (!isset($_SESSION['auth'])) {
            redirect('/Autentication');
        }
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        } else {
            $datos = [
                'estudiantes' => $this->adminEstudiante->getEstudiantes(),
                'grupos' => $this->adminEstudiante->getGrupos()
            ];
            $this->view('pages/partials/adminEstudiante' , $datos);
        }
    }

    public function addGrupo()
    {
        $datos = [
            'grupo' => trim($_POST['grupo']),
            'codigo_estudiante' => trim($_POST['code_user'])
        ];

        if ($this->adminEstudiante->verificarGrupo($datos)) {

            $_SESSION['grupoInsertErrorRepeat'] = 'Grupo error repeat';
            redirect('/administrarEstudiantes');
            
        } else {
            if ($this->adminEstudiante->agregarGrupo($datos)) {
                $datosGrado = [
                    'grado' => $datos['grupo'],
                    'year' => date('Y'),
                    'codigo' => $datos['codigo_estudiante'],
                    'estado' => 1
                ];
                if ($this->adminEstudiante->registrarGrado($datosGrado)) {
                    $_SESSION['grupoInsertSuccess'] = 'Grupo insertado';
                    redirect('/administrarEstudiantes');
                }
                
            }
        }
    }
}