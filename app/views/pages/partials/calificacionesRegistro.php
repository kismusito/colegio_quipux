<?php

include_once URL_RUTE . '/views/components/header.php';

include_once URL_RUTE . '/views/components/navbar.php';

?>

<div class="container mt-5">

    <div class="table-responsive">
        <table class="table">
            <thead>
                <th>Nombre</th>
                <th>Parcial</th>
                <th>Examen final</th>
                <th>Nota final</th>
                <th>Estado</th>
            </thead>
            <tbody>
                <?php foreach ($params['estudiantes'] as $datosEstudiantes) : ?>
                    <tr>
                        <td><?php echo  $datosEstudiantes->nombres . ' ' . $datosEstudiantes->apellidos ?></td>
                        <td><?php echo  $datosEstudiantes->parcial ?></td>
                        <td><?php echo  $datosEstudiantes->final ?></td>
                        <td><?php echo  $datosEstudiantes->promedio ?></td>
                        <td><?php if ($datosEstudiantes->promedio >= 3.0 && $datosEstudiantes->promedio <= 5.0){echo 'Aprobado';} else {echo 'Reprobado';} ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

</div>

<?php

include_once URL_RUTE . '/views/components/footer.php';

?>

<?php if (isset($_SESSION['accionCompleta'])) : ?>
    <script>
        mostrarAlerta('success', 'Buen trabajo', 'La accion se completo correctamente')
    </script>
    <?php unset($_SESSION['accionCompleta']);
endif ?>