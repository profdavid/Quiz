
function buscaCEP(){
    var cep = $("#endcep").val().replace("-", "");

    if(cep != ""){
        var url = "https://viacep.com.br/ws/"+cep+"/json/";

        $.getJSON(url, function(data) {
            if(data.ibge){
                $("#endlogradouro").val(data.logradouro);
                if(data.complemento != "") 
                    $("#endcomplemento").val(data.complemento);
                $("#endbairro").val(data.bairro);
                $("#uf").val(data.uf);

                buscaCidades(data.uf, data.ibge, 'idcidade');
            }
            else{
                alert("CEP não encontrado.");
            }
        }).fail(function(erro){
           alert("Erro na busca do CEP.");
        });
    }
}

function buscaCidades(ufsigla, idcidade, campo){
    $.ajax({
        type: 'GET',
        url: urlbaseEnd+"/buscaCidades/"+ufsigla+"/"+idcidade,
        //data: {'ufsigla': ufsigla},
        success: function(res) {
            if(res.indexOf('Erro') < 0){ 
                $("#"+campo).html(res);
            }
        }
    });
}