<li><a class="nav-link" href="<?php echo PROJECT_URL . '/registrar' ?>">Registrar estudiantes</a></li>
<li><a class="nav-link" href="<?php echo PROJECT_URL . '/administrarEstudiantes' ?>">Administrar estudiantes</a></li>
<li><a class="nav-link" href="<?php echo PROJECT_URL . '/registrar/grupos' ?>">Administrar grupos</a></li>
<li><a class="nav-link" href="<?php echo PROJECT_URL . '/registrar/materias' ?>">Administrar materias</a></li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php echo $_SESSION['auth'] ?>
    </a>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="<?php echo PROJECT_URL . '/pages/logout' ?>">Cerrar sesión</a>
    </div>
</li>