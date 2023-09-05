<?php
session_start();
if((isset($_SESSION['login']) && ($_SESSION['login']))){
    if($_SESSION['role']!=1)
        echo "<script>window.location.href='/public'</script>";
}else {
    echo "<script>window.location.href='/'</script>";
    exit();

}

$table='answers';
$conditions=[];
$columns=[];

require_once '../../../core/DbQuery.php';
$dbOperations = new DatabaseOperations();
$data=$dbOperations->select('answers A',[
    'A.id aid','A.files',
    'Q.id as qid',
    'I.id as iid',
    'F.id as fid',
    'U.id as uid','U.name',
],['A.id='.$_GET['id']],[
    'join questions Q on(Q.id=A.question_id)',
    'join indecators I on(I.id=Q.indecator_id)',
    'join forms F on(F.id=I.form_id)',
    'join users U on(U.id=A.user_id)'
]);

if($data){
    $files=$data[0];
    $files=json_decode($files['files']);
}else{
    var_dump($data);
    die();
}
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <?php $page_name="Files"; include "../../../blocks/main_head.php";?>
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
                        <h5 class="card-title"><?php echo $data[0]['name']?> Result</h5>
                        <a href="/admin/export?id=<?php echo $data[0]['fid']?>&uid=<?php echo $data[0]['uid']?>" class="btn-success btn-block" style="text-align:center;border: none; border-radius: 5px;width: 100px;">Export</a>

                    </div>
                    <?php foreach ($files as $key=>$file){?>
                        <h3><a href="<?php echo $file?>" download><?php echo $file?></a></h3>
                    <?php }?>
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