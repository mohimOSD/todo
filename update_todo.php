<?php
require_once './templates/commonheader.php';

$db = (new Database())->getConnection();    
$todo = new Todo($db);

$todo->user_id = $_SESSION['user_id'];

if(isset($_GET['id'])){
    $todo->id = $_GET['id'];
    $todo_item = $todo->read();
    if(!$todo_item) {
        $todo_item = null;
    }
} else {
   $todo_item = null;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // print_r($_POST);die();
    $todo->id = $_POST['id'];
    $todo->task = $_POST['task'];
    $todo->status = $_POST['status'];

    if($todo->update()){
        setMessage('welcome', 'Task update successfully');
        header("Location: dashboard.php");
    } else {
        $error = 'Something went wrong. Try again';
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
                            <?php if($todo_item != null ) {?>
                            <form method="post" action="update_todo.php">
                            <input type="hidden" name="id" value="<?php echo $todo_item['id']; ?>" >
                            <div class="mb-3">
                                <label  class="form-label">Task</label>
                                <input type="text" class="form-control" name="task" value="<?php echo $todo_item['task']; ?>">
                            </div>
                            <div class="mb-3">
                                <label  class="form-label">Status</label>
                                <select class="form-select form-control"  name="status">
                                <option <?php $todo_item['status'] == 0 ? 'selected': ''?> value="0">Pending</option>
                                <option <?php $todo_item['status'] == 1 ? 'selected': ''?> value="1">Complete</option> 
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                            <?php  } else {
                                echo 'Data not found';
                            }?>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
<?php require_once './templates/footer.php'; ?>