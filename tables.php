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
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Task</th>
                                            <th>Status</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Task</th>
                                            <th>Status</th>
                                            
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($todos as  $v) { ?>
                                            <tr>
                                            <td><?php echo $v['task']; ?></td>
                                            <td><?php echo $v['status'] == 0?'pending':'complete'; ?></td>
                                            
                                        </tr>
                                       <?php } ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
                

                <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>

    <body id="page-top">
       