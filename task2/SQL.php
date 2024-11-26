<?php
require_once __DIR__ . "/Database.php";

$query = DB::prepare
("
    DELETE products FROM products 
    LEFT JOIN availabilities ON products.id = availabilities.product_id 
    WHERE availabilities.product_id IS NULL
    ");

$query->execute();

$query = DB::prepare
    ("
    DELETE categories FROM categories 
    LEFT JOIN products ON products.category_id = categories.id
    WHERE products.category_id IS NULL
    
    ");

$query->execute();

$query = DB::prepare
    ("
    DELETE stocks FROM stocks 
    LEFT JOIN availabilities ON stocks.id = availabilities.stock_id    
    WHERE availabilities.stock_id IS NULL
    ");

$query->execute();


