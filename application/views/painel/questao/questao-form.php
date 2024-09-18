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
                      <div class="row mb-4">
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
                            <div style="height:225px" class="form-control d-flex justify-content-center">
                              <img id="image-preview" class="img-fluid rounded" src="<?=base_url('{queimg}')?>" alt="">
                            </div>
                            <input class="mt-2" id="queimg" type="file" name="queimg" onchange="previewImage(event)"/>
                          </div>
                        </div>
                      </div>
                      <div class="row mb-5">
                        <div class="col-md-12">
                          <div class="form-row">
                            <div class="form-group col-md-12">
                              <label for="quetexto">Texto:</label>
                              <textarea class="form-control" id="quetexto" name="quetexto">
                                {quetexto}
                              </textarea>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="d-flex flex-column mb-2">
                        <label>Respostas:</label>
                        <p> Ao criar as opções de resposta para a sua questão, 
                          é obrigatório que você marque ( <input type="radio" checked> ) 
                          qual delas é a resposta correta.
                        </p>
                      </div>
                      
                      <div id="respostas-container">
                        {LIST_RESPOSTAS}
                        <div class="resposta-item row" id="resposta_{index}">
                          <div class="form-group col-12">
                            <input type="hidden" name="respostas[{index}][id]" value="{id}">
                            <input type="hidden" name="respostas[{index}][qrordem]" value="{qrordem}">
                            <div class="input-group">

                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <input type="radio" 
                                    name="resposta_correta" 
                                    value="{qrordem}"
                                    required
                                    {RES_CORRETA}
                                  >
                                  <span class="ml-3 f-w-600 resposta-ordem">{qrordem}</span>
                                </div>
                              </div>

                              <div class="form-control d-flex flex-column" style="max-width:200px">
                                <img id="qr-preview{index}" class="img-fluid mb-2 rounded" src="<?=base_url('{qrimg}')?>" alt="">
                                <input class="mb-1" type="file" name="respostas[{index}]" onchange="previewResImage(event, {index})"/>
                              </div>

                              <input class="form-control"
                                type="text" 
                                name="respostas[{index}][qrtexto]" 
                                value="{qrtexto}"
                                required
                              >

                              <div class="input-group-append">
                                <button style="display: none" type="button" class="btn btn-sm btn-danger btn-remove-resposta" onclick="removeResposta(this)">
                                  <span class="feather icon-trash-2 f-16 text-c-white"></span>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                        {/LIST_RESPOSTAS}
                      </div>
                      <button type="button" id="add-resposta" class="btn btn-add-resposta text-success text-center w-100 mb-4" onclick="addResposta()">
                        <i class="feather icon-plus"></i>Adicionar
                      </button>
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


<script src="<?= base_url('assets/plugins/tinymce/tinymce.min.js') ?>"></script>
<script>
  let rcount = {RESPOSTAS_COUNT};


  window.onload = function () {
    {RES_OK}
    $("#quesituacao").val({quesituacao});
    enableLastBtn();
  }


  //Inicializa editor de texto da questao
  tinymce.init({
    selector: '#quetexto',
    height: 460,
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


  //Exibe queimg do upload
  function previewImage(event) {
    var file = event.target.files[0];
    if(!file) return;
    document.getElementById('image-preview').src = URL.createObjectURL(file);
  }


  //Exibe qrimg do upload
  function previewResImage(event, index) {
    var preview = document.getElementById('qr-preview' + index);
    var file = event.target.files[0];
    if(!file) return;
    preview.src = URL.createObjectURL(file);
  }


  //Adiciona uma nova opcao de resposta
  function addResposta() {
    disableBtns();
    const letra = String.fromCharCode(65 + rcount);
    const respostaHtml = `
      <div class="resposta-item row" id="resposta_${rcount}">
        <div class="form-group col-12">
          <input type="hidden" respostas[${rcount}][id]" value="null">
          <input type="hidden" name="respostas[${rcount}][qrordem]" value="${letra}">
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input type="radio" 
                  name="resposta_correta" 
                  value="${letra}"
                  required
                  {RES_CORRETA}
                >
                <span class="ml-3 f-w-600 resposta-ordem">${letra}</span>
              </div>
            </div>

            <div class="form-control d-flex flex-column" style="max-width:200px">
              <img id="qr-preview${rcount}" class="img-fluid mb-2 rounded" src="" alt="">
              <input class="mb-1" type="file" name="respostas[${rcount}]" onchange="previewResImage(event, ${rcount})"/>
            </div>

            <input class="form-control"
              type="text"
              name="respostas[${rcount}][qrtexto]" 
              value=""
              required
            >

            <div class="input-group-append">
              <button type="button" class="btn btn-sm btn-danger btn-remove-resposta" onclick="removeResposta(this)">
                <span class="feather icon-trash-2 f-16 text-c-white"></span>
              </button>
            </div>
          </div>
        </div>
      </div>
    `;

    document.getElementById('respostas-container').insertAdjacentHTML('beforeend', respostaHtml);
    rcount++;
  };


  function removeResposta(button) {
    let respostaItem = button.closest('.resposta-item');
    respostaItem.remove();
    rcount--;
    enableLastBtn();
  }


  function disableBtns() {
    if (rcount > 0) {
      document.querySelectorAll('.btn-remove-resposta').forEach(button => {
          button.style.display = 'none';
      });
    }
  }


  function enableLastBtn() {
    const lastRemoveButton = document.querySelector('.resposta-item:last-child .btn-remove-resposta');
    if (lastRemoveButton) {
      lastRemoveButton.style.display = 'block';
    }
  }
</script>