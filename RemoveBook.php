<?php
    include 'connect.php';
    $bID = $_GET['bID'];
	if (isset($bID)) {
		$q="DELETE FROM book WHERE Book_ID = '$bID'";
        if(!$mysqli->query($q)) {
            echo "DELETE failed. Error: ".$mysqli->error ;
        }
        //redirect
        header("Location: ManageBook.php");
        unset($bID);
        exit();
	}
?>