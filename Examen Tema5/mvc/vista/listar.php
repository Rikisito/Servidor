<html>
	<head>
		<meta charset="UTF-8">
		<title>Listado de usuarios</title>
		<style>
			dl {
				padding-top: 50px;
			}
		</style>

        <link href="./mvc/vista/comun.css" rel="stylesheet" type="text/css"/>
    </head>
	<body>
		<?php
		include_once ("./mvc/vista/Menu.php");
		?>

        <p>Aqui puedes ver <strong>el listado</strong> de los pacientes que estan ingresados</p>

        {{lista}}

    </body>
</html>