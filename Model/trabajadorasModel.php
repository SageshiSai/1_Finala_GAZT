<?php

include_once("database/query.php");
include_once("librosModel.php");
class TrabajadorasModel {
    public function verificarUsuario($user, $pass){
        $result = select("personas_trabajadoras",$user,"Usuario");
        $results = "";
        if ($result) {
            $pass_hash = mysqli_result($result, 0, "Contraseña");
            $results = password_verify($pass, $pass_hash);
        }  

        if(isset($results) && $results != ""){
            if($results) {
                setcookie('name', $user, time() + (1 * 20), "/");
                echo "<script>alert('A iniciado sesion correctamente');</script>";
                return true;
            }
        } else {
            echo "<script>alert('El usuraio o la contraseña es incorrecta');</script>";
                return false;
        }
    }

    public function comprobarEditorAutor($user){
        $result = select("personas_trabajadoras",$user,"Usuario");
        $editor_autor = mysqli_result($result, 0, "Autor");
        $_SESSION["validado"] = $editor_autor;
        if($_SESSION["validado"] == 0 ) {
            $_SESSION["validado"] = 7;
        }
    }

    public function paraCambioContrasena($user){
        $result = select("personas_trabajadoras",$user,"Usuario");
        if($result) {
            $usuario = mysqli_result($result, 0, "Usuario");
            $_SESSION["nombre_usuario"] = $usuario;
            return true;
        } else {
            return false;
        }
    }


    public function cambiarContrasena($user, $pass){
        $pass_hash = password_hash($pass, PASSWORD_DEFAULT);

        $result = updateInjection("personas_trabajadoras", $pass_hash, "Usuario", $user);
        return $result;
    }
}
