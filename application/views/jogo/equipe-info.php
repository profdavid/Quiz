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
                                                <div class="mt-3">
                                                    <strong class="bg-info text-white py-2 px-3 mr-2 rounded">
                                                        <i style="font-size: 18px" class="fa-solid fa-star mr-2"></i>
                                                        <span>? pontos</span>
                                                    </strong>
                                                    <strong class="bg-warning text-white py-2 px-3 rounded">
                                                        <i class="fa-solid fa-trophy mr-2"></i>
                                                        <span>?° Ranking</span>
                                                    </strong>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <hr class="my-5">

                                        {LIST_QUESTOES}
                                            <div style="background-color: #f1f1f1" class="row rounded py-3 px-1 my-3 mx-3">
                                                <div class="col-md-12">
                                                    <div class="d-flex justify-content-between">
                                                        <strong>Questão {queordem}</strong>
                                                        <span><i class="feather icon-star"></i> ? de {queponto} pontos</span>
                                                    </div>
                                                </div>
                                            </div>
                                        {/LIST_QUESTOES}
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

