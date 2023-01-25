<?php

include("vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\Auth;

$table = new UsersTable(new MySQL());
$all = $table->getAll();

$auth = Auth::check();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Users</title>
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

                    <!--Blocks -->
                    <div class="container-fluid mt-3 p-4">
                        <div class="row mb-1">
                            <div class="col">
                                <div class="alert alert-info">
                                    <h1 class="mt-5 mb-5">
                                        Manage Users
                                        <span class="badge bg-danger text-white">
                                            <?= count($all) ?>
                                        </span>
                                    </h1>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                                <?php foreach ($all as $user): ?>
                                    <tr>
                                        <td><?= $user->id ?></td>
                                        <td><?= $user->name ?></td>
                                        <td><?= $user->email ?></td>
                                        <td><?= $user->phone ?></td>
                                        <td>
                                            <?php if($user->value === '1'): ?>
                                                <span class="badge bg-secondary">
                                                    <?= $user->role ?>
                                                </span>
                                            <?php elseif($user->value === '2'): ?>
                                                <span class="badge bg-primary">
                                                    <?= $user->role ?>
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-success">
                                                    <?= $user->role ?>
                                                </span>
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            <?php if($auth->value > 1): ?>
                                                <div class="btn-group dropdown">
                                                    <a href="#" class="btn btn-sm btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
                                                        Change Role
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-dark">
                                                        <a href="_actions/role.php?id=<?= $user->id ?>&role=1" class="dropdown-item">User</a>
                                                        <a href="_actions/role.php?id=<?= $user->id ?>&role=2" class="dropdown-item">Manager</a>
                                                        <a href="_actions/role.php?id=<?= $user->id ?>&role=3" class="dropdown-item">Admin</a>
                                                    </div>

                                                    <?php if($user->suspended): ?>
                                                        <a href="_actions/unsuspend.php?id=<?= $user->id ?>" class="btn btn-sm btn-danger">
                                                            Suspended
                                                        </a>
                                                    <?php else: ?>
                                                        <a href="_actions/suspend.php?id=<?= $user->id ?>" class="btn btn-sm btn-outline-success">
                                                            Active
                                                        </a>
                                                    <?php endif ?>

                                                    <?php if($user->id !== $auth->id): ?>
                                                        <a href="_actions/delete.php?id=<?= $user->id ?>" class="btn btn-sm btn-outline-danger" onClick="return confirm('Are you sure?')">
                                                            Delete
                                                        </a>
                                                    <?php endif ?>
                                                </div>

                                                <?php else : ?>
                                                    ###
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </table>
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