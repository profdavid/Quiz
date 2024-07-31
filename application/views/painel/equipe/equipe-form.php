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
                                    <h5 class="m-b-10">Equipes</h5>
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
                                    <form role="form" id="frmacao" enctype="multipart/form-data" name="frmacao" method="post" action="{URL_FRM}">
                                    <input type="hidden" id="id" name="id" value="{id}" />
                                    
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="equnome">Nome: *</label>
                                                            <input type="text" class="form-control" id="equnome" name="equnome" required value="{equnome}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-12 mt-4">
                                                        <label>Logada: </label>
                                                        <div class="switch switch-success d-inline m-r-10">
                                                            <input type="checkbox" id="equlogada" name="equlogada" value="1" {equlogada}>
                                                            <label for="equlogada" class="cr"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-row">
                                                    <div class="col-md-12">
                                                        <label for="equlogo">Logo:</label>
                                                        <div class="form-control d-flex justify-content-center">
                                                            <img id="image-preview" width="80px" src="<?=base_url('{equlogo}')?>" alt="">
                                                        </div>
                                                        <input class="mt-2" id="equlogo" type="file" name="equlogo" size="20" onchange="previewImage(event)"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer d-flex justify-content-end">
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
    }

    function previewImage(event) {
        var file = event.target.files[0];

        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('image-preview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
</script>