<?php
@ob_start();
session_start();
if (isset($_POST['proses'])) {
	require 'config.php';

	$user = strip_tags($_POST['user']);
	$pass = strip_tags($_POST['pass']);

	$sql = 'SELECT member.*, login.user, login.pass
			FROM member 
			INNER JOIN login ON member.id_member = login.id_member
			WHERE user = ? AND pass = MD5(?)';
	$row = $config->prepare($sql);
	$row->execute(array($user, $pass));
	$jum = $row->rowCount();

	if ($jum > 0) {
		$hasil = $row->fetch();
		$_SESSION['admin'] = $hasil;
		echo '<script>window.location="index.php"</script>';
	} else {
		echo '<script>alert("Login Gagal");history.go(-1);</script>';
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>GigaCashier</title>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
	<style>
		body {
			font-family: 'Inter', sans-serif;
			background-color: #F9F8F5;
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
			margin: 0;
		}

		.login-container {
			text-align: center;
			background-color: #fff;
			padding: 50px 40px;
			border-radius: 16px;
			box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
			max-width: 400px;
			width: 100%;
		}

		.login-container h1 {
			color: #1C352D;
			font-weight: 700;
			margin-bottom: 10px;
			font-size: 2rem;
		}

		.login-container p {
			color: #33413C;
			font-size: 0.95rem;
			margin-bottom: 30px;
		}

		.form-group {
			text-align: left;
			margin-bottom: 20px;
		}

		label {
			display: block;
			font-weight: 500;
			color: #1C352D;
			margin-bottom: 6px;
		}

		.input-group {
			position: relative;
			display: flex;
			align-items: center;
		}

		.input-group i {
			position: absolute;
			left: 12px;
			color: #5A6A64;
			font-size: 1rem;
			pointer-events: none;
		}

		input[type="text"], input[type="password"] {
			width: 100%;
			padding: 12px 12px 12px 38px; /* Tambah padding kiri agar teks tidak menumpuk dengan ikon */
			border: 1px solid #ccc;
			border-radius: 8px;
			font-size: 0.95rem;
			color: #1C352D;
			background-color: #fff;
			outline: none;
			transition: border-color 0.3s ease;
		}

		input[type="text"]:focus, input[type="password"]:focus {
			border-color: #1C352D;
		}

		button {
			width: 100%;
			padding: 12px;
			background-color: #1C352D;
			border: none;
			color: #fff;
			border-radius: 10px;
			font-size: 1rem;
			font-weight: 600;
			cursor: pointer;
			transition: background-color 0.3s ease;
		}

		button:hover {
			background-color: #2D4A40;
		}
	</style>
</head>

<body>
	<div class="login-container">
		<h1>GigaCashier</h1>
		<p>Simplify transactions, monitor stock, and grow your business</p>

		<form method="POST">
			<div class="form-group">
				<label for="username">Username</label>
				<div class="input-group">
					<i class="fa fa-user"></i>
					<input type="text" id="username" name="user" placeholder="Username" required autofocus>
				</div>
			</div>

			<div class="form-group">
				<label for="password">Password</label>
				<div class="input-group">
					<i class="fa fa-lock"></i>
					<input type="password" id="password" name="pass" placeholder="Password" required>
				</div>
			</div>

			<button type="submit" name="proses">Login</button>
		</form>
	</div>
</body>
</html>
