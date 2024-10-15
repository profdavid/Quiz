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
                                    <h5 class="mb-0"><?=$this->session->userdata('equipe_evenome')?></h5>
                                </div>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#!">Questões</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ breadcrumb ] end -->

                <div class="main-body container">
                    <div class="page-wrapper">
                        <!-- [ Main Content ] start -->
                        {RES_ERRO}
                        <?php if($id): ?>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-xl-3 order-2">
                                            <div style="position: sticky; top: 95px;">
                                                <div class="card">
                                                    <div class="card-event">
                                                        <img class="img-fluid rounded" src="<?= base_url('{queimg}') ?>" alt="">
                                                    </div>
                                                </div>

                                                <div class="card">
                                                    <div class="card-body d-flex align-items-center">
                                                        <img width="40px" class="img-fluid rounded-pill mr-2" src="<?=base_url($this->session->userdata('equipe_equlogo'))?>" alt="Profile-user">
                                                        <div class="progress w-100" style="height: 15px">
                                                            <div class="progress-bar" role="progressbar" style="width: {EQUIPE_PROGRESSO}%; height: 15px" aria-valuenow="{EQUIPE_PROGRESSO}" aria-valuemin="0" aria-valuemax="100">
                                                                {EQUIPE_PROGRESSO}%
                                                            </div>
                                                        </div>
                                                        <i class="fa-solid fa-trophy text-warning mb-1 ml-2"></i>
                                                    </div>
                                                </div>

                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="mb-0"><i class="fa-solid fa-road mr-2"></i>Jornada da equipe</h5> 
                                                    </div>
                                                    <div class="card-body journey-container">
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 {SVG_WIDTH} {SVG_HEIGHT}">
                                                            <g id="Custom_Size_1" data-name="Custom Size - 1" class="cls-1">
                                                                <rect class="cls-6" width="{SVG_WIDTH}" height="{SVG_HEIGHT}"/>
                                                                <path id="Path_1" data-name="Path 1" stroke="#fff" stroke-width="10" fill="none" d="{JOURNEY_PATH}" transform="translate(11 17)"/>

                                                                {JOURNEY}
                                                                    <g id="Ellipse_{index}" data-name="Ellipse {index}" class="cls-3" transform="translate({x} {y})">
                                                                        <image href="<?= base_url('assets/img/terminar.png') ?>" style="{ultimo}" x="-5" y="-30" height="40" width="40"/>
                                                                        <circle class="cls-4" cx="15.5" cy="15.5" r="25"/>
                                                                        <circle class="cls-5 {situacao}" cx="15.5" cy="15.5" r="24.5"/>
                                                                        <text x='15.5' y='15.5' class='text-journey'>{queordem}</text>
                                                                    </g>
                                                                {/JOURNEY}
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-9 order-1">
                                            <div class="card">
                                                <div class="card-header card-header-sticky bg-light">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="d-flex flex-column flex-md-row justify-content-between">
                                                                <div class="d-flex flex-column flex-md-row align-items-center">
                                                                    <div class="mr-0 mt-2 mr-md-3 mt-md-0">
                                                                        <button class="btn m-0 p-0" onclick="chamaViewQuestaoImage()">
                                                                            <img
                                                                                style="max-width: 90px"
                                                                                class="img-fluid rounded"
                                                                                src="<?= base_url('{queimg}') ?>"
                                                                                alt="questao_logo"
                                                                            >
                                                                        </button>
                                                                    </div>
                                                                    <div class="d-flex flex-column justify-content-center my-4 my-md-0">
                                                                        <h4 class="text-questao mb-0 text-center text-md-left text-{LIBERADA}">
                                                                            Questão {queordem}
                                                                        </h4>
                                                                        <div class="d-flex mt-2">
                                                                            <div class="badge badge-{LIBERADA}">
                                                                                {SITUACAO}
                                                                            </div>
                                                                            <div class="badge badge-info mx-2">
                                                                                <i class="fa-solid fa-star mr-2"></i>{queponto} pontos
                                                                            </div>
                                                                            <div class="badge badge-warning">
                                                                                <i class="fa-solid fa-clock mr-2"></i>{quetempo} segundos
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="mt-3 mt-md-0">
                                                                    <div class="d-flex justify-content-center">
                                                                        <div style="height: 80px; width: 80px" class="card card-countdown mb-0">
                                                                            <i class="fa-solid fa-hourglass-half icon-countdown"></i>
                                                                            <div class="d-flex flex-column justify-content-center align-items-center h-100">
                                                                                <div class="count" id="countdown"></div>
                                                                                <div class="myBar ldBar label-center text-center"
                                                                                    data-value="0"
                                                                                    data-preset="circle"
                                                                                    data-stroke="white"
                                                                                    data-stroke-width="6"
                                                                                    style="width: 80px; height: 80px"
                                                                                ></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row mt-3">
                                                        <div class="col-md-12">
                                                            <div class="text-center text-md-left mb-5 mb-md-0">
                                                                <div class="quetexto">{quetexto}</div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12 my-5">
                                                            <?php if(!$quesituacao): ?>
                                                                <a class="w-100 btn btn-info" href="{CHECK_LIBERACAO}">
                                                                    <i class="feather icon-refresh-ccw"></i>
                                                                    Checar liberação
                                                                </a>
                                                            <?php else: ?>
                                                                <form role="form" id="frmacao" name="frmacao" method="post" action="{SAVE_RESPOSTA}">
                                                                    <input type="hidden" id="id" name="id" value="{id}" />

                                                                        <?php if($idquestaotipo == 1): ?>
                                                                        {RESPOSTAS}
                                                                            <div class="card-resposta d-flex align-items-center my-2 rounded" onclick="selectCard(this)">
                                                                                <input type="radio" name="equipe_resposta" id="resposta_{qrid}" class="d-none" value="{qrid}" required>
                                                                                
                                                                                <label for="resposta_{qrid}" class="d-flex align-items-center p-3 w-100 mb-0">
                                                                                    <span class="badge badge-primary rounded-circle resposta-ordem">
                                                                                        {qrordem}
                                                                                    </span>

                                                                                    <div class="d-flex flex-column flex-sm-row align-items-center text-center mx-0 mx-sm-3 w-100">
                                                                                        <img 
                                                                                            style="max-width: 100px"
                                                                                            class="{SEM_IMAGEM} img-fluid rounded mx-3"
                                                                                            src="<?= base_url('{qrimg}') ?>"
                                                                                            alt="qrimg"
                                                                                        >
                                                                                        <div class="mx-3 my-1">
                                                                                            {qrtexto}
                                                                                        </div>
                                                                                    </div>
                                                                                </label>
                                                                            </div>
                                                                        {/RESPOSTAS}

                                                                        <?php else: ?>
                                                                            <textarea class="form-control" id="eqrdiscursiva" name="eqrdiscursiva"></textarea>
                                                                        <?php endif; ?>
                                                                        
                                                                    <div class="d-flex text-center mt-5">
                                                                        <button id="btnsave" type="submit" class="btn btn-success w-100 m-0">
                                                                            <i class="fa-solid fa-circle-check mr-2"></i>
                                                                            <span>Salvar e continuar</span>
                                                                        </button> 
                                                                    </div>
                                                                </form>
                                                            <?php endif ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php else: ?>
                            <div class="bg-finish w-100">
                                <div class="d-flex h-100 flex-column justify-content-end text-center">
                                    <div class="text-finish">
                                        <i style="font-size: 32px" class="feather icon-flag mx-0"></i>
                                        <h4 class="text-light mt-2">Parabéns! A equipe concluiu o evento!</h4>
                                        <a href="{URL_EQUIPEINFO}" class="btn btn-dark btn-rounded mt-2 mr-0 py-2">
                                            Resultados<i class="feather icon-arrow-up-right ml-2 mr-0"></i>
                                        </a>
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
        <img class="img-fluid" src="<?= base_url('{queimg}') ?>" alt="questao_logo">
      </div>
    </div>
  </div>
</div>

<!-- TinyMCE -->
<script src="<?= base_url('assets/plugins/tinymce/tinymce.min.js') ?>"></script>

<script>
    window.onload = function(){
        {RES_OK}
        $("#questao").val({queordem});
        $('.quetexto img').addClass('img-fluid rounded');

        var tempoRestante = {tempoRestante};
        var bar = new ldBar(".myBar");
        var countdowncard = document.querySelector(".card-countdown");
        var countdown = document.getElementById("countdown");

        function iniciarCountdown() {
            if (tempoRestante == -1){
                countdown.innerHTML = "Aguarde!";
                countdowncard.classList.add("bg-secondary");
                bar.set(100, true);
                return;
            }

            if (tempoRestante == 0) {
                countdown.innerHTML = "Tempo Esgotado!";
                countdowncard.classList.add("bg-danger");
                return;
            }

            var tempo = tempoRestante;
            countdowncard.classList.add("bg-primary");

            var count = setInterval(function() {
                if (tempo <= 0) {
                    clearInterval(count);
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


    function selectCard(cardElement) {
        document.querySelectorAll('.card-resposta').forEach(card => card.classList.remove('selected'));
        cardElement.classList.add('selected');
    }

    tinymce.init({
        selector: '#eqrdiscursiva',
        height: 320,
        plugins: [
            'advlist', 'autolink', 'link', 'lists', 'charmap', 'anchor', 'pagebreak',
            'searchreplace', 'wordcount', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 
            'codesample'
        ],
        toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify |' + 
        'bullist numlist outdent indent | link image | preview media fullscreen | ' +
        'forecolor backcolor',
        menubar: 'edit view insert format table',
        content_style: 'body{font-family:Helvetica,Arial,sans-serif; font-size:16px}',
        branding: false
    });
</script>