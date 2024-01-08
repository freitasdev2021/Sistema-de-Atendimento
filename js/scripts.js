jQuery(function(){
    $(document).ready(function(){
        //PROCEDIMENTOS
        $("#procedimentos").hide();
        $(".error-input").hide()
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
        //ARRAY DOS PROCEDIMENTOS PRE DECLARADOS
        procedimentos = [];
    })

    //FUNÇÃO QUE MUDA A SELEÇÃO DE MULTIPLA PRA UNICA E VICE VERSA
    $("#multipla").hide()
    $("select[name='tipoSolicitacao']").on("change",function(){
        if($(this).val() == 2){
            $("#multipla").show()
            $("#unica").hide()
             //PEGA O TAMANHO DA CAIXA DE SELEÇÃO E AJUSTA DE ACORDO COM O TAMAMHO DO INPUT
            var tamanhoInput = $(".dadosProcedimento #multipla input").width()
            $(".list-items").css("width",tamanhoInput)
        }else{
            $("#unica").show()
            $("#multipla").hide()
        }
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
    //TRATA OS FORMULARIOS
    function validaCampos(form){
        var inputs = [];
        $("input").parent().find(".error-input").hide()
        $("label").removeClass("text-danger")
        $("input").removeClass("border-danger")

        $("select").parents(".select").find(".error-input").hide()
        $("label").removeClass("text-danger")
        $("select").removeClass("border-danger")

        $("textarea").parent().find(".error-input").hide()
        $("label").removeClass("text-danger")
        $("textarea").removeClass("border-danger")

        $("input:visible",form).each(function(){
            if(!$(this).hasClass("norequire")){
                if($(this).val().length < $(this).attr("minlength")){
                    inputs.push($(this).attr("name"))
                }
            }
        })

        $("input[type=email]:visible",form).each(function(){
            if(!$(this).hasClass("norequire")){
                if($(this).val().length < $(this).attr("minlength") || !is_email($(this).val())){
                    inputs.push($(this).attr("name"))
                }
            }
        })

        $(".cpfCnpj input:visible",form).each(function(){
            if(!$(this).hasClass("norequire")){
                if($(this).val().length < $(this).attr("minlength") || !is_cpfcnpj($(this).val())){
                    inputs.push($(this).attr("name"))
                }
            }
        })

        $(".data input:visible",form).each(function(){
            if(!$(this).hasClass("norequire")){
                if($(this).val().length < $(this).attr("minlength")){
                    inputs.push($(this).attr("name"))
                }
            }
        })

        $("select:visible",form).each(function(){
            if(!$(this).hasClass("norequire")){
                if($(this).val() == ""){
                    inputs.push($(this).attr("name"))
                }
            }
        })

        $("textarea:visible",form).each(function(){
            if(!$(this).hasClass("norequire")){
                if($(this).val() == ""){
                    inputs.push($(this).attr("name"))
                }
            }
        })

        if(inputs.length > 0){
            $(inputs).each(function(index,val){
                $("input[name='"+val+"']").parent().find(".error-input").show()
                $("input[name='"+val+"']").parent().find("label").addClass("text-danger")
                $("input[name='"+val+"']").addClass("border-danger")
                //
                $("select[name='"+val+"']").parent().find(".error-input").show()
                $("select[name='"+val+"']").parent().find("label").addClass("text-danger")
                $("select[name='"+val+"']").addClass("border-danger")
                //
                $("textarea[name='"+val+"']").parent().find(".error-input").show()
                $("textarea[name='"+val+"']").parent().find("label").addClass("text-danger")
                $("textarea[name='"+val+"']").addClass("border-danger")
            })
            return false
        }
        return true
    }
    //FUNÇÃO QUE ENVIA O FORMULARIO
    $("#formPacientes").on("submit",function(e){
        e.preventDefault()
        //VALIDA O FOMULÁRIO
        if(!validaCampos("#formPacientes")){
            return false
        }
        //TRATA OS DADOS DOS PROCEDIMENTOS
        if($("select[name='tipoSolicitacao']").val() == 2){
            procedimento = $("input[name='procedimentosSolicitacao']").val().split(",")
        }else{
            procedimento = $("select[name='procedimentosSolicitacao']").val()
        }
        // console.log(procedimento)
        // return false
        //ENVIA OS DADOS PARA O SERVIDOR
        $.ajax({
            method : 'POST',
            url : './Configs/enviaDados.php',
            data : {
                funcao : 'setSolicitacao',
                procedimentos : ($("select[name='tipoSolicitacao']").val() == 2) ? JSON.stringify(procedimento) : procedimento,
                paciente : $("input[name='idPaciente']").val(),
                profissional : $("select[name='escolhaProfissional']").val(),
                dataSol : $("input[name=dataSolicitacao]").val(),
                horaSol : $("input[name=horaSolicitacao]").val(),
                tipoSolicitacao : $("select[name='tipoSolicitacao']").val()
            }
        }).done(function(r){
            //console.log(r)
            window.location.href="index.php"
        })
    })

})