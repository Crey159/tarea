<?php
    require_once __DIR__ .'/../config/database.php';

    function obtenerProductos() {
        global $productosCollection;
        return $productosCollection->find();
    }

    function formatDate($date) {
        return $date->toDateTime()->format('Y-m-d');
    }

    function sanitizeInput($input) {
        return htmlspecialchars(strip_tags(trim($input)));
    }

    function crearProducto($nombre, $categoria, $stock, $precio, $fechavencimiento) {
        global $productosCollection;
        $resultado = $productosCollection->insertOne([
            'nombre' => sanitizeInput($nombre),
            'categoria' => sanitizeInput($categoria),
            'stock' => sanitizeInput($stock),
            'precio' => sanitizeInput($precio),
            'fechavencimiento' => new MongoDB\BSON\UTCDateTime(strtotime($fechavencimiento) * 1000)
        ]);
        return $resultado->getInsertedId();
    }

    function obtenerProductoPorId($id) {
        global $productosCollection;
        return $productosCollection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
    }

    function actualizarProducto($id, $nombre, $categoria, $stock, $precio, $fechavencimiento) {
        global $productosCollection;
        $resultado = $productosCollection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($id)],
            ['$set' => [
                'nombre' => sanitizeInput($nombre),
                'categoria' => sanitizeInput($categoria),
                'stock' => sanitizeInput($stock),
                'precio' => sanitizeInput($precio),
                'fechavencimiento' => new MongoDB\BSON\UTCDateTime(strtotime($fechavencimiento) * 1000)
            ]]
        );
        return $resultado->getModifiedCount();
    }

    function eliminarProducto($id) {
        global $productosCollection;
        $resultado = $productosCollection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
        return $resultado->getDeletedCount();
    }