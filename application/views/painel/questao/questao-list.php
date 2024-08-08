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
                  <li class="breadcrumb-item"><a href="#!">Listagem</a></li>
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
                  <div class="card-body">
                    <div class="row mb-2">
                      <div class="col-6">
                        <p class="f-18">Listagem de Questões</p>
                      </div>
                      <div class="col-6 text-right">
                      <a class="btn btn-secondary" href="{URL_ORDEM}"><i class="feather icon-file"></i>Relatório</a>
                        <a class="btn btn-info" href="{URL_ORDEM}"><i class="feather icon-move"></i>Ordenação</a>
                        <a class="btn btn-success" href="{URL_NOVO}"><i class="feather icon-plus"></i>Nova questão</a>
                      </div>
                    </div>
                    <div class="dt-responsive table-responsive">
                      <table id="tabListagem" class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>Ordem</th>
                            <th>Pontuação</th>
                            <th>Tempo</th>
                            <th>Texto</th>
                            <th data-sortable="false" width="60" class="text-center">Ações
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          {LIST_DADOS}
                          <tr {COR_LIBERADA}>
                            <td><a href="{URL_EDITAR}">Questão {queordem}</td>
                            <td><a href="{URL_EDITAR}">{queponto} pontos</a></td>
                            <td><a href="{URL_EDITAR}">{quetempo} segundos</td>
                            <td><div class="table-questao-texto">{quetexto}</div></td>
                            <td class="text-center d-flex justify-content-end">
                            <button type="button" class="tabledit-delete-button btn btn-default mr-4"
                                onclick="chamaAnular({id}, '{queordem}')">
                                <span class="feather icon-slash f-16"></span>
                              </button>
                              <a href="{URL_EDITAR}" class="tabledit-delete-button mr-4">
                                <span class="feather icon-edit f-16"></span>
                              </a>
                              <button type="button" class="tabledit-delete-button btn btn-default"
                                onclick="chamaExcluir({id}, '{queordem}')">
                                <span class="feather icon-trash-2 f-16 text-c-red"></span>
                              </button>
                            </td>
                          </tr>
                          {/LIST_DADOS}
                        </tbody>
                      </table>
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

<div id="modalExcluir" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLiveLabel">Atenção - Exclusão de Registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <p>Deseja excluir o registro?</p>
        <p>
          <span class="feather icon-trash-2 f-16 text-c-red mr-2"></span>
          Questão
          <span id="txt-excluir"></span>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

        <form id="frmexcluir" name="frmexcluir" method="post" action="{URL_EXCLUIR}">
          <input type="hidden" id="idexcluir" name="idexcluir" value="" />
          <button type="submit" class="btn btn-primary">Excluir</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div id="modalAnular" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLiveLabel">Atenção - Anular questão</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <p>Deseja anular a questão? Isso fará com que todas as equipes do evento adquiram nota máxima nessa questão.</p>
        <p>
          <span class="feather icon-slash f-16 mr-2"></span>
          Questão
          <span id="txt-anular"></span>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

        <form id="frmanular" name="frmanular" method="post" action="{URL_ANULAR}">
          <input type="hidden" id="idanular" name="idanular" value="" />
          <button type="submit" class="btn btn-primary">Anular</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  window.onload = function () {
    {RES_OK}

    $('#tabListagem').DataTable({
      "language": {
        "url": "<?php echo base_url('assets/plugins/data-tables/json/dataTables.ptbr.json') ?>"
      },
      "aaSorting": []
    });
  };

  function chamaAnular(id, str){
    $('#modalAnular').modal('show');
    $('#idanular').val(id);
    $('#txt-anular').html(str);
  }
</script>