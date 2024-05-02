<?php setlocale (LC_TIME, "es_ES"); ?>

<div class="container">
    <?php if (isset(session()->user)) : ?>
        <form action="<?= site_url('publication/add') ?>" method="post">
            <div class="form-group">
                <textarea class="form-control" name="content" rows="3" placeholder="Escribe algo"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Publicar</button>
        </form>
        <br>
    <?php endif; ?>

    <?php foreach ($posts as $item) : ?>
        <div class="card bg-light mb-3">
            <div class="card-body">
            <?php if (array_key_exists('user_name', $item)) : ?>
                <strong><?= $item['user_name']; ?></strong>
            <?php else : ?>
                <strong>No se encontró el nombre del usuario</strong>
            <?php endif; ?>
            <small><?= strftime("%A, %d de %B de %Y %I:%M", strtotime($item['posted_time'])); ?></small>
            <p class="card-text"><?= $item['content']; ?></p>

                <?php if (isset(session()->user) && session()->user === $item['user']) : ?>
                    <a class="btn btn-primary" href="<?= site_url('publication/edit/' . $item['id']) ?>" role="button">Editar</a>
                    <a class="btn btn-danger" href="<?= site_url('publication/delete/' . $item['id']) ?>" role="button">Borrar</a>
                <?php endif; ?>

                <!-- Formulario para cargar imágenes -->
                <form action="<?= site_url('publication/uploadImage') ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="publication_id" value="<?= $item['id'] ?>">
                    <input type="file" name="image" required>
                    <input type="submit" value="Cargar Imagen">
                </form>

                <!-- Lista de imágenes asociadas a cada publicación -->
                <?php if (array_key_exists('images', $item)) : ?>
                    <!-- Lista de imágenes asociadas a esta publicación -->
                    <?php foreach ($item['images'] as $image) : ?>
                        <div>
                        <img src="<?= base_url('writable/uploads/' . $image['filename']) ?>" alt="Imagen altenativa">
                            <!-- Botón para eliminar la imagen -->
                            <a href="<?= site_url('publication/deleteImage/' . $image['id']) ?>" class="btn btn-danger" role="button">Eliminar Imagen</a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>

