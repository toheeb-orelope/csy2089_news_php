<?php
//This function is used to load file such as templates file and it value send it to the browser
function newsTemplates($fileName, $variables)
{
    extract($variables);
    ob_start();
    require $fileName;
    $output = ob_get_clean();
    return $output;
}

