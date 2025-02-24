<?php use Models\Categoria; ?>
<h1>Gestionar productos</h1>


<a href="<?= base_url ?>Producto/crear">Crear producto</a>
<?php $categorias = Categoria::obtenerCategorias(); ?>

<?php if (isset($error) && !empty($error)): ?>
    <div class="error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<table>
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>PRECIO</th>
        <th>STOCK</th>
        <th>ACCIONES</th>
    </tr>
    <?php if (isset($productos)): ?>
        <?php while ($prod = $productos->fetch(PDO::FETCH_OBJ)): ?>
            <tr>
                <td><?= htmlspecialchars($prod->id) ?></td>
                <td><?= htmlspecialchars($prod->nombre) ?></td>
                <td><?= htmlspecialchars($prod->precio) ?></td>
                <td><?= htmlspecialchars($prod->stock) ?></td>
                <td>
                    <a href="<?= base_url ?>Producto/editar/<?= htmlspecialchars($prod->id) ?>">Editar</a>
                    <a href="<?= base_url ?>Producto/eliminar/<?= htmlspecialchars($prod->id) ?>">Eliminar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">No hay productos</td>
        </tr>
    <?php endif; ?>
</table>
