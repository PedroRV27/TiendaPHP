<?php use Models\Categoria; ?>
<h1>Eliminar Categoría</h1>

<?php if (isset($categoria)): ?>
    <p>¿Estás seguro de que deseas eliminar la categoría "<?=htmlspecialchars($categoria->nombre)?>"?</p>
    <p>Esta acción también eliminará todos los productos asociados a esta categoría.</p>
    <form action="<?=base_url?>Categoria/eliminar/<?=htmlspecialchars($categoria->id)?>" method="POST">
        <input type="submit" value="Eliminar">
    </form>
    <a href="<?=base_url?>Categoria/index">Cancelar</a>
<?php else: ?>
    <p>La categoría no existe.</p>
<?php endif; ?>
