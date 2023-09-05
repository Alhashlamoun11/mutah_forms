<?php

require '../core/DbQuery.php';

$dbOperations = new DatabaseOperations();

include 'functions.php';

if (isset($_POST['function'])) {
$function=explode(':',$_POST['function']);
$table=$function[0];
$operation=$function[1];
    $addition=$function[2];
    $update_id= $function[3] ?? null;
$result='';

switch ($table){
    case 'forms'||'questions':
    {
        //        echo"<pre>";
//        var_dump($question_array);
//        die();

        $users=$_POST['users']??[];
        if (isset($addition) && $addition != '') {
            $results = $dbOperations->select($table, ['max(id)'], [], [], ' ORDER BY id desc limit 1');
            if (function_exists($addition)) {
                call_user_func($addition,
                    [$users,
                        $results[0]['max(id)'],
                        $update_id
                ]);
            } else {
                die("Function not found.");
            }
        }
        if(!empty($users))unset($_POST['users']);

        break;
    }
        }

unset($_POST['function']);

switch ($operation){
    case 'create':
        $result=$dbOperations->insert($table,$_POST);
        break;
    case 'update':
        $id=$_POST['id'];
        unset($_POST['id']);
        $result=$dbOperations->update($table,$_POST,['id='.$id]);
        break;
    default:
         return (json_encode(['error'=>true,'success'=>false,'message'=>$result]));

}

}
echo "<script>window.location.href='/admin/$table';</script>";
