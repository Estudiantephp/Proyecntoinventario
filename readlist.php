 <?php
 
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM cuentas";
                    if($result = mysqli_query($db, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>ID</th>";
                                        echo "<th>Nombre</th>";
                                        echo "<th>Apellido</th>";
                                        echo "<th>Usuario</th>";
                                        echo "<th>Contraseña</th>";
                                        echo "<th>tipo</th>";
                                        echo "<th>Acción</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['codigo'] . "</td>";
                                        echo "<td>" . $row['nombre'] . "</td>";
                                        echo "<td>" . $row['apellido'] . "</td>";
                                        echo "<td>" . $row['usuario'] . "</td>";
                                        echo "<td>" . $row['contrasena'] . "</td>";
                                        echo "<td>" . $row['tipo'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='mostrar.php?id=". $row['codigo'] ."' title='Ver tods los datos' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='modificar.php?id=". $row['codigo'] ."' title='Modificar Usuario' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?id=". $row['codigo'] ."' title='Eliminar Usuario' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                        
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
                    }
 
                    // Close connection
                    mysqli_close($db);
                    ?>