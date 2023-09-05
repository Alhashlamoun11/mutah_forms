
<?php
session_start();
if(!(isset($_SESSION['login']) || !($_SESSION['login']))){
    echo "<script>window.location.href='/'</script>";
    exit();
}
?>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/background/111mutah.jpg">
    <link rel="shortcut icon" href="../assets/images/background/111mutah.jpg" type="image/x-icon">

    <title>Success Send</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .message-container {
            max-width: 400px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #007bff;
        }
        .success-message {
            text-align: center;
            color: #228B22;
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div style="direction:rtl" class="message-container">
    <h1> شكرا <?php echo $_SESSION['username']?> !</h1>
    <div class="success-message">تم ارسال الاجابة بنجاح !</div>
</div>


</body></html>