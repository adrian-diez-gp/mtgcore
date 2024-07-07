<?php
    $total_noticias = count($noticias);

    for ($i = 0; $i < $total_noticias / 3; $i++){
        echo '<a href=""><span>[' . (3 * $i) + 1 . ' - '. 3 * $i + 3 .']</span></a>';
    }
    
?>