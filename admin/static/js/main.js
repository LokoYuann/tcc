
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
function tipoCal(){
   // let xhttp = new XMLHttpRequest();
   // xhttp.onload = function() {
    if(document.getElementById("pdf_versao_acad").style.display == "none" && document.getElementById("pdf_versao_esc").style.display == "none"){
        if(document.getElementById("cal_tipo").style.display == "block"){
            document.getElementById("calendario").style.display = "block";
            document.getElementById( 'cal_tipo' ).style.display = 'none';
            //document.getElementById( 'ver_button' ).style.display = 'none';
        }else{
            document.getElementById( 'calendario' ).style.display = 'none';
            document.getElementById("cal_tipo").style.display = "block";
            //document.getElementById("ver_button").style.display = "block";
            //document.getElementById("cal_tipo").innerHTML = this.responseText;
        }}
    else{
        if(document.getElementById( 'pdf_versao_acad' ).style.display == 'block'){
            document.getElementById( 'pdf_versao_acad' ).style.display = 'none';
            document.getElementById( 'pdf_versao_esc' ).style.display = 'block';
        }else{
            document.getElementById( 'pdf_versao_acad' ).style.display = 'block';
            document.getElementById( 'pdf_versao_esc' ).style.display = 'none';
        }
    }
    
   // }
    //xhttp.open("GET", "based/cal_list.php");
   // xhttp.send();
}

function showPdf(){
    if(document.getElementById("cal_tipo").style.display == "block"){
        document.getElementById( 'cal_tipo' ).style.display = 'none';
        document.getElementById( 'pdf_versao_acad' ).style.display = 'block';
        document.getElementById("button_pdf").style.display = "none";
        document.getElementById("recent_button").style.display = "block";
    }else{
        document.getElementById( 'calendario' ).style.display = 'none';
        document.getElementById( 'pdf_versao_esc' ).style.display = 'block';
        document.getElementById("button_pdf").style.display = "none";
        document.getElementById("recent_button").style.display = "block";
    }
}

function voltarCal(){
    if(document.getElementById( 'pdf_versao_esc' ).style.display == 'block'){
        document.getElementById( 'calendario' ).style.display = 'block';
        document.getElementById( 'pdf_versao_esc' ).style.display = 'none';
    }else{
        document.getElementById( 'cal_tipo' ).style.display = 'block';
        document.getElementById( 'pdf_versao_acad' ).style.display = 'none';
    }
    document.getElementById("recent_button").style.display = "none";
    document.getElementById("button_pdf").style.display = "block";
}






function formreact(a,b,c) {
    let xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
     document.getElementById("reactive").innerHTML = this.responseText;}
    
    xhttp.open("GET", "contents/reactive.php?value=" +a+ "&page=" +b+"&calendario="+c);
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



function arroz(src, ver, ver_atual){
if(ver != 'recent_ver'){
    esc = '<embed src="' + src + ver + ' - esc.pdf" width="1000px" height="770px" ></embed>';
    acad = '<embed src="' + src + ver + ' - acad.pdf" width="1000px" height="770px" ></embed>';
    document.getElementById( 'pdf_versao_esc' ).innerHTML = esc;
    document.getElementById( 'pdf_versao_acad' ).innerHTML = acad;

    document.getElementById("recent_button").style.display = "none";
    document.getElementById("button_pdf").style.display = "none";
    if(document.getElementById("cal_tipo").style.display == "block"){
        document.getElementById("cal_tipo").style.display = "none";
        document.getElementById("pdf_versao_acad").style.display = "block";
    }else{
        document.getElementById("calendario").style.display = "none";
        document.getElementById("pdf_versao_esc").style.display = "block";
    }
}else{
    esc = '<embed src="' + src + ver_atual + ' - esc.pdf" width="1000px" height="770px" ></embed>';
    acad = '<embed src="' + src + ver_atual + ' - acad.pdf" width="1000px" height="770px" ></embed>';
    document.getElementById( 'pdf_versao_esc' ).innerHTML = esc;
    document.getElementById( 'pdf_versao_acad' ).innerHTML = acad;

    if(document.getElementById("pdf_versao_acad").style.display == "block"){
        document.getElementById("cal_tipo").style.display = "block";
    }else{
        document.getElementById("calendario").style.display = "block";
    }
    document.getElementById("recent_button").style.display = "none";
    document.getElementById("button_pdf").style.display = "block";
    document.getElementById("pdf_versao_acad").style.display = "none";
    document.getElementById("pdf_versao_esc").style.display = "none";
}

}