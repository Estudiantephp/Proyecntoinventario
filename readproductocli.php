 <?php
 
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT P.codigo as Codigo ,P.nombre as Nombre,P.descripcion as Descripcion, P.cantidad as Cantidad, P.precio as Precio, C.nomcat as Categoria, PR.nombre as Proveedor FROM productos P INNER JOIN categorias C on P.idcat = C.id INNER JOIN 
                    proveedor PR on PR.codigo = P.idprov";
                    if($result = mysqli_query($db, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>ID</th>";
                                        echo "<th>Nombre</th>";
                                        echo "<th>Descripción</th>"; 
                                        echo "<th>Cantidad en Stock</th>"; 
                                        echo "<th>Precio</th>"; 
                                        echo "<th>Categoría</th>"; 
  
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['Codigo'] . "</td>";
                                        echo "<td>" . $row['Nombre'] . "</td>";
                                        echo "<td>" . $row['Descripcion'] . "</td>";
                                        echo "<td>" . $row['Cantidad'] . "</td>";
                                        echo "<td>" . $row['Precio'] . "</td>";
                                        echo "<td>" . $row['Categoria'] . "</td>";
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