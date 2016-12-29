<?php
	if(!empty($_POST))
	{
		$conn = new PDO("mysql:host=localhost;dbname=test","root","samsung") or die("Could not connect");
		$name = $_POST["fullname"];
		$password = $_POST["password"];
		$email = $_POST["email"];
		$age = $_POST["age"];
		$phone = $_POST["phone"];
		
		/*Prepating Statement*/
		$stmt = $conn->prepare("INSERT INTO registration(name,password,age,email,phone) values(:name,:password,:age,:email,:phone)");
		$stmt->bindParam(":name",$name);
		$stmt->bindParam(":password",$password);
		$stmt->bindParam(":age",$age);
		$stmt->bindParam(":email",$email);
		$stmt->bindParam(":phone",$phone);
		
		$stmt->execute() or die("error while inserting");
		echo "<script>alert('registered')</script>";
		$conn = null;
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Registration Form</title>
		<style type="text/css">
			body
			{
				background-color: darkslategray;
				color:white;
			}
			label>input
			{
				background-color:cadetblue;
				border-radius: 10px;
				margin:0.5em;
				padding: 0.2em;
			}
			
			input[type="submit"]
			{
				background-color: limegreen;
				border:none;
				margin:0.5em;
				padding:0.2em;
			}
			
			input[type="submit"]:hover
			{
				cursor: pointer;
			}
			
			form
			{
				border:1px solid ;
				width:25%;
				padding:2em;
				margin:auto;
				z-index: 3;
				box-shadow: 10px 10px black;
			}
			
		</style>
		
		<script type="text/javascript">
			function validate(form)
			{
				var name= form.elements[0];
				var password = form.elements[1];
				var age= form.elements[2];
				var email=form.elements[3];
				var phone=form.elements[4];
				var check=true;
				for(var i=0; i<5;i++) //check for empty 
				{
					if(form.elements[i].value == "")
					{
						form.elements[i].style.borderColor = "red";
						form.elements[i].placeholder = "Fill this field";
						check = false;
					}
					
					else
					{
						form.elements[i].style.borderColor = "";
						form.elements[i].placeholder = "";
					}
				}
				
				if((isNaN(Number(age.value))) || (Number(age.value)>100)) //check wheather age is valid or not
				{
					age.style.borderColor = "red";
					alert("enter valid age");
					check = false;
				}
				
				if(isNaN(Number(phone.value))) //checking validy of phone number
				{
					phone.style.borderColor = "red";
					alert("enter valid phone number");
					check = false;
				}
				
				for(var i=0; i<5;i++) //removing red color of form elements
				{
					if(check)
					{
						form.elements[i].style.borderColor = "";
						form.elements[i].placeholder = "";
					}
				}
				return check;
			}
		</script>
	</head>
	<body>
		<form method="post" onsubmit="return validate(this)">
			<center><h2>Registration Form</h2></center>
			<label>
				Name: <input type="text" name="fullname"/>
			</label><br/>
			<label>
				Password: <input type="password" name="password"/>
			</label><br/>
			<label>
				Age: <input type="text" maxlength="3" name="age"/>	
			</label><br/>
			<label>
				e-mail: <input type="email" name="email"/>
			</label><br/>
			<label>
				Phone: <input type="text" maxlength="10" name="phone">
			</label><br/>
			<input type="submit" value="Register Now" /><br/>
		</form>
		
	</body>
</html>