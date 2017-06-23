<?php

session_start();
include('../../global/conecta.php');
include('../../global/libera.php');

$id1 = $_GET[id];

$idusuario = $_SESSION["idusuario"];
$dados_usuario_logado = mysql_fetch_array(mysql_query("select * from usuariosc where idusuario = '$idusuario'"));
$filial_usuario_logado = $dados_usuario_logado[filial];

$query = "delete from agendadescarrego where id = '$id1'";

if( mysql_query($query))
{
	echo 
	"<script>window.alert('Deletado com Sucesso !')
		window.location.replace('../view/form_agendar.php');
	</script>";	
}
else
{
	echo 
	"<script>window.alert('Algo Errado no Query !')
		window.location.replace('../view/form_agendar.php');
	</script>";	
}

?>

