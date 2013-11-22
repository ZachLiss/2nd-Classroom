<?php
function get_user( $username ) {

	$db = new mysqli("localhost", "admin", "admin", "2nd_classroom_db") or die("Oooops");
	$result= $db->query("SELECT * FROM USERS WHERE USERS.username='$username'");
	if (!$result) {
   		print "Error - the query could not be executed";
		$error = $db->error;
		print "<p>" . $error . "</p>";
    		exit;
	}
	$num_rows = $result->num_rows;
	if($num_rows == 0){
		return FALSE;
	}
	else{
		$user = $result->fetch_object();
		if($user->password == ''){
			return FALSE;
		}
		else{
			return $user;
		}
	}
}

function sign_up ( $first_name, $last_name, $email, $username, $password){
	if(!validEmail($email)){
    		 return 3;
	}

	$db = new mysqli("localhost", "admin", "admin", "2nd_classroom_db") or die("Oooops");
	$result= $db->query("SELECT * FROM USERS WHERE USERS.username='$username' or USERS.email='$email'");
	if (!$result) {
   		print "Error - the query could not be executed";
		$error = $db->error;
		print "<p>" . $error . "</p>";
    		exit;
	}
	$num_rows = $result->num_rows;
	if($num_rows == 0){ // if no rows, then there is no user with that username or email, so insert.
		$result = $db->query("INSERT into USERS VALUES('$first_name', '$last_name', '$username', '$email', '$password')");
		if (!$result) {
   			print "Error - the query could not be executed";
			$error = $db->error;
			print "<p>" . $error . "</p>";
    			exit;
		}
		$error=0; // 0 means successful add of user.
	}
	else{
		$user = $result->fetch_object();
		if($user->username == $username){
			$error = 1; //1 means duplicate username
		}
		elseif($user->email == $email){
			$error = 2; //2 means duplicate email address
		}
	}
	return $error;
}


function validEmail($email)
{
   $isValid = true;
   $atIndex = strrpos($email, "@");
   if (is_bool($atIndex) && !$atIndex)
   {
   	  // '@' not found in entered address
      $isValid = false;
   }
   else
   {
      $domain = substr($email, $atIndex+1);
      $local = substr($email, 0, $atIndex);
      $localLen = strlen($local);
      $domainLen = strlen($domain);
      if ($localLen < 1 || $localLen > 64)
      {
         // local part length exceeded
         $isValid = false;
      }
      else if ($domainLen < 1 || $domainLen > 255)
      {
         // domain part length exceeded
         $isValid = false;
      }
      else if ($local[0] == '.' || $local[$localLen-1] == '.')
      {
         // local part starts or ends with '.'
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $local))
      {
         // local part has two consecutive dots
         $isValid = false;
      }
      else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
      {
         // character not valid in domain part
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $domain))
      {
         // domain part has two consecutive dots
         $isValid = false;
      }
      else if (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\","",$local)))
      {
         // character not valid in local part unless 
         // local part is quoted
         if (!preg_match('/^"(\\\\"|[^"])+"$/', str_replace("\\\\","",$local)))
         {
            $isValid = false;
         }
      }
      if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A")))
      {
         // domain not found in DNS
         $isValid = false;
      }
   }
   return $isValid;
}
?>

