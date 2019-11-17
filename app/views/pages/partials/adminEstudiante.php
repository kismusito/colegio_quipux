<?php

include_once URL_RUTE . '/views/components/header.php';

include_once URL_RUTE . '/views/components/navbar.php';

?>

<div class="container mt-5">

    <h4 class="text-center mb-3">Administrar estudiantes</h4>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Codigo</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Documento</th>
                <th scope="col">Grupo</th>
            </tr>
        </thead>
        <tbody>



            <?php foreach ($params['estudiantes'] as $datosEstudiante) : ?>

                <tr>

                    <th scope="row"><?php echo $datosEstudiante->codigo_estudiante ?></th>
                    <td><?php echo $datosEstudiante->nombres ?></td>
                    <td><?php echo $datosEstudiante->apellidos ?></td>
                    <td><?php echo $datosEstudiante->numero_documento ?></td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#grupomodal<?php echo $datosEstudiante->codigo_estudiante ?>">
                            Agregar grupo
                        </button>
                    </td>


                    <!-- Modal -->
                    <div class="modal fade" id="grupomodal<?php echo $datosEstudiante->codigo_estudiante ?>" tabindex="-1" role="dialog" aria-labelledby="grupomodalLabel<?php echo $datosEstudiante->codigo_estudiante ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Agregar grupo a <?php echo $datosEstudiante->nombres ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form action="<?php echo PROJECT_URL . '/administrarEstudiantes/addGrupo' ?>" method="POST">

                                        <input type="hidden" name="code_user" value="<?php echo $datosEstudiante->codigo_estudiante ?>">

                                        <div class="form-group">

                                            <select name="grupo" id="grupo" class="form-control" required>
                                                <option value="">Grupo</option>

                                                <?php foreach ($params['grupos'] as $datosGrupos) : ?>
                                                    <option value="<?php echo $datosGrupos->codigo_grupo ?>"><?php echo $datosGrupos->codigo_grupo . ' - ' . $datosGrupos->nombre_profesor ?></option>
                                                <?php endforeach ?>

                                            </select>
                                        </div>

                                        <button class="btn btn-primary btn-block">Agregar grupo</button>
                                    </form>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fin modal -->

                </tr>


            <?php endforeach ?>


        </tbody>
    </table>


</div>

<?php

include_once URL_RUTE . '/views/components/footer.php';

?>

<?php if (isset($_SESSION['grupoInsertSuccess'])) : ?>
    <script>
        mostrarAlerta('success', 'Buen trabajo', 'El estudiante se ha registrado en un grupo correctamente')
    </script>
    <?php unset($_SESSION['grupoInsertSuccess']);
endif ?>

<?php if (isset($_SESSION['grupoInsertErrorRepeat'])) : ?>
    <script>
        mostrarAlerta('error', 'Oops...', 'Parece que el estudiante ya pertenece a un grupo')
    </script>
    <?php unset($_SESSION['grupoInsertErrorRepeat']);
endif ?>