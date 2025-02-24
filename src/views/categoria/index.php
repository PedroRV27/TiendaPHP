<?php use Models\Categoria; ?>
<h1>Gestionar especialidad</h1>



<table>
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>
        <!-- <th>ACCIONES</th> -->
    </tr>

        <?php while ($cat = $categorias->fetch(PDO::FETCH_OBJ)): ?>
            <tr>
                <td><?= htmlspecialchars($cat->id) ?></td>
                <td><?= htmlspecialchars($cat->nombre) ?></td>
            </tr>
        <?php endwhile; ?>

        <tr>
            <td colspan="3">No hay categorías</td>
        </tr>

</table>
