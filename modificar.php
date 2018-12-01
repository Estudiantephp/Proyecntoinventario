
<?php
 session_start();
?>
<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$nombre = $apellido = $telefono = "";
$name_err = $address_err = $salary_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $nombre = $input_name;
    }
    
    // Validate apellido
    $imput_apellido = trim($_POST["address"]);
    if(empty($imput_apellido)){
        $address_err = "Please enter an address.";     
    } else{
        $apellido = $imput_apellido;
    }
    
    // Validate fecha
    $input_telefono = trim($_POST["telefono"]);
    if(empty($input_telefono)){
        $salary_err = "Please enter the salary amount.";     
    } else{
        $telefono = $input_telefono;
    }
	
	// Validate email
    $imput_email = trim($_POST["correo"]);
    if(empty($imput_email)){
        $salary_err = "Please enter the salary amount.";     
    } else{
		$correo = $imput_email;
	}
	
	// Validate direccion
	$imput_direccion = trim($_POST["direccion"]);
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
    $imput_usuario = trim($_POST["usuario"]);
    if(empty($imput_usuario)){
        $salary_err = "Please enter the salary amount.";     
    } else{
        $usuario = $imput_usuario;
	}
	
	// Validate telefono
    $imput_pass = trim($_POST["pass"]);
    if(empty($imput_pass)){
        $salary_err = "Please enter the salary amount.";     
    } else{
        $pass = $imput_pass;
    }


    // Check input errors before inserting in database
    if(empty($name_err) && empty($address_err) && empty($salary_err)){
        // Prepare an update statement
        $sql = "UPDATE cuentas SET  nombre=?, apellido=?, telefono=?, correo=?, direccion=?, usuario=?, contrasena=?, tipo=?  WHERE codigo=?";
         
        if($stmt = mysqli_prepare($db, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssi", $param_name, $param_apellido, $param_telefono, $pararm_correo, $pararm_direccion, $pararm_usuario, $pararm_contrasena, $pararm_tipo, $param_id);
            
            // Set parameters
            $param_name = $nombre;
            $param_apellido = $apellido;
            $param_telefono = $telefono;    
			$pararm_correo = $correo;
			$pararm_direccion = $direccion;
			$pararm_usuario = $usuario;
			$pararm_contrasena = $pass;
			$pararm_tipo = $tipo;
			$param_id = $id; 

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
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
} else{
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
					$pass = $row["contrasena"];
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
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Administradores</title>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/sweetalert2.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
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
	
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
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

    
	<section class="full-width pageContent">
		<section class="full-width header-well">
			<div class="full-width header-well-icon">
				<i class="zmdi zmdi-account"></i>
			</div>
			<div class="full-width header-well-text">
				<p class="text-condensedLight">
					Esta sección nos permite modificar los datos de un Usuario.
				</p>
			</div>
		</section>
		<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
			<div class="mdl-tabs__tab-bar">
				<a href="#tabNewAdmin" class="mdl-tabs__tab is-active">MODIFICAR</a>
				
			</div>
			<div class="full-width panel-tittle bg-primary text-center tittles">
								Modificar Usuario
							</div>


    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
				     <?php echo "<br>"; ?>
                    <p>Modifica los datos y dale a enviar.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $nombre; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Telefono</label>
                            <input type="text" name="telefono" class="form-control" value="<?php echo $telefono; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Correo</label>
                            <input type="text" name="correo" class="form-control" value="<?php echo $correo; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Correo</label>
                            <input type="text" name="direccion" class="form-control" value="<?php echo $direccion; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Usuario</label>
                            <input type="text" name="usuario" class="form-control" value="<?php echo $usuario; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Contraseña</label>
                            <input type="text" name="pass" class="form-control" value="<?php echo $pass; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                            <label>Apellido</label>
                            <textarea name="address" class="form-control"><?php echo $apellido; ?></textarea>
                            <span class="help-block"><?php echo $address_err;?></span>
                        </div>
						
						<div class="mdl-textfield mdl-js-textfield">
						<label>Tipo de cuenta:</label>
												<select class="mdl-textfield__input" type="text" name="tipo" >
													<option value="" selected=""><?php echo $tipo;?></option>
													<option value="Administrador">Administrador</option>
													<option value="Cliente">Cliente</option>
													<option value="Vendedor">Vendedor</option>
												</select>
											</div>

                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Enviar">
                        
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>