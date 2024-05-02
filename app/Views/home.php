<div class="container">
    <?php if (isset(session()->login_error)) { ?>
        <div calss="alert alert-danger" role="alert">
            <?=session()->login_error?>
        </div>
    <?php } ?>
    <h1>Página de inicio</h1>
    <h2>Iniciar sesión</h2>
    <form action="<?= site_url('user/login') ?>" method="post">
            <div class="form-group">
                <label for="login">Nombre de Usuario</label>
                <input class="form-control" name="login">
            </div>
            <div calss="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
</div>
