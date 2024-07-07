<?php foreach ($noticias as $noticia): ?>
<div class="admin-card-container">
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
<?php endforeach; ?>