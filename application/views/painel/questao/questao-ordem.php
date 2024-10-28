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
                <div id="sortable-items-container" class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-6">
                        <p class="f-18">Ordenar questões</p>
                      </div>
                    </div>
                    <form>
                      <div class="dt-responsive table-responsive">
                        <table id="tabListagem" class="table table-striped table-bordered nowrap table-questao">
                          <thead>
                            <tr>
                              <th class="d-none">ID</th>
                              <th width="30px">Ordem</th>
                              <th>Pontuação</th>
                              <th>Tempo</th>
                              <th>Texto da questão</th>
                            </tr>
                          </thead>
                          <tbody id="sortable-items">
                            {LIST_DADOS}
                            <tr data-id="{id}">
                              <td class="d-none">{id}</td>
                              <td id="ordem" class="f-w-700">Questão {queordem}</td>
                              <td>{queponto} pontos</td>
                              <td>{quetempo} segundos</td>
                              <td><div class="table-questao-texto">{quetexto}</div></td>
                            </tr>
                            {/LIST_DADOS}
                          </tbody>
                        </table>
                      </div>            
                    </form>
                    <div id="confirm-ordem" class="row pt-2">
                      <div class="col-sm-12 d-flex justify-content-end">
                        <button id="confirm-ordem-button" class="btn btn-success" style="display: none;">
                          <i class="feather icon-check"></i> Confirmar ordem
                        </button>
                      </div>
                    </div>
                  </div>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  window.onload = function () {
    {RES_OK}
    $('.table-questao-texto img').addClass('img-fluid rounded');
  }

  $(document).ready(function(){
    $("#sortable-items").sortable({
        axis: "y",
        update: function(event, ui){
          var ordem = $(this).sortable('toArray', {attribute: 'data-id'});
          var confirmButton = $("#confirm-ordem-button");
          // console.log(ordem);

          $('#sortable-items tr').each(function(index){
            $(this).find('td#ordem').text('Questão ' + (index + 1));
          });

          confirmButton.css("display", "block");
          confirmButton.off().click(function(){
            window.location.href = "{URL_FRM}?ordem=" + ordem.join(',');
          });
        }
    });
  });
</script>