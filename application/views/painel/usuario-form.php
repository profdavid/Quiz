<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <!-- [ breadcrumb ] start -->
                <div class="page-header">
                    <div class="page-block">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="page-header-title">
                                    <h5 class="m-b-10">Usuários</h5>
                                </div>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?=site_url('painel') ?>"><i class="feather icon-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="{URL_CANCELAR}">Listagem</a></li>
                                    <li class="breadcrumb-item"><a href="#!">{LABEL_ACAO}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ breadcrumb ] end -->
                
                <div class="main-body">
                    <div class="page-wrapper">
                        <!-- [ Main Content ] start -->
                        <div class="row">
                            <div class="col-sm-12">
                                {RES_ERRO}

                                <div class="card">
                                    <form role="form" id="frmacao" name="frmacao" method="post" action="{URL_FRM}">
                                    <input type="hidden" id="id" name="id" value="{id}" />
                                    
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="usunome">Nome: *</label>
                                                            <input type="text" class="form-control" id="usunome" name="usunome" required value="{usunome}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="usuemail">E-mail: *</label>
                                                        <input type="email" class="form-control" id="usuemail" name="usuemail" required value="{usuemail}">
                                                    </div>

                                                    <div class="form-group col-md-3">
                                                        <label for="senha">Senha: *</label>
                                                        <input type="password" class="form-control" id="senha" name="senha" {senha_req}>
                                                    </div>

                                                    <div class="form-group col-md-3">
                                                        <label for="senhaconf">Confirma Senha: *</label>
                                                        <input type="password" class="form-control" id="senhaconf" name="senhaconf" {senha_req}>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-md-6 mt-4">
                                                        <label>Ativo: </label>
                                                        <div class="switch switch-success d-inline m-r-10">
                                                            <input type="checkbox" id="ativo" name="ativo" value="1" {ativo}>
                                                            <label for="ativo" class="cr"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <a class="btn btn-danger" href="{URL_CANCELAR}"><i class="feather icon-x"></i>CANCELAR</a>
                                        <button type="submit" class="btn btn-success"><i class="feather icon-save"></i>SALVAR</button> 
                                    </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- [ Main Content ] end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->

<script>
window.onload = function(){
    {RES_OK}
    $("#usunome").focus();
}
</script>