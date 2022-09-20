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
    document.getElementById("reactive").innerHTML = this.responseText;
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
    $('.tel-num').inputmask("(99) 99999-9999");
});