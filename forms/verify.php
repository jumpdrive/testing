<?php

  $userid1 = trim($_POST["userid1"]);
  $pattern = "/\.georgetown\.edu$/";
  $ip_pattern = "/[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/";
    
  $olduserid = $userid1;
  
    $lookup = gethostbyaddr($userid);
    #print "1: $lookup";
    
    if ($lookup != FALSE) {
      $userid1 = $lookup;    }

  #print "Current is $userid1<BR>";
  if ($userid1 == "")                // if user id is blank
    echo "You must fill in a FQDN";
    
    
    
  // user has put in a valid fqdn, lets look it up
  else if (preg_match($pattern, $userid1)) {
    if (gethostbyname($userid1) == $userid1) {
        echo "Error: No NS record for \"".$userid1."\"";
    }
    else echo gethostbyname($userid1);
  }

  // user put in ip address
  else if (preg_match($ip_pattern, $olduserid))
  {
    if (gethostbyaddr($olduserid) == $olduserid) {
        echo "Error: No NS record for \"".$olduserid."\"";
    }
    else echo gethostbyaddr($olduserid);
  }
  
  else {
        echo "You must enter either a valid IP address or an FQDN ending with georgetown.edu.<BR>If you submit this form as is, YOUR REQUEST WILL NOT BE COMPLETED.";
    }
    

    

    ?>