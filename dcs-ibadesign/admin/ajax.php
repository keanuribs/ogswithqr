<?php
include '../db/config.php';
if ($action == 'save_academic') {
    $save = $crud->save_academic();
    if ($save)
        echo $save;
}
if ($action == 'delete_academic') {
    $save = $crud->delete_academic();
    if ($save)
        echo $save;
}
if ($action == 'make_default') {
    $save = $crud->make_default();
    if ($save)
        echo $save;
}
?>
