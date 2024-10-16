<style>
    table td { padding: 0.5rem 0.75rem !important }
</style>

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
                                    <h5 class="m-b-10">Pontuação</h5>
                                </div>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?=site_url('painel') ?>"><i class="feather icon-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="#!">Geral</a></li>
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
                                <div>
                                    <?php if (!empty($PONTUACAO_EQUIPES)): ?>
                                        {PONTUACAO_EQUIPES}
                                        <div class="card">
                                            <div class="card-header card-header-sticky bg-success py-3">
                                                <h5 class="font-poppins text-left text-white mb-0">
                                                    Questão {queordem}
                                                </h5>
                                            </div>

                                            <div class="card-body">
                                                <div class="dt-responsive table-responsive">
                                                    <table class="table table-striped tabListagem table-bordered nowrap">
                                                        <thead>
                                                            <tr>
                                                                <th>Equipe</th>
                                                                <th>Resposta</th>
                                                                <th>Tempo (s)</th>
                                                                <th>Pontuação</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            {equipes}
                                                            <tr>
                                                                <td>{equnome}</td>
                                                                <td>
                                                                    <div class="{OBJETIVA}">{qrordem}</div>
                                                                    <div class="{DISCURSIVA}">{eqrdiscursiva}</div>
                                                                </td>
                                                                <td>{eqrtempo}</td>
                                                                <td>{eqrponto}</td>
                                                            </tr>
                                                            {/equipes}
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        {/PONTUACAO_EQUIPES}

                                        <?php else: ?>
                                            <span>Nenhum dado encontrado.</span>
                                        <?php endif; ?>
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
    window.onload = function() {
        {RES_OK}

        $('.tabListagem').DataTable({
            "language": {
                "url": "<?php echo base_url('assets/plugins/data-tables/json/dataTables.ptbr.json') ?>"
            },
            "aaSorting": []        
        });
    };
</script>