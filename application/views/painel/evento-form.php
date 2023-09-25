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
                                    <h5 class="m-b-10">Evento</h5>
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
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label for="evenome">Nome: *</label>
                                                            <input type="text" class="form-control" id="evenome" name="evenome" required value="{evenome}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="evesituacao">Situação:</label>
                                                        <select class="form-control" name="evesituacao" id="evesituacao">
                                                            <option value="0">Criado</option>
                                                            <option value="1">Iniciado</option>
                                                            <option value="2">Finalizado</option>
                                                        </select>
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
    $("#evenome").focus();

    $("#evesituacao").val({evesituacao});
}
</script>