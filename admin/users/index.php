<?php
session_start();
if((isset($_SESSION['login']) && ($_SESSION['login']))){
    if($_SESSION['role']!=1)
        echo "<script>window.location.href='/public'</script>";
}else {
    echo "<script>window.location.href='/'</script>";
    exit();

}

$table='users';
$conditions=[];
$columns=[];

require_once '../../core/DbQuery.php';
$dbOperations = new DatabaseOperations();

$users=$dbOperations->select($table);

?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <?php $page_name="Users"; include "../../blocks/main_head.php";?>
</head>

<body>
<?php include "../../blocks/preloader.php"?>
<div id="main-wrapper">
<?php include('../../blocks/header.php')?>
    <div class="page-wrapper">

        <?php  include "../../blocks/bread_camp.php"?>

        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $page_name?></h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>University Number</th>
                                <th>Password</th>
                                <th>Role</th>
                                <th>Created_at</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($users as $user){?>
                            <tr>
                                <td><a href="/admin/users/edit?id=<?php echo $user['id']?>"><?php echo $user['id']?></a></td>
                                <td><a href="/admin/users/edit?id=<?php echo $user['id']?>"><?php echo $user['name']?></a></td>
                                <td><?php echo $user['university_number']?></td>
                                <td><?php echo $user['password']?></td>

                                <?php if($user['role']==1){?>
                                <td>Admin</td>
                                <?php }else if($user['role']==2){?>
                                    <td>Professor</td>
                                <?php }else {?>
                                <td>user</td>
                                <?php }?>
                                <td><?php echo $user['created_at']?></td>
                            </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
<?php include "../../blocks/footer.php"?>
        <script src="/assets/extra-libs/DataTables/datatables.min.js"></script>
<script>
    $('#zero_config').DataTable();

</script>
    </div>
</div>

</body>

</html>