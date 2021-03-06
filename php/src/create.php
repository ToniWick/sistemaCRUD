<?php
require_once "config.php";
 
$username = $correo = $celular = "";    #Datos del usuario
$nombre = $pApellido = $sApellido = $nacimiento = "";   #Datos personales

#Variables de errores
$username_err = $correo_err = $celular_err = "";
$nombre_err = $pApellido_err = $sApellido_err = $nacimiento_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    #Usuario
    $input_username = trim($_POST["username"]);
    if(empty($input_username)){
        $username_err = "Ingresar un usuario";
    } else{
        $username = $input_username;
    }
    #Correo
    $input_correo = trim($_POST["correo"]);
    if(empty($input_correo)){
        $correo_err = "Ingresar dirección de correo";     
    } else{
        $correo = $input_correo;
    }
    #Nombre
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $username_err = "Ingresar un nombre";
    } elseif(!filter_var($input_nombre, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $username_err = "Ingresar un nombre valido";
    } else{
        $nombre = $input_nombre;
    }
    #Primer Apellido
    $input_pApellido = trim($_POST["pApellido"]);
    if(empty($input_pApellido)){
        $pApellido_err = "Ingresar un Apellido";
    } elseif(!filter_var($input_pApellido, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $pApellido_err = "Ingresar un Apellido Valido";
    } else{
        $pApellido = $input_pApellido;
    }
    #Segundo Apellido
    $input_sApellido = trim($_POST["sApellido"]);
    if(empty($input_sApellido)){
        $sApellido_err = "Ingresar un Apellido";
    } elseif(!filter_var($input_sApellido, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $sApellido_err = "Ingresar un Apellido Valido";
    } else{
        $sApellido = $input_sApellido;
    }
    #Celular
    $input_celular = trim($_POST["celular"]);
    if(empty($input_celular)){
        $celular_err = "Ingresar tu numero de celular";     
    } elseif(!ctype_digit($input_celular)){
        $celular_err = "No ingresar numeros negativos";
    } else{
        $celular = $input_celular;
    }
    #Nacimiento
    $input_nacimiento = trim($_POST["nacimiento"]);
    if(empty($input_nacimiento)){
        $nacimiento = $input_nacimiento;
    } else{
        $nacimiento = $input_nacimiento;
    }
    
    if(empty($username_err) && empty($correo_err) && empty($celular_err) && empty($nombre_err) && empty($pApellido_err) && empty($sApellido_err)){
        $sql = "INSERT INTO cliente (username, correo, celular, nombre, pApellido, sApellido, nacimiento) VALUES (?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sssssss", $param_username, $param_correo, $param_celular, $param_nombre, $param_pApellido, $param_sApellido, $param_nacimiento);
            
            $param_username = $username;
            $param_correo = $correo;
            $param_celular = $celular;
            $param_nombre = $nombre;
            $param_pApellido = $pApellido;
            $param_sApellido = $sApellido;
            $param_nacimiento = $nacimiento;
            
            if(mysqli_stmt_execute($stmt)){
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        mysqli_stmt_close($stmt);
    }
    
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ingresar cliente</title>
    <link rel="stylesheet" href="Estilo_1.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div id="cont1">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Agregar Cliente</h2>
                    <p>Ingresa los siquientes datos para agregar a tu cliente</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <input type="text" name="username" placeholder="Usuario" class="inputs <?php echo (!empty($username_err)) ? 'Invalido' : ''; ?>" value="<?php echo $username; ?>">
                            <span class="Invalido"><?php echo $username_err;?></span>
                        </div>
                        <div class="form-group">
                        
                            <textarea name="correo" placeholder="Correo electrónico" class="inputs <?php echo (!empty($correo_err)) ? 'Invalido' : ''; ?>"><?php echo $correo; ?></textarea>
                            <span class="Invalido"><?php echo $correo_err;?></span>
                        </div>
                        <div class="form-group">
                        
                            <input type="text" name="celular" placeholder="Celular" class="inputs <?php echo (!empty($celular_err)) ? 'Invalido' : ''; ?>" value="<?php echo $celular; ?>">
                            <span class="Invalido"><?php echo $celular_err;?></span>
                        </div>
                        <div class="form-group">
                        
                            <input type="text" name="nombre" placeholder="Nombre" class="inputs <?php echo (!empty($nombre_err)) ? 'Invalido' : ''; ?>" value="<?php echo $nombre; ?>">
                            <span class="Invalido"><?php echo $nombre_err;?></span>
                        </div>
                        <div class="form-group">
                        
                            <input type="text" name="pApellido" placeholder="Primer Apellido" class="inputs <?php echo (!empty($pApellido_err)) ? 'Invalido' : ''; ?>" value="<?php echo $pApellido; ?>">
                            <span class="Invalido"><?php echo $pApellido_err;?></span>
                        </div>
                        <div class="form-group">
                        
                            <input type="text" name="sApellido" placeholder="Segundo Apellido" class="inputs <?php echo (!empty($sApellido_err)) ? 'Invalido' : ''; ?>" value="<?php echo $sApellido; ?>">
                            <span class="Invalido"><?php echo $sApellido_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Nacimiento</label>
                            <input type="date" name="nacimiento" class="inputs <?php echo (!empty($nacimiento_err)) ? 'Invalido' : ''; ?>" value="<?php echo $nacimiento; ?>">
                            <span class="Invalido"><?php echo $nacimiento_err;?></span>
                        </div>
                        <input type="submit" id="reg" value="Submit">
                        <a href="index.php" id="borr">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>