<?php

include_once("conf/fw_db.conf");
include_once("sanitize.inc");

function ldap_authenticate() {
    
    if ($_SERVER['PHP_AUTH_USER'] != "" && $_SERVER['PHP_AUTH_PW'] != "") {
        $ds=ldap_connect("ldaps://directory.georgetown.edu:1636");
	ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
	$netid=$_SERVER['PHP_AUTH_USER'];
	$filter="(uid=$netid)";
	$ldap_user = "uid=" . $netid . ",ou=people,dc=georgetown,dc=edu";
        if (ldap_bind( $ds, $ldap_user, $_SERVER['PHP_AUTH_PW']) ) {
        	$r = ldap_search( $ds, 'ou=people,dc=georgetown,dc=edu', $filter);
        	if ($r) {
            		$result = ldap_get_entries( $ds, $r);
            		if ($result[0]) {
                    	return $result[0];
                }
            }
        }
    }
    header('WWW-Authenticate: Basic realm="NetID Password Authentication"');
    header('HTTP/1.0 401 Unauthorized');
	echo 'Your authentication has failed. Please try again.';
    return NULL;
}

if (($result = ldap_authenticate()) == NULL) {
#    exit(0);
}

?>

<?php

function lookup_ip()
{
  $userid = trim($_POST["userid"]);
  $pattern = "/\.georgetown\.edu$/";
    
  $ip_pattern = "/[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/";
    
  $olduserid = $userid;
  
  
    $lookup = gethostbyaddr($userid);
    #print "1: $lookup";
    
     if ($lookup != FALSE) {
      $userid = $lookup;    }

  #print "Current is $userid<BR>";
  if ($userid == "")                // if user id is blank
    echo "You must fill in a FQDN";
    
    
    
  // user has put in a valid fqdn, lets look it up
  else if (preg_match($pattern, $userid)) {
    if (gethostbyname($userid) == $userid) {
        echo "Error: No NS record for \"".$userid."\"";
    }
    else echo gethostbyname($userid);
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
        echo "You must enter either a valid IP address or an FQDN ending with georgetown.edu. If you submit this form as is, your request will not be completed.";
    }
    

    
}
    ?>

<?php

function print_ip()
{
  $userid = trim($_POST["userid"]);
  $pattern = "/\.georgetown\.edu$/";
    
  $ip_pattern = "/[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/";
    
  $olduserid = $userid;
  
  
    $lookup = gethostbyaddr($userid);
    #print "1: $lookup";
    
     if ($lookup != FALSE) {
      $userid = $lookup;    }

  #print "Current is $userid<BR>";
  if ($userid == "")                // if user id is blank
    echo "You must fill in a FQDN";
    
    
    
  // user has put in a valid fqdn, lets look it up
  else if (preg_match($pattern, $userid)) {
    if (gethostbyname($userid) == $userid) {
        echo "Error: No NS record for \"".$userid."\"";
    }
    else echo gethostbyname($userid);
  }

  // user put in ip address
  else if (preg_match($ip_pattern, $olduserid))
  {
    echo $olduserid;
  }
  
  else {
        echo "You must enter either a valid IP address or an FQDN ending with georgetown.edu. If you submit this form as is, your request will not be completed.";
    }
    

    
}
    ?>

<?php

function print_fqdn()
{
  $userid = trim($_POST["userid"]);
  $pattern = "/\.georgetown\.edu$/";
    
  $ip_pattern = "/[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/";
    
  $olduserid = $userid;
  
  
    $lookup = gethostbyaddr($userid);
    #print "1: $lookup";
    
     if ($lookup != FALSE) {
      $userid = $lookup;    }

  #print "Current is $userid<BR>";
  if ($userid == "")                // if user id is blank
    echo "You must fill in a FQDN";
    
    
    
  // user has put in a valid fqdn, lets look it up
  else if (preg_match($pattern, $userid)) {
    if (gethostbyname($userid) == $userid) {
        echo "Error: No NS record for \"".$userid."\"";
    }
    else echo $userid;
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
        echo "You must enter either a valid IP address or an FQDN ending with georgetown.edu. If you submit this form as is, your request will not be completed.";
    }
    

    
}
    ?>

<?php

function print_ip2()
{
  $userid = trim($_POST["userid2"]);
  $pattern = "/\.georgetown\.edu$/";
    
  $ip_pattern = "/[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/";
    
  $olduserid = $userid;
  
  
    $lookup = gethostbyaddr($userid);
    #print "1: $lookup";
    
     if ($lookup != FALSE) {
      $userid = $lookup;    }

  #print "Current is $userid<BR>";
  if ($userid == "")                // if user id is blank
    echo "You must fill in a FQDN";
    
    
    
  // user has put in a valid fqdn, lets look it up
  else if (preg_match($pattern, $userid)) {
    if (gethostbyname($userid) == $userid) {
        echo "Error: No NS record for \"".$userid."\"";
    }
    else echo gethostbyname($userid);
  }

  // user put in ip address
  else if (preg_match($ip_pattern, $olduserid))
  {
    echo $olduserid;
  }
  
  else {
        echo "You must enter either a valid IP address or an FQDN ending with georgetown.edu. If you submit this form as is, your request will not be completed.";
    }
    

    
}
    ?>

<?php

function print_fqdn2()
{
  $userid = trim($_POST["userid2"]);
  $pattern = "/\.georgetown\.edu$/";
    
  $ip_pattern = "/[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/";
    
  $olduserid = $userid;
  
  
    $lookup = gethostbyaddr($userid);
    #print "1: $lookup";
    
     if ($lookup != FALSE) {
      $userid = $lookup;    }

  #print "Current is $userid<BR>";
  if ($userid == "")                // if user id is blank
    echo "You must fill in a FQDN";
    
    
    
  // user has put in a valid fqdn, lets look it up
  else if (preg_match($pattern, $userid)) {
    if (gethostbyname($userid) == $userid) {
        echo "Error: No NS record for \"".$userid."\"";
    }
    else echo $userid;
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
        echo "You must enter either a valid IP address or an FQDN ending with georgetown.edu. If you submit this form as is, your request will not be completed.";
    }
    

    
}
    ?>





<?php
function lookup_ip2()
{
  $userid = trim($_POST["userid2"]);
  
  $pattern = "/\.georgetown\.edu$/";
  
  $ip_pattern = "/[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/";
    
  $olduserid = $userid;
    
  
  
    $lookup = gethostbyaddr($userid);
    #print "1: $lookup";
    
    if ($lookup != FALSE) {
      $userid = $lookup;
      }

   
  // user has put in a valid fqdn, lets look it up
  if (preg_match($pattern, $userid)) {
    if (gethostbyname($userid) == $userid) {
        echo "Error: No NS record for \"".$userid."\"";
    }
    else echo gethostbyname($userid);
  }

  // user put in ip address
  else if (preg_match($ip_pattern, $olduserid))
  {
    if (gethostbyaddr($olduserid) == $olduserid) {
        echo "Error: No NS record for \"".$olduserid."\". If you submit this form as is, your request will not be completed.";
    }
    else echo gethostbyaddr($olduserid);
  }
  
  else {
        echo "You must enter either a valid IP address or an FQDN ending with georgetown.edu. If you submit this form as is, your request will not be completed.";
    }
    

    

}
    ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Firewall Rule Request Form</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

		<link rel="stylesheet" type="text/css" href="css/mike_template.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/ajaxtabs.css" />
		<script src='javascript/mootools-yui-compressed.js' type='text/javascript'></script> 
		<script src='javascript/flext-uncompressed.js' type='text/javascript' ></script>
		<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
		
		
		<!--Put the following in the <head>-->
<script type="text/javascript">
$("document").ready(function(){
  $(".js-ajax-php-json").submit(function(){
    var data = {
      "action": "test"
    };
    data = $(this).serialize() + "&" + $.param(data);
    $.ajax({
      type: "POST",
      dataType: "json",
      url: "response.php", //Relative or absolute path to response.php file
      data: data,
      success: function(data) {
        $(".the-return").html(
          "Favorite beverage: " + data["favorite_beverage"] + "<br />Favorite restaurant: " + data["favorite_restaurant"] + "<br />Gender: " + data["gender"] + "<br />JSON: " + data["json"]
        );

        alert("Form submitted successfully.\nReturned json: " + data["json"]);
      }
    });
    return false;
  });
});
</script>
 
		
		
		<script src='javascript/ajaxtabs.js' type='text/javascript'>
		/***********************************************
		* Ajax Tabs Content script v2.2- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
		* This notice MUST stay intact for legal use
		* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
		***********************************************/
		</script>
		<SCRIPT LANGUAGE="JavaScript">
		function popUp(URL, w, h) {
   			 day = new Date();
   			 id = day.getTime();
    		eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=" + w + ",height=" + h + ",left = 290,top = 212');");
		}
		</script>
	</head>
		<body>

		<div id="header">
			<div class="left"><a href="http://www.georgetown.edu/">Georgetown University</a> | <a href="http://uis.georgetown.edu/">University Information Services</a></div>
			<div class="right"><a href="http://security.georgetown.edu/8933.html">Contact Us</a> | <a href="http://search.georgetown.edu/">Search</a> | <a href="http://explore.georgetown.edu/sites/">Site Index</a> | <a href="http://security.georgetown.edu/8934.html">About <abbr title="University Information Security Office">UISO</abbr></a></div>
		</div>
		<div id="title">
			<h1><a href="http://security.georgetown.edu/">University Information Security Office</a></h1>
		</div>
<hr />
<br />  

<ul id="tabs" class="shadetabs" style="margin-left: 2em;">
<li><a href="#" rel="#default" class="selected">Request New Firewall Rules</a></li>
<li><a href="vpn_request.html" rel="countrycontainer">Request a System to a VPN Role</a></li>
<li><a href="vpn_users.html" rel="countrycontainer">Request a User to a VPN Role</a></li>
<li><a href="vpn_roles.html" rel="countrycontainer">Request a New VPN Role</a></li>
</ul>

<div id="countrydivcontainer" style="border:1px solid gray; width:94%; margin-bottom: 1em; margin-left: 1em; padding: 10px">

<? if (strlen($_POST['oncethrough']) != 0){ 

include_once("sanitize.inc");

?>

<form name="fw_form2" method="post" action="fw_form.html">
	
    <p class=Default><b><span style='font-size:10.0pt;color:windowtext'>Please Review the Request for Correctness:</span></b><span style='font-size:10.0pt;color:windowtext'></span></p>
	<table border=0 align="center" cellpadding=0 cellspacing=0 class=MsoNormalTable style='border-collapse:collapse;'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:15.5pt'>
  <td valign=top align="center" style='border:solid black 1.0pt;mso-border-alt:solid black .5pt;background:#D9D9D9;padding:0in 2pt 0in 2pt;height:15.5pt'>
  <b><span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'>Requester's Name</span></b></td>
  <td valign=top align="center" style='border:solid black 1.0pt;mso-border-alt:solid black .5pt;background:#D9D9D9;padding:0in 2pt 0in 2pt;height:15.5pt'>
  <b><span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'>Requester's Phone#</span></b></td>
  <td valign=top align="center" style='border:solid black 1.0pt;mso-border-alt:solid black .5pt;background:#D9D9D9;padding:0in 2pt 0in 2pt;height:15.5pt'>
  <b><span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'>Requester's Email</span></b></td>
  <td valign=top align="center" style='border:solid black 1.0pt;mso-border-alt:solid black .5pt;background:#D9D9D9;padding:0in 2pt 0in 2pt;height:15.5pt'>
    <b><span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'>Department</span></b></td>
  <td valign=top align="center" style='border:solid black 1.0pt;mso-border-alt:solid black .5pt;background:#D9D9D9;padding:0in 2pt 0in 2pt;height:15.5pt'>
    <b><span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'>Change Category:<br>Normal/Urgent/Emergency</span></b></td>
 </tr>
 <tr style='mso-yfti-irow:1;mso-yfti-lastrow:yes;height:19pt'>
  <td valign=middle align="center" style='border:solid black 1.0pt;border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;padding:0in 2pt 0in 2pt;height:19pt'>
  <span style='text-align:center;font-size:8.0pt;color: #000000;font-family:Arial,Helvetica,sans-serif;'>
  	  <? echo sanitize($_POST['req_name'], SQL); ?>
      <input type="hidden" name="req_name" value="<? echo sanitize($_POST['req_name'], SQL); ?>">
    </span>
  </td>
   <td valign=middle align="center" style='border:solid black 1.0pt;border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;padding:0in 5.4pt 0in 5.4pt;height:28.4pt'>
  <span style='text-align:center;font-size:8.0pt;color: #000000;font-family:Arial,Helvetica,sans-serif;'>
      <? echo sanitize($_POST['phone'], SQL); ?>
      <input type="hidden" name="phone" value="<? echo sanitize($_POST['phone'], SQL); ?>">
  </td>
  <td valign=middle align="center" style='border:solid black 1.0pt;border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;padding:0in 5.4pt 0in 5.4pt;height:28.4pt'>
  <span style='text-align:center;font-size:8.0pt;color: #000000;font-family:Arial,Helvetica,sans-serif;'>
      <? echo sanitize($_POST['email'], SQL); ?>
      <input type="hidden" name="email" value="<? echo sanitize($_POST['email'], SQL); ?>">
	</span>
  </td>
  <td valign=middle align="center" style='border:solid black 1.0pt;border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;padding:0in 5.4pt 0in 5.4pt;height:28.4pt'>
  <span style='text-align:center;font-size:8.0pt;color: #000000;font-family:Arial,Helvetica,sans-serif;'>
      <? echo sanitize($_POST['dept'], SQL); ?>
        <input type="hidden" name="dept" value="<? echo sanitize($_POST['dept'], SQL); ?>">
	</span>
    </td>
  <td valign=middle align="center" style='border:solid black 1.0pt;border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;padding:0in 5.4pt 0in 5.4pt;height:28.4pt'>
  <span style='text-align:center;font-size:8.0pt;color: #000000;font-family:Arial,Helvetica,sans-serif;'>
      <? echo sanitize($_POST['category'], SQL); ?>
      <input type="hidden" name="category" value="<? echo sanitize($_POST['category'], SQL); ?>">
  </span>
    </td>
 </tr>
</table>

<p class=Default align="center"><b><span style='font-size:10.0pt;color:windowtext'>VPN Request:</span></b><span style='font-size:10.0pt;color:windowtext'></span></p>

<! START OF MIKE'S EDITS: TABLE !-->

<table align="center" class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width="95%" style='width:95%;border-collapse:collapse;mso-padding-alt:0in 5.4pt 0in 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:19.5pt'>
  <td width="4%" valign=top style='width:24.25pt;border:solid black 1.0pt;
  mso-border-alt:solid black .5pt;background:#D9D9D9;padding:0in 5.4pt 0in 5.4pt;height:19.5pt'>
  <p class=Default><span style='color:windowtext'>&nbsp;</span></p></td>
  <td width="20%" valign=top style='border:solid black 1.0pt;
  border-left:none;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  background:#D9D9D9;padding:0in 5.4pt 0in 5.4pt;height:19.5pt'>
    <p class=Default align=center style='text-align:center'><b><span style='font-size:8.0pt'>VPN Role Name</span></b><span
  style='font-size:8.0pt'></span></p></td>
  
  <td width="20%" valign=top style='border:solid black 1.0pt;border-left:none;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  background:#D9D9D9;padding:0in 5.4pt 0in 5.4pt;height:19.5pt'>
    <p class=Default align=center style='text-align:center'><b><span style='font-size:8.0pt'>Dest. Address (FQDN)/Subnet Mask</span></b>
      <span style='font-size:8.0pt'></span></p></td>
  
  <td width="5%" valign=top style='border:solid black 1.0pt;border-left:none;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  background:#D9D9D9;padding:0in 5.4pt 0in 5.4pt;height:19.5pt'>
    <p class=Default align=center style='text-align:center'><b><span style='font-size:8.0pt'>Destination Protocol</span></b><span
  style='font-size:8.0pt'></span></p>
  </td>
  <td width="5%" valign=top style='border:solid black 1.0pt;border-left:none;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  background:#D9D9D9;padding:0in 5.4pt 0in 5.4pt;height:19.5pt'>
    <p class=Default align=center style='text-align:center'><b><span style='font-size:8.0pt'>Destination Port</span></b><span
  style='font-size:8.0pt'></span></p>
  </td>
  <td width="10%" valign=top style='border:solid black 1.0pt;border-left:none;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  background:#D9D9D9;padding:0in 5.4pt 0in 5.4pt;height:19.5pt'>
    <p class=Default align=center style='text-align:center'><b><span style='font-size:8.0pt'>Add/Remove</span></b><span style='font-size:8.0pt'>
      </span></p>
  </td>
  <td width="25%" valign=top style='border:solid black 1.0pt;border-left:none;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  background:#D9D9D9;padding:0in 5.4pt 0in 5.4pt;height:19.5pt'>
  <p class=Default align=center style='text-align:center'><b><span style='font-size:8.0pt'>Description</span></b><span style='font-size:8.0pt'></span></p>
  </td>
 </tr>
 
 
 
 
 <tr style='mso-yfti-irow:2;height:18.5pt'>
  <td width="4%" align="center" style='width:24.25pt;border:solid black 1.0pt;border-top:none;
  mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;padding:0in 5.4pt 0in 5.4pt;height:18.5pt'>
  <span style='font-size:8.0pt'>1</span>
  </td>
  <td width="20%" align="center" style='border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;padding:0in 5.4pt 0in 5.4pt;height:18.5pt'>
    <span style='font-size:8.0pt;color:windowtext;'>
	  <? $array1=explode(",", sanitize($_POST['src_ip_1'], SQL));
	  	foreach ($array1 as $i => $value) {
		}
		echo "IP Address:<BR>";
        echo print_ip();
        echo "<BR><BR>FQDN:<BR>";
        echo print_fqdn();
        
	  ?>
      <input type="hidden" name="src_ip_1" value="<? echo $_POST['src_ip_1']; ?>">
	  </span>
  </td>
  
  
    <input type="hidden" name="calc_ip" value="<? echo print_ip(); ?>">
    <input type="hidden" name="calc_fqdn" value="<? echo print_fqdn(); ?>">
    
  <td width="20%" align="center" style='border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;padding:0in 5.4pt 0in 5.4pt;height:18.5pt'>
    <span style='font-size:8.0pt;color:windowtext'>
	<? $array1=explode(",", sanitize($_POST['ip_address2'], SQL));
	  	foreach ($array1 as $i => $value) {
		}
        
        echo "IP Address:<BR>";
        echo print_ip2();
        echo "<BR><BR>FQDN:<BR>";
        echo print_fqdn2();
	  ?>
    
    
    <input type="hidden" name="calc_ip" value="<? echo print_ip(); ?>">
    <input type="hidden" name="calc_fqdn" value="<? echo print_fqdn(); ?>">
    
        
    <input type="hidden" name="calc_ip" value="<? $_POST['calc_ip']; ?>">
    <input type="hidden" name="calc_fqdn" value="<? $_POST['calc_fqdn']; ?>">
    
    
    <input type="hidden" name="userid" value="<? echo $_POST['userid']; ?>">
    <input type="hidden" name="userid2" value="<? echo $_POST['userid2']; ?>">
	<input type="hidden" name="ip_address" value="<? echo $_POST['ip_address']; ?>">
    <input type="hidden" name="fqdn" value="<? echo $_POST['fqdn']; ?>">
    <input type="hidden" name="ip_address2" value="<? echo $_POST['ip_address2']; ?>">
    <input type="hidden" name="traffic_1" value="<? echo $_POST['traffic_1']; ?>">
    <input type="hidden" name="action_1" value="<? echo $_POST['action_1']; ?>">
    <input type="hidden" name="proto_1" value="<? echo $_POST['proto_1']; ?>">
    <input type="hidden" name="dst_port_1" value="<? echo $_POST['dst_port_1']; ?>">
    
    <input type="hidden" name="commment_other" value="<? echo $_POST['comment_other']; ?>">
    <input type="hidden" name="comment_1" value="<? echo $_POST['comment_1']; ?>">
</span>
  </td>
  <td width="5%" align="center" style='border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;padding:0in 5.4pt 0in 5.4pt;height:18.5pt'>
    <span style='font-size:8.0pt;color:windowtext'>
      <? echo sanitize($_POST['proto_1'], SQL); ?><input type="hidden" name="proto_1" value="<? echo sanitize($_POST['proto_1'], SQL); ?>"></span>
  </td>
  <td width="10%" align="center" style='border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;padding:0in 5.4pt 0in 5.4pt;height:18.5pt'>
  <span style="font-size:8.0pt;color:windowtext">
		<? $array1=explode(",", sanitize($_POST['dst_port_1'], SQL));
	  	 	foreach ($array1 as $i => $value) {
				echo $value . "<br />";
			}
			
	 	 ?>
		<input type="hidden" name="dst_port_1" value="<? echo $_POST['dst_port_1']; ?>">
  </span></td>
  <td width="10%" align="center" style='border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;padding:0in 5.4pt 0in 5.4pt;height:18.5pt'>
    <span style='font-size:8.0pt;color:windowtext'>
	   <? echo sanitize($_POST['action_1'], SQL); ?><input type="hidden" name="action_1" value="<? echo sanitize($_POST['action_1'], SQL); ?>">
    </span>
  </td>
  <td width="25%" align="center" style='border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;padding:0in 5.4pt 0in 5.4pt;height:18.5pt'>
  <span style='font-size:8.0pt;color:windowtext'>
  <? echo sanitize($_POST['comment_1'], SQL); ?><input type="hidden" name="comment_1" value="<? echo sanitize($_POST['comment_1'], SQL); ?>">
  </span>
  </td>
 </tr>
 
 
 
  
  
  
</table>
<br />
Additional comments: <b>
  <? echo sanitize($_POST['comment_other'], SQL); ?><input type="hidden" name="comment_other" value="<? echo sanitize($_POST['comment_other'], SQL); ?>"></b>
<p class=Default align=center style='text-align:center'><b><span style='color:windowtext'>
    <input type="submit" name ="submit" value ="Submit"> &nbsp; <input type="button" value ="Back" onClick="history.go(-1)">
	<input type="hidden" name="twicethrough" value="Yes">
	<input name="netID" value="<? echo sanitize($_POST['netID'], SQL); ?>" type=hidden>
</span></b></p>
    </form>

<? }

elseif (strlen($_POST['twicethrough']) != 0) {

function send_email($from, $reply, $to, $subject, $message){
        $headers = 'From: ' . $from . "\n";
        $headers .= 'Reply-To: ' . $reply . "\n";
        $headers .= 'Return-Path: ' . $reply . "\n";
		$headers .= 'X-Mailer: PHP/' . phpversion() . "\n";
        mail($to,$subject,$message,$headers);
}

function send_email_html($from, $reply, $to, $cc, $subject, $message){
        $headers = 'From: ' . $from . "\n";
        $headers .= 'Reply-To: ' . $reply . "\n";
		$headers .= 'CC: ' . $cc . "\n";
        $headers .= 'Return-Path: ' . $reply . "\n";
		$headers .= 'X-Mailer: PHP/' . phpversion() . "\n";
		$headers  .= 'MIME-Version: 1.0' . "\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\n";
        mail($to,$subject,$message,$headers);
}

# insert rules in db
mysql_connect($db_host,$user,$password);
@mysql_select_db($database) or die( "Unable to select database");



	$src_ip=sanitize($_POST['ip_address'], SQL);
	${"dst_ip"}=sanitize($_POST['ip_address2'], SQL);
	${"proto_1"}=sanitize($_POST['proto_1'], SQL);
	${"dst_port"}=sanitize($_POST['dst_port_1'], SQL);
	${"action_1"}=sanitize($_POST['action_1'], SQL);
	${"traffic_1"}=sanitize($_POST['traffic_1'], SQL);
	$comment_1=sanitize($_POST['comment_1'], SQL);
	$netID=sanitize($_POST['netID'], SQL);
	$category=sanitize($_POST['category'], SQL);

    
	if((strlen(${"src_ip"}) != 0) && (strlen(${"dst_ip"}) != 0)){

		$insert1 = "INSERT INTO fw_requests (src_ip, dst_ip, dst_prot, dst_port, action, enc, descript, netid, category)
                    VALUES('${'src_ip'}', '${'dst_ip'}', '${'proto_1'}', '${'dst_port'}', '${'action_1'}', '${'traffic_1'}', '${'comment_1'}', '$netID', '$category')";
		mysql_query($insert1) or die(mysql_error());
		
        
		}
	

mysql_close();

$hd_to = "uiso-request@georgetown.edu"; #uiso-request@georgetown.edu
$hd_from = $_POST['email'];
$hd_replyto = $_POST['email'];
$hd_subject = "FW Rule Change Request - " . $_POST['netID'];
		
$hd_msg = "X-RequestType:Firewall Rule\n\n";

$hd_msg .= "Requester: " . $_POST['req_name'] . "\n";
$hd_msg .= "Phone: " . $_POST['phone'] . "\n";
$hd_msg .= "E-mail: " . $_POST['email'] . "\n";
$hd_msg .= "Department: " . $_POST['dept'] . "\n";
$hd_msg .= "Category: " . $_POST['category'] . "\n\n";
       
$hd_msg .= "Firewall Rules Requested:\n\n";

$hd_msg .= "Rule 1:\n";
#$hd_msg .= "Src Host IP: " . $_POST['ip_address'] . "\n";

ob_start(); //Start output buffer
echo print_ip();
$ip1 = ob_get_contents(); //Grab output
ob_end_clean(); //Discard output buffer


ob_start(); //Start output buffer
echo print_ip2();
$ip2 = ob_get_contents(); //Grab output
ob_end_clean(); //Discard output buffer



ob_start(); //Start output buffer
echo print_fqdn();
$fqdn1 = ob_get_contents(); //Grab output
ob_end_clean(); //Discard output buffer



ob_start(); //Start output buffer
echo print_fqdn2();
$fqdn2 = ob_get_contents(); //Grab output
ob_end_clean(); //Discard output buffer



$hd_msg .= "Src Host IP: " . $ip1 . "\n";

#$hd_msg .= "Src Host FQDN: " . $_POST['fqdn'] . "\n";
$hd_msg .= "Src Host FQDN: " . $fqdn1 . "\n";

#$hd_msg .= "Dst Host IP: " . $_POST['ip_address2'] . "\n";
$hd_msg .= "Dst Host IP: " . $ip2 . "\n";

#$hd_msg .= "Dst Host FQDN: " . $_POST['fqdn2'] . "\n";
$hd_msg .= "Dst Host FQDN: " . $fqdn2 . "\n";

$hd_msg .= "Protocol: " . $_POST['proto_1'] . "\n";
$hd_msg .= "Dst Port: " . $_POST['dst_port_1'] . "\n";
$hd_msg .= "Action: " . $_POST['action_1'] . "\n";
$hd_msg .= "Traffic Enc: " . $_POST['traffic_1'] . "\n";
$hd_msg .= "Description: " . $_POST['comment_1'] . "\n\n";

if ((strlen($_POST['comment_other']) != 0)) {
	$hd_msg .= "Additional Comments: " . $_POST['comment_other'] . "\n";
}
$hd_msg .= "Request Received From: " . $_SERVER['REMOTE_ADDR'] . "\n";


$sec_to = $toaddress;
$sec_from = "Authorization Request Form <security@georgetown.edu>";
$sec_replyto = $_POST['email'];
$sec_subject = "Authorization Request - " . $_POST['netID'];

$sec_msg = "<html><body>
	<p align=center><b><span style='font-size:10.0pt;color:windowtext'>Authorization Request Submitted</span></b><span style='font-size:10.0pt;color:windowtext'></span></p>
	<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 style='border-collapse:collapse;mso-padding-alt:0in 5.4pt 0in 5.4pt' align='center'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:19.5pt'>
  <td valign=top>
  <p class=Default align=center style='text-align:center'><b><span style='font-size:8.0pt'></span></b>
  <b><span style='font-size:8.0pt'>Requester's Name</span></b><span style='font-size:8.0pt'></span></p></td>
  <td valign=top>
  <p class=Default align=center style='text-align:center'><b><span style='font-size:8.0pt'>Requester's Phone</span></b>
  <span style='font-size:8.0pt'></span></p></td>
  <td valign=top>
  <p class=Default align=center style='text-align:center'><b><span
  style='font-size:8.0pt'></span></b><b><span
  style='font-size:8.0pt'>Requester's Email</span></b><span style='font-size:
  8.0pt'>
    
  </span></p></td>
  <td valign=top>
    <p class=Default align=center style='text-align:center'><b><span
  style='font-size:8.0pt'>&nbsp;</span></b><b><span
  style='font-size:8.0pt'>Department</span></b><span style='font-size:8.0pt'>
      
    </span></p></td>
  <td valign=top>
    <p class=Default align=center style='text-align:center'><b><span
  style='font-size:8.0pt'>Change Category:<br>Normal/Urgent/Emergency</span></b><span style='font-size:8.0pt'>
      </span></p></td>
 </tr>
 <tr style='mso-yfti-irow:1;mso-yfti-lastrow:yes;height:28.4pt'>
  <td valign=middle>
  <p class=Default align=center style='text-align:center'><span style='font-size:10.0pt;color:windowtext'>&nbsp;</span>
    <label>
      " . $_POST['req_name'] . "
    </label>
  </td>
  <td valign=middle>
  <p class=Default align=center style='text-align:center'><span style='font-size:10.0pt;color:windowtext'>&nbsp;</span>
    <label>
      " . $_POST['phone'] . "
    </label>
  </td>
  <td valign=middle>
  <p class=Default align=center style='text-align:center'><span style='font-size:10.0pt;color:windowtext'>&nbsp;</span>
    <label>
      " . $_POST['email'] . "
    </label>
  </td>
  <td valign=middle>
  <p class=Default align=center style='text-align:center'><span style='font-size:10.0pt;color:windowtext'>&nbsp;</span>
      <label>
        " . $_POST['dept'] . "
        </label>
    </td>
  <td valign=middle>
  <p class=Default align=center style='text-align:center'><span style='font-size:10.0pt;color:windowtext'>&nbsp;</span>
      " . $_POST['category'] . "
    </td>
 </tr>
</table>

<p align=center><b><span style='font-size:10.0pt;color:windowtext'>VPN Rules Requested:</span></b><span style='font-size:10.0pt;color:windowtext'></span></p>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width='99%' style='width:99%;border-collapse:collapse;mso-padding-alt:0in 5.4pt 0in 5.4pt' align='center'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:19.5pt'>
  <td width='4%' valign=top>
  <p class=Default><span style='color:windowtext'>&nbsp;</span></p></td>
  <td width='20' valign=top>
    <p class=Default align=center style='text-align:center'><b><span style='font-size:8.0pt'>VPN Role Name</span></b><span
  style='font-size:8.0pt'></span></p></td>
  <td width='20%' valign=top>
    <p class=Default align=center style='text-align:center'><b><span style='font-size:8.0pt'>Dest. Address (FQDN)/Subnet Mask</span></b>
      <span style='font-size:8.0pt'></span></p></td>
  <td width='5%' valign=top>
    <p class=Default align=center style='text-align:center'><b><span style='font-size:8.0pt'>Destination Protocol</span></b><span
  style='font-size:8.0pt'></span></p>
  </td>
  <td width='5%' valign=top>
    <p class=Default align=center style='text-align:center'><b><span style='font-size:8.0pt'>Destination Port</span></b><span
  style='font-size:8.0pt'></span></p>
  </td>
  <td width='10%' valign=top>
    <p class=Default align=center style='text-align:center'><b><span style='font-size:8.0pt'>Add/Remove</span></b><span style='font-size:8.0pt'>
      </span></p>
  </td>
  <td width='25%' valign=top>
  <p class=Default align=center style='text-align:center'><b><span style='font-size:8.0pt'>Description</span></b><span style='font-size:8.0pt'></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2;height:18.5pt'>
  <td width=4%>
  <p class=Default><span style='font-size:8.0pt'>1
  </span></p>
  </td>
  <td width='20%' >
    <p class=Default align=center style='text-align:center'><span style='font-size:8.0pt;color:windowtext'> "; 
       $array1=explode(",", $_POST['ip_address']);
	  	 foreach ($array1 as $i => $value) {
			$sec_msg .= $value . "<br />";
		}	  
$sec_msg .= "</span></p>
  </td>
  <td width=20%>
    <p class=Default align=center style='text-align:center'><span style='font-size:8.0pt;color:windowtext'> ";
$array1=explode(",", $_POST['dst_ip_1']);
	  	 foreach ($array1 as $i => $value) {
			$sec_msg .= $value . "<br />";
		}	  
$sec_msg .= "</span></p>
  </td>
  <td width=5%>
    <p class=Default align=center style='text-align:center'><span style='font-size:8.0pt;color:windowtext'>
      " . $_POST['proto_1'] . "</span>
    </p>

  </td>
  <td width=10% align='center'><span class='Default' style='text-align:center'><span style='font-size:8.0pt;color:windowtext'> ";
$array1=explode(",", $_POST['dst_port_1']);
	  	 foreach ($array1 as $i => $value) {
			$sec_msg .= $value . "<br />";
		}	  
$sec_msg .= "</span></span></td>
  <td width=10%>
    <p class=Default align=center style='text-align:center'><span style='font-size:8.0pt;color:windowtext'>
      " . $_POST['action_1'] . "
    </span></p>
  </td>

<td width=10%>
    <p class=Default align=center style='text-align:center'><span style='font-size:8.0pt;color:windowtext'>
      " . $_POST['traffic_1'] . "
    </span></p>
  </td>
  <td width=25%>
  <p class=Default align=center style='text-align:center'><span style='font-size:8.0pt;color:windowtext'>
  " . $_POST['comment_1'] . "</span></p>
  </td>
 </tr>
  <tr style='mso-yfti-irow:2;height:18.5pt'>
  <td width='4%' >
  <p class=Default><span style='font-size:8.0pt'>2
  </span></p>
  </td>
  <td width=20%>
    <p class=Default align=center style='text-align:center'><span style='font-size:8.0pt;color:windowtext'>";
       $array1=explode(",", $_POST['src_ip_2']);
	  	 foreach ($array1 as $i => $value) {
			$sec_msg .= $value . "<br />";
		}	  
$sec_msg .= "</span></p>
  </td>
  <td width=20%>
    <p class=Default align=center style='text-align:center'><span style='font-size:8.0pt;color:windowtext'>";
       $array1=explode(",", $_POST['dst_ip_2']);
	  	 foreach ($array1 as $i => $value) {
			$sec_msg .= $value . "<br />";
		}	  
$sec_msg .= "</span></p>
  </td>
  <td width=5%>
    <p class=Default align=center style='text-align:center'><span style='font-size:8.0pt;color:windowtext'>
      ". $_POST['proto_2'] . "</span></p>
  </td>
  <td width=10% align='center'><span class='Default' style='text-align:center'><span style='font-size:8.0pt;color:windowtext'>";
     $array1=explode(",", $_POST['dst_port_2']);
	  	 foreach ($array1 as $i => $value) {
			$sec_msg .= $value . "<br />";
		}	  
$sec_msg .= "</span></span></td>
  <td width=10%>
    <p class=Default align=center style='text-align:center'><span style='font-size:8.0pt;color:windowtext'>
      " . $_POST['action_2'] . "
    </span></p>
  </td>
  <td width=25%>
  <p class=Default align=center style='text-align:center'><span style='font-size:8.0pt;color:windowtext'>
  " . $_POST['comment_2'] . "</span></p>
  </td>
 </tr>
  <tr style='mso-yfti-irow:2;height:18.5pt'>
  <td width=4%>
  <p class=Default><span style='font-size:8.0pt'>3
  </span></p>
  </td>
  <td width=20%>
    <p class=Default align=center style='text-align:center'><span style='font-size:8.0pt;color:windowtext'>";
      $array1=explode(",", $_POST['src_ip_3']);
	  	 foreach ($array1 as $i => $value) {
			$sec_msg .= $value . "<br />";
		}	  
$sec_msg .= "</span></p>
  </td>
  <td width=20%>
    <p class=Default align=center style='text-align:center'><span style='font-size:8.0pt;color:windowtext'>";
      $array1=explode(",", $_POST['dst_ip_3']);
	  	 foreach ($array1 as $i => $value) {
			$sec_msg .= $value . "<br />";
		}	  
$sec_msg .= "</span></p>
  </td>
  <td width=5%>
    <p class=Default align=center style='text-align:center'><span style='font-size:8.0pt;color:windowtext'>
      " . $_POST['proto_3'] . "
    </span></p>
  </td>
  <td width=10% align='center'><span class='Default' style='text-align:center'><span style='font-size:8.0pt;color:windowtext'>";
    $array1=explode(",", $_POST['dst_port_3']);
	  	 foreach ($array1 as $i => $value) {
			$sec_msg .= $value . "<br />";
		}	  
$sec_msg .= "</span></span></td>
  <td width=10%>
    <p class=Default align=center style='text-align:center'><span style='font-size:8.0pt;color:windowtext'>
      " . $_POST['action_3'] . "</span></p>
  </td>
  <td width=25%>
  <p class=Default align=center style='text-align:center'><span style='font-size:8.0pt;color:windowtext'>
  " . $_POST['comment_3'] . "</span></p>
  </td>
 </tr>
  <tr style='mso-yfti-irow:2;height:18.5pt'>
  <td width=4%>
  <p class=Default><span style='font-size:8.0pt'>4
  </span></p>
  </td>
  <td width=20%>
    <p class=Default align=center style='text-align:center'><span style='font-size:8.0pt;color:windowtext'>";
      $array1=explode(",", $_POST['src_ip_4']);
	  	 foreach ($array1 as $i => $value) {
			$sec_msg .= $value . "<br />";
		}	  
$sec_msg .= "</span></p>
  </td>
  <td width=20%>
    <p class=Default align=center style='text-align:center'><span style='font-size:8.0pt;color:windowtext'>";
      $array1=explode(",", $_POST['dst_ip_4']);
	  	 foreach ($array1 as $i => $value) {
			$sec_msg .= $value . "<br />";
		}	  
$sec_msg .= "</span></p>
  </td>
  <td width=5%>
    <p class=Default align=center style='text-align:center'><span style='font-size:8.0pt;color:windowtext'>
      " . $_POST['proto_4'] . "</span></p>
  </td>
  <td width=10% align='center'><span class='Default' style='text-align:center'><span style='font-size:8.0pt;color:windowtext'>";
    $array1=explode(",", $_POST['dst_port_4']);
	  	 foreach ($array1 as $i => $value) {
			$sec_msg .= $value . "<br />";
		}	  
$sec_msg .= "</span></span></td>
  <td width=10%>
    <p class=Default align=center style='text-align:center'><span style='font-size:8.0pt;color:windowtext'>
      " . $_POST['action_4'] . "</span></p>
  </td>
  <td width=25%>
  <p class=Default align=center style='text-align:center'><span style='font-size:8.0pt;color:windowtext'>
  " . $_POST['comment_4'] . "</span></p>
  </td>
 </tr>
  <tr style='mso-yfti-irow:2;height:18.5pt'>
  <td width=4%>
  <p class=Default><span style='font-size:8.0pt'>5
  </span></p>
  </td>
  <td width=20%>
    <p class=Default align=center style='text-align:center'><span style='font-size:8.0pt;color:windowtext'>";
      $array1=explode(",", $_POST['src_ip_5']);
	  	 foreach ($array1 as $i => $value) {
			$sec_msg .= $value . "<br />";
		}	  
$sec_msg .= "</span></p>
  </td>
  <td width=20%>
    <p class=Default align=center style='text-align:center'><span style='font-size:8.0pt;color:windowtext'>";
    $array1=explode(",", $_POST['dst_ip_5']);
	  	 foreach ($array1 as $i => $value) {
			$sec_msg .= $value . "<br />";
		}	  
$sec_msg .= "</span></p>
  </td>
  <td width=5%>
    <p class=Default align=center style='text-align:center'><span style='font-size:8.0pt;color:windowtext'>
      " . $_POST['proto_5'] . "</span></p>
  </td>
  <td width=10% align='center'><span class='Default' style='text-align:center'><span style='font-size:8.0pt;color:windowtext'>";
    $array1=explode(",", $_POST['dst_port_5']);
	  	 foreach ($array1 as $i => $value) {
			$sec_msg .= $value . "<br />";
		}	  
$sec_msg .= "</span></span></td>
  <td width=10%>
    <p class=Default align=center style='text-align:center'><span style='font-size:8.0pt;color:windowtext'>
      " . $_POST['action_5'] . "</span></p>
  </td>
  <td width=25%>
  <p class=Default align=center style='text-align:center'><span style='font-size:8.0pt;color:windowtext'>
  " . $_POST['comment_5'] . "</span></p>
  </td>
 </tr>
</table>
<p class=Default align=center style='text-align:center'><b><span style='color:windowtext'>&nbsp;</span></b></p>
<p>Please go to the <a href='https://security-uiso.uis.georgetown.edu/Auth/'>Authorization Portal</a> to approve or deny this request.</p>
Additional comments: <b>" . $_POST['comment_other'] . "</b>
<P> Request received from: " . $_SERVER['REMOTE_ADDR'] . "</P>

</body></html>";

send_email($hd_from, "", $hd_to, $hd_subject, $hd_msg);
send_email_html($sec_from, $sec_replyto, $sec_to, $sec_cc, $sec_subject, $sec_msg);

?>
<br />
<center>
Your VPN Rule Change Request has been successfully submitted. You should receive a confirmation e-mail from UISO with details of your pending request.
<br /><br />
Click <a href="fw_form.html"><b>here</b></a> to submit another request.</center><br />


<?
	}
else
	{ ?>
<form name="fw_request" action="fw_form.html" method="post"> 
<div id="bodycontent">
<?php 
	include_once("sanitize.inc");
	$netid = sanitize($_SERVER['PHP_AUTH_USER'], SQL); 
	
	$dn = "ou=people,dc=georgetown,dc=edu";
	$filter="(|(uid=$netid))";
	$justthese = array("cn", "telephonenumber", "mail");

	$ds=ldap_connect("directory.georgetown.edu");
	$sr=ldap_search($ds, $dn, $filter, $justthese);
	$info = ldap_get_entries($ds, $sr);
	$fullname = $info[0]['cn'][0];
	$telephone = $info[0]['telephonenumber'][0];
	$email = $info[0]['mail'][0];
	ldap_close($ds);
	
?>

	<h1>Firewall Rule Request Form</h1>

	<table border=0 align="center" cellpadding=0 cellspacing=0 class=MsoNormalTable style='border-collapse:collapse;'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:15.5pt'>
  <td valign=top align="center" style='border:solid black 1.0pt;mso-border-alt:solid black .5pt;background:#D9D9D9;padding:0in 2pt 0in 2pt;height:15.5pt'>
  <b><span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'>Requester's Name</span></b></td>
  <td valign=top align="center" style='border:solid black 1.0pt;mso-border-alt:solid black .5pt;background:#D9D9D9;padding:0in 2pt 0in 2pt;height:15.5pt'>
  <b><span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'>Requester's Phone#</span></b></td>
  <td valign=top align="center" style='border:solid black 1.0pt;mso-border-alt:solid black .5pt;background:#D9D9D9;padding:0in 2pt 0in 2pt;height:15.5pt'>
  <b><span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'>Requester's Email</span></b></td>
  <td valign=top align="center" style='border:solid black 1.0pt;mso-border-alt:solid black .5pt;background:#D9D9D9;padding:0in 2pt 0in 2pt;height:15.5pt'>
    <b><span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'>Department</span></b></td>
  <td valign=top align="center" style='border:solid black 1.0pt;mso-border-alt:solid black .5pt;background:#D9D9D9;padding:0in 2pt 0in 2pt;height:15.5pt'>
    <b><span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'>Change Category:<br>Normal/Urgent/Emergency</span></b></td>
 </tr>
 <tr style='mso-yfti-irow:1;mso-yfti-lastrow:yes;height:19pt'>
  <td valign=middle align="center" style='border:solid black 1.0pt;border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 2pt 0in 2pt;height:19pt'>
  <span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'>
      <input type="text" name="req_name" validateat="onSubmit" required="yes" id="req_name" size="20" value="<? echo $fullname; ?>">
    </span>
  </td>
  <td valign=middle align="center" style='border:solid black 1.0pt;border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 2pt 0in 2pt;height:19pt'>
  <span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'>
      <input type="text" name="phone" id="phone" size="12" value="<? echo $telephone; ?>">
    </span>
  </td>
  <td valign=middle align="center" style='border:solid black 1.0pt;border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 2pt 0in 2pt;height:19pt'>
  <span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'>
      <input type="text" name="email" required="yes" id="email" size="24" value="<? echo $email; ?>">
      <input type="hidden" name="userid2" required="yes" id="email" size="24" value="<? echo $userid2; ?>">
    </span>
  </td>
  <td valign=middle align="center" style='border:solid black 1.0pt;border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 2pt 0in 2pt;height:19pt'>
  <span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'>
        <input type="text" name="dept" id="dept" size="15">
        </span>
    </td>
  <td valign=middle  align="center" style='border:solid black 1.0pt;border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 2pt 0in 2pt;height:19pt'>
  <span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'>
      <select name="category">
        <option selected>Normal</option>
        <option>Urgent</option>
        <option>Emergency</option>
      </select>
	  </span>
    </td>
 </tr>
</table>
<br />
<p><h2 align="center">Firewall Rule Request Hints:</b></h2></p>

<li>UIS Departmental VPN Roles (e.g. NCS-SM) and Roles containing the codes aa or sa do not require destination ports.  All are allowed by default.</li>
<li>User roles, usually indicated by us or dv codes, require destination port specifications.</li>
<li>Expected turnaround time for FW rule request is 2 business days and SLA is 3 days. PLAN ACCORDINGLY.</li>
<li>For additional information on submitting VPN rules please refer to the <a href="javascript:popUp('docs/Firewall_Rule_Submission_Procedure_v1.6.pdf',700,600)"><b>VPN Rule Submission Procedure</b></a> document. </li>

<br />


<! IS THIS WHERE THE TABLE STARTS !-->
<h2 align="center">Firewall Rules:</h2>

<table align="center" class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width="95%" style='width:95%;word-wrap: break-word;border-collapse:collapse;mso-padding-alt:0in 1.0pt 0in 1.0pt'>
 <tr>
  <td width="4%" valign=top style='width:24.25pt;border:solid black 1.0pt;mso-border-alt:solid black .5pt;background:#D9D9D9;padding:0in 2pt 0in 2pt;'>
  <p class=Default><span style='color:windowtext'>&nbsp;</span></p></td>
  
  
  
  <td width="4%" align="center" valign=top style='border:solid black 1.0pt;border-left:none;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;background:#D9D9D9;padding:0in 1pt 0in 1pt;'>
    <b><span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'>Source FQDN </br>OR </br>Source IP Address</span></b></td>
  
  <td width="20%" align="center" valign=top style='border:solid black 1.0pt;border-left:none;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;background:#D9D9D9;padding:0in 2pt 0in 2pt;'>
    <b><span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'> Destination FQDN </br>OR </br>Destination IP Address</span></b></td>
  
  
  
  
  <td width="5%" align="center" valign=top style='border:solid black 1.0pt;border-left:none;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;background:#D9D9D9;padding:0in 2pt 0in 2pt;'>
    <b><span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'>Destination Protocol AND Port</span></b></td>
  
  <td width="10%" align="center" valign=top style='border:solid black 1.0pt;border-left:none;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;background:#D9D9D9;padding:0in 1.0pt 0in 1.0pt;'>
    <b><span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'>Add/Remove</span></b></td>
  
  <td width="20%" align="center" valign=top style='border:solid black 1.0pt;border-left:none;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;background:#D9D9D9;padding:0in 1.0pt 0in 1.0pt;'>
  <b><span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'>Traffic Encrypted?</span></b></td>
 
  
  <td width="20%" align="center" valign=top style='border:solid black 1.0pt;border-left:none;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;background:#D9D9D9;padding:0in 1.0pt 0in 1.0pt;'>
  <b><span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'>Description</span></b></td>
 
 </tr>
 
 <tr style='mso-yfti-irow:1;height:19.0pt'>
 
  <td width="4%" align="center" style='border:solid black 1.0pt;border-top:none;mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;padding:0in 5.4pt 0in 5.4pt;height:19.0pt'>
  <span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'>Ex.</span>  </td>
 
  <td width="20%" align="center" style='border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;padding:0in 5.4pt 0in 5.4pt;height:19.0pt'>
    <span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'>141.161.245.171</br><b><font color="red">OR</font></b></br>fez-test-2.uis.georgetown.edu</span></td>
 
  <td width="20%" align="center" style='width:91.25pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:19.0pt'>
<span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'>141.161.99.77</br><b><font color="red">OR</font></b></br>test2.georgetown.edu</span></td>
 
 
 
  <td width="5%" align="center" style='border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:19.0pt'>
    <span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'>TCP<br></br>80</span></td>
 
  <td width="5%" align="center" style='border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 1.0pt 0in 1.0pt;height:19.0pt'>
    <span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'>Add</span>  </td>
 
  <td width="10%" align="center" style='border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 1.0pt 0in 1.0pt;height:19.0pt'>
    <span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'>Yes</span>  </td>
 
 
  <td width="20%" align="center" style='border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 1.0pt 0in 1.0pt;height:19.0pt'>
 <span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'>Allow VPN access for the Banner-aa-Users group to the LDAP server</span>  </td>
 
  
 </tr>
 
 <! TRYING TO PUT IN THE REVERSE NS LOOKUP SCRIPT !-->

<script>
        function PostData() {
            var xhr;
            if (window.XMLHttpRequest) {
                xhr = new XMLHttpRequest();
            }
            else if (window.ActiveXObject) {
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
            }
            else {
                throw new Error("Ajax is not supported by this browser");
            }
            
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status == 200 && xhr.status < 300) {
                        // www.w3.org/Protocols/rfc2616/rfc2616-sec10.html#sec10 
                        document.getElementById('myDiv').innerHTML = xhr.responseText;
                    }
                }
            }
            
            var userid1 = document.getElementById("userid").value;

            xhr.open('POST', 'verify.php', true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("userid1=" + userid1);
        }

    </script>

<script>
        function PostData2() {
            var xhr;
            if (window.XMLHttpRequest) {
                xhr = new XMLHttpRequest();
            }
            else if (window.ActiveXObject) {
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
            }
            else {
                throw new Error("Ajax is not supported by this browser");
            }
            
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status == 200 && xhr.status < 300) {
                        // www.w3.org/Protocols/rfc2616/rfc2616-sec10.html#sec10 
                        document.getElementById('myDiv2').innerHTML = xhr.responseText;
                    }
                }
            }
            
            var userid2 = document.getElementById("userid2").value;

            xhr.open('POST', 'verify2.php', true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("userid2=" + userid2);
        }

    </script>

 

 
 
 
 <! HERES WHERE THE INPUT STARTS !-->
	
	
 <tr style='mso-yfti-irow:2;height:18.5pt'>
  <td width="4%" align="center" style='width:24.25pt;border:solid black 1.0pt;border-top:none;
  mso-border-top-alt:solid black .5pt;mso-border-alt:solid black .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:18.5pt'>
  <span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'>1  </span></p>  </td>
  
  
  <td width="20%" align="center" style='border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;padding:0in 5.4pt 0in 5.4pt;height:18.5pt'>
    <span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'>
 
 

 
 
 
 <br></br>
    <label for="userid">Enter Full FQDN OR IP Address</label>
	
	<br></br>
	<textarea class='flext growme' name="userid" id="userid" onblur="PostData()" cols="6" rows="1"></textarea>
    <!-- 
	<input type="text" name ="userid" id="userid" onblur="PostData()" /> !-->
    <div id="div1"></div>
    <input type="button" value ="Check" onclick="PostData()" />
	
	<br></br>
<div id="myDiv"><h2>Click "Check" To Lookup FQDN/IP Address</h2></div>
	
	<br></br>
	<input type="checkbox" name="ip_matches" value="Correct IP Address?" required>I Confirm that this is the Correct IP address and FQDN<br>

 
  </td>
  
  
  
  
  <td width="20%" align="center" style='border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;padding:0in 5.4pt 0in 5.4pt;height:18.5pt'>
    <span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'>
 
 

 
 
 <!-- userid2, userid2, userid2, PostData2(), myDiv2 !-->
    <label for="userid2">Enter Full FQDN OR IP Address</label>
	
	<br></br>
    
	<textarea class='flext growme' name="userid2" id="userid2" onblur="PostData2()" cols="6" rows="1"></textarea>
    <!-- 
	<input type="text" name ="userid" id="userid" onblur="PostData()" /> !-->
    <div id="div2"></div>
    <input type="button" value ="Check" onclick="PostData2()" />
	
	<br></br>
<div id="myDiv2"><h2>Click "Check" To Lookup FQDN/IP Address</h2></div>
	
	<br></br>
	<input type="checkbox" name="ip_matches" value="Correct IP Address?" required>I Confirm that this is the Correct IP address and FQDN<br>

 
  </td>

<script>
			function print_name(name) {
				var xmlhttp;
				if (window.XMLHttpRequest)
				  {// code for IE7+, Firefox, Chrome, Opera, Safari
				  xmlhttp=new XMLHttpRequest();
				  }
				else
				  {// code for IE6, IE5
				  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				  }
				xmlhttp.onreadystatechange=function()
				  {
				  if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
					document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
					}
				  }
				xmlhttp.open("GET","test1.txt",true);
				xmlhttp.send();
			}
		</script>
  
  
  <td width="5%" align="center" style='border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;padding:0in 5.4pt 0in 5.4pt;height:18.5pt'>
    Protocol:
	<span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'>
      <select name="proto_1">
        <option selected>TCP</option>
        <option>UDP</option>
        <option>Both</option>
      </select>
	</span>
	<br></br>
	Port:
	<textarea class='flext growme' name="dst_port_1" cols="6" rows="1" required></textarea>
	
	

  
  </td>
  
  
  <td width="10%" align="center" style='border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;padding:0in 1.0pt 0in 1.0pt;height:18.5pt'>
    <span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'>
          <select name="action_1" id="action_1">
            <option selected>Add</option>
            <option>Remove</option>
          </select>
        </span>  </td>

  
  
  
  <td width="10%" align="center" style='border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;padding:0in 1.0pt 0in 1.0pt;height:18.5pt'>
    <span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'>
          <select name="traffic_1" id="traffic_1">
            <option selected>Yes</option>
            <option>No</option>
          </select>
        </span>  </td>
  <td width="20%" align="center" style='border-top:none;border-left:none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black .5pt;mso-border-left-alt:solid black .5pt;mso-border-alt:solid black .5pt;padding:0in 1.0pt 0in 1.0pt;height:18.5pt'>
  <span style='text-align:center;font-size:8.0pt;color: #004b7b;font-family:Arial,Helvetica,sans-serif;'>
  <textarea name="comment_1" class='flext growme' cols="11" rows="1" required></textarea></span>  </td>
  
  
 
 </tr>
 
  
</table>
<br />
<span style='text-align:left;font-size:10.0pt;font-family:Arial,Helvetica,sans-serif;'>Please enter any additional comments: 
<textarea  name="comment_other" class='flext growme' cols="60" rows="2"required></textarea></span>
<p class=Default align=center style='text-align:center'><b><span style='color:windowtext'>
<input type="submit" name ="submit" value ="Next">
<input type="reset" name="Clear">
<input type="hidden" name="oncethrough" value="Yes">
<input type="hidden" name="netID" value="<? echo $netid; ?>" />
  </div>	
  </form> <? } ?>
	</div>

	<div id="footer">
		<div class="left"><a href="http://www.georgetown.edu/">Georgetown University</a> | <a href="http://uis.georgetown.edu/">University Information Services</a></div>
		<div class="right"><a href="http://security.georgetown.edu/8933.html">Contact Us</a> | <a href="http://search.georgetown.edu/">Search</a> | <a href="http://explore.georgetown.edu/sites/">Site Index</a> | <a href="http://security.georgetown.edu/8934.html">About <abbr title="University Information Security Office">UISO</abbr></a></div>
		</div>
	</body>
</html> 

