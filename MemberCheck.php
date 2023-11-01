<?php
if (isset($_POST['SignUp'])) {
    $memberType = $_POST['member_type'];
    if (!empty($memberType)) {
        header('Location: Member.php');
    }
    else {
        header('Location: User.php');
    }
    
}
?>