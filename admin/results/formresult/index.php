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

require_once '../../../core/DbQuery.php';
$dbOperations = new DatabaseOperations();

$answers=$dbOperations->select('answers A',[
        'A.id aid','A.answer','A.created_at','A.user_id as user_id',
    'Q.id as qid','Q.question',
    'I.id as iid',
    'F.id as fid','F.title',
    'U.id as uid','U.name'
],['F.id='.$_GET['id']],[
        'join questions Q on(Q.id=A.question_id)',
    'join indecators I on(I.id=Q.indecator_id)',
    'join forms F on(F.id=I.form_id)',
    'join users U on(U.id=A.user_id)'
]);
//print_r(json_decode($answers[0]['answer']));
//die();
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <?php $page_name="Forms Result"; include "../../../blocks/main_head.php";?>
</head>

<body>
<?php include "../../../blocks/preloader.php"?>
<div id="main-wrapper">
<?php include('../../../blocks/header.php')?>
    <div class="page-wrapper">

        <?php  include "../../../blocks/bread_camp.php"?>

        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div style="display: flex;justify-content: space-between;margin: 10px">
                        <h5 class="card-title">Form Result</h5>
                        <a href="/admin/export?id=<?php echo $_GET['id']?>" class="btn-success btn-block" style="text-align:center;border: none; border-radius: 5px;width: 100px;">Export</a>

                    </div>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered responsive">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Id</th>
                                <th>User</th>
                                <th>question</th>
                                <th>Answer</th>
                                <th>This year</th>
                                <th>Last year</th>
                                <th>All</th>
                                <th>Files</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($answers as $key=>$answer){?>
                            <tr>
                                <th><?php echo $key+1 ?></th>

                                <td><?php echo $answer['aid']?></td>
                                <td style="width: 100px"><?php echo $answer['name']?></td>
                                <td style="width: 100px"><?php echo $answer['question']?></td>
                                <?php
                                $answers_user=json_decode(($answer['answer']));
                                if($answers_user!=null && !is_numeric($answers_user) && count($answers_user)>1){?>
                                    <td>-</td>
                                    <td><?php echo $answers_user[0]?></td>
                                    <td><?php echo $answers_user[1]?></td>
                                    <td><?php echo $answers_user[2]?></td>

                                <?php }else{?>
                                <td style="width: 100px"><?php echo $answer['answer']?></td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>

                                <?php }?>
                                <td>
                                    <a href="/admin/results/files?id=<?php echo $answer['aid']?>">Files</a>
                                </td>
                                <td><?php echo $answer['created_at']?></td>
                            </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
<?php include "../../../blocks/footer.php"?>
        <script src="/assets/extra-libs/DataTables/datatables.min.js"></script>
<script>
    $('#zero_config').DataTable();

</script>
    </div>
</div>

</body>

</html>