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
                                    <li class="breadcrumb-item"><a href="#!">Informações da equipe</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ breadcrumb ] end -->

                <div class="main-body container">
                    <div class="page-wrapper">
                        <!-- [ Main Content ] start -->
                        <div class="row">
                            <div class="col-sm-12">
                                {RES_ERRO}

                                <div class="card">
                                    <div class="card-body">
                                        <div class="row p-4">
                                            <div class="col-md-6 mb-4 mb-md-0 d-flex align-items-center justify-content-center justify-content-md-end">
                                                <img
                                                    width="200px" class="img-fluid rounded-circle"
                                                    src="<?=base_url($this->session->userdata('equipe_equlogo'))?>"
                                                    alt="equipe logo"
                                                >
                                            </div>
                                            <div class="col-md-6 d-flex flex-column text-center text-md-left justify-content-center">
                                                <div>
                                                    <p><?=$this->session->userdata('equipe_evenome')?></p>
                                                    <h1><?=$this->session->userdata('equipe_equnome')?></h1>
                                                </div>
                                                <div class="mt-3 d-flex flex-column flex-sm-row justify-content-center justify-content-md-start">
                                                    <strong class="bg-info text-white py-2 px-3 mr-sm-2 mr-0 rounded">
                                                        <i style="font-size: 18px" class="fa-solid fa-star mr-2"></i>
                                                        <span>{TOTAL_EQRPONTO} pontos</span>
                                                    </strong>
                                                    <strong class="bg-danger text-white py-2 px-3 mt-2 mt-sm-0 rounded">
                                                        <i class="fa-solid fa-clock mr-2"></i>
                                                        <span>{TOTAL_EQRTEMPO} segundos</span>
                                                    </strong>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mx-3 my-3">
                                            <div class="d-flex align-items-center">
                                                <i class="fa-solid fa-clock-rotate-left mr-2"></i>
                                                <label class="mb-0">Respostas:</label>
                                            </div>
                                            <div class="d-flex text-center text-md-right mt-3 mt-md-0">
                                                <small class="mr-2">
                                                    <i class="fa-solid fa-square text-success"></i>
                                                    Correta
                                                </small>
                                                <small class="mr-2">
                                                    <i class="fa-solid fa-square text-warning"></i>
                                                    Correta/Esgotado
                                                </small>
                                                <small>
                                                    <i class="fa-solid fa-square text-danger"></i>
                                                    Incorreta
                                                </small>
                                            </div>
                                        </div>

                                        {LIST_EQUIPE_QUESTAORESPOSTA}
                                            <div class="row {BG_ACERTOU} rounded py-2 px-1 my-2 mx-3">
                                                <div class="col-md-12">
                                                    <div class="d-flex flex-column">
                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                            <strong style="font-size: 18px">Questão {queordem}</strong>
                                                            <div style="font-size: 14px" class="d-flex flex-column text-right">
                                                                <strong>
                                                                    <i class="fa-regular fa-star mr-1"></i>
                                                                    {eqrponto} de {queponto} pontos
                                                                </strong>
                                                                <strong class="mt-1">
                                                                    <i class="fa-regular fa-clock mr-1"></i>
                                                                    {eqrtempo} de {quetempo} segundos
                                                                </strong>
                                                            </div>
                                                        </div>
                                                        <div class="{OBJETIVA}">
                                                            <i class="feather icon-check-circle"></i>
                                                            <span>Letra {qrordem}</span>
                                                        </div>
                                                        <div class="{DISCURSIVA}">{eqrdiscursiva}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        {/LIST_EQUIPE_QUESTAORESPOSTA}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

