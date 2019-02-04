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

		<p>Aqui puedes <strong>modificar</strong> los datos de un paciente</p>

		<div>
            <form action="index.php?pagina=modificar" method="post">
                <div>
                    <label for="dniBuscar">Introduzca el dni</label>
                    <input type="text" id="dniBuscar" name="dniBuscar">
                </div>
                <br>
                <div>
                    <button type="submit" name="buscar">Enviar</i></button>
                </div>
            </form>

            <br><br><br><br>


            <form action="index.php?pagina=modificar" method="post">
                {{errores}}
                <div>
                    <label class=" {{class-nombre}}" for="nombre">nombre</label>
                    <input type="text" id="nombre" name="nombre"
                           value='<?php echo $val->restoreValue('nombre'); ?>'>
                    <span>{{war-nombre}}</span>
                </div>
                <br>
                <div>
                    <label class=" {{class-apellidos}}" for="apellidos">apellidos</label>
                    <input type="text" id="apellidos" name="apellidos"
                           value='<?php echo $val->restoreValue('apellidos'); ?>'>
                    <span>{{war-apellidos}}</span>
                </div>
                <br>
                <div>
                    <label class=" {{class-dni}}" for="dni">dni</label>
                    <input type="text" id="dni" name="dni"
                           value='<?php echo $val->restoreValue('dni'); ?>'>
                    <span>{{war-dni}}</span>
                </div>
                <br>
                <div>
                    <label class=" {{class-historial}}" for="historial">historial</label>
                    <input type="text" id="historial" name="historial"
                           value='<?php echo $val->restoreValue('historial'); ?>'>
                    <span>{{war-historial}}</span>
                </div>
                <br>
                <div>
                    <button type="submit" name="modificar">Modificar</i></button>
                </div>
            </form>


		</div>
	</body>
</html>