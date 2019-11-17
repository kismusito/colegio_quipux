<?php

include_once URL_RUTE . '/views/components/header.php';

include_once URL_RUTE . '/views/components/navbar.php';

?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-7">
            <div class="jumbotron">
                <h1 class="display-4">Bienvenido al colegio quipux</h1>
            </div>
        </div>

        <div class="col-md-5">


            <div class="card-estudiantes mb-3">
                <h4>Total de estudiantes</h4>
                <p><?php echo $params['totalEstudiantes']?></p>
            </div>

            <div class="card-materias mb-3">
                <h4>Total de materias</h4>
                <p><?php echo $params['totalMaterias']?></p>
            </div>

            <div class="card-grupos">
                <h4>Total de grupos</h4>
                <p><?php echo $params['totalGrupos']?></p>
            </div>



        </div>
    </div>
</div>

<?php

include_once URL_RUTE . '/views/components/footer.php';

?>