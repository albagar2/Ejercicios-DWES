<?php
if (isset($_POST["entrar"])) {

    try {
        $con = new mysqli("localhost", "dwes", "abc123.", "explicaciones");
        $con->set_charset("utf8mb4");
        $resul = $con->query("SELECT * FROM usuarios WHERE email ='$_POST[email]'");
        if ($resul->num_rows) {
            $datos = $resul->fetch_object();
            if (password_verify($_POST["pass"], $datos->pass)) {
                setcookie("dni", $datos->DNI);
                setcookie("nombre", $datos->Nombre);
                setcookie("apellidos", $datos->Apellidos);
                header("Location:index.php");
            }
            } 
                $error_mail = "usuario y contraseña incorrectos";
        

        //$resul=$con->query("SELECT * FROM usuarios WHERE pass")
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}
?>
<form action="" method="POST">
    Email: <input type="text" name="email"><br>
    Contraseña: <input type="text" name="pass"><br>
    <input type="submit" name="entrar" value="Entrar"><br>
</form>
<?php if (isset($error_mail)) echo $error_mail; ?>
<?php

