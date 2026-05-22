<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

$host = "kodama.proxy.rlwy.net";
$port = "32044";
$dbname = "railway";
$user = "root";
$password = "HgWoFbckiAEnSSalnGmtjsZVjuQPgwkV";

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
    exit;
}

$nombre = $_POST['nombre'] ?? '';
$apellido = $_POST['apellido'] ?? '';
$email = $_POST['email'] ?? '';
$contrasena = password_hash($_POST['contrasena'] ?? '', PASSWORD_DEFAULT);
$direccion = $_POST['direccion'] ?? '';

$sql = "INSERT INTO Usuarios (nombre, apellido, email, contrasena, direccion) VALUES (:nombre, :apellido, :email, :contrasena, :direccion)";
$stmt = $conn->prepare($sql);
$stmt->execute([
    ':nombre' => $nombre,
    ':apellido' => $apellido,
    ':email' => $email,
    ':contrasena' => $contrasena,
    ':direccion' => $direccion
]);

echo json_encode(["success" => true]);
?>
