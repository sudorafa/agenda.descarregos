<?php
	session_start();
	/*
	Form . do sistema
	Rafael Eduardo L @sudorafa
	Recife, 08 de Outubro de 2016
	*/
	include('../../global/conecta.php');
	include('../../global/libera.php');
	include('../cabecalho.php');
	//include("/controller/ip.php");
	//include('../menu.php');
	if (($_SESSION[perfil] != "GERENCIA") && ($_SESSION[perfil] != "GERENTE") && ($_SESSION[perfil] != "PREVENCAO") && ($_SESSION[perfil] != "RM") && ($_SESSION[perfil] != "CPD")){
		header("Location:/");
	}
	
	$data = date('Y/m/d');
	
	$lista_agendados = mysql_query("select * from agendadescarrego where data_descarrego = '$data' order by hora");
	$linhas_agendados = mysql_num_rows($lista_agendados);
	$uso_mov = $linhas_agendados;
?>

<html>
    <head>
		<meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
        <link type="text/css" rel="stylesheet" href="/_css/style.css"/>
		<meta http-equiv="X-UA-Compatible" content="IE=11"/>		
	</head>
	<body> 
	<!-- --------------------------------------------------------------------------------------- -->
	
	<!-- --------------------------------------------------------------------------------------- -->
		<div id="interface">
			<?php include('../menu.php'); ?>
			<div id="Conteudo">
				<div align="center">
					<br/>
					<h2 align="center"> <font color="336699"> Agendados para Hoje </font></h2> 
					<br/>
					<label><a href="form_outro_dia.php " title="Voltar para Gerar Relatorio"> <img src="/_imagens/btn_voltar.png"></a></label>
					<br/><br/>
					<table cellpadding="0" border="1" width="99%" height="26" align="center">
						<tr height="26">
							<?php if ($uso_mov == 0) { ?>
								<td class="title" height="26"> NADA PARA EXIBIR </td>
							<?php } else {
								?>
								<td class="title" height="26"> TRANSPORTADOR </td>
								<td class="title" height="26"> FORNECEDOR </td>
								<td class="title" height="26"> PRODUTO </td>
								<td class="title" height="26"> QUANTIDADE </td>
								<td class="title" height="26"> AGENDAMENTO </td>
								<td class="title" height="26"> NOME CONTATO </td>
								<td class="title" height="26"> TEL. CONTATO </td>
								<?php if ($dados_usuario_logado[descsetor] == "GERENCIA"){?>
								<td class="title" height="26" colspan="2"> EDICAO </td>
							<?php } }?>
						</tr height="26">
						<?php
						while ($lista_agendados2 = mysql_fetch_array($lista_agendados)) {
							$data_agendamento1 = $lista_agendados2[data_agendamento];
							$data_agendamento1 = explode("-", $data_agendamento1);

							$data_agendamento1 = $data_agendamento1[2] . "/" . $data_agendamento1[1] . "/" . $data_agendamento1[0];
							?>
							<tr>
								<td class="corpo" height="26" > <?php echo $lista_agendados2[nome_transportador] ?> </td>
								<td class="corpo" height="26" > <?php echo $lista_agendados2[nome_fornecedor] ?> </td>
								<td class="corpo" height="26" > <?php echo $lista_agendados2[produto] ?> </td>
								<td class="corpo" height="26" > <?php echo $lista_agendados2[qtd] ?> <?php echo $lista_agendados2[tipo_qtd]; ?> </td>
								<td class="corpo" height="26" > <?php echo $data_agendamento1 ?> | <?php echo $lista_agendados2[hora] ?></td>
								<td class="corpo" height="26" > <?php echo $lista_agendados2[nome_contato] ?> </td>
								<td class="corpo" height="26" > <?php echo $lista_agendados2[telefone_contato] ?> </td>
								<?php if ($dados_usuario_logado[descsetor] == "GERENCIA"){?>
								<td class="corpo" height="26" > <a href="form_editar.php?id=<?php echo $lista_agendados2[id] ?>" > <?php echo "<img src=/agenda.descarregos/imagem/editar.png alt=EDITAR";?> </td>
								<td class="corpo" height="26" > <a href="#" onclick="javascript: if (confirm('Voce deseja realmente excluir?'))location.href='../controller/query_deletar.php?id=<?php echo $lista_agendados2[id] ?>'" > <?php echo "<img src=/agenda.descarregos/imagem/deletar.png alt=DELETAR";?> </td>
								<?php }}; ?>
							</tr>
					</table>
				</div>
				<br/><br/>
				<?php 
					include('../../rodape.php');
				?>
			</div> <!--/conteudo -->
        </div> <!--/interface -->
		
    </body>
</html>