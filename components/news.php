<div class="flex-row gap-5">
    <?php
        include("../db/DB.php");

        $noticias = DB::getNoticias();

        $sliced_noticias = array_slice($noticias, 0, 3);

        include("card.php");

    ?>
</div>