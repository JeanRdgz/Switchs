<?php

function leerJSON($archivo)
{
    return json_decode(file_get_contents($archivo), true);
}

function escribirJSON($archivo, $datos)
{
    file_put_contents($archivo, json_encode($datos, JSON_PRETTY_PRINT));
}
