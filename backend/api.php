<?php
// Configuración de conexión
$host = "10.0.0.40";
$user = "admin_farmacia";
$password = "farm1234";
$dbname = "farmacia_cruzazul";

// Crear conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Procesar datos si el método es POST (Requerimiento 23)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Captura de datos exactos según la pauta
    $id = $_POST['id'];
    $producto = $_POST['producto'];
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];
    $precio_unitario = $_POST['precio_unitario'];

    // Preparar la sentencia SQL para evitar inyecciones (Seguridad 1.1.4)
    $stmt = $conn->prepare("INSERT INTO productos (id, producto, descripcion, cantidad, precio_unitario) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isssd", $id, $producto, $descripcion, $cantidad, $precio_unitario);

    if ($stmt->execute()) {
        echo "<h1>Éxito</h1>";
        echo "<p>Producto registrado correctamente en MariaDB.</p>";
        echo "<a href='index.html'>Volver al formulario</a>";
    } else {
        echo "Error al registrar: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>