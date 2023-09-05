<?php
// Load the database configuration file
include_once '../../core/DbQuery.php';
$dbOperations=new DatabaseOperations();

// Filter the excel data
function filterData(&$str){
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}


// Column names
$fields = array("#",'Id', 'Indicator', 'Question', 'Answer', 'This Year', 'Last Year', 'Total Percentage','Files', 'CREATED AT');

// Display column names as first row
$excelData = implode("\t", array_values($fields)) . "\n";

$result_type='form';
$cond=[
    'form_id='.$_GET['id']
];
if(isset($_GET['uid'])){
    $cond[] = 'user_id='.$_GET['uid'];
    $result_type='user';

}
//var_dump($cond);
//die();
// Fetch records from database
$query = $dbOperations->select('answers A',[
    'A.id aid','A.answer','A.created_at','A.user_id as user_id','files',
    'Q.id as qid','Q.question',
    'I.id as iid','I.title as indicator',
    'F.id as fid','F.title as title',
    'U.id as uid','U.name as name'
],
    $cond
    ,[
        'join questions Q on(Q.id=A.question_id)',
        'join indecators I on(I.id=Q.indecator_id)',
        'join forms F on(F.id=I.form_id)',
        'join users U on(U.id=A.user_id)'
    ],' ORDER BY A.id ASC');

if(count($query) > 0){
    // Excel file name for download
    $fileName = $result_type=='user'?$query[0]['name']."/".$query[0]['title'] . ".xls":date('Y-m-d')."/".$query[0]['title'] . ".xls";

    // Output each row of the data
    foreach($query as $key=>$row){
//        $status = ($row['status'] == 1)?'Active':'Inactive';
        $answers=json_decode($row['answer']);

        $files=json_decode($row['files']);
        $files=implode(',',$files);

        if(!is_string($answers)&&!is_null($answers)){
            $lineData = array($key+1, $row['aid'], $row['indicator'], $row['question'], "-----", $answers[0],$answers[1],$answers[2], $files, $row['created_at']);

        }else{
            $answers=$row['answer'];
            $lineData = array($key+1, $row['aid'], $row['indicator'], $row['question'], $answers,"-----","-----","-----", $files, $row['created_at']);

        }
        array_walk($lineData, 'filterData');
        $excelData .= implode("\t", array_values($lineData)) . "\n";
    }
}else{
    $excelData .= 'No records found...'. "\n";
}

// Headers for download
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$fileName\"");

// Render excel data
echo $excelData;

exit;
