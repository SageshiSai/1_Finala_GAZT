<?php
//*FUNCIONES PARA EJECUCION DE QUERYS EN LA BBDD*
include_once("conect.php");


//------------------------------------------------------------------
//INSERT
//------------------------------------------------------------------
function insert($sql)
{

    $bbdd = new conect();
    $bbdd->OpenConnect();

    return $bbdd->link->query($sql);
}

function insertInjection($nombre_tabla, $columna1, $columna2, $columna3)
{
    $bbdd = new conect();
    $bbdd->OpenConnect();
        
    $sql = "INSERT INTO $nombre_tabla ( `id_usuario`, `id_ropa`, `cantidad`) VALUES (?, ?, ?)";
            
    $stmt = $bbdd->link->prepare($sql);

    // Aquí asumimos que los primeros cuatro parámetros son strings y el último es un entero
    $stmt->bind_param('iii', $columna1, $columna2, $columna3);
    return $stmt->execute();
}

function insertInjectionLibros($nombre_tabla, $columna3, $id_autor, $año_publicación, $ISBN)
{
    $bbdd = new conect();
    $bbdd->OpenConnect();
        
    $sql = "INSERT INTO $nombre_tabla (`Titulo`, `AutorID`, `AñoPublicacion`, `ISBN`) VALUES (?, ?, ?, ?)";
            
    $stmt = $bbdd->link->prepare($sql);

    // Aquí asumimos que los primeros cuatro parámetros son strings y el último es un entero
    $stmt->bind_param('siii', $columna3, $id_autor, $año_publicación, $ISBN);
    return $stmt->execute();
}
//------------------------------------------------------------------
//UPDATE
//------------------------------------------------------------------
function update($sql)
{

    $bbdd = new conect();
    $bbdd->OpenConnect();
    $bbdd->link->query($sql);

    if ($bbdd->link->affected_rows > 0) {
        return true;
    } else {
        return false;
    }
}

function updateInjection($nombre_tabla, $columna2 = "", $condicionColumna1 = "id", $condicion1)
{
    $bbdd = new conect();
    $bbdd->OpenConnect();

    $sql = "UPDATE $nombre_tabla SET";

    //Izena, apellido, pasahitza y admin
    $sql .= " `Contraseña` = ? ";
    $sql .= "WHERE `$condicionColumna1` = ?";
    
    $stmt = $bbdd->link->prepare($sql);

    // Aquí asumimos que los primeros cuatro parámetros son strings, el quinto es un entero y el último (id) también es un entero
    $stmt->bind_param('si', $columna2, $condicion1);
    echo $sql;
    return $stmt->execute();
}
//------------------------------------------------------------------
//DELETE
//------------------------------------------------------------------
function delete($table, $id, $keyname = 'nan')
{

    $bbdd = new conect();
    $bbdd->OpenConnect();
    $sql = "delete from $table where $keyname = '$id'";
    $bbdd->link->query($sql);

    if ($bbdd->link->affected_rows == 1) {
        return true;
    } else {
        return false;
    }
}

function deleteInjection($table, $id, $keyname = 'id')
{

    $bbdd = new conect();
    $bbdd->OpenConnect();
    $sql = "DELETE FROM $table WHERE $keyname = ?";
    $stmt = $bbdd->link->prepare($sql);

    // Aquí asumimos que el id es un string
    $stmt->bind_param('s', $id);

    return $stmt->execute();
}
//------------------------------------------------------------------
//SELECT
//------------------------------------------------------------------
function select($table, $id, $keyname = 'id')
{

    $bbdd = new conect();
    $bbdd->OpenConnect();
    if ($id == 0 && $keyname == 0)
        $sql = "SELECT * from $table";
    else {
        $sql = "SELECT * from $table where $keyname = '$id'";
    }

    $result = $bbdd->link->query($sql);

    return $result;
}

function selectLibro($table, $id, $keyname = 'id')
{

    $bbdd = new conect();
    $bbdd->OpenConnect();
    if ($id == 0 && $keyname == 0)
        $sql = "SELECT a.Titulo, e.Nombre, a.AñoPublicacion, a.ISBN FROM libros a LEFT JOIN editoriales e ON a.EditorialID = e.EditorialID";
    else {
        $sql = "SELECT * from $table where $keyname = '$id'";
    }

    $result = $bbdd->link->query($sql);

    return $result;
}
//------------------------------------------------------------------
//MYSQLI_RESULT
//------------------------------------------------------------------
function mysqli_result($result, $row, $field)
{
    $result->data_seek($row);
    $data = $result->fetch_assoc();

    if (isset($data[$field])) {
        return $data[$field];
    } else {
        return null;
    }
}
