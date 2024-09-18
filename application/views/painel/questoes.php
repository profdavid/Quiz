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
                                <div class="col-sm-12">
                                    {RES_ERRO}
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row mb-3">
                                                        <div class="col-md-12 d-flex justify-content-between">
                                                            <div>
                                                                <select class="form-control" id="questao" onchange="carregarQuestao()">
                                                                    <?php for ($i = 1; $i <= $COUNT_QUESTOES; $i++): ?>
                                                                        <option value="<?php echo $i; ?>">Questão <?php echo $i; ?></option>
                                                                    <?php endfor ?>
                                                                </select>
                                                            </div>
                                                            <div>
                                                                <?php if($queordem > 1): ?>
                                                                    <a class="text-secondary" href="{URL_ANTERIOR}">
                                                                        <span style="font-size: 34px" class="fa-solid fa-circle-arrow-left"></span>
                                                                    </a>
                                                                <?php endif ?>
                                                                <?php if($queordem < $COUNT_QUESTOES): ?>
                                                                    <a class="ml-2 text-secondary" href="{URL_PROXIMO}">
                                                                        <span style="font-size: 34px" class="fa-solid fa-circle-arrow-right"></span>
                                                                    </a>
                                                                <?php endif ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <span class="badge badge-info mr-2">
                                                                <i class="fa-solid fa-star mr-2"></i>{queponto} pontos
                                                            </span>
                                                            <span class="badge badge-warning">
                                                                <i class="fa-solid fa-clock mr-2"></i>{quetempo} segundos
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="d-flex flex-md-row flex-column-reverse justify-content-between">
                                                                <div class="mr-md-2 mr-0">
                                                                    {quetexto}
                                                                </div>
                                                                <div class="p-0 my-3 my-md-0 text-center">
                                                                    <button class="btn m-0 p-0" onclick="chamaViewQuestaoImage()">
                                                                        <img style="max-width: 200px" class="img-fluid rounded" src="<?= base_url('{queimg}') ?>" alt="questao_logo">
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <?php if(!$quesituacao): ?>
                                                                <a class="btn btn-primary" href="{URL_LIBERAR}">
                                                                    <i class="feather icon-play"></i>Liberar questão
                                                                </a>
                                                            <?php endif ?>

                                                            <?php if($COUNT_RESPOSTAS > 0 && $quesituacao): ?>
                                                                {RESPOSTAS}
                                                                    <div class="d-flex align-items-center py-2 px-3 bg-gray my-2 rounded">
                                                                        <span style="font-size: 24px;" class="badge badge-primary rounded-circle mr-3">
                                                                            {qrordem}
                                                                        </span>
                                                                        {qrtexto}
                                                                    </div>
                                                                {/RESPOSTAS}
                                                            <?php endif ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Countdown start -->
                                        <div class="col-md-3">
                                            <div style="min-height: 250px" class="card card-countdown">
                                                <div class="card-body p-2 d-flex flex-column text-center align-items-center justify-content-center">
                                                    <div class="count text-white" id="countdown"></div>
                                                    <div class="myBar ldBar label-center text-center mt-2"
                                                        data-value="0"
                                                        data-preset="circle"
                                                        data-stroke="white"
                                                        data-stroke-width="6"
                                                        style="width: 170px; height: 170px" 
                                                    ></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Countdown end -->
                                    </div>

                                    <!-- Atualizacoes start -->
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h5>Atualizações de envio</h5>
                                                            <hr>
                                                        </div>
                                                        <div id="dataContainer"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Atualizacoes end -->
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
                countdown.innerHTML = "Tempo esgotado!";
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
                        countdown.innerHTML = "Tempo esgotado!";
                        countdowncard.classList.add("bg-danger");
                    }
                }, 500);
            }
        } else {
            countdowncard.classList.add("bg-warning");
            countdown.innerHTML = "Aguarde!";
        }
    }

    
    function carregarQuestao() {
        var ordem = document.getElementById('questao').value;
        window.location.href = '{URL_QUESTAO}/' + ordem;
    }
</script>