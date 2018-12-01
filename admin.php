
<?php
 session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Administradores</title>
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
<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$nombre = $apellido = $telefono = "";
$name_err = $address_err = $salary_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["NameAdmin"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $nombre = $input_name;
    }
    
    // Validate apellido
    $imput_apellido = trim($_POST["LastNameAdmin"]);
    if(empty($imput_apellido)){
        $address_err = "Please enter an last name.";     
    } else{
        $apellido = $imput_apellido;
    }
    
    // Validate telefono
    $imput_telefono = trim($_POST["phoneAdmin"]);
    if(empty($imput_telefono)){
        $salary_err = "Please enter the salary amount.";     
    } else{
        $telefono = $imput_telefono;
    }
	
	// Validate email
    $imput_email = trim($_POST["emailAdmin"]);
    if(empty($imput_email)){
        $salary_err = "Please enter the salary amount.";     
    } else{
		$email = $imput_email;
	}
	
	// Validate direccion
	$imput_direccion = trim($_POST["addressAdmin"]);
    if(empty($imput_direccion)){
        $salary_err = "Please enter the salary amount.";     
    } else{
        $direccion = $imput_direccion;
	}
	
	// Validate tipo
    $imput_tipo = trim($_POST["tipo"]);
    if(empty($imput_tipo)){
        $salary_err = "Please enter the salary amount.";     
    } else{
        $tipo = $imput_tipo;
	}
	
	// Validate usuario
    $imput_usuario = trim($_POST["UserNameAdmin"]);
    if(empty($imput_usuario)){
        $salary_err = "Please enter the salary amount.";     
    } else{
        $usuario = $imput_usuario;
	}
	
	// Validate telefono
    $imput_pass = trim($_POST["passwordAdmin"]);
    if(empty($imput_pass)){
        $salary_err = "Please enter the salary amount.";     
    } else{
        $pass = $imput_pass;
    }



    // Check input errors before inserting in database
    if(empty($name_err) && empty($address_err) && empty($salary_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO cuentas (codigo, nombre, apellido, telefono, correo, direccion, usuario, contrasena, tipo) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($db, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssss", $param_id, $param_name, $pararm_lastname, $pararm_telefono, $pararm_correo, $pararm_direccion, $pararm_usuario, $pararm_contrasena, $pararm_tipo);
            
            // Set parameters
            $param_id = null;
            $param_name = $nombre;
            $pararm_lastname = $apellido;
            $pararm_telefono = $telefono;
			$pararm_correo = $email;
			$pararm_direccion = $direccion;
			$pararm_usuario = $usuario;
			$pararm_contrasena = $pass;
			$pararm_tipo = $tipo;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
				header("location: admin.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($db);
}
?>

	<!-- navBar -->
	<div class="full-width navBar">
		<div class="full-width navBar-options">
			<i class="zmdi zmdi-more-vert btn-menu" id="btn-menu"></i>	
			<div class="mdl-tooltip" for="btn-menu">Menu</div>
			<nav class="navBar-options-list">
				<ul class="list-unstyle">
					
					<li class="btn-exit" id="btn-exit">
						<i class="zmdi zmdi-power"></i>
						<div class="mdl-tooltip" for="btn-exit">Salir</div>
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
						<a href="home.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-view-dashboard"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								Principal
							</div>
						</a>
					</li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="#!" class="full-width btn-subMenu">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-case"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								ADMINISTRACIÓN
							</div>
							<span class="zmdi zmdi-chevron-left"></span>
						</a>
						<ul class="full-width menu-principal sub-menu-options">
			
							<li class="full-width">
								<a href="providers.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-truck"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										PROVEEDORES
									</div>
								</a>
							</li>
					
							<li class="full-width">
								<a href="categories.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-label"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										CATEGORIAS
									</div>
								</a>
							</li>
						</ul>
					</li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="#!" class="full-width btn-subMenu">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-face"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								ADMINISTRAR CUENTAS
							</div>
							<span class="zmdi zmdi-chevron-left"></span>
						</a>
						<ul class="full-width menu-principal sub-menu-options">
							<li class="full-width">
								<a href="admin.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-account"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										USUARIOS
									</div>
								</a>
							</li>
						</ul>
					</li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="products.php" class="full-width">
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
						<a href="sales.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-shopping-cart"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								VENTAS
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
				<i class="zmdi zmdi-account"></i>
			</div>
			<div class="full-width header-well-text">
				<p class="text-condensedLight">
					Esta sección nos permite control el de acceso a las distintas ventanas de nuestra pagina web.
				</p>
			</div>
		</section>
		<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
			<div class="mdl-tabs__tab-bar">
				<a href="#tabNewAdmin" class="mdl-tabs__tab is-active">NUEVO</a>
				<a href="#tabListAdmin" class="mdl-tabs__tab">LISTA</a>
			</div>
			
			<div class="mdl-tabs__panel is-active" id="tabNewAdmin">
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-tittle bg-primary text-center tittles">
								Nuevo Usuario
							</div>
							<div class="full-width panel-content">

								<form action = "admin.php" method="POST">
									<div class="mdl-grid">
										<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
											<h5 class="text-condensedLight">Ingresa los datos del nuevo usuario.</h5>
											
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="text" pattern="-?[A-Za-záéíóúÁÉÍÓÚ ]*(\.[0-9]+)?" name="NameAdmin">
												<label class="mdl-textfield__label" for="NameAdmin">Nombre</label>
												<span class="mdl-textfield__error">Invalid name</span>
											</div>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="text" pattern="-?[A-Za-záéíóúÁÉÍÓÚ ]*(\.[0-9]+)?" name="LastNameAdmin">
												<label class="mdl-textfield__label" for="LastNameAdmin">Apellido</label>
												<span class="mdl-textfield__error">Invalid last name</span>
											</div>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="tel" pattern="-?[0-9+()- ]*(\.[0-9]+)?" name="phoneAdmin">
												<label class="mdl-textfield__label" for="phoneAdmin">Teléfono</label>
												<span class="mdl-textfield__error">Invalid phone number</span>
											</div>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="email"  name="emailAdmin">
												<label class="mdl-textfield__label" for="emailAdmin">Correo</label>
												<span class="mdl-textfield__error">Invalid E-mail</span>
											</div>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="text" name="addressAdmin">
												<label class="mdl-textfield__label" for="addressAdmin">Dirección</label>
												<span class="mdl-textfield__error">Invalid address</span>
											</div>
										</div>
										<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
											<h5 class="text-condensedLight">Ventana para este usuario.</h5>


                                            <div class="mdl-textfield mdl-js-textfield">
												<select class="mdl-textfield__input" type="text" name="tipo">
													<option value="" selected="">Selecciona el tipo de cuenta</option>
													<option value="Administrador">Administrador</option>
													<option value="Cliente">Cliente</option>
													
												</select>
											</div>
											
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="text" pattern="-?[A-Za-z0-9áéíóúÁÉÍÓÚ]*(\.[0-9]+)?" name="UserNameAdmin">
												<label class="mdl-textfield__label" for="UserNameAdmin">Usuario</label>
												<span class="mdl-textfield__error">Invalid user name</span>
											</div>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="password" name="passwordAdmin">
												<label class="mdl-textfield__label" for="passwordAdmin">Contraseña</label>
												<span class="mdl-textfield__error">Invalid password</span>
											</div>
											<h5 class="text-condensedLight">Escoje tu avatar</h5>
											<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
												<input type="radio" id="option-1" class="mdl-radio__button" name="options" value="avatar-male.png">
												<img src="assets/img/avatar-male.png" alt="avatar" style="height: 45px; width="45px;" ">
												<span class="mdl-radio__label">Avatar 1</span>
											</label>
											<br><br>
											<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
												<input type="radio" id="option-2" class="mdl-radio__button" name="options" value="avatar-female.png">
												<img src="assets/img/avatar-female.png" alt="avatar" style="height: 45px; width="45px;" ">
												<span class="mdl-radio__label">Avatar 2</span>
											</label>
											<br><br>
											<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-3">
												<input type="radio" id="option-3" class="mdl-radio__button" name="options" value="avatar-male2.png">
												<img src="assets/img/avatar-male2.png" alt="avatar" style="height: 45px; width="45px;" ">
												<span class="mdl-radio__label">Avatar 3</span>
											</label>
											<br><br>
											<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-4">
												<input type="radio" id="option-4" class="mdl-radio__button" name="options" value="avatar-female2.png">
												<img src="assets/img/avatar-female2.png" alt="avatar" style="height: 45px; width="45px;" ">
												<span class="mdl-radio__label">Avatar 4</span>
											</label>
										</div>
									</div>
									<p class="text-center">
										<button type = "submit" value = "submit " class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary" id="btn-addAdmin">
											<i class="zmdi zmdi-plus"></i>
										</button>
										<div class="mdl-tooltip" for="btn-addAdmin">Añadir Usuario</div>
									</p>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>


			<div class="mdl-tabs__panel" id="tabListAdmin">

	        <div class="mdl-grid">
					<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-tittle bg-primary text-center tittles">

								Mantenimiento de Usuarios
								</div>  
							<?php include 'readlist.php';?>
							
		
						</div>
					</div>
				</div>
			</div>

 		</div>

	</section>
</body>

</html>
