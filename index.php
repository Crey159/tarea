<?php
    require_once __DIR__ .'/includes/functions.php';
    if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
        $count = eliminarProducto($_GET['id']);
        $mensaje = $count > 0 ? "Producto eliminado con éxito." : "No se pudo eliminar el producto.";
    }
    $productos = obtenerProductos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Electrodomésticos</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Tienda de Electrodomésticos</h1>

        <?php if (isset($mensaje)): ?>
            <div class="<?php echo $count > 0 ? 'success' : 'error'; ?>">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <a href="agregar_producto.php" class="button">Agregar Nuevo Producto</a>

        <h2>Lista de Productos</h2>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Stock</th>
                <th>Precio</th>
                <th>Fecha de Vencimiento</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($productos as $producto): ?>
            <tr>
                <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                <td><?php echo htmlspecialchars($producto['categoria']); ?></td>
                <td><?php echo htmlspecialchars($producto['stock']) ?></td>
                <td><?php echo htmlspecialchars($producto['precio']) ?></td>
                <td><?php echo formatDate($producto['fechavencimiento']); ?></td>
                <td class="actions">
                    <a href="editar_producto.php?id=<?php echo $producto['_id']; ?>" class="button">Editar</a>
                    <a href="index.php?accion=eliminar&id=<?php echo $producto['_id']; ?>" class="button" onclick="return confirm('¿Estás seguro de que quieres eliminar este producto?');">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>