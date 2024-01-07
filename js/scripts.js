jQuery(function(){
    $(document).ready(function(){
        //PROCEDIMENTOS
        $("#procedimentos").hide();
        //AO CLICAR NOS PROCEDIMENTOS E LIBERADO A MULTISELEÇÃO
        $("input[name=procedimentosSolicitacao]").on("focusin",function(){
            $("#procedimentos").show()
        })
        //AO CLICAR FORA DOS PROCEDIMENTOS A MULTISELEÇÃO E FECHADA
        $(document).mouseup(function(e){
            var container = $("#procedimentos,input[name=procedimentosSolicitacao]");
            if (!container.is(e.target) && container.has(e.target).length === 0){
                $("#procedimentos").hide();
            }
        });
        //PEGA O TAMANHO DA CAIXA DE SELEÇÃO E AJUSTA DE ACORDO COM O TAMAMHO DO INPUT
        var tamanhoInput = $(".dadosProcedimento span input").width()
        $(".list-items").css("width",tamanhoInput)
        //ARRAY DOS PROCEDIMENTOS PRE DECLARADOS
        procedimentos = [];
    })

    //FUNÇÃO QUE ADICIONA E REMOVE OS PROCEDIMENTOS DO CAMPO DE PROCEDIMENTOS
    $("input[name=procedimento]").on("click",function(){
        if($(this).is(":checked")){
            procedimentos.push($(this).val())
        }else{
            posicaoProcedimento = procedimentos.indexOf($(this).val())
            procedimentos.splice(posicaoProcedimento,1)    
        }
        $("input[name=procedimentosSolicitacao]").val(procedimentos.join(","))
    })
    //
})