<?php
require_once "../Models/Task.db.php";
session_start();
$tid = $_GET["tid"];
$task = new Task();
$updateRow = $task->getTaskByTaskId($tid);
// print_r($updateRow);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Todo App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post">
                    <input type="hidden" name="tid" value="<?php echo $updateRow["id"]; ?>">
                    <div class="mb-3">
                        <label for="task" class="form-label">Task</label>
                        <input type="text" class="form-control" name="updateTaskName" value="<?php echo $updateRow["taskName"]; ?>">
                    </div>
                    <?php
                    $value = $updateRow["status"];
                    $option = ($value) ? "Done" : "Pending";
                    $option2 = (!$value) ? "Done" : "Pending";
                    ?>
                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="updateStatus">
                        <option value="<?php echo $value; ?>"><?php echo $option; ?></option>
                        <option value="<?php echo !$value; ?>"><?php echo $option2; ?></option>
                    </select>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success" name="updateTask">Update Task</button>
                    </div>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
    <?php
    if (isset($_POST["updateTask"])) {
        $taskName = $_POST["updateTaskName"];
        $status = $_POST["updateStatus"];
        $tid = $_POST["tid"];
        $task->updateTask($taskName, $status, $tid);
        header("Location:../task.php");
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>