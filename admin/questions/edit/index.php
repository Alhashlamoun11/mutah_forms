<?php
session_start();
if((isset($_SESSION['login']) && ($_SESSION['login']))){
    if($_SESSION['role']!=1)
        echo "<script>window.location.href='/public'</script>";
}else {
    echo "<script>window.location.href='/'</script>";
    exit();

}

$table='questions';
$conditions=[];
$columns=[];

require_once '../../../core/DbQuery.php';
$dbOperations = new DatabaseOperations();

$users=$dbOperations->select('users',[],['role!=1']);
$indecators=$dbOperations->select('indecators');
$question=$dbOperations->select($table,[],['id='.$_GET['id']])[0];

$users_ids=$dbOperations->select('users_role_questions',[],['question_id='.$_GET['id']]);
$ids_array=[];
foreach ($users_ids as $id){
    $ids_array[]=$id['user_id'];
}

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
                        <input type="hidden" name="function" value="questions:update:users_role_questions:<?php echo $question['id']?>">
                        <input type="hidden" name="id" value="<?php echo $question['id']?>">

                        <div class="card-body">
                            <h4 class="card-title">Info</h4>
                            <div class="form-group row">
                                <label for="question" class="col-md-3 m-t-15">Title</label>
                                <div class="col-sm-9">
                                    <input  value="<?php echo $question['question']?>" required type="text" class="form-control" name="question" id="question" placeholder="Question Here">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 m-t-15">Type</label>
                                <div class="col-md-9">
                                    <select name="type" required class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                        <option disabled  > select</option>
                                        <option <?php echo $question['type']==0?"selected":'' ?> value="0">Text/Number</option>
                                        <option <?php echo $question['type']==1?"selected":'' ?> value="1">Precedent</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 m-t-15">Role</label>
                                <div class="col-md-9">
                                    <select name="role" required onchange="getUsers(this)" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                        <option disabled selected > select</option>
                                        <option <?php echo $question['role']==0?"selected":''?> value="0">Public</option>
                                        <option <?php echo $question['role']==1?"selected":''?> value="1">Professors</option>
                                        <option <?php echo $question['role']==2?"selected":''?> value="2">Custom</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 m-t-15">Indicators</label>
                                <div class="col-md-9">
                                    <select  class="select2 form-control m-t-15" name="indecator_id" style="height: 36px;width: 100%;">
                                        <option disabled > select</option>
                                        <?php foreach ($indecators as $indecator){?>
                                            <option <?php echo $question['indecator_id']==$indecator['id']?"selected":''?> value="<?php echo $indecator['id']?>"><?php echo $indecator['title']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 m-t-15">Status</label>
                                <div class="col-md-9">
                                    <select class="select2 form-control m-t-15" name="status" style="height: 36px;width: 100%;">
                                        <option value="1" <?php echo $question['status']==1?'selected':''?>>Active</option>
                                        <option value="0" <?php echo $question['status']==0?'selected':''?>>Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div id="users" style="display:<?php echo $question['role']==2?"flex":'none'?>" class="form-group row">
                                <label class="col-md-3 m-t-15">Users</label>
                                <div class="col-md-9">
                                    <select id="users_array[]" class="select2 form-control m-t-15" multiple="multiple" name="users[]" style="height: 36px;width: 100%;">
                                        <option disabled value="0"> select</option>
                                        <?php foreach ($users as $user){?>
                                            <option <?php echo in_array($user['id'],$ids_array)?'selected':''?>  value="<?php echo $user['id']?>"><?php echo $user['name']?></option>
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