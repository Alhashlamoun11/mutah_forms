<?php
session_start();
if((isset($_SESSION['login']) && ($_SESSION['login']))){
    if($_SESSION['role']!=1)
        echo "<script>window.location.href='/public'</script>";

}else {
    echo "<script>window.location.href='/'</script>";
    exit();

}
include "../../../core/DbQuery.php";
$dbOperation=new DatabaseOperations();

$user=$dbOperation->select('users',[],['id='.$_GET['id']]);
if($user){
    $user=$user[0];

}

?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <?php $page_name=$user['name']; include "../../../blocks/main_head.php";?>
</head>

<body>
<?php include "../../../blocks/preloader.php" ?>
<div id="main-wrapper">
<?php include('../../../blocks/header.php') ?>
    <div class="page-wrapper">

        <?php include "../../../blocks/bread_camp.php" ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <form class="form-horizontal" action="/backend/forms_route.php" method="post">
                            <input type="hidden" name="function" value="users:update:">
                            <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
                            <div class="card-body">
                                <h4 class="card-title">Info</h4>
                                <div class="form-group row">
                                    <label for="name" class="col-md-3 m-t-15">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo $user['name']?>" class="form-control" name="name" id="name" placeholder="Name Here">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="university_number" class="col-md-3 m-t-15">University Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly value="<?php echo $user['university_number']?>" class="form-control" name="university_number" id="university_number" placeholder="University Number">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-md-3 m-t-15">Password</label>
                                    <div style="display: flex" class="col-sm-9">
                                        <input type="password" value="<?php echo $user['password']?>" name="password" class="form-control" id="password" placeholder="Password">
                                        <span id="view_password" style="text-align: center;margin:10px 2px"><i  style="font-size: 20px" class="fas fa-eye"></i>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 m-t-15">Status</label>
                                    <div class="col-md-9">
                                        <select name="status" class="select2 form-control m-t-15"  style="height: 36px;width: 100%;">
                                            <option value="1" <?php echo $user['status']==1?'selected':''?>>Active</option>
                                            <option value="0" <?php echo $user['status']==0?'selected':''?>>Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 m-t-15">Role</label>
                                    <div class="col-md-9">
                                        <select name="role" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                <option value="0" <?php echo $user['role']==0?'selected':''?>>Admin</option>
                                            <option value="1" <?php echo $user['status']==1?'selected':''?>>User</option>
                                            <option value="1" <?php echo $user['status']==2?'selected':''?>>Professor</option>
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

        </div>
<?php include "../../../blocks/footer.php" ?>
        <script>
            let validate=true;
            document.querySelector('#view_password').addEventListener('click',()=>{
                if(validate){
                    document.querySelector('#password').type='text'
                    document.querySelector('#view_password i').className='fas fa-eye-slash'
                }else {
                    document.querySelector('#view_password i').className='fas fa-eye'
                    document.querySelector('#password').type='password'
                }
                validate=!validate
            })
        </script>
    </div>
</div>

</body>

</html>