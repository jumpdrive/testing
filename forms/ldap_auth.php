
<?php 

if (strlen($_POST['netid']) != 0){
	$netid = $_POST['netid']; 
	
	$dn = "ou=people,dc=georgetown,dc=edu";
	$ldap_user = 'uid=UISOVPNReportingUIDMapping,ou=Specials,dc=georgetown,dc=edu';
        $ldap_pass = '7/xoFVeC1CAHOHL+n1NHhK5i15UPrk9v';
	$filter="(uid=$netid)";
	$justthese = array("cn", "guradiusprofile", "mail", "guntlmhash", "guprimaryaffiliation");

	$ds=ldap_connect("ldaps://directory.georgetown.edu");
	ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3) ;
    	$bound = ldap_bind($ds, $ldap_user, $ldap_pass);
	$sr=ldap_search($ds, $dn, $filter, $justthese);
	$info = ldap_get_entries($ds, $sr);
	$fullname = $info[0]['cn'][0];
	$guntlmhash = $info[0]['guntlmhash'][0];
	$email = $info[0]['mail'][0];
	$guradiusprofile = array_search("securewireless", $info[0]['guradiusprofile']);
	$securewireless = $info[0]['guradiusprofile'][$guradiusprofile];
	$guprimaryaffiliation = $info[0]['guprimaryaffiliation'][0];
	ldap_close($ds);
	
	if ($securewireless == "securewireless" && strlen($guntlmhash) != 0 && $bound){
		echo "You are authorized for SecureWireless!<br><br>";
		echo "<b>Name:</b> " . $fullname . "<br>";
		echo "<b>NetID:</b> " . $netid . "<br>";
		echo "<b>Affiliation:</b> " . $guprimaryaffiliation . "<br>";
		echo "<br>Click <a href='https://netid-mgmt.georgetown.edu/passwd/'>here</a> to reset your NetID Password!<br>";
		}
	else if ($securewireless == "securewireless" && strlen($guntlmhash) == 0 && $bound) {
		echo "You are authorized for SecureWirelss, but <b>you must change your password</b>!<br><br>";
		echo "<b>Name:</b> " . $fullname . "<br>";
		echo "<b>NetID:</b> " . $netid . "<br>";
		echo "<b>Affiliation:</b> " . $guprimaryaffiliation . "<br>";
		echo "<br>Click <a href='https://netid-mgmt.georgetown.edu/passwd/'>here</a> to reset your NetID Password!<br>";
		}
	else if (strlen($guntlmhash) != 0 && $bound){
		echo "You are <b>NOT</b> authorized for SecureWirelss, but you have changed your password!<br><br>";
		echo "<b>Name:</b> " . $fullname . "<br>";
		echo "<b>NetID:</b> " . $netid . "<br>";
		echo "<b>Affiliation:</b> " . $guprimaryaffiliation . "<br>";
		echo "<br>Click <a href='https://netid-mgmt.georgetown.edu/passwd/'>here</a> to reset your NetID Password!<br>";
		}
	else if (!$bound) { ?>
		<form name="ldap_auth" method="post">

		<h2 align="center"> NetID LDAP Auth </h2>

		<table align="center">
		<tr>
			<td></td>
			<td>Incorrect login, please try again!</td>
		</tr>
		<tr>
			<td> NetID: </td>
			<td> <input type="text" name="netid" id="netid" size="20" /> </td>
		</tr>
		<tr>
			<td> Password: </td>
			<td> <input type="password" name="password" id="password" size="20" /> </td>
		</tr>
		</table>
		<center><input type="submit" name="submit" value="Login"> </center> 

		</form>
		<?php }
}
else { ?>

<form name="ldap_auth" method="post">

<h2 align="center"> NetID LDAP Auth </h2>

<table align="center">
<tr>
	<td> NetID: </td>
	<td> <input type="text" name="netid" id="netid" size="20" /> </td>
</tr>
<tr>
	<td> Password: </td>
	<td> <input type="password" name="password" id="password" size="20" /> </td>
</tr>
</table>
<center><input type="submit" name="submit" value="Login"> </center> 

</form>

<?php
	}
	?>
