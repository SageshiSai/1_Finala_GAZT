<?php
include_once("../Model/database/query.php");
include_once("../Model/trabajadorasModel.php");
include_once("../Model/librosModel.php");

if( isset($_POST["username"]) && isset($_POST["password"]) ){
    $name = $_POST["username"];
    $pass = $_POST["password"];
}


$expirado = false;

if( isset( $_POST["Entrar"] ) ){
    $boton = "Entrar";
} elseif(isset( $_POST["Cambiar"] ) && $_POST["Cambiar"] == "Cambiar_ph"){
    $boton = "Cambiar_ph";
} elseif(isset( $_POST["Cambiar"] ) && $_POST["Cambiar"] == "Cambiar Contraseña" ){
    $boton = "Cambiar";
} elseif(isset( $_POST["subir"] ) && $_POST["subir"]){
    $boton = "subir";
} elseif(isset( $_POST["Subir"] ) && $_POST["Subir"]){
    $boton = "Subir";
} elseif(isset( $_POST["lib_autor_ver"] ) && $_POST["lib_autor_ver"]){
    $boton = "lib_autor_ver";
} elseif(isset( $_POST["lib_editor_ver"] ) && $_POST["lib_editor_ver"]){
    $boton = "lib_editor_ver";
} elseif(isset( $_POST["publi_lib"] ) && $_POST["publi_lib"]){
    $boton = "publi_lib";
}


if ( !isset( $_COOKIE['name'] ) ) {
    if(!isset ( $_POST["Entrar"] ) && !isset( $_POST["Cambiar"] )){
        $_SESSION["validado"] = -1;
        header("location: ../index.php");
    }
}
    



switch ( $boton ) {
    case "Entrar":

        $_SESSION["validado"] = 0;

        $TrabajadorasModel = new TrabajadorasModel;

        $result = $TrabajadorasModel->verificarUsuario( $name, $pass );

        if( $result ){

            $expirado = false;
            $TrabajadorasModel->comprobarEditorAutor( $name );
            
        }
        echo $_SESSION["validado"];
        
        header("location: ../index.php");

        break;

    case "Cambiar":
        $TrabajadorasModel = new TrabajadorasModel;
        $result = $TrabajadorasModel->paraCambioContrasena( $name );
        if($name){

            if($result){
                $_SESSION["validado"]=2;
                $_SESSION["nombre_usuario"] = $name;
            } else{
                $_SESSION["validado"]=4;
            }
        }
        else {
            $_SESSION["validado"]=3;
        }
        
        header("location: ../index.php");
        break;

    case "Cambiar_ph": 

        $pass = $_POST["contra"];
        $TrabajadorasModel = new TrabajadorasModel;
        $result = $TrabajadorasModel->cambiarContrasena( $_SESSION["nombre_usuario"], $pass );
        if($result){
            $_SESSION["validado"]=5;
        } else {
            $_SESSION["validado"]=6;
        }
        header("location: ../index.php");
        break;
    
    case "subir":
        header("location: ../index.php?subir=1");

        break;
    case "Subir":
        $LibrosModel = new librosModel;
        $result = $LibrosModel->subirLibro($_POST["nombre"]);
        if($result){
            header("location: ../index.php?subido=1");
        } else {
            header("location: ../index.php?subido=0");
        }
        
        break;
    case "lib_autor_ver":
        header("location: ../index.php?lib_autor_ver=1");
        break;

    case "lib_editor_ver":
        header("location: ../index.php?lib_editor_ver=1");
        break;
    case "publi_lib":
        header("location: ../index.php?publi_lib=1");
        break;
    case "publicar": 
        
        break;
}