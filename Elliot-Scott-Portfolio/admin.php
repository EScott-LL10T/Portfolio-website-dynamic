<?php
function isAdmin(){
    return isset($_SESSION['UserID']) && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
}
?>