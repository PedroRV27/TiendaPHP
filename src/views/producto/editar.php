<?php
use Models\Categoria;
?>
<h2>Editar producto</h2>

<?php $categorias = Categoria::obtenerCategorias(); ?>
<?php if (isset($categorias) && isset($producto)) : ?>

<div class="form_content">
    <form action="<?=base_url?>Producto/update" method="post" class="form" enctype="multipart/form-data">
        <input type="hidden" name="data[id]" value="<?= $producto->id ?>" />
        <label for="nombre">Nombre:</label>
        <input type="text" name="data[nombre]" id="nombre" value="<?= htmlspecialchars($producto->nombre) ?>" required class="input_field">
        <br>
        <label for="categoria">Categor&iacute;a:</label>
        <select name="data[categoria]" id="categoria" required class="input_field">
            <?php while ($cat = $categorias->fetch(PDO::FETCH_OBJ)): ?>
                <option value="<?=$cat->id?>" <?= $cat->id == $producto->categoria_id ? 'selected' : '' ?>><?=$cat->nombre?></option>
            <?php endwhile; ?>
            <br>
        </select>
        <label for="descripcion">Descripci&oacute;n:</label>
        <textarea name="data[descripcion]" id="descripcion" cols="50" rows="5" required class="input_field" placeholder="Descripción..."><?= htmlspecialchars($producto->descripcion) ?></textarea>
        <br>
        <label for="precio">Precio:</label>
        <input type="number" name="data[precio]" id="precio" step="0.01" value="<?= htmlspecialchars($producto->precio) ?>" required class="input_field">
        <br>
        <label for="stock">Stock:</label>
        <input type="number" name="data[stock]" id="stock" value="<?= htmlspecialchars($producto->stock) ?>" required class="input_field">
        <br>
        <label for="imagen">Imagen:</label>
        <input type="file" name="imagen" id="imagen" class="input_field">
        <br>
        <span class="error"><?= $error ?? "" ?></span>
        <input type="submit" value="Actualizar" class="submit_registro">
    </form>
</div>

<?php else: ?>

<h2>No hay categor&iacute;as, <a href="<?=base_url?>Categoria/save">cree una</a> antes de editar productos</h2>

<?php endif; ?>
