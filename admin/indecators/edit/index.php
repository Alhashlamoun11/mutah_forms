<?php

session_start();
if((isset($_SESSION['login']) && ($_SESSION['login']))){
    if($_SESSION['role']!=1)
        echo "<script>window.location.href='/public'</script>";
}else {
    echo "<script>window.location.href='/'</script>";
    exit();

}

$table='indecators';
$conditions=[];
$columns=[];

require_once '../../../core/DbQuery.php';
$dbOperations = new DatabaseOperations();

$forms=$dbOperations->select('forms');
$indicator=$dbOperations->select($table,[],['id='.$_GET['id']])[0];
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="/assets/libs/select2/dist/css/select2.min.css">

    <?php
    $page_name="Indicators";
    include "../../../blocks/main_head.php";?>
</head>

<body>
<?php include "../../../blocks/preloader.php" ?>
<div id="main-wrapper">
    <?php include('../../../blocks/header.php') ?>
    <div class="page-wrapper">

        <?php include "../../../blocks/bread_camp.php" ?>

        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card">
                    <form class="form-horizontal" action="/backend/forms_route.php" method="post">
                        <input type="hidden" name="function" value="indecators:update:">
                        <input type="hidden" name="id" value="<?php echo $indicator['id']?>">

                        <div class="card-body">
                            <h4 class="card-title">Info</h4>
                            <div class="form-group row">
                                <label for="title" class="col-md-3 m-t-15">Title</label>
                                <div class="col-sm-9">
                                    <input required value="<?php echo $indicator['title']?>" type="text" class="form-control" name="title" id="title" placeholder="Title Here">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 m-t-15">Status</label>
                                <div class="col-md-9">
                                    <select class="select2 form-control m-t-15" name="status" style="height: 36px;width: 100%;">
                                        <option value="1" <?php echo $indicator['status']==1?'selected':''?>>Active</option>
                                        <option value="0" <?php echo $indicator['status']==0?'selected':''?>>Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 m-t-15">Form</label>
                                <div class="col-md-9">
                                    <select class="select2 form-control m-t-15" name="form_id" style="height: 36px;width: 100%;">
                                        <option disabled selected> select</option>
                                        <?php foreach ($forms as $form){?>
                                            <option <?php echo $indicator['form_id']==$form['id']?'selected':''?> value="<?php echo $form['id']?>"><?php echo $form['title']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <?php include "../../../blocks/footer.php" ?>
        <script src="/assets/libs/select2/dist/js/select2.full.min.js"></script>
        <script src="/assets/libs/select2/dist/js/select2.min.js"></script>

        <script>
            $(".select2").select2();

            function getUsers(e){
                console.log(e.value);
                let users=document.getElementById('users');

                if(e.value==2){
                    users.style.display='flex';
                }else{
                    users.style.display='none';
                    users.value=[];
                }
                console.log(users.value)
            }
        </script>
    </div>
</div>

</body>

</html>