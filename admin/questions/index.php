<?php
session_start();
if((isset($_SESSION['login']) && ($_SESSION['login']))){
    if($_SESSION['role']!=1)
        echo "<script>window.location.href='/public'</script>";
}else {
    echo "<script>window.location.href='/'</script>";
    exit();

}

$table='questions Q';
$conditions=[];
$columns=[];

require_once '../../core/DbQuery.php';
$dbOperations = new DatabaseOperations();

$indecators=$dbOperations->select($table,[
        'I.id',
    'I.title as Ititle',
    'I.form_id as form_id',
    'F.id as fid',
    'F.title as Ftitle',
    'Q.created_at',
    'Q.id as Qid',
    'Q.question',
    'Q.role',
    'Q.type',
    'Q.indecator_id'
],[],['join indecators I on(I.id=Q.indecator_id)',
    'join forms F on(F.id=I.form_id)']);

?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <?php $page_name="Add question"; include "../../blocks/main_head.php";?>
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
                    <h5 class="card-title">Basic Datatable</h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Question</th>
                                <th>Type</th>
                                <th>Indicator</th>
                                <th>Form</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($indecators as $indecator){?>
                            <tr>
                                <td><a href="/admin/questions/edit?id=<?php echo $indecator['Qid']?>"><?php echo $indecator['Qid']?></a></td>
                                <td><a href="/admin/questions/edit?id=<?php echo $indecator['Qid']?>"><?php echo $indecator['question']?></a></td>
                                <?php if($indecator['type']==0) {?>
                                    <td>Text/Number</td>
                                <?php } else {?>
                                    <td>Percentage</td>
                                <?php }?>
                                <td><?php echo $indecator['Ititle']?></td>
                                <td><?php echo $indecator['Ftitle']?></td>
                                <td><?php echo $indecator['created_at']?></td>
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