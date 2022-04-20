<?php

   //**************************************//
  // Redirecting Requests from Admin Page //
 //**************************************//

 if(isset($_GET['profileOf'])){
    $valueReceived=urldecode($_GET['profileOf']);
    $profRedirQuery = "SELECT clgid FROM users WHERE name='" .$valueReceived. "'";
    $profRedirResult = mysqli_fetch_assoc(mysqli_query($db, $profRedirQuery));
    header('location: profile.php?profile='.urlencode($profRedirResult['clgid']));
}

?>