<select>
    <option onclick="get_endereco(this.value)" value="25926-526">Rua Professora Luísa Vieira da Silva
    <option onclick="get_endereco(this.value)" value="13846-675">Rua Miguel de Paula Oliveira
    <option onclick="get_endereco(this.value)" value="41225-420">Rua Abelardo Magalhães 
</select>
<button onclick="get_endereco('25926-526')">asdawd</button>

<?php
$cep = filter_input(INPUT_GET, "cep");
 
 
 if($cep){
     $cep = str_replace("-", "", $cep);
    
     $json = file_get_contents('https://viacep.com.br/ws/'. $cep . '/json/');
  
     $jsonToArray = json_decode($json);
     $a = $jsonToArray->cep;
     echo $a;
     ?> 
     <?php
 } ?>