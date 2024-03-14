<!-- [ signin-img ] start -->
<div class="auth-wrapper aut-bg-img-side cotainer-fiuid align-items-stretch">
  <div class="row align-items-center w-100 align-items-stretch bg-white">
    <div class="col-lg-4 col-md-6 col-sm-12 mx-auto align-items-stret h-100 ad-flex justify-content-center">
      <div class="auth-content">
        <div class="row mb-3">
          <div class="col-12 align-self-center text-center">
            <img width="175px" src="<?=base_url('assets/img/logo_cor.png') ?>" alt="" class="img-fluid">
          </div>
        </div>
        <div class="row">
          <div class="col-12 align-self-center text-center my-3">
            <img width="155px" src="<?=base_url('assets/img/quiz_logo.png') ?>" alt="" class="img-fluid">
          </div>
        </div>
        
        <h4 class="mb-3 f-w-400">Dados de Acesso</h4>

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

        <p class="m-0"><a href="#" class="text-primary f-w-400" data-toggle="modal" data-target="#modalRecSenha">Esqueceu a senha?</a></p>
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