<link rel="stylesheet" href="estilo.css">

<?php
    include './funciones.php';
    $conex = conectarBBDD();
    
    if (isset($_POST["entrar"])){
        $password = md5($_POST["pass"]);
        
        $result = $conex->prepare("Select * from usuario where Email=?");
        $result->bindParam("s", $_POST["email"]);
        $result->execute();
        
        $resultCon = $result;
       
        if (!$result->num_rows){
            $error_mail = "El usuario introducido no existe en al BD <br>";
        } else {
            $datos=$result->fetchObject();
            if ($datos->pass==$password){
                setcookie("Nombre",$datos->Nombre);
                setcookie("Apellidos",$datos->Apellidos);
                
                header("Location:index.php");
            }else{
                $error_pass ="La contraseña es incorrecta <br>";
            }
        }
             
    }
?>
<div class="login-container">
    
    <h2>Iniciar sesion</h2>
    
    <form action="" method="POST">
    
        Email: <input type="text" name="email"><br>
        Contraseña: <input type="text" name="pass"><br>
        <input type="submit" name="entrar" value="Entrar"><br>
    
    </form>
    
</div>
