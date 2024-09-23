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
                                    <li class="breadcrumb-item"><a href="#!">Meus Dados</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ breadcrumb ] end -->

                <div class="main-body">
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
                                                    <strong class="bg-warning text-white py-2 px-3 rounded">
                                                        <i class="fa-solid fa-trophy mr-2"></i>
                                                        <span>{RANKING}° no Ranking</span>
                                                    </strong>
                                                </div>
                                            </div>
                                        </div>

                                        {LIST_EQUIPE_QUESTAORESPOSTA}
                                            <div style="background-color: {ACERTOU}10; border: 1px solid {ACERTOU}50" class="row rounded py-2 px-1 my-2 mx-3">
                                                <div class="col-md-12">
                                                    <div class="d-flex justify-content-between align-items-center {TEXT_ACERTOU}">
                                                        <strong>Questão {queordem}</strong>
                                                        <div class="d-flex flex-column text-right">
                                                            <small><i class="feather icon-check-circle"></i> Letra {qrordem}</small>
                                                            <strong>
                                                                <i class="fa-solid fa-star"></i> {eqrponto} de {queponto} pontos
                                                            </strong>
                                                        </div>
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

