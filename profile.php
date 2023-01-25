<?php
    include("vendor/autoload.php");

    use Helpers\Auth;

    $auth = Auth::check();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    </head>
    <body>
        <!-- Sidebar Nabigation -->
        <div class="container-fluid">
            <div class="row g-0">
                <nav class="col-2 bg-light pe-3">
                    <!-- Title -->
                    <h1 class="h4 py-3 text-center text-primary">
                        <i class="fas fa-ghost me-2"></i>
                        <span class="d-none d-lg-inline">GHOST ADMIN</span>
                    </h1>

                    <!-- Controls Group -->
                    <div class="list-group text-center text-lg-start">
                        <!-- <span class="list-group-item disabled d-none d-lg-block">
                            <small>CONTROLS</small>
                        </span>
                        <a href="#" class="list-group-item list-group-item-action active">
                            <i class="fas fa-home"></i>
                            <span class="d-none d-lg-inline">Dashboard</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-users"></i>
                            <span class="d-none d-lg-inline badge bg-danger rounded-pill float-end">20</span>
                        </a>
                        <a href="#" class="list-group-item  list-group-item-action">
                            <i class="fas fa-chart-line"></i>
                            <span class="d-none d-lg-inline">Statistics</span>
                        </a>
                        <a href="#" class="list-group-item  list-group-item-action">
                            <i class="fas fa-flag"></i>
                            <span class="d-none d-lg-inline">Reports</span>
                        </a>                         -->
                    </div>

                    <!-- Action Group -->
                    <div class="list-group mt-4 text-center text-lg-start">
                        <span class="list-group-item disabled d-none d-lg-block">
                            <small>ACTIONS</small>
                        </span>
                        <a href="admin.php" class="list-group-item list-group-item-action">
                            <i class="fas fa-edit"></i>
                            <span class="d-none d-lg-inline">Manage Users</span>
                        </a>                                             
                    </div>
                </nav>

                <main class="col-10 bg-secondary">
                    <!-- Horizontal Navbar -->
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">

                        <div class="flex-fill"></div>

                        <div class="navbar nav">
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="fas fa-user-circle"></i>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="profile.php" class="dropdown-item">User Profile</a>
                                    </li>
                                    <li>
                                        <a href="_actions/logout.php" class="dropdown-item">Logout</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-cog"></i>
                                </a>
                            </li>
                        </div>
                    </nav>

                    <!--Stat Blocks -->
                    <div class="container-fluid mt-3 p-4">
                        <div class="row mb-1">
                            <div class="col">
                                <div class="alert alert-info">
                                    <h1 class="mt-3 mb-3">
                                        <?= $auth->name ?>
                                        <span class="fw-normal text-muted">
                                            (<?= $auth->role ?>)
                                        </span>
                                    </h1>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <?php if (isset($_GET['error'])): ?>
                                    <div class="alert alert-warning">
                                        Cannot upload file
                                    </div>
                                <?php endif ?>

                                <?php if ($auth->photo): ?>
                                    <img class="img-thumbnail mb-3" src="_actions/photos/<?= $auth->photo ?>" alt="Profile Photo" width="200">
                                <?php endif ?>

                                <form action="_actions/upload.php" method="POST" enctype="multipart/form-data">
                                    <div class="input-group mb-3">
                                        <input type="file" name="photo" class="form-control">
                                        <button class="btn btn-secondary">Upload</button>
                                    </div>
                                </form>

                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <b>Email:</b> <?= $auth->email ?>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Phone:</b> <?= $auth->phone ?>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Address:</b> <?= $auth->address ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <script src="js/bootstrap.bundle.min.js"></script>
    </body>
    <footer class="text-center py-4 text-muted">
        &copy; Copyright 2022
    </footer>
</html>