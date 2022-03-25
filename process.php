<?php
session_start();

$mysqli = new mysqli("localhost", "root", "root", "stseisua") or die(mysqli_error($mysqli));

$owner = '';
$ingreso = '';
$procesador = '';
$mb = '';
$disco = '';
$descripcion = '';
$update = false;
$id = 0;

if (isset($_POST['save'])) {
    $owner = $_POST['owner'];
    $ingreso = $_POST['ingreso'];
    $procesador = $_POST['procesador'];
    $mb = $_POST['mb'];
    $disco = $_POST['disco'];
    $descripcion = $_POST['descripcion'];

    $mysqli->query("INSERT INTO data (owner, ingreso , procesador , mb, disco, descripcion ) VALUES('$owner','$ingreso', '$procesador', '$mb', '$disco' , '$descripcion' )") or die($mysqli->error);

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";
    header("location: index.php");
}
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error);
    if ($result->num_rows) {
        $row = $result->fetch_array();
        $owner = $row['owner'];
        $ingreso = $row['ingreso'];
        $procesador = $row['procesador'];
        $mb = $row['mb'];
        $disco = $row['disco'];
        $descripcion = $row['descripcion'];
    }
}
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $owner = $_POST['owner'];
    $ingreso = $_POST['ingreso'];
    $procesador = $_POST['procesador'];
    $mb = $_POST['mb'];
    $disco = $_POST['disco'];
    $descripcion = $_POST['descripcion'];

    $mysqli->query("UPDATE data SET owner='$owner', ingreso='$ingreso', procesador='$procesador', mb='$mb', disco='$disco', descripcion='$descripcion' WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";
    header("location: index.php");
}
