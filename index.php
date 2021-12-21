<?php

$host="localhost";
$bd="sitioweb";
$usuario="root";
$contrasenia="";

try{

$conexion=new PDO("mysql:host=$host;dbname=$bd",$usuario,$contrasenia);

//echo "conectando....";

} catch ( Exception $ex) {

    echo $ex->getMessage();
}

if (isset($_GET['accion'])=="insertar"){

    $CODIGO=$_POST['CODIGO'];
    $NOMBRE=$_POST['NOMBRE'];
    $LOTE=$_POST['LOTE'];
    $UNIDADMEDIDA=$_POST['UNIDADMEDIDA'];
    $PRECIO=$_POST['PRECIO'];

    $sentenciaSQL= $conexion->prepare("INSERT INTO LAPTOP (CODIGO,NOMBRE,LOTE,UNIDADMEDIDA,PRECIO) VALUES (:CODIGO,:NOMBRE,:LOTE,:UNIDADMEDIDA,:PRECIO);");
    $sentenciaSQL->bindParam(':CODIGO',$CODIGO);
    $sentenciaSQL->bindParam(':NOMBRE',$NOMBRE);
    $sentenciaSQL->bindParam(':LOTE',$LOTE);
    $sentenciaSQL->bindParam(':UNIDADMEDIDA',$UNIDADMEDIDA);
    $sentenciaSQL->bindParam(':PRECIO',$PRECIO);
    $sentenciaSQL->execute();

    exit();
}

if (isset($_GET["Borrar"])){

    $id=$_GET["Borrar"];

    $sentenciaSQL= $conexion->prepare("DELETE FROM laptop WHERE id=:id");
    $sentenciaSQL->bindParam(':id',$id);
    $sentenciaSQL->execute(); 


    exit();

}

if (isset($_GET["Seleccionar"])){

    $id=$_GET["Seleccionar"];

    $sentenciaSQL= $conexion->prepare("SELECT * FROM laptop WHERE id=".$id);
    $sentenciaSQL->execute(); 

    $listaLAPTOP=$sentenciaSQL->fetchALL(PDO::FETCH_ASSOC);
    echo json_encode($listaLAPTOP);


    exit();

}


if (isset($_GET['Editar']) ){

    $ID=$_POST['ID'];
    $CODIGO=$_POST['CODIGO'];
    $NOMBRE=$_POST['NOMBRE'];
    $LOTE=$_POST['LOTE'];
    $UNIDADMEDIDA=$_POST['UNIDADMEDIDA'];
    $PRECIO=$_POST['PRECIO'];

    $sentenciaSQL= $conexion->prepare("UPDATE LAPTOP SET CODIGO=:CODIGO,NOMBRE=:NOMBRE,LOTE=:LOTE,UNIDADMEDIDA=:UNIDADMEDIDA,PRECIO=:PRECIO WHERE ID=:ID");
    $sentenciaSQL->bindParam(':CODIGO',$CODIGO);
    $sentenciaSQL->bindParam(':NOMBRE',$NOMBRE);
    $sentenciaSQL->bindParam(':LOTE',$LOTE);
    $sentenciaSQL->bindParam(':UNIDADMEDIDA',$UNIDADMEDIDA);
    $sentenciaSQL->bindParam(':PRECIO',$PRECIO);
    $sentenciaSQL->bindParam(':ID',$ID);
    $sentenciaSQL->execute();

    echo json_encode(["success"=>1]);

    exit();
}







$sentenciaSQL=$conexion->prepare("SELECT * FROM LAPTOP");
$sentenciaSQL->execute();
$listaLAPTOP=$sentenciaSQL->fetchALL(PDO::FETCH_ASSOC);
echo json_encode($listaLAPTOP);


?>