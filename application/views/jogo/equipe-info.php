<div class="pcoded-main-container mx-auto" style="max-width: 68rem">
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
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between">
                                            <h5>Resultados:</h5>
                                            <small><?=$this->session->userdata('equipe_evenome')?></small>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="d-flex flex-column align-items-center text-center justify-content-center mt-4">
                                                    <img class="img-fluid img-thumbnail rounded-circle my-2" 
                                                        src="<?=base_url($this->session->userdata('equipe_equlogo'))?>"
                                                        width="100px" alt="equipe_logo"
                                                    >

                                                    <h3><?=$this->session->userdata('equipe_equnome')?></h3>

                                                    <div style="font-size: 19px" class="d-inline-block mt-2">
                                                        <span class="badge badge-pill badge-info mr-1">
                                                            <i class="feather icon-star-on mr-1"></i>
                                                            {TOTAL_EQRPONTO} pontos
                                                        </span>
                                                        <span class="badge badge-pill badge-warning">
                                                            <i class="fa-solid fa-clock mr-1"></i>
                                                            {TOTAL_EQRTEMPO} segundos
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-5">
                                                <div class="d-flex justify-content-end">
                                                    <div>
                                                        <small class="mr-2">
                                                            <i class="fa-solid fa-square text-success mr-1"></i>
                                                            Correta
                                                        </small>
                                                        <small class="mr-2">
                                                            <i class="fa-solid fa-square text-warning mr-1"></i>
                                                            Correta/Esgotado
                                                        </small>
                                                        <small>
                                                            <i class="fa-solid fa-square text-danger mr-1"></i>
                                                            Incorreta
                                                        </small>
                                                    </div>
                                                </div>

                                                <div>
                                                    {LIST_EQUIPE_QUESTAORESPOSTA}
                                                    <div class="card mt-3">
                                                        <div class="card-header text-white py-2 {BG_QUESTAO}">
                                                            <h2 style="font-size: 16px" class="font-poppins text-white mt-2">QUESTÃO {queordem}</h2>
                                                            <div style="font-size: 14px; font-weight: 600">
                                                                <span>
                                                                    <i class="fa-regular fa-star mr-1"></i>
                                                                    {eqrponto} de {queponto} pontos
                                                                </span>
                                                                <span class="ml-2">
                                                                    <i class="fa-regular fa-clock mr-1"></i>
                                                                    {eqrtempo} de {quetempo} segundos
                                                                </span>
                                                            </div>
                                                        </div>
                                                        
                                                        <div style="background-color: #F9F9F9" class="card-body">
                                                            <div class="quetexto">
                                                                {quetexto}
                                                            </div>

                                                            <div class="d-flex mt-4">
                                                                <strong class="mr-2">Sua resposta:</strong>
                                                                <div class="{OBJETIVA}">{qrordem}</div>
                                                                <div class="{DISCURSIVA}">{eqrdiscursiva}</div>
                                                            </div>

                                                            <div class="d-flex">
                                                                <strong class="text-success mr-2">Resposta correta:</strong>
                                                                <div>{CORRETA}</div>
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

<script>
    $('.quetexto img').addClass('img-fluid rounded');
</script>