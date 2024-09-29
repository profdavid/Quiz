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
                                    <h5 class="m-b-10"><?=$this->session->userdata('equipe_evenome')?></h5>
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
                        {RES_ERRO}
                        <?php if($id): ?>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="d-flex flex-column align-items-center justify-content-between mt-2 mt-sm-0 flex-sm-row">
                                                                <h3 class="mb-0 text-{LIBERADA}">
                                                                    Questão {queordem}
                                                                </h3>
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
                                                                <a class="btn btn-sm btn-info" href="{CHECK_LIBERACAO}/{queordem}">
                                                                    <i class="feather icon-refresh-ccw"></i>Checar liberação
                                                                </a>
                                                            <?php endif ?>

                                                            <?php if($COUNT_RESPOSTAS > 0 && $quesituacao): ?>
                                                                <form role="form" id="frmacao" name="frmacao" method="post" action="{SAVE_RESPOSTA}">
                                                                    <input type="hidden" id="id" name="id" value="{id}" />
                                                                        <?php foreach($RESPOSTAS as $resposta): ?>
                                                                            <div class="card-resposta d-flex align-items-center my-2 rounded" onclick="selectCard(this)">
                                                                                <input type="radio" name="equipe_resposta" id="resposta_<?= $resposta['qrid'] ?>" class="d-none" value="<?= $resposta['qrid'] ?>" required>
                                                                                
                                                                                <label for="resposta_<?= $resposta['qrid'] ?>" class="d-flex align-items-center p-3 w-100 mb-0">
                                                                                    <span class="badge badge-primary rounded-circle resposta-ordem">
                                                                                        <?= $resposta['qrordem'] ?>
                                                                                    </span>

                                                                                    <div class="d-flex flex-column flex-sm-row align-items-center text-center mx-0 mx-sm-3 w-100">
                                                                                        <?php if (!empty($resposta['qrimg'])): ?>
                                                                                            <img style="max-width: 100px" class="img-fluid rounded mx-3" src="<?= base_url($resposta['qrimg']) ?>" alt="qrimg">
                                                                                        <?php endif; ?>
                                                                                        <div class="mx-3 my-1"><?= $resposta['qrtexto'] ?></div>
                                                                                    </div>
                                                                                </label>
                                                                            </div>
                                                                        <?php endforeach; ?>
                                                                    <div class="d-flex mt-5 text-sm-right text-center">
                                                                        <button id="btnsave" type="submit" class="btn btn-success w-100 m-0">
                                                                            <i class="feather icon-check-circle"></i>Salvar e continuar
                                                                        </button> 
                                                                    </div>
                                                                </form>
                                                            <?php endif ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                         <!-- countdown start -->
                                         <div class="col-md-3 d-flex flex-column">
                                            <div style="max-height: 200px" class="card card-countdown">
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
                                        </div>
                                        <!-- countdown end -->
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="bg-finish w-100">
                                <div class="d-flex h-100 flex-column justify-content-around text-center">
                                    <span></span>
                                    <span></span>
                                    <h4 class="finish-text text-light">Fim das questões!</h4>
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
        {RES_OK}
        $("#questao").val({queordem});
        $('.quetexto img').addClass('img-fluid');

        var tempoRestante = {tempoRestante};
        var bar = new ldBar(".myBar");
        var countdowncard = document.querySelector(".card-countdown");
        var countdown = document.getElementById("countdown");

        function iniciarCountdown() {
            if (tempoRestante == -1){
                countdown.innerHTML = "Aguarde!";
                countdowncard.classList.add("bg-warning");
                return;
            }

            if (tempoRestante == 0) {
                countdown.innerHTML = "Tempo esgotado!";
                countdowncard.classList.add("bg-danger");
                return;
            }

            var tempo = tempoRestante;
            countdowncard.classList.add("bg-primary");

            var count = setInterval(function() {
                if (tempo <= 0) {
                    clearInterval(count);
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

    function selectCard(cardElement) {
        document.querySelectorAll('.card-resposta').forEach(card => card.classList.remove('selected'));
        cardElement.classList.add('selected');
    }
</script>