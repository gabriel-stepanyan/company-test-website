
<!DOCTYPE HTML>  
<html>
	<head>
		<meta charset="UTF-8">
     	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<title>Contact</title>
		<!-- favicon -->
		<link rel="apple-touch-icon" sizes="180x180" href="icons/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="icons/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="icons/favicon-16x16.png">
		<link rel="manifest" href="icons/site.webmanifest">
		<!-- stylesheets -->
		<link rel="stylesheet" href="styles/main.css">
		<link rel="stylesheet" href="styles/general.css">
		<link rel="stylesheet" href="styles/sidebar.css">
		<link rel="stylesheet" href="styles/header.css">
		<link rel="stylesheet" href="styles/contacts.css?v=<?php echo time(); ?>">
		<!-- font -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
		<!-- js -->
		<script>
			function menuOnClick() {
			document.getElementById("menu-bar").classList.toggle("change");
			document.getElementById("nav").classList.toggle("change");
			document.getElementById("menu-bg").classList.toggle("change-bg");
		}
      </script>
	</head>
	<body>
		<div class="header">
			<div class="logo-container">
			<img class="logo" src="images/satria-logo.png">
			</div>
		</div>
		<input type="checkbox" class="openSidebarMenu" id="openSidebarMenu">
		<label for="openSidebarMenu" class="sidebarIconToggle">
			<div class="spinner diagonal part-1"></div>
			<div class="spinner horizontal"></div>
			<div class="spinner diagonal part-2"></div>
		</label>

		<div id="sidebarMenu">
			<ul class="sidebarMenuInner">
			<li><a href="index.html">Начало</a></li>
			<li><a href="about.html">За нас</a></li>
			<li><a href="gallery.html">Галерия</a></li>
			<li><a href="contact.php">Контакти</a></li>
			</ul>
		</div>	

		<?php
		// define variables and set to empty values
		$nameErr = $surnameErr = $emailErr = $msgErr = "";
		$name = $surname = $email = $message = "";

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST["name"])) {
				$nameErr = "*Моля, въведете името си.";
			} else {
				$name = test_input($_POST["name"]);
				// check if name only contains letters and whitespace
				if (!preg_match("/^[а-яa-zА-ЯA-Z-' ]*$/",$name)) {
					$nameErr = "*Допуска се употреба само на букви.";
				}
			}
		
			if (empty($_POST["surname"])) {
				$surnameErr = "*Моля, въведете фамилията си.";
			} else {
				$surname = test_input($_POST["name"]);
				// check if name only contains letters and whitespace
				if (!preg_match("/^[а-яa-zА-ЯA-Z-' ]*$/",$surname)) {
					$surnameErr = "*Допуска се употреба само на букви.";
				}
			}

			if (empty($_POST["email"])) {
				$emailErr = "*Моля, въведете имейл адреса си.";
			} else {
				$email = test_input($_POST["email"]);
				// check if e-mail address is well-formed
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$emailErr = "*Невалиден имейл формат.";
				}
			}
			
			if (empty($_POST["message"])) {
				$msgErr = "*Моля, въведете съобщението си.";
			} else {
				$message = test_input($_POST["message"]);
			}
		}

		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		?>

		

		<form class="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<h2>Свържете се с нас:</h2>
			<p><span class="error">* задължително поле</span></p>

			Име*: <input type="text" name="name" value="<?php echo $name;?>">
			<span class="error"> <?php echo $nameErr;?></span>
			<br><br>

			Фамилия*: <input type="text" name="surname" value="<?php echo $surname;?>">
			<span class="error"> <?php echo $surnameErr;?></span>
			<br><br>

			Имейл адрес*: <input type="text" name="email" value="<?php echo $email;?>">
			<span class="error"> <?php echo $emailErr;?></span>
			<br><br>

			Съобщение*: <textarea name="message" rows="5" cols="40"><?php echo $message;?></textarea>
			<span class="error"> <?php echo $msgErr;?></span>
			<br><br>

			<input type="submit" name="submit" value="Изпрати">

			<?php
				if (!empty($_POST["name"]) && !empty($_POST["surname"]) && !empty($_POST["email"]) && !empty($_POST["message"])) {
					echo "<br><br>Въведените от Вас данни: <br>";
					echo "Име: ", $name, "<br>";
					echo "Фамилия: ", $surname, "<br>";
					echo "Имейл адрес: ", $email, "<br>";
					echo "Съобщение: ", $message, "<br>";
					echo "Благодарим Ви за съобщението! Ще бъде прегледано при първа възможност.";
			}
			?>
		</form>
	</body>
</html>
