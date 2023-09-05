<?php

session_start();
if((isset($_SESSION['login']) && ($_SESSION['login']))){
    if($_SESSION['role']!=1)
        echo "<script>window.location.href='/public'</script>";
}else {
    echo "<script>window.location.href='/'</script>";
    exit();

}
$table='forms';
$conditions=[];
$columns=[];

require_once '../../core/DbQuery.php';
$dbOperations = new DatabaseOperations();

$forms=$dbOperations->select($table);

?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <?php $page_name="Form Result"; include "../../blocks/main_head.php";?>
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
                    <div style="display: flex;justify-content: space-between;margin: 10px">
                        <h5 class="card-title">Results</h5>
                    </div>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Role</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($forms as $form){?>
                            <tr>
                                <td><a href="/admin/results/formresult?id=<?php echo $form['id']?>"><?php echo $form['id']?></a></td>
                                <td><a href="/admin/results/formresult?id=<?php echo $form['id']?>"><?php echo $form['title']?></a></td>
                                <?php if($form['role']==0){?>
                                <td>Public</td>
                                <?php } else if($form['role']==1){?>
                                <td>Professors</td>
                                <?php }else {?>
                                    <td>Custom</td>
                                <?php }?>
                                <td><?php echo $form['created_at']?></td>
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