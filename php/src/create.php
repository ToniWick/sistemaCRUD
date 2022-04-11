<?php
require_once "config.php";
 
$username = $correo = $celular = "";
$username_err = $correo_err = $celular_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $input_username = trim($_POST["username"]);
    if(empty($input_username)){
        $username_err = "Ingresar un nombre";
    } elseif(!filter_var($input_username, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $username_err = "Ingresar nombre valido";
    } else{
        $username = $input_username;
    }
    
    $input_correo = trim($_POST["correo"]);
    if(empty($input_correo)){
        $correo_err = "Ingresar dirección de correo";     
    } else{
        $correo = $input_correo;
    }
    
    $input_celular = trim($_POST["celular"]);
    if(empty($input_celular)){
        $celular_err = "Ingresar tu numero de celular";     
    } elseif(!ctype_digit($input_celular)){
        $celular_err = "No ingresar numeros negativos";
    } else{
        $celular = $input_celular;
    }
    
    if(empty($username_err) && empty($correo_err) && empty($celular_err)){
        $sql = "INSERT INTO cliente (username, correo, celular) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_correo, $param_celular);
            
            $param_username = $username;
            $param_correo = $correo;
            $param_celular = $celular;
            
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
    <title>Ingresar empleado</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Agregar Cliente</h2>
                    <p>Ingresa los siquientes datos para agregar a tu empleado</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'Invalido' : ''; ?>" value="<?php echo $username; ?>">
                            <span class="Invalido"><?php echo $username_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Correo electrónico</label>
                            <textarea name="correo" class="form-control <?php echo (!empty($correo_err)) ? 'Invalido' : ''; ?>"><?php echo $correo; ?></textarea>
                            <span class="Invalido"><?php echo $correo_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Salario</label>
                            <input type="text" name="celular" class="form-control <?php echo (!empty($celular_err)) ? 'Invalido' : ''; ?>" value="<?php echo $celular; ?>">
                            <span class="Invalido"><?php echo $celular_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>