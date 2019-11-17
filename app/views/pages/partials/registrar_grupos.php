<?php


include_once URL_RUTE . '/views/components/header.php';

include_once URL_RUTE . '/views/components/navbar.php';

?>

<div class="container mt-5">

    <div class="row">


        <div class="col-md-7">
            <h4 class="text-center mb-3">Registrar grupos</h4>

            <form action="<?php echo PROJECT_URL . '/registrar/grupos' ?>" method="POST" class="mb-4"> 
                <div class="form-row">

                    <div class="form-group col-md-6">
                        <select name="grado" id="grado" class="form-control" required>
                            <option value="">Grado</option>
                            <option value="06">6</option>
                            <option value="07">7</option>
                            <option value="08">8</option>
                            <option value="09">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <select name="grupo" id="grupo" class="form-control" required>
                            <option value="">Grupo</option>
                            <option value="01">1</option>
                            <option value="02">2</option>
                            <option value="03">3</option>
                            <option value="04">4</option>
                            <option value="05">5</option>
                            <option value="06">6</option>
                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <input type="text" name="profesor" id="profesor" placeholder="Nombre del maestro" class="form-control" required>
                    </div>

                    <div class="form-group col-md-12">
                        <select name="jornada" id="jornada" class="form-control" required>
                            <option value="">Jornada</option>
                            <option value="mañana">Mañana</option>
                            <option value="tarde">Tarde</option>
                            <option value="noche">Noche</option>
                        </select>
                    </div>

                    <button class="btn btn-primary btn-block">Registrar grupo</button>

                </div>
            </form>

        </div>


        <div class="col-md-5">
            <h4 class="text-center">Grupos registrados</h4>

            <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Profesor</th>
                        <th scope="col">Jornada</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($params['grupos'] as $datosMaterias) : ?>

                        <tr>
                            <td><?php echo $datosMaterias->codigo_grupo ?></td>
                            <td><?php echo $datosMaterias->nombre_profesor ?></td>
                            <td><?php echo $datosMaterias->jornada ?></td>
                            <td><a href="<?php echo PROJECT_URL . '/registrar/administrarGrupo/' . $datosMaterias->codigo_grupo ?>" class="btn btn-info">Administrar</a></td>
                        </tr>
                    <?php endforeach ?>


                </tbody>
            </table>
            </div>

        </div>


    </div>


</div>

<?php

include_once URL_RUTE . '/views/components/footer.php';

?>

<?php if (isset($_SESSION['grupoSuccess'])) : ?>
    <script>
        mostrarAlerta('success', 'Buen trabajo', 'El grupo ha sido registrado correctamente')
    </script>
    <?php unset($_SESSION['grupoSuccess']);
endif ?>

<?php if (isset($_SESSION['grupoActualizado'])) : ?>
    <script>
        mostrarAlerta('success', 'Buen trabajo', 'El grupo ha sido actualizado correctamente')
    </script>
    <?php unset($_SESSION['grupoActualizado']);
endif ?>

