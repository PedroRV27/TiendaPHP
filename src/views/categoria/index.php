<?php use Models\Categoria; ?>
<h1>Gestionar Categorías</h1>

<a href="<?=base_url?>Categoria/crear" class="btn-crear">Crear Categoría</a>

<?php $categorias = Categoria::obtenerCategorias(); ?>

<table class="tabla-categorias">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($categorias): ?>
            <?php while ($cat = $categorias->fetch(PDO::FETCH_OBJ)): ?>
                <tr>
                    <td><?= htmlspecialchars($cat->id) ?></td>
                    <td><?= htmlspecialchars($cat->nombre) ?></td>
                    <td class="acciones">
                        <a href="<?=base_url?>Categoria/editar/<?=$cat->id?>" class="btn-editar">Editar</a>
                        <a href="<?=base_url?>Categoria/confirmEliminar/<?=$cat->id?>" class="btn-eliminar">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">No hay categorías disponibles.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>