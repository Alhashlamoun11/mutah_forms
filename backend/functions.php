<?php


function users_role_forms($users){
    global $dbOperations;

    if($users[2]==null){
        $form_id=$users[1]+1;
    }else{
        $form_id=$users[2];
        $dbOperations->delete('users_role_forms',['form_id='.$form_id]);
    }
    foreach ($users[0] as $user){
        $data=[
            'user_id'=>$user,
            'form_id'=>$form_id
        ];
        $dbOperations->insert('users_role_forms',$data);
    }
}


function users_role_questions($users){
//    echo"<pre>";
//    var_dump($users);
//    die();
    global $dbOperations;
    if($users[2]==null){
        $question_id=$users[1]+1;
    }else{
        $question_id=$users[2];
        $dbOperations->delete('users_role_questions',['question_id='.$question_id]);
    }
    foreach ($users[0] as $user){
        $data=[
            'user_id'=>$user,
            'question_id'=>$question_id
        ];

        $dbOperations->insert('users_role_questions',$data);
    }
}

//this function is convert between form and question auth
function auth_form_question($id,$role,$type)
{

    global $dbConnection;
    if($role==2){
        $ids_array=[];
        $table=$type=='forms'?"users_role_forms":"users_role_questions";
        $condition=$type=='forms'?"form_id=".$id:"question_id=".$id;
        $ids=$dbConnection->select($table,
            [],
            [
                $condition
            ]);
        foreach ($ids as $id){
            $ids_array[]=$id['user_id'];
        }
        return in_array($_SESSION['id'],$ids_array);
    }else if ($role==1){
        return $_SESSION['role']==2;
    }
    return true;
}

function uploadFile($fileName ,$tempName ): string
{

    $folder='../uploads/';
    $traget_name=$folder.rand(11111111,99999999).$fileName;
    if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
    }
    move_uploaded_file($tempName, $traget_name);
    return explode('..',$traget_name)[1];
}
function handleAnswers(){
    session_start();
    include "../core/DbQuery.php";

    $dbConnection=new DatabaseOperations();
    $user_id=$_SESSION['id'];
    $form_id=$_POST['form_id'];
    unset($_POST['form_id']);
    foreach ($_POST as $key=>$answer) {
        $post = explode('_', $key);
        $question_id = $post[1];
        $data = [
            'question_id' => $question_id,
            'user_id' => $user_id,
            'answer' => $answer,
            'files' => "{}"
        ];
        $dbConnection->insert('answers', $data);
    }
    $dbConnection->insert('answer_checker', ['form_id'=>$form_id,'user_id'=>$user_id]);

    $temp=[];
        foreach ($_FILES as $key=>$file){
            $files_Array=[];
            $question_id=explode('_',$key)[1];
            $fileCount = count($file['name']);

            for ($i = 0; $i < $fileCount; $i++) {
                $files_Array[] = uploadFile($file['name'][$i], $file['tmp_name'][$i]);
            }
            $temp[]=[
              'file'=>$files_Array,
              'id'=>  $question_id,
                'key'=>$key,
                'user_id'=>$user_id
            ];
            $files=json_encode($files_Array);
//            $dbConnection->getConnection()->query("update answers set files='".$files."' where question_id='$question_id' and user_id='$user_id'");
            $dbConnection->update('answers',[
                'files'=>$files],[
                'question_id='.$question_id,
                ' user_id='.$user_id]);
            $files_Array=[];

        }
//        echo"<pre>";
        return print_r(json_encode(['msg'=>'success']));
//        echo"|||||||||||";
//    die();

//        print_r($answer);
//    }

}
function save_equation(){
    $request=$_POST;
//    session_start();
    include "../core/DbQuery.php";
    $dbConnection=new DatabaseOperations();
    $data=['equation'=>$request['equation']];
$result=$dbConnection->update('setting',$data,['id='.$request['id']]);
echo "<script>window.location.href='/admin/'</script>";
}
if(isset($_GET['call']) && $_GET['call']!=null){
//    echo"<pre>";
//    var_dump($_POST);
//    echo"######################";

//    var_dump($_FILES);
//    die();
    if (function_exists($_GET['call'])) {
        call_user_func($_GET['call']);
    } else {
        die("Function not found.");
    }

}


