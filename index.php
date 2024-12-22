<?php

require_once 'src/pages/common.php';
$head->setParams([
    'title' => 'Rubrica',
    'style' => 'src/css/style.css',
    'script' => 'src/js/main.js' 
])

?>
<!DOCTYPE html>
<html lang="en">
<?=$head->render()?>
<body>
    <div class="position-absolute top-50 start-50 translate-middle text-center">
        <a href="src/pages/home.php" class="display-1">Tabella</a> <br>________________<br>
        <a href="src/pages/Contact-list.php" class="display-1">Lista Contatti</a>
    </div>
</body>

</html>