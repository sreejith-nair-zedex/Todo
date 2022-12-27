<!doctype html>
<?php
session_start();
require_once "./Models/Task.db.php";
error_reporting(E_ERROR | E_PARSE);
$task = new Task();
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Todo App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.13.1/datatables.min.css" />
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-primary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/todo/task.php">Todo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active " aria-current="home page" href="/todo/task.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="login page" href="/todo/Controller/logout.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="login page" href="/todo/Controller/register_nav.php">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php if ($_SESSION["id"]) : ?>
        <div class="container">
            <div class="row m-3">
                <div class="col-lg-6 text-danger">
                    Welcome <?php echo $_SESSION["username"]; ?>! Your task
                </div>
                <div class="col-lg-6">
                    <button class="btn btn-primary float-end ms-2" data-bs-toggle="modal" data-bs-target="#addTask">
                        Add New Task
                    </button>
                    <a href="/todo/Controller/logout.php" name="logout" class="btn btn-danger float-end">
                        Logout
                    </a>
                </div>
            </div>
            <?php
            $uId = (int)$_SESSION["id"];
            $datas = $task->getTaskByUserId($uId);
            // print_r($datas);
            if (count($datas)>0) :
            ?>
            <div class="row m-3">
                <div class="col-lg-12">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Task</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($datas as $data) : ?>
                                <tr>
                                    <td><?php echo $data[1]; ?></td>
                                    <?php $status = ($data[3]) ? "Done" : "Pending"; ?>
                                    <td><?php echo $status; ?></td>
                                    <td>
                                        <a href="/todo/Controller/update_task.php?tid=<?php echo $data[0]; ?>" class="btn btn-success btn-sm ms-2">Update</a>
                                        <a href="/todo/Controller/delete_task.php?tid=<?php echo $data[0]; ?>" class="btn btn-danger btn-sm ms-2">Delete</a>
                                    </td>
                                <?php endforeach; ?>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php else: ?>
                <div class="row" style="margin-top: 10%;">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <h3 class="text-danger">No Task Found!</h3>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            <?php endif; ?>
        </div>

        <!--Add Task Modal -->
        <div class="modal fade" id="addTask" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-primary" id="staticBackdropLabel">Add New Task</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/todo/Controller/add_task.php" method="post">
                            <div class="mb-3">
                                <label for="task" class="form-label">Task</label>
                                <input type="text" class="form-control" name="taskName">
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary" name="addtasktodb">Add Task</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="container">
            <div class="row" style="margin-top: 10%;">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <h3 class="text-danger">Please Login First!</h3>
                    <a href="/todo/index.php" class="text-decoration-none text-primary">Click here to login!</a>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.13.1/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $("table").DataTable({
                order: [0, "desc"]
            });

        });
    </script>
</body>

</html>