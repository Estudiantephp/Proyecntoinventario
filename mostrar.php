
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

	<!-- Notifications area -->
	<section class="full-width container-notifications">
		<div class="full-width container-notifications-bg btn-Notification"></div>
	    <section class="NotificationArea">
	        <div class="full-width text-center NotificationArea-title tittles">Notifications <i class="zmdi zmdi-close btn-Notification"></i></div>
	        <a href="#" class="Notification" id="notifation-unread-1">
	            <div class="Notification-icon"><i class="zmdi zmdi-accounts-alt bg-info"></i></div>
	            <div class="Notification-text">
	                <p>
	                    <i class="zmdi zmdi-circle"></i>
	                    <strong>Registrar nuevo admin</strong> 
	                    <br>
	                    <small>Just Now</small>
	                </p>
	            </div>
	        	<div class="mdl-tooltip mdl-tooltip--left" for="notifation-unread-1">Notification as UnRead</div> 
	        </a>
	        <a href="#" class="Notification" id="notifation-read-1">
	            <div class="Notification-icon"><i class="zmdi zmdi-cloud-download bg-primary"></i></div>
	            <div class="Notification-text">
	                <p>
	                    <i class="zmdi zmdi-circle-o"></i>
	                    <strong>New Updates</strong> 
	                    <br>
	                    <small>30 Mins Ago</small>
	                </p>
	            </div>
	            <div class="mdl-tooltip mdl-tooltip--left" for="notifation-read-1">Notification as Read</div>
	        </a>
	        <a href="#" class="Notification" id="notifation-unread-2">
	            <div class="Notification-icon"><i class="zmdi zmdi-upload bg-success"></i></div>
	            <div class="Notification-text">
	                <p>
	                    <i class="zmdi zmdi-circle"></i>
	                    <strong>Archive uploaded</strong> 
	                    <br>
	                    <small>31 Mins Ago</small>
	                </p>
	            </div>
	            <div class="mdl-tooltip mdl-tooltip--left" for="notifation-unread-2">Notification as UnRead</div>
	        </a> 
	        <a href="#" class="Notification" id="notifation-read-2">
	            <div class="Notification-icon"><i class="zmdi zmdi-mail-send bg-danger"></i></div>
	            <div class="Notification-text">
	                <p>
	                    <i class="zmdi zmdi-circle-o"></i>
	                    <strong>New Mail</strong> 
	                    <br>
	                    <small>37 Mins Ago</small>
	                </p>
	            </div>
	            <div class="mdl-tooltip mdl-tooltip--left" for="notifation-read-2">Notification as Read</div>
	        </a>
	        <a href="#" class="Notification" id="notifation-read-3">
	            <div class="Notification-icon"><i class="zmdi zmdi-folder bg-primary"></i></div>
	            <div class="Notification-text">
	                <p>
	                    <i class="zmdi zmdi-circle-o"></i>
	                    <strong>Folder delete</strong> 
	                    <br>
	                    <small>1 hours Ago</small>
	                </p>
	            </div>
	            <div class="mdl-tooltip mdl-tooltip--left" for="notifation-read-3">Notification as Read</div>
	        </a>  
	    </section>
	</section>
	<!-- navBar -->
	<div class="full-width navBar">
		<div class="full-width navBar-options">
			<i class="zmdi zmdi-more-vert btn-menu" id="btn-menu"></i>	
			<div class="mdl-tooltip" for="btn-menu">Menu</div>
			<nav class="navBar-options-list">
				<ul class="list-unstyle">
					<li class="btn-Notification" id="notifications">
						<i class="zmdi zmdi-notifications"></i>
						<!-- <i class="zmdi zmdi-notifications-active btn-Notification" id="notifications"></i> -->
						<div class="mdl-tooltip" for="notifications">Notificaciones</div>
					</li>
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
						<a href="admin.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-view-dashboard"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								Volver al Administrador
							</div>
						</a>
				</ul>
			</nav>
		</div>
	</section>


<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$nombre = $apellido = $fecha = "";
$name_err = $address_err = $salary_err = "";
 
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

    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM cuentas WHERE codigo = ?";
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
                    $nombre = $row["nombre"];
                    $apellido = $row["apellido"];
                    $telefono = $row["telefono"];
                    $correo = $row["correo"];
                    $direccion = $row["direccion"];
                    $usuario = $row["usuario"];
                    $contrasena = $row["contrasena"];
                    $tipo = $row["tipo"];
                 
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



	<!-- pageContent -->
	<section class="full-width pageContent">
		<section class="full-width header-well">
			<div class="full-width header-well-icon">
				<i class="zmdi zmdi-account"></i>
			</div>
			<div class="full-width header-well-text">
				<p class="text-condensedLight">
					Esta sección nos permite Mostrar todos los datos de un usuario.
				</p>
			</div>
		</section>
		<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
			<div class="mdl-tabs__tab-bar">
				<a href="#tabNewAdmin" class="mdl-tabs__tab is-active">Ver</a>
				
			</div>
			
			<div class="mdl-tabs__panel is-active" id="tabNewAdmin">
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-tittle bg-primary text-center tittles">
								Datos del Usuario
							</div>
							<div class="full-width panel-content">

								<form action = "admin.php" method="POST">
									<div class="mdl-grid">
										<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
											<h5 class="text-condensedLight">Datos personales.</h5>
											
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="text" pattern="-?[A-Za-záéíóúÁÉÍÓÚ ]*(\.[0-9]+)?" name="NameAdmin"  value="<?php echo $nombre; ?> ">
												<label class="mdl-textfield__label" for="NameAdmin">Nombre</label>
												<span class="mdl-textfield__error">Invalid name</span>
											</div>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="text" pattern="-?[A-Za-záéíóúÁÉÍÓÚ ]*(\.[0-9]+)?" name="LastNameAdmin" value="<?php echo $apellido; ?>" >
												<label class="mdl-textfield__label" for="LastNameAdmin">Apellido</label>
												<span class="mdl-textfield__error">Invalid last name</span>
											</div>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="tel" pattern="-?[0-9+()- ]*(\.[0-9]+)?" name="phoneAdmin"  value="<?php echo $telefono; ?>">
												<label class="mdl-textfield__label" for="phoneAdmin">Teléfono</label>
												<span class="mdl-textfield__error">Invalid phone number</span>
											</div>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"> 
												<input class="mdl-textfield__input" type="email"  name="emailAdmin" value="<?php echo $correo; ?>">
												<label class="mdl-textfield__label" for="emailAdmin">Correo</label>
												<span class="mdl-textfield__error">Invalid E-mail</span>
											</div>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="text" name="addressAdmin" value="<?php echo $direccion; ?>"> 
												<label class="mdl-textfield__label" for="addressAdmin">Dirección</label>
												<span class="mdl-textfield__error">Invalid address</span>
											</div>
										</div>
										<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
											<h5 class="text-condensedLight">Credenciales.</h5>


                                            <div class="mdl-textfield mdl-js-textfield">
												<select class="mdl-textfield__input" type="text" name="tipo" value="<?php echo $tipo; ?>">
				
													<option value="Administrador">Administrador</option>
													<option value="Cliente">Cliente</option>
													<option value="Vendedor">Vendedor</option>
												</select>
											</div>
											
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="text" pattern="-?[A-Za-z0-9áéíóúÁÉÍÓÚ]*(\.[0-9]+)?" name="UserNameAdmin" value="<?php echo $usuario; ?>">
												<label class="mdl-textfield__label" for="UserNameAdmin">Usuario</label>
												<span class="mdl-textfield__error">Invalid user name</span>
											</div>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="password" name="passwordAdmin" value="<?php echo $contrasena; ?>">
												<label class="mdl-textfield__label" for="passwordAdmin">Contraseña</label>
												<span class="mdl-textfield__error">Invalid password</span>
											</div>
											<h5 class="text-condensedLight">Tu avatar</h5>
											<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
												<input type="radio" id="option-1" class="mdl-radio__button" name="options" value="avatar-male.png">
												<img src="assets/img/avatar-male.png" alt="avatar" style="height: 45px; width="45px;" ">
												<span class="mdl-radio__label">Avatar </span>
											</label>
											
										</div>
									</div>
									
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

								Lista de Usuarios
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
