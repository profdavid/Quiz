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
                                        <div class="row">
                                            <div class="col-lg-4 col-md-12">
                                                <div class="row h-100 justify-content-center">
                                                    <div class="col-md-12 align-self-center">
                                                        <div class="card m-0">
                                                            <div class="widget-profile-card-1">
                                                                <img class="img-fluid" src="<?=base_url('assets/img/finish.png') ?>" alt="card-style-1">
                                                                <div class="middle-user">
                                                                    <img class="img-fluid img-thumbnail" src="<?=base_url($this->session->userdata('equipe_equlogo'))?>" alt="Profile-user">
                                                                </div>
                                                            </div>
                                                            <div class="card-body text-center">
                                                                <h3><?=$this->session->userdata('equipe_equnome')?></h3>
                                                                <small><?=$this->session->userdata('equipe_evenome')?></small>
                                                            </div>
                                                            <div class="card-footer bg-inverse">
                                                                <div class="row text-center">
                                                                    <div class="col my-2">
                                                                        <span class="badge badge-pill py-2 px-3 badge-info">
                                                                            <i class="feather icon-star-on mr-1"></i>
                                                                            <span>{TOTAL_EQRPONTO} pontos</span>
                                                                        </span>
                                                                    </div>
                                                                    <div class="col my-2">
                                                                        <span class="badge badge-pill py-2 px-3 badge-warning">
                                                                            <i class="fa-solid fa-clock mr-1"></i>
                                                                            <span>{TOTAL_EQRTEMPO} segundos</span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-8 col-md-12 align-self-center">
                                                <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center mx-3 mt-5 mt-lg-0 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <h6 class="m-0"><i class="fa-solid fa-list-check mr-2"></i>Resultados da equipe</h6>
                                                    </div>
                                                    <div class="d-flex text-center text-lg-right mt-3 mt-lg-0">
                                                        <small class="mr-2"><i class="fa-solid fa-square text-success mr-1"></i>Correta</small>
                                                        <small class="mr-2"><i class="fa-solid fa-square text-warning mr-1"></i>Correta/Esgotado</small>
                                                        <small><i class="fa-solid fa-square text-danger mr-1"></i>Incorreta</small>
                                                    </div>
                                                </div>

                                                <div class="equipe-info">
                                                    {LIST_EQUIPE_QUESTAORESPOSTA}
                                                    <div class="row {BG_ACERTOU} rounded py-2 px-1 my-2 mx-3">
                                                        <div class="col-md-12">
                                                            <div class="d-flex flex-column">
                                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                                    <strong class="questao-equipeinfo">Questão {queordem}</strong>
                                                                    <div style="font-size: 16px; color: white" class="d-flex flex-column text-right">
                                                                        <strong>
                                                                            <i class="fa-solid fa-star mr-1"></i>
                                                                            {eqrponto} de {queponto} pontos
                                                                        </strong>
                                                                        <strong class="mt-1">
                                                                            <i class="fa-solid fa-clock mr-1"></i>
                                                                            {eqrtempo} de {quetempo} segundos
                                                                        </strong>
                                                                    </div>
                                                                </div>
                                                                <div class="{OBJETIVA}">Letra {qrordem}</div>
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
        </div>
    </div>
</div>

