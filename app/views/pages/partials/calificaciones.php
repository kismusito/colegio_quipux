<?php

include_once URL_RUTE . '/views/components/header.php';

include_once URL_RUTE . '/views/components/navbar.php';

?>

<div class="container mt-5">

    <h4 class="text-center mb-2">Seleccionar materia</h4>
    <form action="" method="POST">
        <div class="form-group">
            <select name="materia" id="materia" class="form-control" required>
                <option value="">Materia</option>
                <?php foreach($params['materias'] as $datosMaterias): ?>
                    <option value="<?php echo $datosMaterias->codigo_materia ?>"><?php echo $datosMaterias->nombre ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <button class="btn btn-primary btn-block">Enviar</button>
    </form>

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
