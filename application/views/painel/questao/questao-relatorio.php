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
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-4 text-center text-md-left">
                                <h4 class="m-0">Questão {queordem}</h4>
                            </div>
                            <div class="col-md-8 pt-2 pt-md-0 text-center text-md-right">
                                <div class="mr-2 badge {cor_situacao}">
                                    <i class="fa-solid fa-info-circle pr-1"></i>
                                    {text_situacao}
                                </div>
                                <div class="mr-2 badge text-info">
                                    <i class="fa-solid fa-star pr-1"></i>
                                    {queponto} pontos
                                </div>
                                <div class="badge text-danger">
                                    <i class="fa-solid fa-clock pr-1"></i>
                                    {quetempo} segundos
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="d-flex flex-column-reverse flex-sm-row justify-content-between text-center text-sm-left">
                            <div>{quetexto}</div>
                            <div class="p-0 my-3 my-sm-0">
                                <img style="max-width: 100px" class="img-fluid rounded" src="<?= base_url('{queimg}') ?>" alt="questao_logo">
                            </div>
                        </div>

                        <ul class="{OBJETIVA} list-group my-4">
                            {respostas}
                            <li class="list-group-item {BG_CORRETA}">
                                <div class="badge {BADGE_CORRETA} mr-2">{qrordem}</div>
                                <img style="max-width: 75px" class="img-fluid rounded mx-3" src="<?= base_url('{qrimg}') ?>" alt="">
                                <span>{qrtexto}</span>
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
