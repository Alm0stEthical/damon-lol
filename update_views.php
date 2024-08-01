<?php
$file = 'views.json';

try {
    if (file_exists($file)) {
        $viewsData = json_decode(file_get_contents($file), true);
        if ($viewsData === null) {
            throw new Exception('Error decoding JSON data.');
        }
    } else {
        $viewsData = ["views" => 0];
    }

    $viewsData["views"] += 1;

    if (file_put_contents($file, json_encode($viewsData)) === false) {
        throw new Exception('Error writing to views.json.');
    }

    echo json_encode($viewsData);
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
