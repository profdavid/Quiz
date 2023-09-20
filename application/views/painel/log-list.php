<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <!-- [ breadcrumb ] start -->
                <div class="page-header">
                    <div class="page-block">
                        <div class="row align-items-center">
                            <div>
                                <div class="page-header-title">
                                    <h5 class="m-b-10">Log</h5>
                                </div>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?=site_url() ?>"><i class="feather icon-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="#!">Listagem</a></li>
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
                                <div class="card">
                                    <form role="form" id="frmfiltro" name="frmfiltro" method="post" action="{URL_FRMFILTRO}">
                                    <input type="hidden" id="filtro" name="filtro" value="1" />

                                    <div class="card-body p-3">
                                        <h5>Filtro</h5>

                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="dtfim">Data Início:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="validationTooltipUsernamePrepend"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control pull-right" id="dtini" name="dtini" value="{dtini}">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="dtfim">Data Fim:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="validationTooltipUsernamePrepend"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control pull-right" id="dtfim" name="dtfim" value="{dtfim}">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <button type="submit" class="btn btn-primary" style="margin-top: 28px;">FILTRAR</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="card-footer p-3">
                                        <button type="submit" class="btn btn-primary">FILTRAR</button>
                                    </div> -->
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="row">
							<div class="col-sm-12">
								<div class="card">
                                    <div class="card-body">
                                        <div class="dt-responsive table-responsive">
                                            <table id="tabListagem" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Data</th>
                                                        <th>Texto</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {LIST_DADOS}
                                                    <tr>
                                                    	<td>{criado_em}</td>
                                                        <td>{logtexto}</td>
                                                    </tr>
                                                    {/LIST_DADOS}
                                                </tbody>
                                            </table>
                                        </div>
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
    $('#tabListagem').DataTable({
        "language": {
            "url": "<?php echo base_url('assets/plugins/data-tables/json/dataTables.ptbr.json') ?>"
        },
        "aaSorting": [],
        //"responsive": true
    });
};
</script>
