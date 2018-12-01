<?php
 session_start();
?>

<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$nombre = $descripcion = $cantidad = "";
$name_err = $address_err = $salary_err = "";

    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT P.nombre as Nombre,P.descripcion as Descripcion, P.cantidad as Cantidad, P.precio as Precio, C.nomcat as Categoria, PR.nombre as Proveedor FROM productos P INNER JOIN categorias C on P.idcat = C.id INNER JOIN 
        proveedor PR on PR.codigo = P.idprov WHERE P.codigo = ?";
        if($stmt = mysqli_prepare($db, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id); 
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $nombre = $row["Nombre"];
                    $descripcion = $row["Descripcion"];
                    $cantidad = $row["Cantidad"];
					$precio = $row["Precio"];
                    $categoria = $row["Categoria"];
                    $proveedor = $row["Proveedor"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($db);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Categories</title>
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

	<!-- navBar -->
	<div class="full-width navBar">
		<div class="full-width navBar-options">
			<i class="zmdi zmdi-more-vert btn-menu" id="btn-menu"></i>	
			<div class="mdl-tooltip" for="btn-menu">Menu</div>
			<nav class="navBar-options-list">
				<ul class="list-unstyle">
				
					<li class="btn-exit" id="btn-exit">
						<i class="zmdi zmdi-power"></i>
						<div class="mdl-tooltip" for="btn-exit">LogOut</div>
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
					Cuenta: <?php echo $_SESSION['usuario']; ?><br>
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
						<a href="products.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-view-dashboard"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								PRINCIPAL
							</div>
						</a>
					</li>
					
					
					
				</ul>
			</nav>
		</div>
	</section>
	<!-- pageContent -->
	<section class="full-width pageContent">
		<section class="full-width header-well">
			<div class="full-width header-well-icon">
				<i class="zmdi zmdi-label"></i>
			</div>
			<div class="full-width header-well-text">
				<p class="text-condensedLight">
					En esta sección podras ver los datos de un Producto.
				</p>
			</div>
		</section>

		<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
			<div class="mdl-tabs__tab-bar">
				<a href="#tabNewCategory" class="mdl-tabs__tab is-active">DATOS</a>
		 
			</div>

			
			<div class="mdl-tabs__panel is-active" id="tabNewCategory">
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--8-col-desktop mdl-cell--2-offset-desktop">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-tittle bg-primary text-center tittles">
							 Producto
							</div>
							<div class="full-width panel-content ">
								<form action = "categories.php" method="POST">
									<h5 class="text-condensedLight">Datos</h5>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input class="mdl-textfield__input"  name="Name" value="<?php echo $nombre; ?>" >
										<label class="mdl-textfield__label" for="NameCategory">Nombre</label>
										<span class="mdl-textfield__error">Invalid name</span>
									</div>
		
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input class="mdl-textfield__input" type="text"  name="direccion"  value="<?php echo $descripcion; ?>">
										<label class="mdl-textfield__label" for="descriptionCategory">Descripción</label>
										<span class="mdl-textfield__error">Invalid descripción</span>
									</div>

                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input class="mdl-textfield__input" type="text"  name="tel" value="<?php echo $cantidad; ?> ">
										<label class="mdl-textfield__label" for="descriptionCategory">Cantidad</label>
										<span class="mdl-textfield__error">Invalid descripción</span>
									</div>

<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input class="mdl-textfield__input" type="text"  name="correo"  value="<?php echo $precio; ?>">
										<label class="mdl-textfield__label" for="descriptionCategory">Precio</label>
										<span class="mdl-textfield__error">Invalid descripción</span>
									</div>

									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input class="mdl-textfield__input" type="text"  name="web"  value="<?php echo $categoria; ?>">
										<label class="mdl-textfield__label" for="descriptionCategory">Categoria</label>
										<span class="mdl-textfield__error">Invalid descripción</span>
									</div>

                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input class="mdl-textfield__input" type="text"  name="web"  value="<?php echo $proveedor; ?>">
										<label class="mdl-textfield__label" for="descriptionCategory">Proveedor</label>
										<span class="mdl-textfield__error">Invalid descripción</span>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="mdl-tabs__panel" id="tabListCategory">
               <div class="mdl-grid">
					<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-tittle bg-primary text-center tittles">

								Lista de Categorías
						    </div>  

		
						</div>
					</div>
				</div>
			</div>

								
							
		</div>
	</section>
</body>
</html>