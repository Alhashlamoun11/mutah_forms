<?php


require '../core/DbQuery.php';

$dbOperations = new DatabaseOperations();



$tableName = 'users';
$u_n=$_POST['university_number'];
$pass=($_POST['password']);
$conditions = array(
    "university_number = '$u_n'",
    "password = '$pass'",
);

$result = $dbOperations->select($tableName,[],$conditions,[]);

//var_dump(isset($result[0])&&!empty($result[0]));
//die();
    if(isset($result[0])&&!empty($result[0])){
        $result=$result[0];
        if(!$result['status']){
             header('location: /?msg='.base64_encode("Your account is blocked"));
             exit();
        }
        session_start();
        $_SESSION['id']=$result['id'];
        $_SESSION['role']=$result['role'];
        $_SESSION['username']=$result['name'];
        $_SESSION['email']=$result['email'];
        $_SESSION['email']=$result['email'];
        $_SESSION['login']=true;
        $_SESSION['university_number']=$result['university_number'];
        if($result['role']==1){
             header('location: /admin/dashboard');
            exit();

        }else{
             header('location: /public');
            exit();

        }
    }else{
         header('location: /?msg='.base64_encode("Invalid university number or password"));
        exit();


    }
