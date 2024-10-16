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
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-row">
                            <div class="form-group col-md-12">
                              <label for="idquestaotipo">Tipo: *</label>
                              <select class="form-control" name="idquestaotipo" id="idquestaotipo" onchange="handleQuestaoTipo()">
                                <option value="1">Objetiva</option>
                                <option value="2">Discursiva</option>
                              </select>
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
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="queimg">Imagem inicial:</label>
                            <div style="height: 135px" class="form-control d-flex justify-content-center">
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


                      <div id="discursivaResposta">
                        <div class="row mb-5">
                          <div class="col-md-12">
                            <div class="form-row">
                              <div class="form-group col-md-12">
                                <label for="quediscursiva">Resposta correta:</label>
                                <textarea class="form-control" id="quediscursiva" name="quediscursiva">
                                  {quediscursiva}
                                </textarea>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>


                      <div id="alternativas">
                        <label class="mb-3">Alternativas:</label>
                      
                        <div id="respostas-container">
                          {LIST_RESPOSTAS}
                          <div class="resposta-item" id="resposta_{index}">
                            <div class="form-group d-flex flex-column flex-sm-row mb-4">

                              <input type="hidden" name="respostas[{index}][id]" value="{id}">
                              <input type="hidden" name="respostas[{index}][qrordem]" class="resposta-ordem-input" value="{qrordem}">

                              <div class="d-flex align-self-center">
                                <input type="radio" id="radio_{index}" class="resposta-ordem-radio mr-2"
                                  name="resposta_correta" 
                                  value="{qrordem}"
                                  required
                                  {RES_CORRETA}
                                >
                                <label for="radio_{index}" class="badge badge-primary rounded-circle mb-0 resposta-ordem resposta-ordem-label">
                                  {qrordem}
                                </label>
                              </div>

                              <div class="input-group ml-0 ml-sm-3 my-2 my-sm-0">
                                <input class="form-control"
                                  type="text" 
                                  name="respostas[{index}][qrtexto]" 
                                  value="{qrtexto}"
                                >
                              </div>

                              <div class="form-control qrimg d-flex flex-column mx-0 mx-sm-1 my-sm-0 my-1 p-2">
                                <img id="qr-preview{index}" class="img-fluid mb-2 rounded" src="<?=base_url('{qrimg}')?>" alt="">
                                <input class="mb-1" type="file" name="respostas[{index}]" onchange="previewResImage(event, {index})"/>
                              </div>

                              <button type="button" class="btn btn-sm btn-danger btn-remove-resposta m-0" onclick="removeResposta(this)">
                                <span class="feather icon-trash-2 f-16 text-c-white"></span>
                              </button>
                            </div>
                          </div>
                          {/LIST_RESPOSTAS}
                        </div>
                        <button type="button"
                          id="add-resposta"
                          class="btn btn-add-resposta text-success text-center w-100 mb-4"
                          onclick="addResposta()"
                        >
                          <i class="feather icon-plus"></i>Adicionar
                        </button>
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

<script src="<?= base_url('assets/plugins/tinymce/tinymce.min.js') ?>"></script>

<script>
  let rcount = {RESPOSTAS_COUNT};

  window.onload = function () {
    {RES_OK}
    $("#quesituacao").val({quesituacao});
    $("#idquestaotipo").val({idquestaotipo});
    reordenarRespostas();
    handleQuestaoTipo();
  }



  // https://www.tiny.cloud/docs/tinymce/latest/file-image-upload/
  const handleImageUpload = (blobInfo, progress) => new Promise((resolve, reject) => {
    const xhr = new XMLHttpRequest();
    xhr.withCredentials = false;
    xhr.open('POST', '{URL_UPLOADTINYMCE}');

    xhr.upload.onprogress = (e) => {
      progress(e.loaded / e.total * 100);
    };

    xhr.onload = () => {
      if (xhr.status === 403) {
        reject({ message: 'HTTP Error: ' + xhr.status, remove: true });
        return;
      }

      if (xhr.status < 200 || xhr.status >= 300) {
        reject('HTTP Error: ' + xhr.status);
        return;
      }

      const json = JSON.parse(xhr.responseText);

      if (!json || typeof json.location != 'string') {
        reject('Invalid JSON: ' + xhr.responseText);
        return;
      }

      resolve(json.location);
    };

    xhr.onerror = () => {
      reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
    };

    const formData = new FormData();
    formData.append('file', blobInfo.blob(), blobInfo.filename());

    xhr.send(formData);
  });



  tinymce.init({
    selector: '#quetexto',
    height: 460,
    plugins: [
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
    branding: false,
    relative_urls: false,
    remove_script_host: false,
    convert_urls: true,
    images_upload_handler: handleImageUpload
  });



  tinymce.init({
    selector: '#quediscursiva',
    height: 460,
    plugins: [
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
    if(!file) return;
    document.getElementById('image-preview').src = URL.createObjectURL(file);
  }



  function previewResImage(event, index) {
    var preview = document.getElementById('qr-preview' + index);
    var file = event.target.files[0];
    if(!file) return;
    preview.src = URL.createObjectURL(file);
  }



  function reordenarRespostas() {
    const respostas = document.querySelectorAll('.resposta-item');

    respostas.forEach((resposta, index) => {
        const ordemAtualizada = String.fromCharCode(65 + index);
        const ordemInput = resposta.querySelector('.resposta-ordem-input');
        ordemInput.value = ordemAtualizada;
        const ordemLabel = resposta.querySelector('.resposta-ordem-label');
        ordemLabel.textContent = ordemAtualizada;
        const radioInput = resposta.querySelector('.resposta-ordem-radio');
        radioInput.value = ordemAtualizada;
    });
  }

  function handleQuestaoTipo() {
    var idquestaotipo = document.getElementById('idquestaotipo');
    var alternativas = document.getElementById('alternativas');
    var discursivaResposta = document.getElementById('discursivaResposta');

    if (idquestaotipo.value == 1){
      alternativas.style.display = 'block';
      discursivaResposta.style.display = 'none';
    }
    else {
      alternativas.style.display = 'none';
      discursivaResposta.style.display = 'block';
    }
  }


  function addResposta() {
    const letra = String.fromCharCode(65 + rcount);
    const respostaHtml = `
      <div class="resposta-item" id="resposta_${rcount}">
        <div class="form-group d-flex flex-column flex-sm-row mb-4">

          <input type="hidden" name="respostas[${rcount}][qrordem]" class="resposta-ordem-input" value="${letra}">

          <div class="d-flex align-self-center">
            <input type="radio" id="radio_${rcount}" class="resposta-ordem-radio mr-2"
              name="resposta_correta" 
              value="${letra}"
              required
              {RES_CORRETA}
            >
            <label for="radio_${rcount}" class="badge badge-primary mb-0 rounded-circle resposta-ordem resposta-ordem-label">
              ${letra}
            </label>
          </div>

          <div class="input-group ml-0 ml-sm-3 my-2 my-sm-0">
            <input class="form-control"
              type="text" 
              name="respostas[${rcount}][qrtexto]" 
              value=""
              required
            >
          </div>

          <div class="form-control qrimg d-flex flex-column mx-0 mx-sm-1 my-sm-0 my-1 p-2">
            <img id="qr-preview${rcount}" class="img-fluid mb-2 rounded" src="" alt="">
            <input class="mb-1" type="file" name="respostas[${rcount}]" onchange="previewResImage(event, ${rcount})"/>
          </div>

          <button type="button" class="btn btn-sm btn-danger btn-remove-resposta m-0" onclick="removeResposta(this)">
            <span class="feather icon-trash-2 f-16 text-c-white"></span>
          </button>
        </div>
      </div>
    `;

    document.getElementById('respostas-container').insertAdjacentHTML('beforeend', respostaHtml);
    rcount++;
    reordenarRespostas();
  };


  
  function removeResposta(button) {
    let respostaItem = button.closest('.resposta-item');
    respostaItem.remove();
    reordenarRespostas();
  }
</script>