<?php
session_start();
if((isset($_SESSION['login']) && ($_SESSION['login']))){
    if($_SESSION['role']!=1)
        echo "<script>window.location.href='/public'</script>";
}else {
    echo "<script>window.location.href='/'</script>";
    exit();

}

require_once '../core/DbQuery.php';
$dbConnection = new DatabaseOperations();

$equation=$dbConnection->select("setting")[0];

?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <?php $page_name="Dashboard"; include "../blocks/main_head.php";?>
</head>

<body>
<?php include "../blocks/preloader.php"?>
<div id="main-wrapper">
<?php include('../blocks/header.php')?>
    <div class="page-wrapper">

        <?php  include "../blocks/bread_camp.php"?>

        <div class="container-fluid">
            <div class="card" style="max-width: 500px">
                <form method="post" action="/backend/functions.php?call=save_equation" class="form-horizontal">
                    <div class="card-body">
                        <input type="hidden" name="id" value="<?php echo $equation['id']?>">
                        <h4 class="card-title">Equation</h4>
                        <div class="form-group row">
                            <label for="equation" class="col-md-3 m-t-15">Equation</label>
                            <div class="col-sm-9">
                                <input value="<?php echo $equation['equation']?>"  type="text" class="form-control" name="equation" id="equation" placeholder="Add Equation Here">
                                <button type="submit" style="border: none " class="btn-success">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
<?php include "../blocks/footer.php"?>
        <script src="/assets/extra-libs/DataTables/datatables.min.js"></script>
        <script>
            $('#zero_config').DataTable();

        </script>
    </div>
</div>

</body>

</html>