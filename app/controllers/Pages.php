<?php

class Pages extends Controller
{
    public function __construct()
    {
        $this->estudiante = $this->model('estudiante');
        if (!isset($_SESSION['auth'])) {
            redirect('/Autentication');
        }
    }

    public function index()
    {
        
            $totalEstudiantes = $this->estudiante->totalestudiantes();
            $totalMaterias = $this->estudiante->totalmaterias();
            $totalGrupos = $this->estudiante->totalgrupos();

            $params = [
                'totalEstudiantes' => $totalEstudiantes,
                'totalMaterias' => $totalMaterias,
                'totalGrupos' => $totalGrupos,
            ];

            $this->view('pages/home' , $params);
    }

    public function logout ()
    {
        session_destroy();

        $_SESSION[] = array();

        redirect('/Autentication');
    }

}