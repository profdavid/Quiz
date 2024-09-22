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
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body d-flex justify-content-between">
                                            <div>
                                                <?php foreach($QUESTOES as $questao): ?>
                                                    <a href="{URL_QUESTAO}/<?= $questao['queordem']; ?>">
                                                        <span class="badge <?= $questao['ATUAL']; ?> <?= $questao['LIBERADA']; ?>">
                                                            <?= $questao['queordem']; ?>
                                                        </span>
                                                    </a>
                                                <?php endforeach; ?>
                                            </div>
                                            <div class="ml-4 text-right">
                                                <?php if($queordem > 1): ?>
                                                    <a class="text-secondary" href="{URL_ANTERIOR}">
                                                        <span style="font-size: 28px" class="fa-solid fa-circle-arrow-left"></span>
                                                    </a>
                                                <?php endif ?>
                                                <?php if($queordem < $COUNT_QUESTOES): ?>
                                                    <a class="ml-2 text-secondary" href="{URL_PROXIMO}">
                                                        <span style="font-size: 28px" class="fa-solid fa-circle-arrow-right"></span>
                                                    </a>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="d-flex flex-column align-items-center flex-sm-row">
                                                                <h4 class="mr-0 mr-sm-4 mb-0">
                                                                    Questão {queordem}
                                                                </h4>
                                                                <div class="d-flex mt-2 mt-sm-0 ">
                                                                    <div class="badge badge-small text-info w-100 mr-2">
                                                                        <i class="fa-solid fa-star mr-2"></i>{queponto} pontos
                                                                    </div>
                                                                    <div class="badge badge-small text-warning w-100">
                                                                        <i class="fa-solid fa-clock mr-2"></i>{quetempo} segundos
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                        </div>
                                                    </div>

                                                    <div class="row mt-3">
                                                        <div class="col-md-12">
                                                            <div class="d-flex flex-column-reverse flex-sm-row justify-content-between text-center text-sm-left">
                                                                <div>{quetexto}</div>
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
                                                                    <i class="feather icon-play"></i>Liberar questão
                                                                </a>
                                                            <?php endif ?>

                                                            <?php if($COUNT_RESPOSTAS > 0 && $quesituacao): ?>
                                                                <?php foreach($RESPOSTAS as $resposta): ?>
                                                                    <div class="card-resposta d-flex align-items-center p-3 my-2 rounded">
                                                                        <span class="badge badge-primary rounded-circle mr-3 resposta-ordem">
                                                                            <?= $resposta['qrordem'] ?>
                                                                        </span>
                                                                        <div class="d-flex flex-column flex-sm-row align-items-center text-center mx-0 mx-sm-3 w-100">
                                                                            <?php if (!empty($resposta['qrimg'])): ?>
                                                                                <img style="max-width: 100px" class="img-fluid rounded" src="<?= base_url($resposta['qrimg']) ?>" alt="qrimg">
                                                                            <?php endif; ?>
                                                                            <div class="mx-3 my-1"><?= $resposta['qrtexto'] ?></div>
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                            <?php endif ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Atualizacoes start -->
                                        <div class="col-md-3 d-flex flex-column">
                                            <div style="max-height: 150px" class="card card-countdown">
                                                <div class="card-body p-2 d-flex flex-column text-center align-items-center justify-content-center">
                                                    <div class="count text-white" id="countdown"></div>
                                                    <div class="myBar ldBar label-center text-center"
                                                        data-value="0"
                                                        data-preset="circle"
                                                        data-stroke="white"
                                                        data-stroke-width="5"
                                                        style="width: 100px; height: 100px" 
                                                    ></div>
                                                </div>
                                            </div>

                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h6 class="mb-3">Atualizações</h6>
                                                        </div>
                                                        <div id="dataContainer"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Atualizacoes end -->
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

        var quedtliberacao = new Date("{quedtliberacao}").getTime();
        var quedtlimite = new Date("{quedtlimite}").getTime();

        var bar = new ldBar(".myBar");
        var countdowncard = document.querySelector(".card-countdown");
        var countdown = document.getElementById("countdown");


        //Exibe na tela as atualizacoes das equipes
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


        //Busca no banco as atualizacoes da questao liberada
        function buscaAtualizacoes() {
            fetch('{URL_ATUALIZACOES}', { method: 'GET' } )
            .then(response => {
                if (!response.ok) { throw new Error('Erro ao realizar operação.') }
                return response.json();
            })
            .then(data => { exibeAtualizacoes(data) })
            .catch(error => { console.error('Erro ao buscar atualizações:', error) });
        }

        buscaAtualizacoes();


        //Confere se questao liberada
        if(quedtlimite){
            var now = new Date().getTime();

            if (now > quedtlimite) {
                countdown.innerHTML = "Tempo esgotado";
                countdowncard.classList.add("bg-danger");
            } else {
                countdowncard.classList.add("bg-primary");
                var totalTime = quedtlimite - quedtliberacao;

                buscaAtualizacoes();
                var att = setInterval(buscaAtualizacoes, 1500);

                var count = setInterval(function() {
                    var now = new Date().getTime();
                    var tempo = quedtlimite - now;

                    // Atualiza countdown text
                    var min = Math.floor((tempo % (1000 * 60 * 60)) / (1000 * 60));
                    var s = Math.floor((tempo % (1000 * 60)) / 1000);
                    countdown.innerHTML = min + "m " + s + "s ";

                    // Atualiza countdown bar
                    var tempoDecorrido = totalTime - tempo;
                    var percent = (tempoDecorrido / totalTime) * 100;
                    bar.set(100 - percent, false);

                    // Confere se tempo esgotou
                    if (tempo < 0) {
                        clearInterval(count);
                        clearInterval(att);
                        buscaAtualizacoes();
                        countdown.innerHTML = "Tempo esgotado";
                        countdowncard.classList.add("bg-danger");
                    }
                }, 500);
            }
        } else {
            countdowncard.classList.add("bg-warning");
            countdown.innerHTML = "Aguarde";
        }
    }
</script>