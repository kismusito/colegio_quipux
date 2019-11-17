<header>
    <div class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">

            <a href="<?php echo PROJECT_URL ?>" class="navbar-brand">
                <h4><?php echo NAMEPROJECT ?></h4>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav mr-auto">

                </ul>

                <ul class="navbar-nav ml-auto">

                    <?php if (isset($_SESSION['auth'])) :
                        include_once URL_RUTE . '/views/pages/navigation/admin.php';
                    endif ?>

                </ul>
            </div>
        </div>
    </div>
</header>