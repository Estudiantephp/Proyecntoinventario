
<?php
 session_start();
?>

<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$nombre = $descripcion = $precio = $categoria = $proveedor ="";
$name_err = $address_err = $salary_err = "";
 

if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    

    // Validate name
    $input_name = trim($_POST["nombre"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $nombre = $input_name;
    }
        
        // Validate descripcion
        $imput_cantidad = trim($_POST["cantidad"]);
        if(empty($imput_cantidad)){
            $address_err = "Please enter an last name.";     
        } else{
            $cantidad = $imput_cantidad;
        }
    
        $imput_precio = trim($_POST["precio"]);
        if(empty($imput_precio)){
            $address_err = "Please enter an last name.";     
        } else{
            $precio = $imput_precio;
        }
        
        $imput_descrip = trim($_POST["descripcion"]);
        if(empty($imput_descrip)){
            $address_err = "Please enter an last name.";     
        } else{
            $descripcion = $imput_descrip;
        }
    
        $imput_cat = trim($_POST["categoria"]);
        if(empty($imput_cat)){
            $address_err = "Please enter an last name.";     
        } else{
            $categoria = $imput_cat;
        }
        
        $imput_prov = trim($_POST["proveedor"]);
        if(empty($imput_prov)){
            $address_err = "Please enter an last name.";     
        } else{
            $proveedor = $imput_prov;
        }

    // Check input errors before inserting in database
    if(empty($name_err) && empty($address_err) && empty($salary_err)){
        // Prepare an update statement
        $sql = "UPDATE productos SET nombre=?, descripcion=?, cantidad=?, precio=?, idcat=?, idprov=? WHERE codigo=?";
         
        if($stmt = mysqli_prepare($db, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssi", $param_name, $param_descrippcion, $param_cantidad, $param_precio, $param_cate, $param_prove, $param_id);
            
            // Set parameters
            $param_name = $nombre;
            $param_descrippcion = $descripcion;
            $param_cantidad = $cantidad;
            $param_precio= $precio;
            $param_cate = $categoria;
            $param_prove = $proveedor;     
		    $param_id = $id;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: products.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection

    
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = " SELECT P.nombre as Nombre,P.descripcion as Descripcion, P.cantidad as Cantidad, P.precio as Precio, C.nomcat as Categoria, PR.nombre as Proveedor FROM productos P INNER JOIN categorias C on P.idcat = C.id INNER JOIN 
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

        
        // Close connection
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
						<a href="products.php" class="full-width">
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
					Esta sección nos permite modificar los datos de un proveedor.
				</p>
			</div>
		</section>
		<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
			<div class="mdl-tabs__tab-bar">
				<a href="#tabNewAdmin" class="mdl-tabs__tab is-active">MODIFICAR</a>
				
			</div>
			<div class="full-width panel-tittle bg-primary text-center tittles">
								Modificar proveedor
							</div>


    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
				     <?php echo "<br>"; ?>
                    <p>Modifica los datos y dale a enviar.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input class="mdl-textfield__input" type="text" name="nombre"  value= "<?php echo $nombre; ?>">
										<label class="mdl-textfield__label" for="NameCategory">Nombre</label>
										<span class="mdl-textfield__error">Invalid name</span>
									</div>
		
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input class="mdl-textfield__input" type="text" name="descripcion" value= "<?php echo $descripcion; ?>">
										<label class="mdl-textfield__label">Dirección</label>
										<span class="mdl-textfield__error">Invalid descripción</span>
									</div>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input class="mdl-textfield__input" type="text"  name="cantidad" value= "<?php echo $cantidad; ?>">
										<label class="mdl-textfield__label" >Teléfono</label>
										<span class="mdl-textfield__error">Invalid descripción</span>
									</div>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input class="mdl-textfield__input" type="text"  name="precio" value= "<?php echo $precio; ?>" >
										<label class="mdl-textfield__label" >Correo</label>
										<span class="mdl-textfield__error">Invalid descripción</span>
									</div>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                    <select class="mdl-textfield__input" name="categoria"> 

<option value="0">Selecciona una Categoria:</option>
<?php
$sql = "SELECT * FROM categorias";
if($result = mysqli_query($db, $sql)){
if(mysqli_num_rows($result) > 0){

while($row = mysqli_fetch_array($result)){
echo '<option value="'.$row[id].'">'.$row[nomcat].'</option>';

 }
}
}
?>
</select> 

									
									</div>
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                    <select class="mdl-textfield__input" name="proveedor"> 
<option value="0">Selecciona un Proveedor</option>
<?php
$sql = "SELECT * FROM proveedor";
if($result = mysqli_query($db, $sql)){
if(mysqli_num_rows($result) > 0){

while($row = mysqli_fetch_array($result)){
echo '<option value="'.$row[codigo].'">'.$row[nombre].'</option>';

 }
}
}
?>
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