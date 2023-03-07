<?php
session_unset();
session_destroy();
header("Location:admin_log.php");
exit;
