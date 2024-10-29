<?php
require_once __DIR__ . '/includes/functions.php';
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}
$producto = obtenerProductoPorId($_GET['id']);

if (!$producto) {
    header("Location: index.php?mensaje=Producto no encontrado");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $count = actualizarProducto(
        $_GET['id'], 
        $_POST['nombre'], 
        $_POST['categoria'], 
        $_POST['stock'], 
        $_POST['precio'], 
        $_POST['fechagarantia']
    );
    
    if ($count > 0) {
        header("Location: index.php?mensaje=Producto actualizado con éxito");
        exit;
    } else {
        $error = "No se pudo actualizar el producto.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto - Tienda de Electrodomésticos</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>

<body>
    <div class="container">
        <h1>Editar Producto</h1>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label>Nombre del Producto: 
                    <input type="text" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required>
                </label>
            </div>
            
            <div class="form-group">
                <label>Categoría: 
                    <select name="categoria" required>
                        <option value="Línea Blanca" <?php echo $producto['categoria'] === 'Línea Blanca' ? 'selected' : ''; ?>>Línea Blanca</option>
                        <option value="Electrodomésticos de Cocina" <?php echo $producto['categoria'] === 'Electrodomésticos de Cocina' ? 'selected' : ''; ?>>Electrodomésticos de Cocina</option>
                        <option value="Climatización" <?php echo $producto['categoria'] === 'Climatización' ? 'selected' : ''; ?>>Climatización</option>
                        <option value="Pequeños Electrodomésticos" <?php echo $producto['categoria'] === 'Pequeños Electrodomésticos' ? 'selected' : ''; ?>>Pequeños Electrodomésticos</option>
                        <option value="Audio y Video" <?php echo $producto['categoria'] === 'Audio y Video' ? 'selected' : ''; ?>>Audio y Video</option>
                    </select>
                </label>
            </div>
            
            <div class="form-group">
                <label>Stock: 
                    <input type="number" name="stock" min="0" value="<?php echo htmlspecialchars($producto['stock']); ?>" required>
                </label>
            </div>
            
            <div class="form-group">
                <label>Precio: 
                    <input type="number" name="precio" min="0" step="0.01" value="<?php echo htmlspecialchars($producto['precio']); ?>" required>
                </label>
            </div>
            
            <div class="form-group">
                <label>Fecha de Garantía: 
                    <input type="date" name="fechagarantia" value="<?php echo formatDate($producto['fechagarantia']); ?>" required>
                </label>
            </div>

            <div class="form-buttons">
                <input type="submit" value="Actualizar Producto" class="button primary">
                <a href="index.php" class="button secondary">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>