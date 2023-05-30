<?php
header("Content-Type: application/json");

include_once 'database.php';
include_once 'relojes.php';

$database = new Database();
$db = $database->getConnection();

$reloj = new Relojes($db);

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id !== null) {
            $reloj->id = $id;
            $result = $reloj->readOne();
        } else {
            $result = $reloj->readAll();
        }
        echo json_encode($result);
        break;

    case 'POST':
        // Crear un nuevo reloj
        $data = json_decode(file_get_contents("php://input"));

        $reloj->nombre = $data->nombre;
        $reloj->marca = $data->marca;
        $reloj->precio = $data->precio;
        $reloj->material_caja = $data->material_caja;
        $reloj->material_correa = $data->material_correa;
        $reloj->descripcion = $data->descripcion;

        if ($reloj->create()) {
            echo json_encode(array("message" => "Reloj creado con éxito."));
        } else {
            echo json_encode(array("message" => "No se pudo crear el reloj."));
        }
        break;

    case 'PUT':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id !== null) {
            $data = json_decode(file_get_contents("php://input"));

            $reloj->id = $id;
            $reloj->nombre = $data->nombre;
            $reloj->marca = $data->marca;
            $reloj->precio = $data->precio;
            $reloj->material_caja = $data->material_caja;
            $reloj->material_correa = $data->material_correa;
            $reloj->descripcion = $data->descripcion;

            if ($reloj->update()) {
                echo json_encode(array("message" => "Reloj actualizado con éxito."));
            } else {
                echo json_encode(array("message" => "No se pudo actualizar el reloj."));
            }
        } else {
            echo json_encode(array("message" => "ID de reloj no especificado."));
        }
        break;

    case 'DELETE':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id !== null) {
            $reloj->id = $id;
            if ($reloj->delete()) {
                echo json_encode(array("message" => "Reloj eliminado con éxito."));
            } else {
                echo json_encode(array("message" => "No se pudo eliminar el reloj."));
            }
        } else {
            echo json_encode(array("message" => "ID de reloj no especificado."));
        }
        break;

    default:
        echo json_encode(array("message" => "Método no válido."));
        break;
}
?>
