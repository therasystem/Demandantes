function CarregaCentro(cod) {
    
    var parametro = null; 
    
        url = 'select.php?metodo=1';
        parametro = '&cod=' + cod;
 
    objAjax = new Ajax.Request(url, {
        method: 'get',
        parameters: parametro,
        onComplete: PreencheSpanCentro
    });
}
 
 
//PREENCHEDOR DO SPAN Concurso
function PreencheSpanCentro(resposta) {
    //alert('PREENCHE'+unescape(resposta.responseText));
    var s = unescape(resposta.responseText);
    $('Centro').innerHTML = s;
//  $('selectNew').innerHTML = '<select name="relatcentrocusto" id="relatcentrocusto"><option>dqewdf</option> </select>';
}
 