<?php use Models\Categoria; ?>
<h1>Editar Categoría</h1>

<?php if (isset($categoria)): ?>
    <form action="<?=base_url?>Categoria/update/<?=($categoria->id)?>" method="POST">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?=htmlspecialchars($categoria->nombre)?>" required>

        <input type="submit" value="Guardar">
    </form>
<?php else: ?>
    <p>La categoría no existe.</p>
<?php endif; ?>
