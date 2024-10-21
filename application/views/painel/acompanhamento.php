<style>
    table td { padding: 0.5rem 0.75rem !important; }
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
                                    <li class="breadcrumb-item"><a href="<?=site_url('painel') ?>"><i class="feather icon-home"></i></a></li>
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
                                        <!-- [ listagem da questao ] start -->
                                        <div class="col-xl-9">
                                            <div class="card">
                                                <div class="card-header card-header-sticky bg-light py-2">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="d-flex flex-column flex-md-row justify-content-between py-1">
                                                                <div class="d-flex flex-column flex-md-row align-items-center">
                                                                    <div class="mr-0 mt-3 mr-md-3 mt-md-0">
                                                                        <button class="btn m-0 p-0" onclick="chamaViewQuestaoImage()">
                                                                            <img
                                                                                style="max-height: 55px"
                                                                                class="img-fluid rounded"
                                                                                src="<?= base_url('{queimg}') ?>"
                                                                                alt="questao_logo"
                                                                            >
                                                                        </button>
                                                                    </div>

                                                                    <div class="d-flex flex-column justify-content-center my-4 my-md-0">
                                                                        <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                                                                            <h4 class="font-poppins ml-1 mb-1 mb-md-0 text-{LIBERADA}">
                                                                                Questão {queordem}
                                                                            </h4>
                                                                        </div>

                                                                        <div class="d-flex mt-1">
                                                                            <div class="badge badge-pill badge-small badge-{LIBERADA}">
                                                                                {SITUACAO}
                                                                            </div>
                                                                            <div class="badge badge-pill badge-small badge-info mx-2">
                                                                                <i class="fa-solid fa-star mr-1"></i>
                                                                                {queponto} pontos
                                                                            </div>
                                                                            <div class="badge badge-pill badge-small badge-warning">
                                                                                <i class="fa-solid fa-clock mr-1"></i>
                                                                                {quetempo} segundos
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="d-flex flex-column-reverse">
                                                                    <?php if(!$quesituacao): ?>
                                                                        <div class="d-flex align-items-center justify-content-center justify-content-md-end my-4 my-md-0">
                                                                            <a class="btn btn-sm btn-primary m-0" href="{URL_LIBERAR}">
                                                                                <i class="fa-solid fa-play"></i>
                                                                                Liberar questão
                                                                            </a>
                                                                        </div>
                                                                    <?php endif ?>

                                                                    <div id="mobile-countdown-container"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card-body">
                                                    <div class="row mt-2">
                                                        <div class="col-md-12">
                                                            <div class="mb-4">
                                                                <div class="quetexto">{quetexto}</div>
                                                            </div>

                                                            <?php if($COUNT_RESPOSTAS > 0 && $quesituacao): ?>
                                                                {RESPOSTAS}
                                                                    <div class="card-resposta d-flex align-items-center px-3 py-2 my-2 rounded">
                                                                        <span class="badge badge-primary rounded-circle resposta-ordem">
                                                                            {qrordem}
                                                                        </span>
                                                                        <div class="d-flex align-items-center mx-0 mx-sm-3 w-100">
                                                                            <img 
                                                                                style="max-width: 100px" 
                                                                                class="{SEM_IMAGEM} img-fluid rounded ml-3" 
                                                                                src="<?= base_url('{qrimg}') ?>" 
                                                                                alt=""
                                                                            >
                                                                            <div class="mx-3">
                                                                                <p class="mb-0">{qrtexto}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                {/RESPOSTAS}
                                                            <?php endif ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- [resultados] start -->
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h6 class="mb-0"><i class="fa-solid fa-square-poll-horizontal mr-2"></i>Resultados</h6>
                                                        <?php if($SHOW_RESULTS): ?>
                                                            <a href="{URL_ATUAL}" class="btn btn-sm btn-dark m-0">
                                                                <i class="fa-solid fa-eye-slash"></i>Esconder resultados
                                                            </a>
                                                        <?php else: ?>
                                                            <a href="{URL_ATUAL}/true" class="btn btn-sm btn-light m-0">
                                                                <i class="fa-solid fa-eye"></i>Mostrar resultados
                                                            </a>
                                                        <?php endif ?>
                                                    </div>
                                                </div>

                                                <?php if ($SHOW_RESULTS): ?>
                                                    <?php if ($idquestaotipo == 1): ?>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <h6 class="mt-2 mb-3 text-success">
                                                                        <i class="fa-solid fa-circle-check mr-2"></i>Resposta correta:
                                                                    </h6>
                                                                    <div class="card-resposta-correta d-flex align-items-center p-3 mb-5 rounded">
                                                                        <div class="badge badge-success rounded-circle resposta-ordem">
                                                                            {CORRETA_qrordem}
                                                                        </div>
                                                                        <div class="d-flex flex-column flex-sm-row align-items-center mx-3 w-100">
                                                                            <img
                                                                                style="max-width: 100px"
                                                                                class="img-fluid rounded"
                                                                                src="<?= base_url('{CORRETA_qrimg}') ?>"
                                                                                alt=""
                                                                            >
                                                                            <p class="mx-3 my-1 text-success">
                                                                                {CORRETA_qrtexto}
                                                                            </p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="dt-responsive table-responsive">
                                                                        <table class="table table-striped table-bordered nowrap">
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
                                                                                    <td>{eqrtempo}</td>
                                                                                    <td>{eqrponto}</td>
                                                                                </tr>
                                                                                {/RESULTS}
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <?php else: ?>
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <h6 class="mt-2 mb-3 text-success">
                                                                            <i class="fa-solid fa-circle-check mr-2"></i>Resposta correta:
                                                                        </h6>
                                                                        <div class="card-resposta-correta d-flex align-items-center p-3 mb-5 rounded">
                                                                            <div>{quediscursiva}</div>
                                                                        </div>

                                                                        <div class="dt-responsive table-responsive">
                                                                            <table class="table table-striped table-bordered nowrap">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Ordem</th>
                                                                                        <th>Equipe</th>
                                                                                        <th>Resposta</th>
                                                                                        <th>Tempo</th>
                                                                                        <th>Pontuação</th>
                                                                                        <th>Ações</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    {RESULTS}
                                                                                    <tr class="{COR_EQRSITUACAO}">
                                                                                        <td>{ordem}</td>
                                                                                        <td>{equnome}</td>
                                                                                        <td><div class="table-questao-discursiva">{eqrdiscursiva}</div></td>
                                                                                        <td>{eqrtempo}</td>
                                                                                        <td>{eqrponto}</td>
                                                                                        <td class="text-center">
                                                                                            <a href="{URL_CORRECAO_CERTA}" data-toggle="tooltip"
                                                                                                data-placement="top"
                                                                                                title="Correta" class="text-success mx-2">
                                                                                                <i style="font-size: 20px" class="fa-solid fa-circle-check"></i>
                                                                                            </a>
                                                                                            <a href="{URL_CORRECAO_ERRADA}" data-toggle="tooltip"
                                                                                                data-placement="top"
                                                                                                title="Errada" class="text-danger mx-2">
                                                                                                <i style="font-size: 20px" class="fa-solid fa-circle-xmark"></i>
                                                                                            </a>
                                                                                        </td>
                                                                                    </tr>
                                                                                    {/RESULTS}
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    <?php endif ?>
                                                <?php endif ?>
                                            </div>
                                            <!-- [resultados] end -->

                                            <!-- [paginacao] start -->
                                            <div id="desktop-pagination-container">
                                                <div id="questoes-pagination" style="margin: 4rem 0rem">
                                                    <nav aria-label="">
                                                        <ul class="pagination justify-content-center flex-wrap">
                                                            <?php if($queordem > 1): ?>
                                                                <li class="page-item">
                                                                    <a style="background-color: transparent; border: none" class="page-link text-success mr-1 mb-1" href="{URL_ANTERIOR}">
                                                                        <i class="fa-solid fa-angle-left"></i>
                                                                    </a>
                                                                </li>
                                                            <?php endif ?>

                                                            {QUESTOES}
                                                                <li class="page-item {ACTIVE}">
                                                                    <a style="{LIBERADA}" href="{URL_ACCESS}" class="page-link mb-1 mr-1">
                                                                        {queordem}
                                                                    </a>
                                                                </li>
                                                            {/QUESTOES}

                                                            <?php if($queordem < $COUNT_QUESTOES): ?>
                                                                <li class="page-item">
                                                                    <a style="background-color: transparent; border: none" class="page-link text-success mb-1" href="{URL_PROXIMO}">
                                                                        <i class="fa-solid fa-angle-right"></i>
                                                                    </a>
                                                                </li>
                                                            <?php endif ?>
                                                        </ul>
                                                    </nav>
                                                </div>
                                            </div>
                                            <!-- [paginacao] end -->
                                        </div>
                                        <!-- [ listagem da questao ] end -->
                                         

                                        <!-- [ countdown desktop e envios ] start -->
                                        <div class="col-xl-3">
                                            <div id="desktop-countdown-container" class="card card-countdown-sticky">
                                                <div id="countdown-element" class="d-flex justify-content-center">
                                                    <div class="card-countdown mb-0">
                                                        <i class="fa-regular fa-clock icon-countdown"></i>
                                                        <div class="d-flex flex-column justify-content-center align-items-center h-100">
                                                            <div class="count" id="countdown"></div>
                                                            <div class="myBar ldBar label-center p-1 text-center"
                                                                data-value="0"
                                                                data-preset="circle"
                                                                data-stroke="white"
                                                                data-stroke-width="5"
                                                            ></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card-body">
                                                    <h6 class="mb-0"><i class="fa-solid fa-clock mr-2"></i>Envios</h6>
                                                </div>

                                                <div class="card-footer">
                                                    <div id="dataContainer">Não há envios registrados.</div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- [ countdown desktop e envios  ] end -->

                                        <div id="mobile-pagination-container" class="col-md-12"></div>
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


<!-- [ modal imagem da questao ] start -->
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
        <img class="img-fluid" src="<?= base_url('{queimg}') ?>" alt="questao_logo">
      </div>
    </div>
  </div>
</div>
<!-- [ modal imagem da questao ] end -->



<script>
    window.onload = function(){
        {RES_OK}
        $("#questao").val({queordem});
        $('.quetexto img').addClass('img-fluid rounded');

        function moverCountdownAndPagination() {
            var countElement = document.getElementById("countdown-element");
            var mobileCount = document.getElementById("mobile-countdown-container");
            var desktopCount = document.getElementById("desktop-countdown-container");

            var paginationElement = document.getElementById("questoes-pagination");
            var mobilePagination = document.getElementById("mobile-pagination-container");
            var desktopPagination = document.getElementById("desktop-pagination-container");
            
            if (window.innerWidth <= 1200) {
                mobileCount.appendChild(countElement);
                mobilePagination.appendChild(paginationElement);
            }
            else {
                desktopCount.insertBefore(countElement, desktopCount.firstChild);
                desktopPagination.insertBefore(paginationElement, desktopPagination.firstChild);
            }
        }

        moverCountdownAndPagination();
        
        window.onresize = function() {
            moverCountdownAndPagination();
        };
        

        function exibeAtualizacoes(data) {
            var container = document.getElementById('dataContainer');
            container.innerHTML = '';

            if (data.length > 0) {
                var ol = document.createElement('ol');
                ol.classList.add('px-3');

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


        var tempoRestante = {tempoRestante};
        var bar = new ldBar(".myBar");
        var countdowncard = document.querySelector(".card-countdown");
        var countdown = document.getElementById("countdown");

        function iniciarCountdown() {
            if (tempoRestante == -1){
                countdown.innerHTML = "Aguarde!";
                countdowncard.classList.add("bg-dark");
                bar.set(100, true);
                return;
            }

            if (tempoRestante == 0) {
                countdown.innerHTML = "Tempo Esgotado!";
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
                    countdown.innerHTML = "Tempo Esgotado!";
                    countdowncard.classList.remove("bg-warning");
                    countdowncard.classList.add("bg-danger");
                    bar.set(0, false);
                    return;
                }

                var m = Math.floor(tempo / 60);
                var s = tempo % 60;
                countdown.innerHTML = m + "m " + s + "s ";

                var percent = (tempo / {quetempo}) * 100;
                bar.set(percent, false);

                if ((percent > 0) && (percent < 30) && (!countdowncard.classList.contains("bg-warning"))) {
                    countdowncard.classList.add("bg-warning");
                }

                tempo--;
            }, 1000);
        }

        iniciarCountdown();
    }
</script>