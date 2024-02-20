<?php


class Vista {

    //Formulario completo con la parte del login.
    public function Login() {
        ?>
        
        <form method="POST" action="../Controller/Controller.php">
            Nombre de usuario: <input type="text" name="username">
            <br>
            Contraseña: <input type="password" name="password">
            <br>
            <input type="submit" name="Entrar" value="Entrar">
            <input type="submit" name="Cambiar" value="Cambiar Contraseña">
        </form>

        <?php
    }
   

    //Formulario para el cambio de contraseña
    public function cambiarContra() {
        ?>
        <form method="POST" action="../Controller/Controller.php">
            <div>
                <div>
                    <label><b>Introduce la nueva contraseña</b></label>
                    <input type="text" name="contra"/>
                </div>
                
                <input type="submit" value="Cambiar_ph" name="Cambiar"/> 
            </div>
        </form>
        <?php
    }

 //Formulario para la opción editor una vez elegida la opción de publicar libro.
 public function Libros($libros){
    ?>
    
    <h1>Elige el que quieras publicar: </h1>
    <form method="POST" action="../Controller/Controller.php">
    <?php
    echo '<select name="libros">';
    foreach($libros as $libro){
        $id=$libro['Id'];
        $nombre=$libro['Nombre'];
        $titulo=$libro['Titulo'];
        echo '<option value="'.$id.'">'.$nombre.' - '.$titulo. '</option>';        
    }
    echo "</select>";
    ?> Año:   <input type="text" name="año"> 
    <?php
    echo '<input type="submit" value="Publicar" name="publicar"/> ';
    echo "</form>";
}


    //En la opción de editor formulario para añadir usuario.
    public function nuevoUsuario() {
        ?>
         <form method="POST" action="../Controller/Controller.php">
            <div >
                <div>
                <label><b> Id</b></label>
                <input type="text" name="id"/>
                </div>
                <div >
                    <label><b> Usuario</b></label>
                    <input type="text" name="usuario"/>
                </div>

                <div>
                    <label><b>Contraseña</b></label>
                    <input type="password"  name="contra"/>
                </div>
                <br>
                <div>
                    <label><b>Nombre</b></label>
                    <input type="nombre"  name="nombre"/>
                </div>
                <div>
                    <label><b>Nacionalidad</b></label>
                    <input type="nacionalidad"  name="nacionalidad"/>
                </div>
                <br>
                <div>
                    <label><b>Autor/Editor:</b></label>
                    Autor<input type="radio" name="autor" value='1'/>
                    Editor<input type="radio" name="autor" value='0'/>
                </div>
                <br>
                
                <input type="submit" value="Enviar" name="Dar_de_alta"/> 
            </div>
        </form>
        <?php
    }

    //Formulario para el area de autor.
    public function area_autor(){
        ?>
         <h1>Gestion de libros</h1>
        <form method="POST" action="../Controller/Controller.php">
            <input type="submit" value="Subir libro" name="subir"/>
            <input type="submit" value="Ver libros" name="lib_autor_ver"/> 
        </form>
        
        <?php
    }

    //Formulario para el area de editor.
    public function area_editor(){
        ?>
         <h1>Gestion de libros y autores</h1>
        <form method="POST" action="../Controller/Controller.php">
            <input type="submit" value="Nuevo usuario" name="Alta"/>
            <input type="submit" value="Publicar libro" name="publi_lib"/>
            <input type="submit" value="Ver libros" name="lib_editor_ver"/> 
        </form>
        
        <?php
    }
    //Dado un array de arrays asociativos se representan los Libros de un autor en una tabla.
    public function CrearTablaLibro($Libros){
        echo"<h1>Especificación de libros</h1>";
        echo' <form method="POST" action="../Controller/Controller.php">';
        echo"<table>";
        echo"       <thead>";
        echo"           <tr>";
        echo"               <th>Titulo</th>";
        echo"               <th>Editorial</th>";
        echo"               <th>Año</th>";
        echo"               <th>ISBN-a</th>";                     
        echo"           </tr>";
        echo"       </thead>";
        echo"       <tbody>";
        foreach($Libros as $libro){
            echo "<tr>";
            foreach($libro as $columna){
                echo "<td>$columna</td>";
            }
            echo "</tr>";
        }
        echo"       </tbody>";
        echo"   </table>";
        ?>
        </form>
        <?php
        

    }

    //Dado un array de arrays asociativos se representa una tabla de libros para los editore.
    public function CrearTablaLibrosEditor($Libros){
        echo"<h1>Todos los libros</h1>";
        echo' <form method="POST" action="../Controller/Controller.php">';
        echo"<table>";
        echo"       <thead>";
        echo"           <tr>";
        echo"               <th>Titulo</th>";
        echo"               <th>Autor</th>";
        echo"               <th>Editorial</th>";
        echo"               <th>ISBN</th>";                     
        echo"           </tr>";
        echo"       </thead>";
        echo"       <tbody>";
        foreach($Libros as $libro){
            echo "<tr>";
            foreach($libro as $columna){
                echo "<td>$columna</td>";
            }
            echo "</tr>";
        }
        echo"       </tbody>";
        echo"   </table>";
        ?>
        </form>
        <?php
        

    }
    //Formulario para subir un libro.
    public function SubirLibro(){
        ?>

        <h1>Subir Libro</h1>
        <form method="POST" action="../Controller/Controller.php">
        <div>
            <div >
                <label><b> Nombre</b></label>
                <input type="text" name="nombre"/>
            </div>
            <input type="submit" value="Subir" name="Subir"/> 
            <br><br>
        
        <?php
    }
   
}
