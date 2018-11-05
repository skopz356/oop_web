<?php
foreach (glob("engine/base/*.php") as $filename)
{
    include_once $filename;
}




$d = new Route();
$d->renderView();








?>