<?php

  $userid22 = trim($_POST["userid2"]);
  $pattern = "/\.georgetown\.edu$/";
  $ip_pattern = "/[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/";
    
  $olduserid = $userid22;
  
    $lookup = gethostbyaddr($userid22);
    #print "1: $lookup";
    
    if ($lookup != FALSE) {
      $userid22 = $lookup;    }

  #print "Current is $userid22<BR>";
  if ($userid22 == "")                // if user id is blank
    echo "You must fill in a FQDN";
    
    
    
  // user has put in a valid fqdn, lets look it up
  else if (preg_match($pattern, $userid22)) {
    if (gethostbyname($userid22) == $userid22) {
        echo "Error: No NS record for \"".$userid22."\"";
    }
    else echo gethostbyname($userid22);
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
