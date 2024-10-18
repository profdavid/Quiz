<div class="container mt-5">
    <h3 class="text-center text-md-left">
        <i class="fa-regular fa-file-lines pr-2"></i>RELATÓRIO DE QUESTÕES
    </h3>

    <div class="row mt-3 mb-5">
        <div class="col-md-6 text-center text-md-left">{evenome}</div>
        <small class="col-md-6 text-center text-md-right">Emitido em {datereq}</small>
    </div>

    <div class="row">
        {LIST_QUESTOES}
            <div class="col-md-12 mb-2">
                <div class="card">
                    <div class="card-header bg-light py-3">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex flex-column flex-md-row justify-content-between">
                                    <div class="d-flex flex-column flex-md-row align-items-center">
                                        <div class="mr-0 mt-3 mr-md-3 mt-md-0">
                                            <img
                                                style="max-height: 55px"
                                                class="img-fluid rounded"
                                                src="<?= base_url('{queimg}') ?>"
                                                alt="questao_logo"
                                            >
                                        </div>

                                        <div class="d-flex flex-column justify-content-center my-4 my-md-0">
                                            <h4 class="font-poppins mb-1 mb-md-0 text-center text-md-left text-{situacao}">
                                                Questão {queordem}
                                            </h4>
                                            <div class="d-flex mt-2">
                                                <div class="badge badge-{situacao}">
                                                    {text_situacao}
                                                </div>
                                                <div class="badge badge-info mx-2">
                                                    <i class="fa-solid fa-star mr-1"></i>
                                                    {queponto} pontos
                                                </div>
                                                <div class="badge badge-warning">
                                                    <i class="fa-solid fa-clock mr-1"></i>
                                                    {quetempo} segundos
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="mb-3 mb-md-0">
                                    <div class="quetexto">{quetexto}</div>
                                </div>
                            </div>
                        </div>

                        <ul class="{OBJETIVA} list-group my-4">
                            {respostas}
                            <li class="list-group-item {BG_CORRETA}">
                                <div class="d-flex align-items-center w-100 mb-0">
                                    <div class="badge {BADGE_CORRETA} mr-2">{qrordem}</div>
                                    <img style="max-width: 75px" class="img-fluid rounded mx-3" src="<?= base_url('{qrimg}') ?>" alt="">
                                    <span>{qrtexto}</span>
                                </div>
                            </li>
                            {/respostas}
                        </ul>

                        <div class="{DISCURSIVA}">
                            <div class="card-resposta-correta d-flex align-items-center p-3 my-4 rounded">
                                <div>{quediscursiva}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {/LIST_QUESTOES}
    </div>
</div>

<script>
    window.onload = function(){
        $('.quetexto img').addClass('img-fluid rounded');
    }
</script>