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
function formreact(a) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
    document.getElementById("lista_eve_form").innerHTML = this.responseText;
    }
    xhttp.open("GET", "contents/evento/select.php?ue=" +a+ "");
    xhttp.send();
}