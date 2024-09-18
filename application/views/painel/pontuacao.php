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
                                <div class="card">
                                    <div class="card-body">

                                    <?php if (!empty($PONTUACAO_EQUIPES)): ?>
                                        <div class="mb-5">
                                            <p class="f-18">Pontuação geral das equipes</p>
                                            <div class="dt-responsive table-responsive">
                                                <table id="tabListagem" class="table table-striped table-bordered nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Equipe</th>
                                                            <th>Pontuação</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($TOTAL_EQRPONTOS as $equipe => $total): ?>
                                                        <tr>
                                                            <td><?php echo htmlspecialchars($equipe); ?></td>
                                                            <td><?php echo intval($total); ?></td>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div>
                                            <p class="f-18">Relatório das questões</p>
                                            {PONTUACAO_EQUIPES}
                                            <div class="dt-responsive table-responsive">
                                                <table class="table table-striped table-bordered nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Questão {queordem}</th>
                                                            <th>Resposta</th>
                                                            <th>Pontuação</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        {equipes}
                                                        <tr>
                                                            <td>{equnome}</td>
                                                            <td>{qrordem}</td>
                                                            <td>{eqrponto}</td>
                                                        </tr>
                                                        {/equipes}
                                                    </tbody>
                                                </table>
                                            </div>
                                            {/PONTUACAO_EQUIPES}
                                        </div>

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
</div>

<script>
    window.onload = function() {
        {RES_OK}

        $('#tabListagem').DataTable({
            "language": {
                "url": "<?php echo base_url('assets/plugins/data-tables/json/dataTables.ptbr.json') ?>"
            },
            "aaSorting": []        
        });
    };
</script>