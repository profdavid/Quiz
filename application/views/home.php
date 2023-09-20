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

                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="text-success">Sistema CovidCalPrev Ifes</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="f-16">Sistema de previsão do Calendário Acadêmico, tendo como parâmetros a paralização pela pandemia causada pelo vírus Covid-19.</p>

                                        <p class="f-16">O sistema possui o objetivo de apoiar e orientar gestores escolares em suas tomadas de desições e planejamento do futuro, com possibilidade de simulação de diferentes cenários.</p>
                                    </div>
                                    <div class="card-footer">
                                        <p class="text-danger">Desenvolvido pelo Prof. David Paolini Develly - Campus Santa Teresa.</p>
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
