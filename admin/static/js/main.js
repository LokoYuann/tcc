// feather icons
feather.replace();

//collapse sidebar
function botina() {
    document.getElementById('sidebar').classList.toggle('collapsed');
    
}

//tooltips
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
})

//asda
function formreact(a,b) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
    if(b == 'versao'){
        if(a == 'recent_ver'){
            document.getElementById( 'pdf_versao' ).style.display = 'none';
            document.getElementById( 'recent_button' ).style.display = 'none';
            document.getElementById("calendario").style.display = "block";
        }else{
            document.getElementById( 'calendario' ).style.display = 'none';
            document.getElementById("pdf_versao").style.display = "block";
            document.getElementById("recent_button").style.display = "block";
            document.getElementById("pdf_versao").innerHTML = this.responseText;}
        }
    else{
        document.getElementById("reactive").innerHTML = this.responseText;}
    }
    xhttp.open("GET", "contents/reactive.php?value=" +a+ "&page=" +b+"");
    xhttp.send();
}

function sla(a){
    var filename = a.replace(/^.*[\\\/]/, '');   
    document.getElementsByName('tit_simb')[0].placeholder=filename;
}

function get_endereco($cep){


    // formatar o cep removendo caracteres nao numericos
    $cep = preg_replace("/[^0-9]/", "", $cep);
    $url = "http://viacep.com.br/ws/$cep/xml/";
  
    $xml = simplexml_load_file($url);
    return $xml;
  }

$(document).ready(function(){
	$('.cpf').inputmask("999.999.999-99");
    $('.tel').inputmask("(99) 99999-9999");
    $('.cep').inputmask("99999-999");
});

