<?php
include_once("sanitize.inc");

$sanIp = sanitize($_POST["ip_to_block"], SQL);
$sanDes = sanitize($_POST["description"], SQL);
$sanRemove = sanitize($_POST["remove"], SQL);

if (isset($_POST['Add']) && isset($_POST['Remove'])){
    echo "Error: You cannot both add and remove an IP address. Please try again.";
    exit(0);
}

if (!isset($_POST['Add']) && !isset($_POST['Remove'])){
    echo "Error: You must choose to either add or remove an IP address. Please try again.";
    exit(0);
}

$pattern = "/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/";

$slash = "/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\/[0-9]{1,2}$/";

$range = "/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}-[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/";

# adding an IP to the blacklist
if (isset($_POST['Add'])) {
    
    # if it is a range or subnet
    if ( (preg_match($range, $sanIp)) || (preg_match($slash, $sanIp)) ) {
        
        # add to the blocklist
        $file = "../Palo_Alto/dynamic_blocklist.txt";
        
        $newEntry = $sanIp ." # " . $sanDes;
        
        # we need to make sure its not in here already
        $input = file_get_contents($file);
        $find_q = preg_quote($newEntry,'/');
        
        if ( preg_match("/^$find_q(\n|\$)/m",$input) ) {
            echo nl2br("The IP address you entered is already on the blacklist.");
            
            echo nl2br("\n\nThe GU IP Blacklist is displayed below:\n\n");
            $blockList = file_get_contents("../Palo_Alto/dynamic_blocklist.txt");
            echo nl2br($blockList);
            exit(0);
        }
    
        file_put_contents($file, $newEntry.PHP_EOL, FILE_APPEND);
        
        # echo the new file
        echo "You added ";
        echo $sanIp;
        echo " to the IP Blacklist.";
        echo nl2br("\nDescription: ");
        echo $sanDes;
        echo nl2br("\n\nThe GU IP Blacklist is displayed below:\n\n");
        $blockList = file_get_contents("../Palo_Alto/dynamic_blocklist.txt");
        echo nl2br($blockList);
    }
    
    else {
        
        echo nl2br("You did not enter a valid IP address. Your entry was not added to the IP Blacklist.\n");
    }
    
    
    
    
    
    
    
}


else if (isset($_POST['Remove'])) {
    # if it is a range or subnet
    if ( (preg_match($range, $sanIp)) || (preg_match($slash, $sanIp)) ) {
    
        # remove from the blocklist
        $file = "../Palo_Alto/dynamic_blocklist.txt";
        
        $newEntry = $sanIp;
        echo nl2br("ip: " . $newEntry . "\n");
            
        $input = file_get_contents($file);
            
        $find_q = preg_quote($newEntry,'/');
            
        #$find_q2 = $find_q . ".*$";
        $find_q2 = $find_q . ".*$";
        
        echo nl2br("find q: " . $find_q . "\n");
            
        if ( !preg_match("/^$find_q2(\n|\$)/m",$input) ) {
        #if ( !preg_match("/^ $find_q2(\n|\$)/m",$input) )
            echo nl2br("The IP address you requested to remove is not on the blacklist. Please try again.");
            exit(0);
        }
          
        
        $count = 0;
        #-1 for no limit on number of replacements
        $output = preg_replace("/^$find_q2(\n|\$)/m","",$input,-1,$count);
        file_put_contents($file,$output);
        
        # echo the new file
        echo "You removed ";
        echo $sanIp;
        echo nl2br(" from the IP Blacklist. \n Number of replacements: " . $count ."\n");
        echo nl2br("\nDescription: ");
        echo $sanDes;
        echo nl2br("\n\nThe GU IP Blacklist is displayed below:\n\n");
        $blockList = file_get_contents("../Palo_Alto/dynamic_blocklist.txt");
        echo nl2br($blockList);
    }
    
    else {
       echo nl2br("You did not enter a valid IP address. Your entry was not deleted from the IP Blacklist.\n"); 
       echo $sanIp; 
    }
    
    
    
    
}

?>