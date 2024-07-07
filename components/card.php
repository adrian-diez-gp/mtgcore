<?php foreach ($sliced_noticias as $noticia): ?>
    <a href="<?php echo "../pages/noticia.php?id=" . $noticia['idNoticia']; ?>" class="card-link">
<div class="card-container">
    <div class="img-container">
        <img src="<?php echo "../assets/".$noticia['imagen']; ?>" alt="Imagen de la noticia">
    </div>
    <div class="card-title">
       <?php echo $noticia['titulo']; ?>
    </div>
    <div class="card-author">
       <?php echo "Escrito por: ". $noticia['nombre']." ". $noticia['apellidos']; ?>
    </div>
</div>
</a>
<?php endforeach; ?>