<? session_start(); ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Contact . Allison Hart . Oklahoma Attorney</title>
			<meta charset="utf-8">
			<link rel="stylesheet" href="static/styles.css" type="text/css">
			<?php include "static/analytics.php" ?>
			<?php include "static/meta.php" ?>
	</head>
		<body>
			<header>
				<div id="top">
					<div id="top-center">
						<div class="social">
						<br>
						</div>
							<nav>
							<ul>
								<li><a href="index.php">Home</a></li>
								<li><a href="profile.php">Profile</a></li>
								<li><a href="practice.php">Practice</a></li>
								<li><a id="active" href="contact.php">Contact</a></li>
							</ul>
							</nav>
					</div>
				</div>
					<div id="skyline">
						<a href="index.php">Allison Hart</a>
						<span class="tagline">Attorney at Law</span>
					</div>
			</header>
				<div class="columns">
					<div class="column-1">
						<i class="fa fa-map-marker fa-2x h1"></i><h1>Map</h1>
						<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12995.531761289427!2d-97.524262!3d35.48244!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xe66b4e4bdbbe6517!2sHart+Law+Firm!5e0!3m2!1sen!2sus!4v1433278822979" width="250" height="250" style="border:0;"></iframe>
						</div>
							<div class="column-2">
							<i class="fa fa-info-circle fa-2x h1"></i><h1>Office Information</h1>
							<h2>701 NW 13th Street
							<br>
							Oklahoma City, OK 73103</h2>
							<br>
							<ul>
								<li><i class="fa fa-phone fa-lg"></i>   Phone: <a href="tel:4053406340">(405) 340-6340</a></li>
								<li><i class="fa fa-fax fa-lg"></i>     Fax: (405) 604-9054</li>
								<li><i class="fa fa-envelope-o fa-lg"></i>   Email: <a href="mailto:allison@hartlawfirm.org">allison@hartlawfirm.org</a>
							</ul>
							</div>
								<div class="column-3">
								<i class="fa fa-clock-o fa-2x h1"></i><h1>In a hurry?</h1>
								<p>Maybe you called and we were not able to speak with you at that very moment. No problem! Use the form below and shoot us a quick message so we can get started working on your case.</p>
								</div>
				</div>
					<form method="post" action="contact.php">
					<div class="columns new">
						<div class="column-1">
						<?php
						function testInput($data)
						{
							$data = trim($data);
							$data = stripslashes($data);
							$data = htmlspecialchars($data);
							
							return $data;
						}
											
						function keepValue($value)
						{
							if(isset($_POST[$value]))
							{
								testInput($_POST[$value]);
								echo $_POST[$value];
							}
						}
						?>
						<h2>How can we reach you?</h2>
						<input type="text" name="firstName" value="<? keepValue('firstName') ?>" maxlength="255" placeholder="First Name (required)" required>
						<input type="text" name="lastName" value="<? keepValue('lastName') ?>" maxlength="255" placeholder="Last Name (required)" required>
						<input type="email" name="email" value="<? keepValue('email') ?>" maxlength="255" placeholder="Email Address (required)" required>
						<input type="tel" name="phone" value="<? keepValue('phone') ?>" maxlength="10" placeholder="Phone Number (ex. 1234567890)">
						</div>
							<div class="column-2">
							<h2>Where do you need us?</h2>
							<input type="text" name="referral" value="<? keepValue('referral') ?>" maxlength="255"  placeholder="How did you find us?">
							<input type="text" name="county" value="<? keepValue('county') ?>" maxlength="255" placeholder="What county has juridiction on your case?">
							<br><br>
							</div>
								<div class="column-3">
								<h2>What are your legal needs?</h2>
								<textarea name="message" placeholder="Briefly describe how we can help. (required)" required><? keepValue('message') ?></textarea>
								<img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image">
								<input type="text" name="captcha_code" size="10" maxlength="6" />
								<p><a href="#" onclick="document.getElementById('captcha').src = '/securimage/securimage_show.php?' + Math.random(); return false">Refresh Image</a></p>
								<input type="submit" name="sendMessage" value="Send Message">
								</form>
								<?php
								$firstName = $lastName = $email = $phone = $referral = $county = $message = "";
								
								if($_SERVER['REQUEST_METHOD'] == "POST")
								{
									$firstName = $_POST['firstName']; // Required
									$lastName = $_POST['lastName']; // Required
									$email = $_POST['email']; // Required
									$phone = $_POST['phone'];
									$referral = $_POST['referral'];
									$county = $_POST['county'];
									$message = $_POST['message']; // Required
									
									include_once $_SERVER['DOCUMENT_ROOT'] . '/securimage/securimage.php';
									$securimage = new Securimage();
									
									if(empty($firstName) or empty($lastName) or empty($email) or empty($message))
									{
										echo '<p class="error">Please fill all required fields on this form.</p>';
									}
									else
									{
										if ($securimage->check($_POST['captcha_code']) == false) {
											echo '<p class="error">The security code entered was incorrect.</p>';
											exit;
										}

										$firstname = testInput($firstName);
										$lastName = testInput($lastName);
										$email = testInput($email);
										$phone = testInput($phone);
										$referral = testInput($referral);
										$county = testInput($county);
										$message = testInput($message);
														
										$fullName = $firstName . ' ' . $lastName;
										$message = wordwrap($message, 70);
										
										$to = "allison@hartlawfirm.org";
										$subject = "A Message From Your Web Site";
										
										$body = '<html><body>
										<h1>A Message From Your Web Site</h1>
										<p><strong>From:</strong> ' . $fullName . '</p>
										<p><strong>Email:</strong> ' . $email . '</p>
										<p>' . $message . '</p>
										</body></html>
										';
										
										$headers = "MIME-Version: 1.0\r\n";
										$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
														
										if(mail($to, $subject, $body, $headers))
										{
											echo '<p class="success">Your message was sent.</p>';
											echo '<meta http-equiv="refresh" content="10">';
										}
										else
										{
											echo '<p class="error">There was an error sending your message.</p>';
										}
						
									}
								}
								?>
								</div>
					</div>
						<footer>
						<?php include "static/footer.php" ?>
						</footer>
		</body>
</html>