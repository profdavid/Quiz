<div class="container mt-5">
    <h5>RELATÓRIO DE QUESTÕES</h5>

    <div class="row mt-3 mb-5">
        <div class="col-md-6 text-md-left">{evenome}</div>
        <div class="col-md-6 text-md-right">Emitido em {datereq}</div>
    </div>

    <div class="row">
        {LIST_QUESTOES}
            <div class="col-md-12 mb-2">
                <div class="card">
                    <div class="card-header" style="background-color: #EFF3F6">
                        <div class="row">
                            <div class="col-md-4">
                                <h5 class="pb-2">Questão {queordem}</h5>
                            </div>
                            <div class="col-md-8 text-md-right">
                                <span class="mr-2 badge badge-primary">{queponto} pontos</span>
                                <span class="mr-2 badge badge-warning">{quetempo} segundos</span>
                                <span class="badge {situacao}">{quesituacao}</span>
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

                        <ul class="list-group my-4">
                            {respostas}
                            <li {BG_CORRETA} class="list-group-item">
                                <span class="badge {BADGE_CORRETA} mr-2">{qrordem}</span>
                                <img style="max-width: 75px" class="img-fluid rounded mx-3" src="<?= base_url('{qrimg}') ?>" alt="">
                                <span>{qrtexto}</span>
                            </li>
                            {/respostas}
                        </ul>
                    </div>
                </div>
            </div>
        {/LIST_QUESTOES}
    </div>
</div>
