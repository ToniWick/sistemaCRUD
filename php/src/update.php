<?php
require_once "config.php";
 
$username = $correo = $celular = "";
$username_err = $correo_err = $celular_err = "";
 
if(isset($_POST["id"]) && !empty($_POST["id"])){
    $id = $_POST["id"];
    
    $input_username = trim($_POST["username"]);
    if(empty($input_username)){
        $username_err = "Ingresa un nombre valido";
    } elseif(!filter_var($input_username, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $username_err = "Ingresa un nombre valido";
    } else{
        $username = $input_username;
    }
    
    $input_correo = trim($_POST["correo"]);
    if(empty($input_correo)){
        $correo_err = "Ingresa un correo valido";     
    } else{
        $correo = $input_correo;
    }
    
    $input_celular = trim($_POST["celular"]);
    if(empty($input_celular)){
        $celular_err = "Ingresa un salario valido";     
    } elseif(!ctype_digit($input_celular)){
        $celular_err = "Ingresa un salario valido";
    } else{
        $celular = $input_celular;
    }
    
    if(empty($username_err) && empty($correo_err) && empty($celular_err)){
        $sql = "UPDATE cliente SET username=?, correo=?, celular=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sssi", $param_username, $param_correo, $param_celular, $param_id);
            
            $param_username = $username;
            $param_correo = $correo;
            $param_celular = $celular;
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                header("location: index.php");
                exit();
            } else{
                echo "Intentalo más tarde";
            }
        }
         
        mysqli_stmt_close($stmt);
    }
    
    mysqli_close($link);
} else{
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        $id =  trim($_GET["id"]);
        
        $sql = "SELECT * FROM cliente WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    $username = $row["username"];
                    $correo = $row["correo"];
                    $celular = $row["celular"];
                } else{
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Intentalo más tarde";
            }
        }
        
        mysqli_stmt_close($stmt);
        
        mysqli_close($link);
    }  else{
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Actualizar información</title>
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
                    <h2 class="mt-5">Actualizar información</h2>
                    <p>Edita la información de tu empleado</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'Invalido' : ''; ?>" value="<?php echo $username; ?>">
                            <span class="Invalido"><?php echo $username_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Correo</label>
                            <textarea name="correo" class="form-control <?php echo (!empty($correo_err)) ? 'Invalido' : ''; ?>"><?php echo $correo; ?></textarea>
                            <span class="Invalido"><?php echo $correo_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Salario</label>
                            <input type="text" name="celular" class="form-control <?php echo (!empty($celular_err)) ? 'Invalido' : ''; ?>" value="<?php echo $celular; ?>">
                            <span class="Invalido"><?php echo $celular_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>