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
                        {quetexto}

                        <ul class="list-group">
                            {respostas}
                            <li class="list-group-item">
                                <span class="badge {RES_CORRETA} mr-2">{qrordem}</span>
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
