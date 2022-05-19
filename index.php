<?php

include 'bd/BD.php';

//hacer peticiones desde cualquier URL
header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['id'])){
        $query="select * from estudiante where id=".$_GET['id'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="select * from estudiante";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll()); 
    }

    //Codigo 200 significa que la peticion de la API fue exitosa
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $nota=$_POST['nota'];
    $query="insert into estudiante(nombre, apellido, nota) values ('$nombre', '$apellido', '$nota')";
    $queryAutoIncrement="select MAX(id) as id from estudiante";
    $resultado=metodoPost($query, $queryAutoIncrement);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $id=$_GET['id'];
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $nota=$_POST['nota'];
    $query="UPDATE estudiante SET nombre='$nombre', apellido='$apellido', nota='$nota' WHERE id='$id'";
    $resultado=metodoPut($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='DELETE'){
    unset($_POST['METHOD']);
    $id=$_GET['id'];
    $query="DELETE FROM estudiante WHERE id='$id'";
    $resultado=metodoDelete($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

//error 400
header("HTTP/1.1 400 Bad Request");


?>