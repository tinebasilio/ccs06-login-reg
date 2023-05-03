<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registration</title>
	<script src="user-validation.js"></script>
</head>
<body>
<h1>Register a User</h1>

<form  action="save-registration.php" method="POST" onsubmit="return validateUserInput()">
	<div>
		<label>First Name:</label>
		<input type="text" name="first_name" placeholder="First Name" required />	
	</div>
	<div>
		<label>Middle Name:</label>
		<input type="text" name="middle_name" placeholder="Middle Name"  />	
	</div>
	<div>
		<label>Last Name:</label>
		<input type="text" name="last_name" placeholder="Last Name" required />	
	</div>
	<div>
		<label>Email Address:</label>
		<input type="email" name="email" placeholder="email@address.com" required />	
	</div>
	<div>
		<label>Password:</label>
		<input type="password" name="password" minlength="8" required />	
	</div>
	<div>
		<label>Confirm Password:</label>
		<input type="password" name="confirm_password" required />	
	</div>
	<div>
		<label>Birthdate:</label>
		<input type="date" name="birthdate" />	
	</div>
	<div>
		<label>Gender:</label>
		<select name="gender">
			<option value="male">Male</option>
			<option value="female">Female</option>
			<option value="other">Other</option>
		</select>
	</div>
	<div>
		<label>Address:</label>
		<input type="text" name="address" placeholder="Address"/>	
	</div>
	<div>
		<label>Contact Number:</label>
		<input type="text" name="contact_number" />	
	</div>

	<script>

		var password = document.getElementById("password")
  		, confirm_password = document.getElementById("confirm_password");

		// Check if password and confirm password match
		function validatePassword() {
  			if(password.value != confirm_password.value) {
      		confirm_password.setCustomValidity("Passwords don't match.");
   		} else {
      		confirm_password.setCustomValidity('');
   		}
		}

		password.onchange = validatePassword;
		confirm_password.onkeyup = validatePassword;

	</script>

	<div>
		<button>
			Register User
		</button>	
	</div>
</form>
</body>
</html>

