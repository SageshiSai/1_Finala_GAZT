<?php 
include_once("View/Vista.php");
include_once("Model/librosModel.php");


if (!isset($_COOKIE['name']) && isset($_SESSION["validado"]) && !in_array($_SESSION["validado"], [-1, 2, 3, 4, 5, 6, 7])) {
    echo "<script>alert('La sesión ha expirado');</script>";
    session_destroy();
    header("Refresh:0");
}

if(!isset($_SESSION["validado"]) || in_array($_SESSION["validado"], [-1, 3, 4, 5, 6])){
    if(isset($_SESSION["validado"]) && $_SESSION["validado"] == -1){
        echo "<script>alert('La sesion a expirado helloda');</script>";
    } elseif(isset($_SESSION["validado"]) && $_SESSION["validado"] == 3) {
        echo "<script>alert('Para cambiar la contraseña al menos se necesita poner el nombre de usuario');</script>";
    } elseif(isset($_SESSION["validado"]) && $_SESSION["validado"] == 4) {
        echo "<script>alert('Nombre de Usuario no existe, vuelve a intentarlo');</script>";
    } elseif(isset($_SESSION["validado"]) && $_SESSION["validado"] == 5) {
        echo "<script>alert('Contraseña Cambiada correctamente');</script>";
    } elseif(isset($_SESSION["validado"]) && $_SESSION["validado"] == 6) {
        echo "<script>alert('No se pudo cambiar la contraseña, vuelve a intentarlo');</script>";
    }

    $vista = new Vista;
    $vista->Login();

} elseif( $_SESSION["validado"]==2 ){

    $vista = new Vista;
    $vista->cambiarContra();
    

} else {

    if($_SESSION["validado"]==7) {
        $vista = new Vista;
        $vista->area_editor();

        if( isset($_GET["lib_editor_ver"]) && $_GET["lib_editor_ver"]==1){
            $LibrosModel = new librosModel;
            $libros = $LibrosModel->recogerLibros();
            $vista->CrearTablaLibro($libros);
        }
        if( isset($_GET["publi_lib"]) && $_GET["publi_lib"]==1){
            $LibrosModel = new librosModel;
            $libros = $LibrosModel->recogerLibros();
            $vista->Libros($libros);
        }
        

    } elseif($_SESSION["validado"]==1) {

        $vista = new Vista;
        $vista->area_autor();

        if(isset($_GET["subir"]) && $_GET["subir"]==1){
            $vista->subirLibro();
        }
        if(isset($_GET["subido"]) && $_GET["subido"]==1){
            echo "<script>alert('Libro subido correctamente');</script>";
        } elseif(isset($_GET["subido"]) && $_GET["subido"]==0) {
            echo "<script>alert('No se pudo subir el libro');</script>";
        }
        if( isset($_GET["lib_autor_ver"]) && $_GET["lib_autor_ver"]==1){
            $LibrosModel = new librosModel;
            $libros = $LibrosModel->recogerLibros();
            $vista->CrearTablaLibro($libros);
        }

    }
    
}


