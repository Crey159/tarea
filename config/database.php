<?php
    require_once __DIR__.'/../vendor/autoload.php';
    $mongoClient = new MongoDB\Client('mongodb+srv://cristiancrey159:2VqfhoVApRxLhb7k@cluster0.zdvgl.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0');
    $database = $mongoClient->selectDataBase('tienda-electrodomesticos');
    $productosCollection = $database->productos;
?>