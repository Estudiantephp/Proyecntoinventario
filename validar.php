<?php
	session_start();


	ConsultarUsuario($_POST['username'], $_POST['password']);

	function ConsultarUsuario($usuario, $password)
	{
		include'config.php';
		$sentencia="SELECT * FROM cuentas WHERE usuario='".$usuario."' AND contrasena='".$password."' ";
		$resultado=$db->query($sentencia) or die ("Error al comprobar usuario: ".mysqli_error($db));

		$count = mysqli_num_rows($resultado); //Numero de filas del resultado de la consulta
		echo $count;
		if($count > 0) //si la variable count es mayor a 0
		{

			$row = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $tipo = $row["tipo"];

	        $_SESSION['tipo'] = $tipo;
			$_SESSION['usuario']=$usuario;

			if ($tipo=='Administrador'){
				echo '<script>';
				echo 'alert("Bienvenido Admin!!");';
				echo 'window.location.href="home.php";';
			echo '</script>';

			}else if ($tipo=='Cliente'){
				echo '<script>';
				echo 'alert("Bienvenido!!");';
				echo 'window.location.href="homecliente.php";';
			echo '</script>';

			}else {
					echo '<script>';
					echo 'alert("Bienvenido!!");';
					echo 'window.location.href="admin.php";';
				echo '</script>';
			}

			echo '<script>';
				echo 'alert("Bienvenido!!");';
				echo 'window.location.href="home.php";';
			echo '</script>';
		}
		else
		{
			echo '<script>';
				echo 'alert("Datos de acceso incorrectos");';
				echo 'window.location.href="index.php";';
			echo '</script>';
		}
	}
?>