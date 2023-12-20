<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Sign-up Form</title>
  <link rel="stylesheet" href="../../public/css/style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<!DOCTYPE html>
<html>
<head>
	<title>Slide Navbar</title>
	<link rel="stylesheet" type="text/css" href="slide navbar style.css">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>
:<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<form method="POST" action="../../app/controller/AuthController.php"  enctype="multipart/form-data" >
					<label for="chk" aria-hidden="true">Sign up</label>
					<input type="text" name="first_name" placeholder="First Name" required>
                    <input type="text" name="last_name" placeholder="Last Name" required>
					<input type="email" name="email" placeholder="Email" required>
					<input type="password" name="password" placeholder="Password" required>
					<input type="number" name="phone" placeholder="Phone Number" required>
					<button type="submit" name="submit-up" >Sign up</button>
				</form>
			</div>

		
	</div>
</body>
</html>
<!-- partial -->
  
</body>
</html>