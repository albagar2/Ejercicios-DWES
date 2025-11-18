<?php
if (isset($_POST["entrar"])){
    $password= md5($_POST["pass"]);
    try {
        $con=new mysqli("localhost","dwes","abc123.","explicaciones");
        $con->set_charset("utf8mb4");
        $resul=$con->query("SELECT * FROM usuarios WHERE email ='$_POST[email]'");
        if(!$resul->num_rows){
            $error_mail="El usuario introducido no existe en la BD";
        }else{
            $datos=$resul->fetch_object();
            if($datos->pass==$password){
                setcookie("dni",$datos->DNI);
                setcookie("nombre",$datos->Nombre);
                setcookie("apellidos",$datos->Apellidos);
                header("Location:index.php");
            }else{
                $error_pass="La contraseña introducida no es correcta";
            }
           
        }
        
        //$resul=$con->query("SELECT * FROM usuarios WHERE pass")
            
        
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}
?>
<form action="" method="POST">
    Email: <input type="text" name="email"><br><?php if (isset($error_mail)) echo $error_mail;?>
    Contraseña: <input type="text" name="pass"><br><?php if (isset($error_pass)) echo $error_pass;?>
    <input type="submit" name="entrar" value="Entrar"><br>
</form>
<?php

