<?php use Utils\Utils; ?>
<h1>Editar Perfil</h1>

<?php if (isset($_SESSION["update_error"])): ?>
    <div class="alert alert-error"><?= $_SESSION["update_error"] ?></div>
    <?php Utils::deleteSession("update_error"); ?>
<?php endif; ?>

<?php if (isset($_SESSION["update_success"])): ?>
    <div class="alert alert-success"><?= $_SESSION["update_success"] ?></div>
    <?php Utils::deleteSession("update_success"); ?>
<?php endif; ?>

<div class="form-container">
    <form action="<?=base_url?>Usuario/update" method="POST">
        <label for="nombre">Nombre *</label>
        <input type="text" name="data[nombre]" value="<?= $usuario->nombre ?? '' ?>" required>
        <?php if (isset($errores["nombre"])): ?>
            <div class="error"><?= $errores["nombre"] ?></div>
        <?php endif; ?>
        
        <label for="apellidos">Apellidos</label>
        <input type="text" name="data[apellidos]" value="<?= $usuario->apellidos ?? '' ?>">
        <?php if (isset($errores["apellidos"])): ?>
            <div class="error"><?= $errores["apellidos"] ?></div>
        <?php endif; ?>
        
        <label for="email">Email *</label>
        <input type="email" name="data[email]" value="<?= $usuario->email ?? '' ?>" required>
        <?php if (isset($errores["email"])): ?>
            <div class="error"><?= $errores["email"] ?></div>
        <?php endif; ?>
        
        <label for="password">Nueva Contraseña (dejar en blanco para mantener la actual)</label>
        <input type="password" name="data[password]">
        
        <label for="confirm_password">Confirmar Nueva Contraseña</label>
        <input type="password" name="data[confirm_password]">
        <?php if (isset($errores["confirm_password"])): ?>
            <div class="error"><?= $errores["confirm_password"] ?></div>
        <?php endif; ?>
        
        <p class="form-info">* Campos obligatorios</p>
        
        <div class="botones">
            <input type="submit" value="Guardar Cambios" class="btn btn-primary">
            <a href="<?=base_url?>" class="btn">Cancelar</a>
        </div>
    </form>
</div>