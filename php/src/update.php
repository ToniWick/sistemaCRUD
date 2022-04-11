<?php
require_once "config.php";
 
$name = $address = $salary = "";
$name_err = $address_err = $salary_err = "";
 
if(isset($_POST["id"]) && !empty($_POST["id"])){
    $id = $_POST["id"];
    
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Ingresa un nombre valido";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Ingresa un nombre valido";
    } else{
        $name = $input_name;
    }
    
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Ingresa un correo valido";     
    } else{
        $address = $input_address;
    }
    
    $input_salary = trim($_POST["salary"]);
    if(empty($input_salary)){
        $salary_err = "Ingresa un salario valido";     
    } elseif(!ctype_digit($input_salary)){
        $salary_err = "Ingresa un salario valido";
    } else{
        $salary = $input_salary;
    }
    
    if(empty($name_err) && empty($address_err) && empty($salary_err)){
        $sql = "UPDATE cliente SET name=?, address=?, salary=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_address, $param_salary, $param_id);
            
            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;
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
                    
                    $name = $row["name"];
                    $address = $row["address"];
                    $salary = $row["salary"];
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
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'Invalido' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="Invalido"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Correo</label>
                            <textarea name="address" class="form-control <?php echo (!empty($address_err)) ? 'Invalido' : ''; ?>"><?php echo $address; ?></textarea>
                            <span class="Invalido"><?php echo $address_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Salario</label>
                            <input type="text" name="salary" class="form-control <?php echo (!empty($salary_err)) ? 'Invalido' : ''; ?>" value="<?php echo $salary; ?>">
                            <span class="Invalido"><?php echo $salary_err;?></span>
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