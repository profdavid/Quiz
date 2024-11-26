<!-- [ Main Content ] start -->
<!-- [ Main Content ] start -->
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
                                    <h5 class="m-b-10">Home</h5>
                                </div>
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

                                <div class="card" style="border-radius: 18px; overflow: hidden">
                                    <div class="card-header bg-home">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h1 class="home-title mb-0">{EVENOME}</h1>
                                            <img width="110px" src="<?=base_url('assets/img/logo_cor.png')?>" alt="logo_ifes">
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-5">
                                                <div class="d-flex flex-column card-home justify-content-between">
                                                    <div class="card-home-min p-4 mb-3 mb-lg-0" style="background-color: #dbdbdb">
                                                        <h2 class="text-dark font-poppins">Relatório</h2>
                                                        <p class="text-dark">Informações sobre as questões, pontuação e tempo de resposta.</p>
                                                        <a href="<?=site_url('painel/Questao/relatorio')?>" target="_blank" 
                                                            class="btn btn-dark btn-sm btn-home">
                                                            Relatório
                                                            <i class="feather icon icon-arrow-up-right ml-2 mr-0"></i>
                                                        </a>
                                                    </div>

                                                    <div class="card-home-min p-4 mb-3 mb-lg-0" style="background-color: #8cd4ff">
                                                        <h2 class="text-dark font-poppins">Ordenar Questões</h2>
                                                        <p class="text-dark">Altere a ordem de apresentação das questões na dinâmica.</p>
                                                        <a href="<?=site_url('painel/Questao/ordem')?>" class="btn btn-dark btn-sm btn-home">
                                                            Ordem
                                                            <i class="feather icon icon-arrow-up-right ml-2 mr-0"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-lg-3">
                                                <div class="d-flex flex-column card-home justify-content-between">
                                                    <div class="card-home-min p-4" style="background-color: #95e38a">
                                                        <h3 class="text-dark font-poppins">Dinâmica</h3>
                                                        <p class="text-dark">Acompanhe o andamento da dinâmica e seus resultados.</p>
                                                        <a href="<?=site_url('painel/Acompanhamento')?>" class="btn btn-dark btn-sm btn-home">
                                                            Acompanhar
                                                            <i class="feather icon icon-arrow-up-right ml-2 mr-0"></i>
                                                        </a>
                                                    </div>
                                                    <div class="card-home-min p-4 my-3 my-lg-0" style="background-color: #ffd352">
                                                        <h3 class="text-dark font-poppins">Ranking</h3>
                                                        <p class="text-dark">Informações sobre o ranking das equipes no evento.</p>
                                                        <a href="<?=site_url('painel/Acompanhamento/ranking')?>" class="btn btn-dark btn-sm btn-home">
                                                            Ranking
                                                            <i class="feather icon icon-arrow-up-right ml-2 mr-0"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-lg-4">
                                                <div class="card-home bg-light border p-4">
                                                    <h3 class="text-dark font-poppins mb-3">Equipes</h3>
                                                    <div class="h-75" style="overflow: auto">
                                                        {EQUIPES}
                                                        <div class="my-2">
                                                            <img width='30px' 
                                                                class="rounded-pill mr-2" 
                                                                style="{img-color}" 
                                                                src="<?=base_url('{equlogo}')?>" 
                                                                alt="equipe_logo"
                                                            >
                                                            <a href="{editar}" class="{text-color}">{equnome}</a>
                                                        </div>
                                                        {/EQUIPES}
                                                    </div>

                                                    <a href="<?=site_url('painel/Equipe')?>" class="btn btn-dark btn-sm btn-home">
                                                        Equipes<i class="feather icon icon-arrow-up-right ml-2 mr-0"></i>
                                                    </a>
                                                    
                                                    <p class="equipes-info">Offline | <span class="text-success">Online</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <small>
                                            <i class="fa-solid fa-circle-info mr-1"></i>
                                            <strong>Desenvolvido por:</strong> Prof. David Paolini Develly e Aluno Luis Gustavo Leal Rossim - Campus Colatina
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ Main Content ] end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->

<script>
window.onload = function(){
    {RES_OK}

    $('#tabListagem').DataTable({
        "language": {
            "url": "<?php echo base_url('assets/plugins/data-tables/json/dataTables.ptbr.json') ?>"
        },
        "aaSorting": []        
    });
};
</script>
