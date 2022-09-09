<?php
    $origem = $_FILES["foto"]['tmp_name'];
    $nomedoc = "C:/Users/samu/Documents/xamp/htdocs/admin/static/img/".$_FILES["foto"]["name"].".jpg";
    copy($origem, $nomedoc);
    $sql = "update usuarios set ";
    $sql .= "foto='".$_FILES["foto"]["name"]."' where id_func = '".$_SESSION['UsuarioID']."';";
    $resultado = mysqli_query($con, $sql)or die(mysqli_error());
    if($resultado){header('Location: dash.php?page=perfil&msg=1');mysqli_close($con);}else{header('dash.php?page=perfil&msg=4');mysqli_close($con);};

?>