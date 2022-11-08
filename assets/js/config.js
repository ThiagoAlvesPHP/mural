//DEFINIR SE É EM PRODUÇÃO OU~DESENVOLVIMENTO
var url_local = window.location.href;
//produção
if (url_local.indexOf('localhost') == -1) {
    var url = 'https://www.optimus.mdsystemweb.com.br/';
}
//desenvolvimento
else {
    var url = 'http://localhost/PROJETOS_ANDAMENTO/mural/';
}