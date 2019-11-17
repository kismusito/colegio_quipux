<?php

include_once URL_RUTE . '/views/components/header.php';

include_once URL_RUTE . '/views/components/navbar.php';

?>

<div class="container mt-5">

    <h4>Notas del estudiante <?php echo $params['estudiante']->nombres . ' ' . $params['estudiante']->apellidos ?></h4>

    <br>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <th>Materia</th>
                <th>Profesor</th>
                <th>Agregar Nota</th>
                <th>Agregar Parcial</th>
                <th>Agregar Final</th>
                <th>Terminar proceso</th>
            </thead>
            <tbody>
                <?php foreach ($params['notas'] as $datosNota) : ?>
                    <tr>
                        <td><?php echo $datosNota->codigo_materia ?></td>
                        <td><?php echo $datosNota->nombre ?></td>
                        <td><?php echo $datosNota->profesor ?></td>
                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#notaModal<?php echo $datosNota->codigo_materia?>">Agregar nota</button></td>
                        <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#parcialModal<?php echo $datosNota->codigo_materia?>">Agregar parcial</button></td>
                        <td><button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#finalModal<?php echo $datosNota->codigo_materia?>">Agregar final</button></td>
                        <td><a href="<?php echo PROJECT_URL . '/nota/terminarProceso/' . $datosNota->codigo_materia . '/' . $params['estudiante']->codigo_estudiante . '/' . $params['grupo'] ?>" onclick="return confirm('Quieres terminar el proceso del estudiante?')" class="btn btn-warning">Terminar proceso</a></td>
                    </tr>

                    <!-- Modal Notas -->
                    <div class="modal fade" id="notaModal<?php echo $datosNota->codigo_materia?>" tabindex="-1" role="dialog" aria-labelledby="notaModal<?php echo $datosNota->codigo_materia?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel<?php echo $datosNota->codigo_materia?>">Agregar Nota</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo PROJECT_URL . '/nota/agregarNota' ?>" method="POST">
                                        <input type="hidden" name="grupo" id="grupo" value="<?php echo $params['grupo']?>">
                                        <input type="hidden" name="materia" id="materia" value="<?php echo $datosNota->codigo_materia?>">
                                        <input type="hidden" name="estudiante" id="estudiante" value="<?php echo $params['estudiante']->codigo_estudiante ?>">
                                        <div class="form-group">
                                            <input type="number" name="nota" id="nota" step="any" min="0" max="5" class="form-control" placeholder="Agregar nota" required>
                                        </div>
                                        <button class="btn btn-primary btn-block">Agregar nota</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fin modal -->

                    <!-- Modal parcial -->
                    <div class="modal fade" id="parcialModal<?php echo $datosNota->codigo_materia?>" tabindex="-1" role="dialog" aria-labelledby="parcialModal<?php echo $datosNota->codigo_materia?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel<?php echo $datosNota->codigo_materia?>">Agregar nota parcial</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <form action="<?php echo PROJECT_URL . '/nota/agregarParcial' ?>" method="POST">
                                        <input type="hidden" name="grupo" id="grupo" value="<?php echo $params['grupo']?>">
                                        <input type="hidden" name="materia" id="materia" value="<?php echo $datosNota->codigo_materia?>">
                                        <input type="hidden" name="estudiante" id="estudiante" value="<?php echo $params['estudiante']->codigo_estudiante ?>">
                                        <div class="form-group">
                                            <input type="number" name="parcial" id="parcial" step="any" min="0" max="5" class="form-control" placeholder="Agregar nota" required>
                                        </div>
                                        <button class="btn btn-primary btn-block">Agregar parcial</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fin parcial -->

                    <!-- Modal final -->
                    <div class="modal fade" id="finalModal<?php echo $datosNota->codigo_materia?>" tabindex="-1" role="dialog" aria-labelledby="finalModal<?php echo $datosNota->codigo_materia?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel<?php echo $datosNota->codigo_materia?>">Agregar nota examen final</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <form action="<?php echo PROJECT_URL . '/nota/agregarExaFinal' ?>" method="POST">
                                        <input type="hidden" name="grupo" id="grupo" value="<?php echo $params['grupo']?>">
                                        <input type="hidden" name="materia" id="materia" value="<?php echo $datosNota->codigo_materia?>">
                                        <input type="hidden" name="estudiante" id="estudiante" value="<?php echo $params['estudiante']->codigo_estudiante ?>">
                                        <div class="form-group">
                                            <input type="number" name="exaFinal" id="exaFinal" step="any" min="0" max="5" class="form-control" placeholder="Agregar nota" required>
                                        </div>
                                        <button class="btn btn-primary btn-block">Agregar examen final</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fin final -->




                <?php endforeach ?>




            </tbody>
        </table>
    </div>

</div>



<?php

include_once URL_RUTE . '/views/components/footer.php';

?>

<?php if (isset($_SESSION['notaAgregada'])) : ?>
    <script>
        mostrarAlerta('success', 'Buen trabajo', 'La nota se agrego correctamente')
    </script>
    <?php unset($_SESSION['notaAgregada']);
endif ?>