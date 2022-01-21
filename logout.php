<?php
session_start();
unset($_SESSION['sess_user_name']);
session_destroy();
echo '<script type="text/javascript"> alert("Logout successfully.") </script>';
?>
    <script>
        window.location = "index.php";
    </script>
