<style>
    table td {
        padding: 0.5rem 0.75rem !important;
    }
</style>

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
                                    <h5 class="m-b-10">Acompanhamento</h5>
                                </div>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#!">Questões</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ breadcrumb ] end -->

                <div class="main-body">
                    <div class="page-wrapper">
                        <!-- [ Main Content ] start -->
                        <?php if($id): ?>
                            <div class="row">
                                {RES_ERRO}
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="d-flex flex-column align-items-center justify-content-between mt-2 mt-sm-0 flex-sm-row">
                                                                <div class="d-flex align-items-center mr-0 mr-sm-4">
                                                                    <?php if($queordem > 1): ?>
                                                                        <a class="mr-3 text-dark" href="{URL_ANTERIOR}">
                                                                            <span style="font-size: 14px" class="fa-solid fa-chevron-left"></span>
                                                                        </a>
                                                                    <?php endif ?>
                                                                    
                                                                    <h3 class="mb-0 text-{LIBERADA}">
                                                                        Questão {queordem}
                                                                    </h3>

                                                                    <?php if($queordem < $COUNT_QUESTOES): ?>
                                                                        <a class="ml-3 text-dark" href="{URL_PROXIMO}">
                                                                            <span style="font-size: 14px" class="fa-solid fa-chevron-right"></span>
                                                                        </a>
                                                                    <?php endif ?>
                                                                </div>
                                                                <div class="d-flex mt-3 mt-sm-0">
                                                                    <div class="badge badge-small text-{LIBERADA} w-100">
                                                                        <i class="fa-solid fa-circle-info mr-2"></i>{SITUACAO}
                                                                    </div>
                                                                    <div class="badge badge-small text-info w-100 mx-2">
                                                                        <i class="fa-solid fa-star mr-2"></i>{queponto} pontos
                                                                    </div>
                                                                    <div class="badge badge-small text-danger w-100">
                                                                        <i class="fa-solid fa-clock mr-2"></i>{quetempo} segundos
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row mt-3">
                                                        <div class="col-md-12">
                                                            <div class="d-flex flex-column-reverse flex-sm-row justify-content-between text-center text-sm-left">
                                                                <div class="quetexto">{quetexto}</div>
                                                                <div class="p-0 my-3 my-sm-0">
                                                                    <button class="btn m-0 p-0" onclick="chamaViewQuestaoImage()">
                                                                        <img style="max-width: 125px" class="img-fluid rounded" src="<?= base_url('{queimg}') ?>" alt="questao_logo">
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12 my-4">
                                                            <?php if(!$quesituacao): ?>
                                                                <a class="btn btn-sm btn-primary" href="{URL_LIBERAR}">
                                                                    <i class="fa-solid fa-play"></i>Liberar questão
                                                                </a>
                                                            <?php endif ?>

                                                            <?php if($COUNT_RESPOSTAS > 0 && $quesituacao): ?>
                                                                {RESPOSTAS}
                                                                    <div class="card-resposta d-flex align-items-center p-3 my-2 rounded">
                                                                        <span class="badge badge-primary rounded-circle resposta-ordem">
                                                                            {qrordem}
                                                                        </span>
                                                                        <div class="d-flex flex-column flex-sm-row align-items-center text-center mx-0 mx-sm-3 w-100">
                                                                            <img style="max-width: 100px" class="{SEM_IMAGEM} img-fluid rounded mx-3" src="<?= base_url('{qrimg}') ?>" alt="">
                                                                            <div class="mx-3 my-1">{qrtexto}</div>
                                                                        </div>
                                                                    </div>
                                                                {/RESPOSTAS}
                                                            <?php endif ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h6 class="mb-0"><i class="fa-solid fa-check-circle text-secondary mr-2"></i>Resultados</h6>
                                                        <?php if($SHOW_RESULTS): ?>
                                                            <a href="{URL_ATUAL}" class="btn btn-sm btn-secondary m-0">
                                                                <i class="fa-solid fa-eye-slash"></i>Esconder resultados
                                                            </a>
                                                        <?php else: ?>
                                                            <a href="{URL_ATUAL}/true" class="btn btn-sm btn-info m-0">
                                                                <i class="fa-solid fa-eye"></i>Mostrar resultados
                                                            </a>
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <?php if($SHOW_RESULTS): ?>
                                                                <div class="card-resposta-correta d-flex align-items-center p-3 my-4 rounded">
                                                                    <span class="badge badge-success rounded-circle resposta-ordem">
                                                                        {CORRETA_qrordem}
                                                                    </span>
                                                                    <div class="d-flex flex-column flex-sm-row align-items-center text-center mx-0 mx-sm-3 w-100">
                                                                        <?php if (!empty($CORRETA_qrimg)): ?>
                                                                            <img style="max-width: 100px" class="img-fluid rounded mx-3" src="<?= base_url('{CORRETA_qrimg}') ?>" alt="qrimg">
                                                                        <?php endif; ?>
                                                                        <div class="mx-3 my-1 text-success">{CORRETA_qrtexto}</div>
                                                                    </div>
                                                                </div>

                                                                <div class="dt-responsive table-responsive">
                                                                    <table id="tabListagem" class="table table-striped table-bordered nowrap">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Ordem</th>
                                                                                <th>Equipe</th>
                                                                                <th>Resposta</th>
                                                                                <th>Tempo</th>
                                                                                <th>Pontuação</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            {RESULTS}
                                                                            <tr class="{COR_EQRSITUACAO}">
                                                                                <td>{ordem}</td>
                                                                                <td>{equnome}</td>
                                                                                <td>{qrordem}</td>
                                                                                <td>{eqttempo}</td>
                                                                                <td>{eqrponto}</td>
                                                                            </tr>
                                                                            {/RESULTS}
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            <?php endif ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Painel, Countdown e Atualizacoes start -->
                                        <div class="col-md-3 d-flex flex-column">
                                            <div class="card">
                                                <div class="card-body">
                                                    {QUESTOES}
                                                        <a href="{URL_ACCESS}">
                                                            <span class="badge badge-pill {ATUAL} {LIBERADA}">{queordem}</span>
                                                        </a>
                                                    {/QUESTOES}
                                                    <div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card">
                                                <div style="max-height: 200px" class="card-countdown">
                                                    <div class="p-2 d-flex flex-column text-center align-items-center justify-content-center">
                                                        <div class="count text-white" id="countdown"></div>
                                                        <div class="myBar ldBar label-center text-center"
                                                            data-value="0"
                                                            data-preset="circle"
                                                            data-stroke="white"
                                                            data-stroke-width="5"
                                                            style="width: 150px; height: 150px" 
                                                        ></div>
                                                    </div>
                                                </div>

                                                <div class="card-header">
                                                    <h6 class="mb-0">
                                                        <i class="fa-solid fa-clock text-secondary mr-2"></i>Atualizações
                                                    </h6>
                                                </div>
                                                <div class="card-body">
                                                    <div id="dataContainer"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Painel, Countdown e Atualizacoes end -->
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modalQuestaoImage" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLiveLabel">Questão {queordem} - Imagem</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body text-center p-0">
        <img class="w-100 img-fluid" src="<?= base_url('{queimg}') ?>" alt="questao_logo">
      </div>
    </div>
  </div>
</div>

<script>
    window.onload = function(){
        $("#questao").val({queordem});
        $('.quetexto img').addClass('img-fluid');
        $('#tabListagem').DataTable({
            "language": {
                "url": "<?php echo base_url('assets/plugins/data-tables/json/dataTables.ptbr.json') ?>"
            },
            "aaSorting": []
        });

        var tempoRestante = {tempoRestante};
        var bar = new ldBar(".myBar");
        var countdowncard = document.querySelector(".card-countdown");
        var countdown = document.getElementById("countdown");


        function exibeAtualizacoes(data) {
            var container = document.getElementById('dataContainer');
            container.innerHTML = '';

            if (data.length > 0) {
                var ol = document.createElement('ol');

                data.forEach(function(item) {
                    var li = document.createElement('li');
                    li.textContent = item.equnome;
                    ol.appendChild(li);
                });

                container.appendChild(ol);
            }
        }


        function buscaAtualizacoes() {
            fetch('{URL_ATUALIZACOES}', { method: 'GET' } )
            .then(response => {
                if (!response.ok) { throw new Error('Erro ao realizar operação.') }
                return response.json();
            })
            .then(data => { exibeAtualizacoes(data) })
            .catch(error => { console.error('Erro ao buscar atualizações:', error) });
        }


        function iniciarCountdown() {
            if (tempoRestante == -1){
                countdown.innerHTML = "Aguarde!";
                countdowncard.classList.add("bg-warning");
                return;
            }

            if (tempoRestante == 0) {
                countdown.innerHTML = "Tempo esgotado!";
                countdowncard.classList.add("bg-danger");
                buscaAtualizacoes();
                return;
            }

            var tempo = tempoRestante;
            countdowncard.classList.add("bg-primary");
            var att = setInterval(buscaAtualizacoes, 1500);

            var count = setInterval(function() {
                if (tempo <= 0) {
                    clearInterval(count);
                    clearInterval(att);
                    buscaAtualizacoes();
                    countdown.innerHTML = "Tempo esgotado!";
                    countdowncard.classList.add("bg-danger");
                    bar.set(0, false);
                    return;
                }

                var m = Math.floor(tempo / 60);
                var s = tempo % 60;
                countdown.innerHTML = m + "m " + s + "s ";

                var percent = (tempo / {quetempo}) * 100;
                bar.set(100 - percent, false);

                tempo--;
            }, 1000);
        }

        iniciarCountdown();
    }
</script>