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

$forms=$dbOperations->select($table);
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
                        <input type="hidden" name="function" value="indecators:create:">
                        <div class="card-body">
                            <h4 class="card-title">Info</h4>
                            <div class="form-group row">
                                <label for="title" class="col-md-3 m-t-15">Title</label>
                                <div class="col-sm-9">
                                    <input required type="text" class="form-control" name="title" id="title" placeholder="Title Here">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 m-t-15">Form</label>
                                <div class="col-md-9">
                                    <select class="select2 form-control m-t-15" name="form_id" style="height: 36px;width: 100%;">
                                        <option disabled selected> select</option>
                                        <?php foreach ($forms as $form){?>
                                            <option  value="<?php echo $form['id']?>"><?php echo $form['title']?></option>
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