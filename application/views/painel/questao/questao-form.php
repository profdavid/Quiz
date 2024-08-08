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
                  <h5 class="m-b-10">Questões</h5>
                </div>
                <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?= site_url('painel') ?>"><i class="feather icon-home"></i></a>
                  </li>
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
                      <div class="row mb-2">
                        <div class="col-md-12">
                          <div class="form-row">
                            <div class="form-group col-md-12">
                                <h5>Questão {queordem}</h5>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-row">
                            <input type="hidden" class="form-control" id="queordem" name="queordem" readonly value="{queordem}">
                            <div class="form-group col-md-12">
                              <label for="queponto">Pontuação: *</label>
                              <input type="number" class="form-control" id="queponto" name="queponto" required value="{queponto}">
                            </div>
                            <div class="form-group col-md-12">
                              <label for="quetempo">Tempo (segundos): *</label>
                              <input type="number" class="form-control" id="quetempo" name="quetempo" required value="{quetempo}">
                            </div>
                            <div class="form-group col-md-12">
                              <label for="quesituacao">Situação: *</label>
                              <select class="form-control" name="quesituacao" id="quesituacao">
                                <option value="0">Não liberada</option>
                                <option value="1">Liberada</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-8">
                          <div class="form-group col-md-12">
                            <label for="queimg">Imagem inicial:</label>
                            <div class="form-control d-flex justify-content-center img-questao-form-wrapper">
                              <img id="image-preview" class="img-fluid" src="<?=base_url('{queimg}')?>" alt="">
                            </div>
                            <input class="mt-2" id="queimg" type="file" name="queimg" size="20" onchange="previewImage(event)"/>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-row">
                            <div class="form-group col-md-12">
                              <label for="quetexto">Texto da questão: *</label>
                              <textarea class="form-control" id="quetexto" name="quetexto" required>
                                {quetexto}
                              </textarea>
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

 <!-- tinymce -->
 <script src="<?php echo base_url('assets/plugins/tinymce/tinymce.min.js') ?>"></script>

<script>
  window.onload = function () {
    {RES_OK}
    $("#quesituacao").val({quesituacao});
  }

  tinymce.init({
    selector: '#quetexto',
    height: 320,
    plugins:[
        'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'anchor', 'pagebreak',
        'searchreplace', 'wordcount', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 
        'emoticons', 'template', 'codesample'
    ],
    toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify |' + 
    'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
    'forecolor backcolor emoticons',
    menu: {
        favs: {title: 'Menu', items: 'code visualaid | searchreplace | emoticons'}
    },  
    menubar: 'favs file edit view insert format tools table',
    content_style: 'body{font-family:Helvetica,Arial,sans-serif; font-size:16px}',
    branding: false
  });

  function previewImage(event) {
    var file = event.target.files[0];
    var reader = new FileReader();
    reader.onload = function(e) {
      document.getElementById('image-preview').src = e.target.result;
    };
    reader.readAsDataURL(file);
  }

</script>