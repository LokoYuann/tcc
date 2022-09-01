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