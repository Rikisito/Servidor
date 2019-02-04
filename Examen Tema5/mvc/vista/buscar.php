<?php $val = Validacion::getInstance(); ?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>GESTION DE LA BASE DE DATOS DE USUARIOS</title>
		<style>
			form {
				padding-top: 10px;
			}

			.has-error {
				background: red;
				color: white;
				padding: 0.2em;
			}

			.has-warning {
				background: blue;
				color: white;
				padding: 0.2em;
			}
		</style>
		<link href="./mvc/vista/comun.css" rel="stylesheet" type="text/css"/>


	</head>
	<body>
		<?php
		include_once("./mvc/vista/Menu.php");
		?>

		<p>Aqui puedes <strong>buscar los pacientes</strong> por nombre, apellidos p dni</p>

		<div>
			<form action="index.php?pagina=buscar" method="post">
				{{errores}}
				<div>
					<label class=" {{class-campoBuscar}}" for="campoBuscar">Introduzca el dni o el nombre y/o apellidos</label>
					<input type="text" id="campoBuscar" name="campoBuscar"
						   value='<?php echo $val->restoreValue('campoBuscar'); ?>'>
					<span>{{war-campoBuscar}}</span>
				</div>
				<br>
				<div>
					<button type="submit" name="buscar">Buscar</i></button>
				</div>

                <div>
                    {{resultadoBuscar}}
                </div>
			</form>
		</div>
	</body>
</html>