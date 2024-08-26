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
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row mb-4">
                                                    <div class="col-md-12 d-flex justify-content-between mb-2">
                                                        <div class="d-flex flex-md-row flex-column align-content-center">
                                                            <h3>Questão {queordem}</h3>
                                                            <div class="d-flex mt-md-0 mt-2">
                                                                <p style="font-size: 14px" class="badge badge-info ml-0 ml-md-4">
                                                                    <i class="fa-solid fa-star mr-2"></i>{queponto} pontos
                                                                </p>
                                                                <p style="font-size: 14px" class="badge badge-warning ml-2">
                                                                    <i class="fa-solid fa-clock mr-2"></i>{quetempo} segundos
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-column flex-md-row justify-content-end align-items-end">
                                                            <?php if($queordem > 1): ?>
                                                                <a class="btn btn-sm btn-outline-secondary m-0" href="{URL_ANTERIOR}">Anterior</a>
                                                            <?php endif; ?>
                                                            <?php if($queordem < $COUNT_QUESTOES): ?>
                                                                <a class="btn btn-sm btn-outline-secondary m-0" href="{URL_PROXIMO}">Próxima</a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                            
                                                    <div class="col-md-8">
                                                        <span>{quetexto}</span>
                                                        <div class="col-md-12 px-0">
                                                            <?php if(!$quesituacao): ?>
                                                                <a class="btn btn-primary mt-3 mb-md-0 mb-4" href="{URL_LIBERAR}">
                                                                    <i class="feather icon-play"></i>Liberar questão
                                                                </a>
                                                            <?php else: ?>
                                                                <?php if($COUNT_RESPOSTAS > 0): ?>
                                                                    {RESPOSTAS}
                                                                    <div class="text-center">
                                                                        <div class="bg-gray py-3 my-2">
                                                                            <span class="badge badge-primary mr-3">
                                                                                {qrordem}
                                                                            </span>
                                                                            {qrtexto}
                                                                        </div>
                                                                    </div>
                                                                    {/RESPOSTAS}
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 text-center align-content-center">
                                                        <img width="320px" class="img-fluid rounded" src="<?= base_url('{queimg}') ?>" alt="questao_logo">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Countdown e Atualizacoes start -->
                                <div class="row">
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
                                    <div class="col-md-9">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <strong>Atualizações</strong> <hr>
                                                    </div>
                                                    <!-- atualizacao das equipes start -->
                                                    <!-- atualizacao das equipes end -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Countdown e Atualizacoes end -->
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.onload = function(){
        var now = new Date().getTime();
        var quedtliberacao = new Date("{quedtliberacao}").getTime();
        var quedtlimite = new Date("{quedtlimite}").getTime();

        var bar = new ldBar(".myBar");
        var countdowncard = document.querySelector(".card-countdown");
        var countdown = document.getElementById("countdown");

        if(quedtlimite){
            if (now > quedtlimite) {
                countdown.innerHTML = "Tempo esgotado!";
                countdowncard.classList.add("bg-danger");
            } else {
                countdowncard.classList.add("bg-primary");

                var totalTime = quedtlimite - quedtliberacao;

                var x = setInterval(function() {
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
                        clearInterval(x);
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
</script>