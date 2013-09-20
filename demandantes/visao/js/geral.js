function CarregaConcursoMateria(ano) {

    var parametro = null;
    var url = null;
    if(ano == 0)
        url = 'seleciona_cargo_materia.post.php?metodo=todos_materia';
    else {
        url = 'seleciona_cargo_materia.post.php?metodo=concurso_materia';
        parametro = 'ano=' + ano;
    }

    var carregando = null;
    carregando = '&nbsp;&nbsp;&nbsp; <center><img src="imagens/carregando.gif" title="" alt="" border="0"></img></center><BR><center><b>Carregando..</b></center>';

    $('Concurso').innerHTML = carregando;
    objAjax = new Ajax.Request(url, {
        method: 'get',
        parameters: parametro,
        onComplete: PreencheSpanConcurso
    });
}

function CarregaCargoSemMateria(concurso) {

    var parametro = null;
    var url = null;
    if(concurso == "")
        url = 'seleciona_cargo_materia.post.php?metodo=sem_cargo';
    else {
        url = 'seleciona_cargo_materia.post.php?metodo=cargo';
        parametro = 'concurso=' + concurso;
    }

    var carregando = null;
    carregando = '&nbsp;&nbsp;&nbsp; <center><img src="imagens/carregando.gif" title="" alt="" border="0"></img></center><BR><center><b>Carregando..</b></center>';

    $('Cargo').innerHTML = carregando;
    objAjax = new Ajax.Request(url, {
        method: 'get',
        parameters: parametro,
        onComplete: PreencheSpanCargo
    });
}

function CarregaConcursoGabarito(ano) {

    var parametro = null;
    var url = null;
    if(ano == 0)
        url = 'seleciona_cargo_gabarito.post.php?metodo=todos_gabarito';
    else {
        url = 'seleciona_cargo_gabarito.post.php?metodo=concurso_gabarito';
        parametro = 'ano=' + ano;
    }

    var carregando = null;
    carregando = '&nbsp;&nbsp;&nbsp; <center><img src="imagens/carregando.gif" title="" alt="" border="0"></img></center><BR><center><b>Carregando..</b></center>';

    $('Concurso').innerHTML = carregando;
    objAjax = new Ajax.Request(url, {
        method: 'get',
        parameters: parametro,
        onComplete: PreencheSpanConcurso
    });
}

function Gabarito() {

    if (document.frmGabarito.slcCargo.value=="" )
        alert('Selecione um cargo!\n');
    else
        document.frmGabarito.submit();
}
                                      
function CarregaCargoGabarito(concurso) {

    var parametro = null;
    var url = null;
    if(concurso == "")
        url = 'seleciona_cargo_gabarito.post.php?metodo=sem_cargo';
    
    else {
        url = 'seleciona_cargo_gabarito.post.php?metodo=cargo_gabarito';
        parametro = 'concurso=' + concurso;
    }

    var carregando = null;
    carregando = '&nbsp;&nbsp;&nbsp; <center><img src="imagens/carregando.gif" title="" alt="" border="0"></img></center><BR><center><b>Carregando..</b></center>';

    $('Cargo').innerHTML = carregando;
    objAjax = new Ajax.Request(url, {
        method: 'get',
        parameters: parametro,
        onComplete: PreencheSpanCargo
    });
}

function SemGabarito() {

    if (document.frmGabarito.slcCargo.value=="" || document.frmGabarito.nQuestoes.value=="") {
        msg = "";
        if (document.frmGabarito.slcCargo.value=="")
            msg = 'Selecione um cargo!\n';
        if (document.frmGabarito.nQuestoes.value=="")
            msg += 'Informe o n\xFAmero de quest\xF5es!';
        alert(msg);
    }
    else
        document.frmGabarito.submit();
}
                                        
function CarregaCargoSemGabarito(concurso) {

    var parametro = null;
    var url = null;
    if(concurso == "")
        url = 'seleciona_cargo_gabarito.post.php?metodo=sem_cargo';
    else {
        url = 'seleciona_cargo_gabarito.post.php?metodo=cargo';
        parametro = 'concurso=' + concurso;
    }

    var carregando = null;
    carregando = '&nbsp;&nbsp;&nbsp; <center><img src="imagens/carregando.gif" title="" alt="" border="0"></img></center><BR><center><b>Carregando..</b></center>';

    $('Cargo').innerHTML = carregando;
    objAjax = new Ajax.Request(url, {
        method: 'get',
        parameters: parametro,
        onComplete: PreencheSpanCargo
    });

}

function RespostasEmLote() {

    if (document.frmRespostas.arquivo.value=="")
        alert('Escolha um arquivo para enviar!');
    else
        document.frmRespostas.submit();
}

function CarregaConcursosFinal(cpf) {
    var parametro = null;
    var url = 'consultar_inscricao.post.php?metodo=consulta_por_cpf&cpf='+cpf;
    var carregando = null;
    carregando = '&nbsp;&nbsp;&nbsp; <center><img src="imagens/carregando.gif" title="" alt="" border="0"></img></center><BR><center><b>Carregando..</b></center>';

    parametro = 'cpf_doido=' + cpf;
    $('SpanConcurso').innerHTML = carregando;
    objAjax = new Ajax.Request(url, {
        method: 'post',
        parameters: parametro,
        onComplete: PreencheSpanConcurso2
    });
}

function CarregaCargoMateria(concurso) {

    var parametro = null;
    var url = null;
    if(concurso == "")
        url = 'seleciona_cargo_materia.post.php?metodo=sem_cargo';
    else {
        url = 'seleciona_cargo_materia.post.php?metodo=cargo_materia';
        parametro = 'concurso=' + concurso;
    }

    var carregando = null;
    carregando = '&nbsp;&nbsp;&nbsp; <center><img src="imagens/carregando.gif" title="" alt="" border="0"></img></center><BR><center><b>Carregando..</b></center>';

    $('Cargo').innerHTML = carregando;
    objAjax = new Ajax.Request(url, {
        method: 'get',
        parameters: parametro,
        onComplete: PreencheSpanCargo
    });

}

function CarregaConcursoSemMateria(ano) {

    var parametro = null;
    var url = null;
    if(ano == 0)
        url = 'seleciona_cargo_materia.post.php?metodo=todos';
    else {
        url = 'seleciona_cargo_materia.post.php?metodo=concurso';
        parametro = 'ano=' + ano;
    }

    var carregando = null;
    carregando = '&nbsp;&nbsp;&nbsp; <center><img src="imagens/carregando.gif" title="" alt="" border="0"></img></center><BR><center><b>Carregando..</b></center>';

    $('Concurso').innerHTML = carregando;
    objAjax = new Ajax.Request(url, {
        method: 'get',
        parameters: parametro,
        onComplete: PreencheSpanConcurso
    });

}

function CarregaSemCargoMateria(concurso) {

    var parametro = null;
    var url = null;
    if(concurso == "")
        url = 'seleciona_cargo_materia.post.php?metodo=sem_cargo';
    else {
        url = 'seleciona_cargo_materia.post.php?metodo=cargo';
        parametro = 'concurso=' + concurso;
    }

    var carregando = null;
    carregando = '&nbsp;&nbsp;&nbsp; <center><img src="imagens/carregando.gif" title="" alt="" border="0"></img></center><BR><center><b>Carregando..</b></center>';

    $('Cargo').innerHTML = carregando;
    objAjax = new Ajax.Request(url, {
        method: 'get',
        parameters: parametro,
        onComplete: PreencheSpanCargo
    });

}

function CarregaConcursoSemGabarito(ano) {

    var parametro = null;
    var url = null;
    if(ano == 0)
        url = 'seleciona_cargo_gabarito.post.php?metodo=todos';
    else {
        url = 'seleciona_cargo_gabarito.post.php?metodo=concurso';
        parametro = 'ano=' + ano;
    }

    var carregando = null;
    carregando = '&nbsp;&nbsp;&nbsp; <center><img src="imagens/carregando.gif" title="" alt="" border="0"></img></center><BR><center><b>Carregando..</b></center>';

    $('Concurso').innerHTML = carregando;
    objAjax = new Ajax.Request(url, {
        method: 'get',
        parameters: parametro,
        onComplete: PreencheSpanConcurso
    });

}

function CarregaCargos(concurso,cpf) {
    var parametro = null;
    var url = 'confirmar_deletar_inscricao.post.php?metodo=consulta_por_cargo&cpf='+cpf;
    parametro = 'concurso=' + concurso;
    
    var carregando = null;
    carregando = '&nbsp;&nbsp;&nbsp; <center><img src="imagens/carregando.gif" title="" alt="" border="0"></img></center><BR><center><b>Carregando..</b></center>';
    $('SpanCargo').innerHTML = carregando;
    objAjax = new Ajax.Request(url, {
        method: 'post',
        parameters: parametro,
        onComplete: PreencheSpanCargoFinal
    });

}

function CarregaToolTip(nome) {

    obj = document.getElementById("txtInfo");
    obj.value = "Clique sobre uma das op\u00e7\u00f5es acima para acessar as \u00e1reas configur\u00e1veis.";

    switch (nome)
    {
        case "bt_novo":
            obj.value = "Para criar (abertura) um novo edital";
            break;
        case "bt_obra":
            obj.value = "Cadastrar as obras da empresa.";
            break;
        case "bt_envio_extrato":
            obj.value = "Enviar extrato para análise.";
            break;
        case "bt_analise_extrato":
            obj.value = "Analisar extrato da empresa.";
            break;
        case "bt_cria_processo":
            obj.value = "Cadastrar um novo processo.";
            break;
        case "bt_processo":
            obj.value = "Acompanhar processos existentes.";
            break;
        case "bt_centro_custo":
            obj.value = "Adicionar novos Centros de Custo.";
            break;
        case "bt_material":
            obj.value = "Cadastro de materiais.";
            break;
        case "bt_fornecedor":
            obj.value = "Cadastro de fornecedor.";
            break;
        case "bt_relatorio":
            obj.value = "Gerador de Relatórios.";
            break;
        case "bt_relatorio_financeiro":
            obj.value = "Gerador de Relatórios Financeiros.";
            break;
        case "bt_liberacao_compra":
            obj.value = "Visualizar e liberar compras, cotar preços e montar quadro comparativo.";
            break;
        case "bt_visualiza_compra":
            obj.value = "Visualizar compras executadas.";
            break;
        case "bt_lancamento_notas":
            obj.value = "Adicionar novas notas ao sistema.";
            break;
        case "bt_relatorios":
            obj.value = "Criar novo solicita\u00E7\u00E3o de compra.";
            break;
        case "bt_estoque":
            obj.value = "Adicionar material ao estoque.";
            break;
        case "bt_estoque_out":
            obj.value = "Retirar material do estoque.";
            break;
        case "bt_usuario":
            obj.value = "Cadastro de usu\u00e1rios para acesso ao sistema.";
            break;
        case "bt_cargos":
            obj.value = "Cadastro de cargos.";
            break;
        case "bt_pagamentos":
            obj.value = "Confirma\u00E7\u00E3o de pagamentos ou deferimento dos pedidos de isen\u00E7\u00E3o da taxa de inscri\u00E7\u00E3o.";
            break;
        case "bt_escolaridade":
            obj.value = "Cadastro de escolaridades que podem ser vinculadas aos cargos.";
            break;
        case "bt_aprovados":
            obj.value = "Sele\u00E7\u00E3o de aprovados nos concursos.";
            break;
        case "bt_salas":
            obj.value = "Cadastro de salas para a realiza\u00E7\u00E3o de provas dos concursos.";
            break;
        case "bt_edital":
            obj.value = "Criar ou alterar edital.";
            break;
        case "bt_prova":
            obj.value = "Cria\u00E7\u00E3o dos gabaritos das provas e leitura dos cart\xF5es de resposta dos candidatos.";
            break;
        case "bt_candidato":
            obj.value = "Altera\u00E7\u00E3o dos dados cadastrais dos candidatos.";
            break;
        case "bt_administrador":
            obj.value = "Altera\u00E7\u00E3o do e-mail administrativo.";
            break;

    }
}
