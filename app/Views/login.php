<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Codeigniter Login with Email/Password Example</title>
  </head>
  <body>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-5">
                
                <h2>Login in</h2>
                
                <?php if(session()->getFlashdata('msg')):?>
                    <div class="alert alert-warning">
                       <?= session()->getFlashdata('msg') ?>
                    </div>
                <?php endif;?>
                <form action="<?php echo base_url(); ?>/Auth/loginAcc" method="post">
                    <div class="form-group mb-3">
                        <label for="usuario">Usuario</label>
                        <input type="text" name="usuario" placeholder="Usuario" value="<?= set_value('usuario') ?>" class="form-control" >
                    </div>
                    <div class="form-group mb-3">
                        <label for="contrasena">contraseña</label>
                        <input type="password" name="contrasena" placeholder="contrasena" class="form-control" >
                    </div>
                    
                    <div class="d-grid">
                         <button type="submit" class="btn btn-success">Iniciar Sesión</button>
                    </div>     
                </form>
            </div>
              
        </div>
    </div>
  </body>
</html>