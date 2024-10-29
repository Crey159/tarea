<?php
require_once __DIR__ . '/includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = crearProducto(
        $_POST['nombre'],
        $_POST['categoria'],
        $_POST['stock'],
        $_POST['precio'],
        $_POST['fechagarantia']
    );
    
    if ($id) {
        header("Location: index.php?mensaje=Producto agregado con éxito");
        exit;
    } else {
        $error = "No se pudo agregar el producto.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nuevo Producto - Tienda de Electrodomésticos</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>

<body>
    <div class="container">
        <h1>Agregar Nuevo Producto</h1>
        
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" class="product-form">
            <div class="form-group">
                <label>Nombre del Producto:
                    <input 
                        type="text" 
                        name="nombre" 
                        required 
                        placeholder="Ej: Refrigerador Samsung RF28"
                    >
                </label>
            </div>

            <div class="form-group">
                <label>Categoría:
                    <select name="categoria" required>
                        <option value="">Seleccione una categoría</option>
                        <option value="Línea Blanca">Línea Blanca</option>
                        <option value="Electrodomésticos de Cocina">Electrodomésticos de Cocina</option>
                        <option value="Climatización">Climatización</option>
                        <option value="Pequeños Electrodomésticos">Pequeños Electrodomésticos</option>
                        <option value="Audio y Video">Audio y Video</option>
                    </select>
                </label>
            </div>

            <div class="form-group">
                <label>Stock:
                    <input 
                        type="number" 
                        name="stock" 
                        required 
                        min="0" 
                        placeholder="Cantidad disponible"
                    >
                </label>
            </div>

            <div class="form-group">
                <label>Precio:
                    <input 
                        type="number" 
                        name="precio" 
                        required 
                        min="0" 
                        step="0.01" 
                        placeholder="Precio en $"
                    >
                </label>
            </div>

            <div class="form-group">
                <label>Fecha de Garantía:
                    <input 
                        type="date" 
                        name="fechagarantia" 
                        required
                    >
                </label>
            </div>

            <div class="form-group">
                <label>Marca:
                    <input 
                        type="text" 
                        name="marca" 
                        required 
                        placeholder="Ej: Samsung, LG, Whirlpool"
                    >
                </label>
            </div>

            <div class="form-group">
                <label>Modelo:
                    <input 
                        type="text" 
                        name="modelo" 
                        required 
                        placeholder="Ej: XRT-1000"
                    >
                </label>
            </div>

            <div class="form-buttons">
                <input type="submit" value="Agregar Producto" class="button primary">
                <a href="index.php" class="button secondary">Volver al Inventario</a>
            </div>
        </form>
    </div>
