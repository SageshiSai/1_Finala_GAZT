<?php

include_once("database/query.php");
session_start();
class librosModel {

    public function subirLibro($nombre_libro){
        $result = select("personas_trabajadoras",$_SESSION["nombre_usuario"],"Usuario");
        $id = mysqli_result($result, 0, "Id");
        $isbn = '';
        for ($i = 0; $i < 12; $i++) {
            $isbn .= mt_rand(0, 9);
        }
        $result = insertInjectionLibros("libros", $nombre_libro,$id,null,$isbn);
        return $result;
    }

    public function recogerLibros(){
        $result = selectLibro("libros",0,0);
        return $result;
    }


}