<?php
session_start();
include('../../global/conecta.php');
include('../../global/libera.php');

$data = date('Y/m/d');
$hora = date('H:i');

$transpT 			= $_POST["transp"];
$novo_transp1 		= $_POST["novo_transp"];
if ($transpT == "NOVO"){
	$transp1 = $novo_transp1;
	$novoT = "NOVO";
} else { 
	$transp1 = $transpT;
}

$fornecT	 		= $_POST["fornec"];
$novo_fornec1 		= $_POST["novo_fornec"];
if ($fornecT == "NOVO"){
	$fornec1 = $novo_fornec1;
	$novoF = "NOVO";
} else {
	$fornec1 = $fornecT;
}

$produto1	 		= $_POST["produto"];
$qtd1		 		= $_POST["qtd"];

$qtd_palletes1 		= $_POST["qtd_palletes"];
$qtd_volumes1 		= $_POST["qtd_volumes"];
if ($qtd_palletes1 == ""){
	$tipo_qtd1 = $qtd_volumes;
} else {
		$tipo_qtd1 = $qtd_palletes1;
}

$nome1		 		= $_POST["nome"];

	$telefone0	 		= $_POST["telefone"];
	
	$telefone1			= str_replace('/','-',$telefone0);

	$data_descarrego0	= $_POST[data_descarrego];
	
	$data_descarrego1	= str_replace('-','/',$data_descarrego0);
	
	$data_descarrego1 	= explode("/", $data_descarrego1);

	if (  (!(Checkdate($data_descarrego1[1],$data_descarrego1[0], $data_descarrego1[2] ))) ) {
		echo "<script>window.alert('Data Invalida, NADA SALVO !'); window.location.replace('form_agendar.php');</script>"; 
	} else {
		$data_descarrego1 = $data_descarrego1[2] . "-" . $data_descarrego1[1] . "-" . $data_descarrego1[0];
			
		$query = "insert into agendadescarrego (nome_transportador, nome_fornecedor, produto, qtd, tipo_qtd, data_agendamento, hora, data_descarrego, nome_contato, telefone_contato) values ('$transp1', '$fornec1', '$produto1', '$qtd1', '$tipo_qtd1', '$data', '$hora', '$data_descarrego1', '$nome1', '$telefone1')";
		if( mysql_query($query)) { }
		else {
			echo 
			"<script>window.alert('Algo Errado no Query !');
				window.location.replace('../view/form_agendar.php');
			</script>";		
		}
		
		if ($novoT == "NOVO") {
			$buscaT = mysql_fetch_array(mysql_query("select * from transportador where nome_transportador = '$transp1'"));
			$dados_buscaT = $buscaT[nome_transportador];
			if ($dados_buscaT <> $transp1){
				$query1 = "insert into transportador (nome_transportador) values ('$transp1')";
				if( mysql_query($query1)) { }
				else {
					echo 
					"<script>window.alert('Algo Errado no Query1 !');
						window.location.replace('../view/form_agendar.php');
					</script>";		
				}
			}
		}

		if ($novoF == "NOVO") {
			$buscaF = mysql_fetch_array(mysql_query("select * from fornecedor where nome_fornecedor = '$fornec1'"));
			$dados_buscaF = $buscaF[nome_fornecedor];
			if ($dados_buscaF <> $fornec1){
				$query2 = "insert into fornecedor (nome_fornecedor) values ('$fornec1')";
				if( mysql_query($query2)) {	}
				else {
					echo 
					"<script>window.alert('Algo Errado no Query2 !');
						window.location.replace('../view/form_agendar.php');
					</script>";		
				}
			}
		}
		echo 
		"<script>window.alert('Salvo com Sucesso !');
			window.location.replace('../view/form_agendar.php');
		</script>";	
	}
	
	
?>