<?php
require_once './templates/commonheader.php';

$db = (new Database())->getConnection();    
$todo = new Todo($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // print_r($_SESSION);die();
    $todo->user_id = $_SESSION['user_id'];
    $todo->task = $_POST['task'];

    if($todo->create()){
        setMessage('welcome', 'Task created successfully');
        header('Location: dashboard.php');
    } else {
        $error = 'Registration failed. Try again';
    }
}
require_once './templates/header.php';
?>


                <!-- Begin Page Content -->

                   <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Todo List</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 row">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><a href="dashboard.php"  class="btn btn-primary">Back</a></h6>
                        </div>
                        <div class="card-body col-md-4 offset-md-4 ">
                            <form method="post">
                            <div class="mb-3">
                                <label  class="form-label">Task</label>
                                <input type="text" class="form-control" name="task">
                            </div>
                            <button type="submit" class="btn btn-dark">Add Task</button>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
<?php require_once './templates/footer.php'; ?>