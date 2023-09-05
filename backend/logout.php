<?php
unset($_SESSION);
session_destroy();
echo"<script>window.location.href='/'</script>";
