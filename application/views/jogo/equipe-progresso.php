<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <!-- [ breadcrumb ] start -->
                <div class="page-header">
                    <div class="page-block">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="page-header-title mb-1">
                                    <h5 class="mb-0"><?=$this->session->userdata('equipe_evenome')?></h5>
                                </div>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= site_url('dinamica/Jogo') ?>"><i class="feather icon-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="#!">Questões</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ breadcrumb ] end -->

                <div class="main-body container">
                    <div class="page-wrapper">
                        {RES_ERRO}
                        <?php if($id): ?>
                            <div class="row">
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
                                                                        <h4 class="font-poppins mb-1 mb-md-0 ml-1 text-center text-md-left text-{LIBERADA}">
                                                                            Questão {queordem}
                                                                        </h4>
                                                                        <div class="d-flex justify-content-center justify-content-md-start mt-1">
                                                                            <div class="badge badge-pill badge-small badge-{LIBERADA}">
                                                                                {SITUACAO}
                                                                            </div>
                                                                            <div class="{D-SITUACAO} badge badge-pill badge-small badge-info mx-2">
                                                                                <i class="fa-solid fa-star mr-1"></i>
                                                                                {queponto} pontos
                                                                            </div>
                                                                            <div class="{D-SITUACAO} badge badge-pill badge-small badge-warning">
                                                                                <i class="fa-solid fa-clock mr-1"></i>
                                                                                {quetempo} segundos
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="d-flex flex-column-reverse">
                                                                    <?php if(!$quesituacao && $AUTOCHECK == 0): ?>
                                                                        <div class="d-flex align-items-center justify-content-center justify-content-md-end my-4 my-md-0">
                                                                            <a class="btn btn-sm btn-info m-0" href="{CHECK_LIBERACAO}">
                                                                                <i class="feather icon-refresh-ccw"></i>
                                                                                Checar liberação
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
                                                            <?php if(!$quesituacao): ?>
                                                                <p class="m-0">Aguarde a liberação da questão.</p>
                                                                
                                                                <?php else: ?>
                                                                <div class="mb-4">
                                                                    <div class="quetexto">{quetexto}</div>
                                                                </div>

                                                                <form role="form" id="frmacao" name="frmacao" method="post" action="{SAVE_RESPOSTA}">
                                                                    <input type="hidden" id="id" name="id" value="{id}" />

                                                                        <?php if($idquestaotipo == 1): ?>
                                                                        {RESPOSTAS}
                                                                            <div class="card-resposta d-flex align-items-center my-2 rounded {SELECTED}" onclick="selectCard(this)">
                                                                                <input type="radio" 
                                                                                    name="equipe_resposta" 
                                                                                    id="resposta_{qrid}" 
                                                                                    class="d-none" 
                                                                                    value="{qrid}" 
                                                                                    required
                                                                                >

                                                                                <label for="resposta_{qrid}" class="d-flex align-items-center px-3 py-2 w-100 mb-0">
                                                                                    <span class="badge badge-primary rounded-circle resposta-ordem">
                                                                                        <span>{qrordem}</span>
                                                                                    </span>

                                                                                    <div class="d-flex align-items-center mx-0 mx-sm-3 w-100">
                                                                                        <img 
                                                                                            style="max-width: 100px"
                                                                                            class="{SEM_IMAGEM} img-fluid rounded ml-3"
                                                                                            src="<?= base_url('{qrimg}') ?>"
                                                                                            alt="qrimg"
                                                                                        >
                                                                                        <div class="mx-3">
                                                                                            <p class="resposta-texto mb-0">
                                                                                                {qrtexto}
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </label>
                                                                            </div>
                                                                        {/RESPOSTAS}

                                                                        <?php else: ?>
                                                                            <textarea class="form-control" id="eqrdiscursiva" name="eqrdiscursiva">
                                                                                {eqrdiscursiva}
                                                                            </textarea>
                                                                        <?php endif; ?>
                                                                        
                                                                    <div class="d-flex justify-content-end mt-4">
                                                                        <button id="btnsave" type="submit" class="btn btn-success m-0 {BTN_RESPONDEU}">
                                                                            <i class="fa-solid fa-check mr-2"></i>
                                                                            Salvar e continuar
                                                                        </button> 
                                                                    </div>
                                                                </form>
                                                            <?php endif ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- [paginacao] start -->
                                            <div id="desktop-pagination-container" style="margin-top: 4rem">
                                                <nav id="questoes-pagination" aria-label="">
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
                                            <!-- [paginacao] end -->
                                        </div>
                                        <!-- [ listagem da questao ] end -->

                                        <!-- [ countdown desktop ] start -->
                                        <div class="col-xl-3">
                                            <div id="desktop-countdown-container">
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
                                            </div>
                                        </div>
                                        <!-- [ countdown desktop  ] end -->
                                    </div>
                                </div>
                            </div>

                        <?php else: ?>
                            <!-- [ banner evento finalizado ] start -->
                            <div class="bg-finish w-100">
                                <div class="d-flex h-100 flex-column justify-content-end text-center">
                                    <div class="text-finish">
                                        <i style="font-size: 32px" class="feather icon-flag mx-0"></i>
                                        <h4 class="text-light mt-2">
                                            Parabéns! A equipe concluiu o evento!
                                        </h4>
                                        <a href="{URL_EQUIPEINFO}" class="btn btn-dark btn-rounded mt-2 mr-0 py-2">
                                            Resultados
                                            <i class="feather icon-arrow-up-right ml-2 mr-0"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- [ banner evento finalizado ] end -->
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



<script src="<?= base_url('assets/plugins/tinymce/tinymce.min.js') ?>"></script>
<script>
    window.onload = function(){
        {RES_OK}
        $("#questao").val({queordem});
        $('.quetexto img').addClass('img-fluid rounded');


        function moverCountdownAndPagination() {
            var countElement = document.getElementById("countdown-element");
            var mobileCount = document.getElementById("mobile-countdown-container");
            var desktopCount = document.getElementById("desktop-countdown-container");
            
            if (window.innerWidth <= 1200) {
                mobileCount.appendChild(countElement);
            }
            else {
                desktopCount.appendChild(countElement);
            }
        }

        moverCountdownAndPagination();
        
        window.onresize = function() {
            moverCountdownAndPagination();
        };


        var autoCheck = {AUTOCHECK};
        var tempoRestante = {tempoRestante};
        var bar = new ldBar(".myBar");
        var countdowncard = document.querySelector(".card-countdown");
        var countdown = document.getElementById("countdown");


        function checkLiberacao() {
            fetch('{URL_AUTOCHECK}', { method: 'GET' } )
            .then(response => {
                if (!response.ok) { throw new Error('Erro ao realizar operação.') }
                return response.json();
            })
            .then(data => {
                if(data == "1"){
                    location.reload();
                }
            })
            .catch(error => { console.error('Erro ao checar liberacao:', error) });
        }
        

        function iniciarCountdown() {
            if (tempoRestante == -1){
                countdown.innerHTML = "Aguarde!";
                countdowncard.classList.add("bg-dark");
                bar.set(100, true);

                if (autoCheck == 1) {
                    checkLiberacao();
                    var checkLib = setInterval(checkLiberacao, 2000);
                }

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
        if({RESPONDEU} == -1){
            document.querySelectorAll('.card-resposta').forEach(card => card.classList.remove('selected'));
            cardElement.classList.add('selected');
        }
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