<div class="view-content">
    <h2>Login</h2>
    <form method="post" action="<?=$action?>" style="width: 400px;">
        <label>Usuario</label>
        <input type="text" name="usuario" />
        <label>Senha</label>
        <input type="password" name="senha" />
        <input type="submit" value="confirmar" />
    </form>
    <?php if (!empty($message)): ?>
    <br />
    <p style="color: red; text-align: center;"><?= $message; ?></p>
    <?php endif; ?>
</div>