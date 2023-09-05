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

require_once '../../../core/DbQuery.php';
$dbOperations = new DatabaseOperations();

$users=$dbOperations->select($table,[],['role!=1']);
$indecators=$dbOperations->select('indecators');
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="/assets/libs/select2/dist/css/select2.min.css">

    <?php
    $page_name="Questions";
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
                        <input type="hidden" name="function" value="questions:create:users_role_questions">
                        <div class="card-body">
                            <h4 class="card-title">Info</h4>
                            <div class="form-group row">
                                <label for="question" class="col-md-3 m-t-15">Title</label>
                                <div class="col-sm-9">
                                    <input required type="text" class="form-control" name="question" id="question" placeholder="Question Here">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 m-t-15">Type</label>
                                <div class="col-md-9">
                                    <select name="type" required class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                        <option disabled selected > select</option>
                                        <option value="0">Text/Number</option>
                                        <option value="1">Precedent</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 m-t-15">Role</label>
                                <div class="col-md-9">
                                    <select name="role" required onchange="getUsers(this)" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                        <option disabled selected > select</option>
                                        <option value="0">Public</option>
                                        <option value="1">Professors</option>
                                        <option value="2">Custom</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 m-t-15">Indicators</label>
                                <div class="col-md-9">
                                    <select  class="select2 form-control m-t-15" name="indecator_id" style="height: 36px;width: 100%;">
                                        <option disabled selected> select</option>
                                        <?php foreach ($indecators as $indecator){?>
                                            <option  value="<?php echo $indecator['id']?>"><?php echo $indecator['title']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>

                            <div id="users" style="display:none" class="form-group row">
                                <label class="col-md-3 m-t-15">Users</label>
                                <div class="col-md-9">
                                    <select id="users_array[]" class="select2 form-control m-t-15" multiple="multiple" name="users[]" style="height: 36px;width: 100%;">
                                        <option disabled > select</option>
                                        <?php foreach ($users as $user){?>
                                            <option  value="<?php echo $user['id']?>"><?php echo $user['name']?></option>
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