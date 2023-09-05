<?php
session_start();
if((isset($_SESSION['login']) && ($_SESSION['login']))){
    if($_SESSION['role']!=1)
        echo "<script>window.location.href='/public'</script>";
}else {
    echo "<script>window.location.href='/'</script>";
    exit();

}

?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <?php $page_name="Add users"; include "../../../blocks/main_head.php";?>
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
                            <input type="hidden" name="function" value="users:create:">
                            <div class="card-body">
                                <h4 class="card-title">Info</h4>
                                <div class="form-group row">
                                    <label for="name" class="col-md-3 m-t-15">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Name Here">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="university_number" class="col-md-3 m-t-15">University Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="university_number" id="university_number" placeholder="University Number">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-md-3 m-t-15">Password</label>
                                    <div style="display: flex" class="col-sm-9">
                                        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                                        <i id="view_password" style="cursor:pointer;font-size: 20px" class="fas fa-eye"></i>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 m-t-15">Role</label>
                                    <div class="col-md-9">
                                        <select class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                            <option disabled selected>Selected</option>
                                            <option value="0">Admin</option>
                                            <option  value="1">User</option>
                                            <option  value="2">Professor</option>
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
            let validate=false;
            document.querySelector('#password').addEventListener('click',()=>{
                if(validate){
                    document.querySelector('#password').type='text'
                    document.querySelector('#view_password').className='fas fa-eye-slash'
                }else {
                    document.querySelector('#view_password').className='fas fa-eye'
                    document.querySelector('#password').type='password'
                }
                validate=!validate
            })
        </script>

    </div>
</div>

</body>

</html>