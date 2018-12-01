
<?php
 session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Principal</title>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/sweetalert2.css">
	<link rel="stylesheet" href="css/material.min.css">
	<link rel="stylesheet" href="css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
	<link rel="stylesheet" href="css/main.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')</script>
	<script src="js/material.min.js" ></script>
	<script src="js/sweetalert2.min.js" ></script>
	<script src="js/jquery.mCustomScrollbar.concat.min.js" ></script>
	<script src="js/main.js" ></script>
</head>
<body>
	<!-- Notifications area -->
	
	<!-- navBar -->
	<div class="full-width navBar">
		<div class="full-width navBar-options">
			<i class="zmdi zmdi-more-vert btn-menu" id="btn-menu"></i>	
			<div class="mdl-tooltip" for="btn-menu">Menú</div>
			<nav class="navBar-options-list">
				<ul class="list-unstyle">
					
					<li class="btn-exit" id="btn-exit" >
						<i class="zmdi zmdi-power"></i>
						<div class="mdl-tooltip" for="btn-exit">Cerrar Seción</div>
					</li>
					<li class="text-condensedLight noLink" ><small><?php echo $_SESSION['usuario']; ?></small></li>
					<li class="noLink">
						<figure>
							<img src="assets/img/avatar-male.png" alt="Avatar" class="img-responsive">
						</figure>
					</li>
				</ul>
			</nav>
		</div>
	</div>
	<!-- navLateral -->
	<section class="full-width navLateral">
		<div class="full-width navLateral-bg btn-menu"></div>
		<div class="full-width navLateral-body">
			<div class="full-width navLateral-body-logo text-center tittles">
				<i class="zmdi zmdi-close btn-menu"></i> Inventario
			</div>
			<figure class="full-width" style="height: 77px;">
				<div class="navLateral-body-cl">
					<img src="assets/img/avatar-male.png" alt="Avatar" class="img-responsive">
				</div>
				<figcaption class="navLateral-body-cr hide-on-tablet">
					<span>
					Bienvenido <?php echo $_SESSION['usuario']; ?><br>
						<small><?php echo $_SESSION['tipo']; ?> </small>
					</span>
				</figcaption>
			</figure>
			<div class="full-width tittles navLateral-body-tittle-menu">
				<i class="zmdi zmdi-desktop-mac"></i><span class="hide-on-tablet">&nbsp; DASHBOARD</span>
			</div>
			<nav class="full-width">
				<ul class="full-width list-unstyle menu-principal">
					<li class="full-width">
						<a href="homecliente.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-view-dashboard"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								PRINCIPAL
							</div>
						</a>
					</li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="clienteproducts.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-washing-machine"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								PRODUCTOS
							</div>
						</a>
					</li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="salescli.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-shopping-cart"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								PEDIDOS
							</div>
						</a>
					</li>
					<li class="full-width divider-menu-h"></li>
					
					<li class="full-width divider-menu-h"></li>
					
				</ul>
			</nav>
		</div>
	</section>
	<!-- pageContent -->
	<section class="full-width pageContent">
		<section class="full-width text-center" style="padding: 40px 0;">
			<h3 class="text-center tittles">Conteo por Seccíon</h3>
			<!-- Tiles -->
			<article class="full-width tile">
				<div class="tile-text">
					<span class="text-condensedLight">

      <?php
		include'config.php';
		$sentencia="SELECT * FROM cuentas where tipo='Administrador'";
		$resultado=$db->query($sentencia) or die ("Error al comprobar cantidad de administradores: ".mysqli_error($db));

		$count = mysqli_num_rows($resultado); //Numero de filas del resultado de la consulta

		if($count < 0) //si la variable count es mayor a 0
		{
			echo '<script>';
				echo 'alert("No hay usuarios administradores");';
			echo '</script>';
		}
	
    ?>

						<?php echo $count;?><br>
						<small>Administradores</small>
					</span>
				</div>
				<i class="zmdi zmdi-account tile-icon"></i>
			</article>
			<article class="full-width tile">
				<div class="tile-text">
					<span class="text-condensedLight">

					<?php
		$sentencia="SELECT * FROM cuentas where tipo='Cliente'";
		$resultado=$db->query($sentencia) or die ("Error al comprobar cantidad de administradores: ".mysqli_error($db));

		$countcli = mysqli_num_rows($resultado); //Numero de filas del resultado de la consulta

		if($countcli < 0) //si la variable count es mayor a 0
		{
			echo '<script>';
				echo 'alert("No hay usuarios administradores");';
			echo '</script>';
		}
	
    ?>
						<?php echo $countcli;?><br>
						<small>Clientes</small>
					</span>
				</div>
				<i class="zmdi zmdi-accounts tile-icon"></i>
			</article>
			<article class="full-width tile">
				<div class="tile-text">
					<span class="text-condensedLight">
					
					<?php
		$sentencia="SELECT * FROM proveedor";
		$resultado=$db->query($sentencia) or die ("Error al comprobar cantidad de administradores: ".mysqli_error($db));

		$countpro = mysqli_num_rows($resultado); //Numero de filas del resultado de la consulta

		if($count < 0) //si la variable count es mayor a 0
		{
			echo '<script>';
				echo 'alert("No hay proveedores registrados");';
			echo '</script>';
		}
	
    ?>



						<?php echo $countpro;?><br>
						<small>Proveedores</small>
					</span>
				</div>
				<i class="zmdi zmdi-truck tile-icon"></i>
			</article>
			<article class="full-width tile">
				<div class="tile-text">
					<span class="text-condensedLight">
					<?php
		$sentencia="SELECT * FROM categorias";
		$resultado=$db->query($sentencia) or die ("Error al comprobar cantidad de administradores: ".mysqli_error($db));

		$countcat = mysqli_num_rows($resultado); //Numero de filas del resultado de la consulta

		if($countcat < 0) //si la variable count es mayor a 0
		{
			echo '<script>';
				echo 'alert("No hay Categorias registradas");';
			echo '</script>';
		}
	
    ?>
						<?php echo $countcat;?><br>
						<small>Categorías</small>
					</span>
				</div>
				<i class="zmdi zmdi-label tile-icon"></i>
			</article>
			<article class="full-width tile">
				<div class="tile-text">
					<span class="text-condensedLight">
					<?php
		$sentencia="SELECT * FROM productos";
		$resultado=$db->query($sentencia) or die ("Error al comprobar cantidad de administradores: ".mysqli_error($db));

		$countpro = mysqli_num_rows($resultado); //Numero de filas del resultado de la consulta

		if($countpro < 0) //si la variable count es mayor a 0
		{
			echo '<script>';
				echo 'alert("No hay usuarios administradores");';
			echo '</script>';
		}
	
    ?>
						<?php echo $countpro;?><br>
						<small>Productos</small>
					</span>
				</div>
				<i class="zmdi zmdi-washing-machine tile-icon"></i>
			</article>
			<article class="full-width tile">
				<div class="tile-text">
					<span class="text-condensedLight">
						47<br>
						<small>Ventas</small>
					</span>
				</div>
				<i class="zmdi zmdi-shopping-cart tile-icon"></i>
			</article>
		</section>
		
	</section>
</body>
</html>

