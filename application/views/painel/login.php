<!-- [ signin-img ] start -->
<div class="auth-wrapper aut-bg-img-side cotainer-fiuid align-items-stretch">
  <div class="row align-items-center w-100 align-items-stretch bg-white">
    <div class="col-md-4 align-items-stret h-100 ad-flex justify-content-center">
      <div class="auth-content">
        <div class="row">
          <div class="col-12 text-center">
            <img src="<?=base_url('assets/img/brand01.png') ?>" alt="" class="img-fluid mb-4">
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
        
        <p class="mb-2 text-muted"><a href="#" class="text-primary f-w-400" data-toggle="modal" data-target="#modalRecSenha">Esqueceu a senha?</a></p>
      </div>
    </div>

    <div class="d-none d-lg-flex col-md-8 aut-bg-img d-md-flex justify-content-center">
      <div class="col-md-8 d-flex">
        <div class="auth-content d-flex align-items-stretch">
          <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <!-- <ol class="carousel-indicators justify-content-start mx-0">
              <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
              <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <h1 class="text-white mb-5">Login in A&G Sistemas</h1>
                <p class="text-white">A melhor solução de controle para sua empresa.</p>
              </div>
              <div class="carousel-item">
                <h1 class="text-white mb-5">Login in Elite Able</h1>
                <p class="text-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.</p>
              </div>
              <div class="carousel-item">
                <h1 class="text-white mb-5">Login in Elite Able</h1>
                <p class="text-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.</p>
              </div>
            </div> -->
          </div>
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