<?php require_once("preheader.php"); ?>

<header class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <h1>
                    <a href="<?php echo BASE_URL ?>">My Bank</a>
                </h1>
            </div>
            <nav class="col-8">
                <ul>
                    <li>
                        <a href="#">
                            <i class="fa fa-user"></i>
                            <?php if(isset($_SESSION['id'])) {echo $_SESSION['login'];} else {header('Location: ' . BASE_URL . '/index.php');} ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo BASE_URL . "logout.php"; ?>">Выход</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>