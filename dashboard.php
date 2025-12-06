
</head>
   

<?php
require_once './templates/commonheader.php';

$db = (new Database())->getConnection();    
$todo = new Todo($db);

$todo->user_id = $_SESSION['user_id'];

$todos = $todo->readAll();

if(isset($_GET['delete'])){
    $todo->id = $_GET['delete'];
    $todo->delete();
    setMessage('welcome', 'Task delete successfully');
}
$welcome = getMessage('welcome');
require_once './templates/header.php';
?>


                <!-- Begin Page Content -->

                   <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Todo List</h1>
                    <?php if($welcome) { ?> 
                    <div class="alert alert-success" role="alert">
                        <?php echo $welcome['message'];?>
                    </div>
                    <?php } ?>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><a href="add_todo.php"  class="btn btn-secondary">Add Todo</a></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Task</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Task</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($todos as  $v) { ?>
                                            <tr>
                                            <td><?php echo $v['task']; ?></td>
                                            <td><?php echo $v['status'] == 0?'pending':'complete'; ?></td>
                                            <td><a href="update_todo.php?id=<?php echo $v['id']; ?>" class="btn btn-primary">edit</a> <a href="dashboard.php?delete=<?php echo $v['id']; ?>" class="btn btn-danger">delete</a></td>
                                        </tr>
                                       <?php } ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->


  <?php require_once './templates/footer.php'; ?>

    <body id="page-top"> 

              
             
                 
      

         
           
        
             
 

 