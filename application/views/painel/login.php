<!-- [ signin-img ] start -->
<div class="auth-wrapper">
  <div class="auth-content container">
    <div class="card card-rounded">
      <div class="card-body row align-items-center">
        <div class="col-md-6">
          <div class="mb-4">
            <h1 class="quiz-title">Quiz IFES</h1>
          </div>

          <h6 class="mb-3 f-w-400">Dados de acesso</h6>

          {RES_MSG}

          <form action="{URL_ACAO}" method="post">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="feather icon-user"></i></span>
              </div>
              <input type="text" class="form-control" id="email" name="email" placeholder="E-mail">
            </div>
            
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="feather icon-lock"></i></span>
              </div>
              <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
            </div>
            
            <button type="submit" class="btn btn-primary btn-block mb-4">Acessar</button>
          </form>

          <div class="d-flex justify-content-between align-items-center">
            <a href="#" class="text-primary" data-toggle="modal" data-target="#modalRecSenha">
              <small>Esqueceu a senha?</small>
            </a>
            <img width="100px" src="<?=base_url('assets/img/logo_cor.png') ?>" alt="" class="img-fluid">
          </div>
        </div>

        <div class="col-md-6">
          <div class="aut-bg-img"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- [ signin-img ] end -->

<div id="modalRecSenha" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form method="post" action="<?=site_url('Login/enviarRecSenha')?>">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLiveLabel">Recuperação de Senha</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="recemail">E-mail: *</label>
                    <input type="text" class="form-control" id="recemail" name="recemail" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
          </form>
        </div>
    </div>
</div>