<?php
if (php_sapi_name() == 'cli') {
    $_SERVER["REQUEST_METHOD"] = 'CLI';
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => 'http://localhost/prunac/registros',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS =>
		'nombres=' . $_POST['nombres'] .
			'&apellidos=' . $_POST['apellidos'] .
			'&email=' . $_POST['email'],
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/x-www-form-urlencoded'
		),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	$datos = json_decode($response, true);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>API Modelo de Negocio</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

	<!-- JS, Popper.js, and jQuery -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

	<style>
		.container {
			display: flex;
			justify-content: center;
			align-items: center;


		}
	</style>

</head>

<body class="text-justify">

	<div class="container-fluid">
		<div class="row">
			<h1 class="col-xl-12 text-center">API Modelo de Negocio</h1>
			<h2 class="col-xl-12 text-center">Desarrolla aplicaciones con nosotros</h2>
			<h3 class="col-xl-12 text-center">Accede a nuestros servicios</h3>
			<div class="row col-xl-10 offset-1 alert alert-light">
				

			</div>

			<?php if ($_SERVER["REQUEST_METHOD"] == "POST") : ?>
				<div class="row col-xl-12 my-6">
					<div class="row col-xl-8 offset-2 bg-dark text-white font-weight-bold py-2">
						<?php print_r($datos['Detalle']); ?>
					</div>
					<div class="row col-xl-8 offset-2 bg-success text-white font-weight-bold py-2">
						<?php print_r("Cliente_id: " . $datos['credenciales']['cliente_id']); ?>
					</div>
					<div class="row col-xl-8 offset-2 bg-info text-white font-weight-bold py-2">
						<?php print_r("Llave secreta: " . $datos['credenciales']['llave_secreta']); ?>
					</div>
				</div>

			<?php endif ?>

			<div class=" col-xl-10 offset-1">

				<h3 class="col-xl-12 text-center">Solicitud de Acceso a Datos</h3>
				<div class="container">
					<form method="post" class="col-xl-8 center">
						<div class="form-group">
							<input type="text" name="nombres" placeholder="Nombres" class="form-control" required>
						</div>
						<div class="form-group">
							<input type="text" name="apellidos" placeholder="Apellidos" class="form-control" required>
						</div>
						<div class="form-group">
							<input type="email" name="email" placeholder="E-mail" class="form-control" required>
						</div>
						<button type="submit" class="btn btn-success registrar">Registrar</button>
					</form>
				</div>
			</div>



		</div>
	</div>
</body>

</html>
