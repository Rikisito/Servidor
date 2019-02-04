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

		<p>Aqui puedes <strong>eliminar el registro</strong> de un paciente</p>

		<div>
			<form action="index.php?pagina=altas" method="post">
				{{errores}}
				<div>
					<label class=" {{class-buscar}}" for="buscar">Introduzca el dni o el nombre y/o apellidos</label>
					<input type="text" id="buscar" name="buscar"
						   value='<?php echo $val->restoreValue('buscar'); ?>'>
					<span>{{war-buscar}}</span>
				</div>
				<br>
				<div>
					<button type="submit" name="altas">Enviar</i></button>
				</div>

                <div>
                    {{resultadoAltas}}
                </div>
			</form>
		</div>
	</body>
</html>