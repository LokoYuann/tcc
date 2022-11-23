
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

//pdf e versões
function tipoCal(){
    if(document.getElementById("cal_lis").style.display == "block"){
        document.getElementById("cal_esc").style.display = "block";
        document.getElementById( 'pdf_versao_esc' ).style.display = 'block';
        document.getElementById( 'cal_lis' ).style.display = 'none';
        document.getElementById( 'pdf_versao_acad' ).style.display = 'none';
        //document.getElementById( 'ver_button' ).style.display = 'none';
    }else{
        document.getElementById( 'cal_esc' ).style.display = 'none';
        document.getElementById( 'pdf_versao_esc' ).style.display = 'none';
        document.getElementById("cal_lis").style.display = "block";
        document.getElementById( 'pdf_versao_acad' ).style.display = 'block';
        //document.getElementById("ver_button").style.display = "block";
        //document.getElementById("cal_lis").innerHTML = this.responseText;
    }}


function Pdf(){
    if(document.getElementById("pdf").style.display == "block"){
        document.getElementById( 'calendario' ).style.display = 'block';
        document.getElementById( 'pdf' ).style.display = 'none';
        document.getElementById("button_pdf").style.display = "block";
        document.getElementById("recent_button").style.display = "none";
    }else{
        document.getElementById( 'calendario' ).style.display = 'none';
        document.getElementById( 'pdf' ).style.display = 'block';
        document.getElementById("button_pdf").style.display = "none";
        document.getElementById("recent_button").style.display = "block";
    }
}

function arroz(src, ver, ver_atual){
    if(ver != 'recent_ver'){
        esc = '<embed src="' + src + ver + ' - esc.pdf" width="1000px" height="770px" ></embed>';
        acad = '<embed src="' + src + ver + ' - acad.pdf" width="1000px" height="770px" ></embed>';
        document.getElementById( 'pdf_versao_esc' ).innerHTML = esc;
        document.getElementById( 'pdf_versao_acad' ).innerHTML = acad;
    
        document.getElementById("calendario").style.display = "none";
        document.getElementById("pdf").style.display = "block";
        document.getElementById("recent_button").style.display = "none";
        document.getElementById("button_pdf").style.display = "none";
        document.getElementById("nv_button").style.display = "none";
    }else{
        esc = '<embed src="' + src + ver_atual + ' - esc.pdf" width="1000px" height="770px" ></embed>';
        acad = '<embed src="' + src + ver_atual + ' - acad.pdf" width="1000px" height="770px" ></embed>';
        document.getElementById( 'pdf_versao_esc' ).innerHTML = esc;
        document.getElementById( 'pdf_versao_acad' ).innerHTML = acad;

        document.getElementById("calendario").style.display = "block";
        document.getElementById("pdf").style.display = "none";
        document.getElementById("button_pdf").style.display = "block";
        document.getElementById("nv_button").style.display = "block";
    }
    
    }





// select responsivo
function formreact(a,b,c) {
    let xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
     document.getElementById("reactive").innerHTML = this.responseText;}
    
    xhttp.open("GET", "contents/reactive.php?value=" +a+ "&page=" +b+"&cal_esc="+c);
    xhttp.send();
}
function verifybase(a) {
    let xhttp = new XMLHttpRequest();
    let xhttp2 = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById('verifybase1').value = this.responseText;
        
        }
    xhttp2.onload = function() {
        document.getElementById('verifybase2').value = this.responseText;
        }

    xhttp.open("GET", "contents/verifybase.php?id_leg=" +a+"&num=1");
    xhttp2.open("GET", "contents/verifybase.php?id_leg=" +a+"&num=2");
    xhttp.send();
    xhttp2.send();
}
function date_limit(a, b){
    if(b == 1){
        document.getElementById('verifybase2').min = a;
    }else{
        document.getElementById('verifybase1').max = a;
    }
}

// inserir novo símbolo
function sla(a){
    var filename = a.replace(/^.*[\\\/]/, '');   
    document.getElementsByName('tit_simb')[0].placeholder=filename;
}

// pega info de cep
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



//simbolo

function simbolo(a){
    document.getElementById("simb").innerHTML = '<img src="/admin/static/img/simbolos/'+a+'" class="simbico_leg_edit" alt=""><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">Mudar</button>';
}