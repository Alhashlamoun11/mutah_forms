<?php
session_start();
if(!(isset($_SESSION['login']) || !($_SESSION['login']))){
    echo "<script>window.location.href='/'</script>";
    exit();
}

include "../../core/DbQuery.php";

$dbConnection=new DatabaseOperations();

$id=$_GET['id'];

$answer_checker=$dbConnection->select("answer_checker",[],['user_id='.$_SESSION['id'],'form_id='.$id]);

if(!empty($answer_checker[0])){
    echo "<script>window.location.href='/public/answered'</script>";
}

include "../../backend/functions.php";

$form=null;
$equation=$dbConnection->select("setting")[0];
$data=[];
$question_array=[];
$form=$dbConnection->select("forms",[],['forms.id='.$id]);
if($form){
    $form=$form[0];
if(auth_form_question($id,$form['role'],'forms')){
        $indicators=$dbConnection->select("indecators",[],['status=1','form_id='.$id]);
        foreach ($indicators as $indicator){
            $questions=$dbConnection->select("questions",[],['status=1','indecator_id='.$indicator['id']]);
            $question_array=[];
            foreach ($questions as $question){
                if(auth_form_question($id,$question['role'],'question')){
                    $question_array[]=$question;
                }
            }
            $data[]=[
                'title'=>$indicator['title'],
                'questions'=>$question_array
            ];

        }
    }
}else{
    $form=null;
}

?>

<!DOCTYPE html>
<html dir="rtl" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Form</title>
    <!-- Custom CSS -->
    <link href="/assets/libs/jquery-steps/jquery.steps.css" rel="stylesheet">
    <link href="/assets/libs/jquery-steps/steps.css" rel="stylesheet">
    <link href="/dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        body {
            background-image: url('/assets/images/background/mu8.png');
            background-size: cover;
        }

        .container {
            margin: 0 auto;
            margin-top: 100px;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .btn-submit {
            width: 100%;
        }

        .academy-logo {
            width: 100px;
            height: 100px;
            border-radius: 10%;
            margin-bottom: 20px;
        }
        .answer_typ_precent{
            display: flex;
        }
        .answer_typ_precent input{
            width: auto;
            margin: 16px;
        }
        @media only screen
        and (max-device-width: 600px){
            .answer_typ_precent{
                display: flex;
                flex-direction: column;
            }
        }
        /* Modal content container */
        .modal-content {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100px;
        }

        /* Circular spinner animation */
        .spinner {
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top: 4px solid #3498db;
            width: 40px;
            height: 40px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

    </style>

</head>
<body>

<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div class="container">
    <div class="card">
        <div class="card-body wizard-content">
            <img src="/assets/images/MutahLogo.png" alt="Academy Logo" class="academy-logo">
            <?php if(!$form['status']){?>
                <h4 align="center">انتهت صلاحية النموذج </h4>
                <?php exit();}?>

            <?php if(!is_null($form) && !empty($data)){?>
            <h1><?php echo $form['title']?></h1>
            <form dir="rtl" id="example-form" action="#" method="post" class="m-t-40">
                <input type="hidden" name="form_id" value="<?php echo $id?>">
                <div>
                    <?php foreach ($data as $datum){?>
                        <h3><?php echo $datum['title']?></h3>
                        <section ">
                        <?php foreach ($datum['questions'] as $question){?>
                            <div align="right" style="text-align: right;margin:10px 0" >
                                <label for="Q_<?php echo $question['id']?>"><?php echo $question['question']?> *</label>
                                <?php if($question['type']==0){?>
                                    <input placeholder="answer" id="Q_<?php echo $question['id']?>" name="answer_<?php echo $question['id']?>" type="text" class="required form-control">
                                <?php } else{?>
                                    <div class="answer_typ_precent">
                                        <input id="final_answer" type="hidden" name="answer_<?php echo $question['id'];?>">
                                        <label for="p1">النسبة لسنة الاصدار *</label>
                                        <input placeholder="answer" id="p1" type="number" class="required form-control">
                                        <label  for="p2">النسبة للسنة فبل الاصدار *</label>
                                        <input placeholder="answer" id="p2" type="number" class="required form-control">
                                        <label for="p3">النسبة الكلية* </label>
                                        <input placeholder="answer" onclick="calc(this)" style="background: #ffffffa6" id="result_precenteg" type="text" readonly class="required form-control">
                                    </div>
                                <?php }?>
                                <input id="p2" multiple name="file_<?php echo $question['id']?>[]" type="file" class="form-control">
                            </div>
                        <?php }?>
                        <p>(*) Mandatory</p>
                        </section>
                        <?php }?>
                    <h3>Finish</h3>
                    <section >
                        <input id="acceptTerms" type="checkbox" class="required">
                        <label for="acceptTerms">I agree with the Terms and Conditions.</label>
                    </section>
                </div>
            </form>
            <?php }else{?>
                <h4 align="center">لا يوجد بيانات </h4>
            <?php }?>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="/assets/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="/assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="/assets/extra-libs/sparkline/sparkline.js"></script>
<!--Wave Effects -->
<script src="/dist/js/waves.js"></script>
<!--Menu sidebar -->
<script src="/dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="/dist/js/custom.min.js"></script>
<!-- this page js -->
<script src="/assets/libs/jquery-steps/build/jquery.steps.min.js"></script>
<script src="/assets/libs/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.js"></script>

<script>
    // Basic Example with form
    var form = $("#example-form");
    form.validate({
        errorPlacement: function errorPlacement(error, element) { element.before(error); },
        rules: {
            confirm: {
                equalTo: "#password"
            }
        }
    });
    form.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        onStepChanging: function(event, currentIndex, newIndex) {
            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        },
        onFinishing: function(event, currentIndex) {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function(event, currentIndex) {
            var formData = new FormData(form[0]);
            console.log('test')

            Swal.fire({
                title: 'Loading...',
                html: '<div class="modal-content"><div class="spinner"></div></div>',
                showCancelButton: false,
                showConfirmButton: false,
                allowOutsideClick: false,
                didOpen: function() {
                    console.log('asdasodkaposk')
                    setTimeout(()=>{
                        $.ajax({
                            url: '/backend/functions.php?call=handleAnswers', // Replace with your server-side script URL
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                // Handle the response from the server
                                let res=JSON.parse(response);
                                if(res.msg=='success'){
                                    Swal.close();
                                    Swal.fire({
                                        icon: 'success',
                                    });
                                    window.location.href="/public/success";
                                }else{
                                    Swal.close();
                                    Swal.fire({
                                        icon: 'info',
                                        title: 'يرجى التحقق من جميع الاجابات',
                                        // text: JSON.stringify(data, null, 2),
                                    });

                                }

                            },
                            error: function(xhr, textStatus, errorThrown) {
                                // Handle any errors that occur during the AJAX request
                                Swal.close();
                                Swal.fire({
                                    icon: 'error',
                                    title: 'يرجى المحاولة في وقت اخر',
                                    // text: JSON.stringify(data, null, 2),
                                });

                                console.error('Error: ' + errorThrown);
                            }
                        });

                    },2000)

                    // Swal.showLoading();
                }})

            // alert("Submitted!");
        }
    });


</script>
<script>
    function evaluateEquationWithTwoVariables(equationString, variable1, variable2) {
        // Sanitize the input (for this example, we will only allow basic operators, numbers, and letters for variables)
        const sanitizedString = equationString.replace(/[^0-9+\-/*a-zA-Z\s]/g, '');

        // Replace the variables in the equation string
        const replacedString = sanitizedString.replace(/x/g, variable1).replace(/y/g, variable2);

        // Parse and evaluate the expression step by step
        const expression = replacedString.split(/([\+\-\*\/])/).map((item) => item.trim());
        let result = parseFloat(expression[0]);

        for (let i = 1; i < expression.length; i += 2) {
            const operator = expression[i];
            const operand = parseFloat(expression[i + 1]);

            if (operator === '+') {
                result += operand;
            } else if (operator === '-') {
                result -= operand;
            } else if (operator === '*') {
                result *= operand;
            } else if (operator === '/') {
                result /= operand;
            }
        }

        return result;
    }


</script>
<script>
    function calc(e){
        let event=e.parentElement;
        const equationString = "<?php echo $equation['equation']?>";
        let p1=event.querySelector('#p1');
        let p2=event.querySelector('#p2');
let final_answer=event.querySelector('#final_answer');
if(p2.value!='' && p1.value!=''){
    e.value=parseInt(evaluateEquationWithTwoVariables(equationString,p1.value,p2.value))+' %';
    final_answer.value=JSON.stringify([p1.value,p2.value,e.value]);
}

    }
</script>

</body>

</html>