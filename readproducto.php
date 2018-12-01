 <?php
 
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM productos";
                    if($result = mysqli_query($db, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>ID</th>";
                                        echo "<th>Nombre</th>";
                                        echo "<th>Descripción</th>"; 
                                        echo "<th>Cantidad</th>"; 
                                        echo "<th>Precio</th>"; 
                                        echo "<th>Acción</th>"; 

                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['codigo'] . "</td>";
                                        echo "<td>" . $row['nombre'] . "</td>";
                                        echo "<td>" . $row['descripcion'] . "</td>";
                                        echo "<td>" . $row['cantidad'] . "</td>";
                                        echo "<td>" . $row['precio'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='mostrarproducto.php?id=". $row['codigo'] ."' title='Ver mas detalles del producto' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='modificarproducto.php?id=". $row['codigo'] ."' title='Modificar producto' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='deleteproducto.php?id=". $row['codigo'] ."' title='Eliminar producto' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                        
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