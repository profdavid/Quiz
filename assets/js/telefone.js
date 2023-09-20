var prev_handler = window.onload;
window.onload = function(){
    if (prev_handler) {
        prev_handler();
    }
    
    $('#telnumero').keyup(function(event) {
       if($(this).val().length == 15){ 
          $('#telnumero').mask('(00) 00000-0009');
       } else {
          $('#telnumero').mask('(00) 0000-00009');
       }
    });

    $("#frmTelefone").submit(function(e) {
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            success: function(res){
                if(res.indexOf('Erro') < 0){
                    //form.trigger('reset');

                    carregaTelefone();
                }
                else{
                    $('#msg-alt-tel').html(res);
                }
            }
        });

        $('#modalTelefone').modal('hide');
    });

    $("#frmExcluirTelefone").submit(function(e) {
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            success: function(res){
                if(res.indexOf('Erro') < 0){
                    //form.trigger('reset');

                    carregaTelefone();
                }
                else{
                    $('#msg-alt-tel').html(res);
                }
            }
        });

        $('#modalExcluirTelefone').modal('hide');
    });

    $('#modalTelefone').on('hidden.bs.modal', function () {
        $('#frmTelefone').trigger('reset');
    });

    carregaTelefone();
}

function carregaTelefone(){
    var campotelefone = $('#campotelefone').val();
    var idcampotelefone = $('#idcampotelefone').val();

    if(idcampotelefone > 0){
        $.ajax({
            type: 'POST',
            url: urlbaseTel+"/carregaTelefone/"+idcampotelefone+"/"+campotelefone,
            //data: {'id': 0},
            success: function(res) {
                if(res.indexOf('Erro') >= 0) $('#msg-alt').html(res);
                else{ 
                    $('#tabelaTelefone').html(res);
                }
            }
        });
    }
}

function openAddTelefone(){
    $('#idtelefone').val("");
    $('#modalTelefone').modal('show');
}

function openEdtTelefone(id, ident, num){
    $('#idtelefone').val(id);
    $('#telident').val(ident);
    $('#telnumero').val(num);

    $('#modalTelefone').modal('show');
}

function openExcTelefone(id, str){
    $('#modalExcluirTelefone').modal('show');
    $('#idexcluirtelefone').val(id);
    $('#txt-excluir-telefone').html(str);
}