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
	if (($_SESSION[perfil] != "GERENCIA") && ($_SESSION[perfil] != "GERENTE")){
		header("Location:form_outro_dia.php");
	}
	
	$idusuario = $_SESSION["idusuario"];
	$dados_usuario_logado = mysql_fetch_array(mysql_query("select * from usuariosc where idusuario = '$idusuario'"));
	$filial_usuario_logado = $dados_usuario_logado[filial];
	
	$lista_transportador = mysql_query("select * from transportador order by nome_transportador");
	$lista_fornecedor = mysql_query("select * from fornecedor order by nome_fornecedor");
	
?>

<html>
    <head>
		<meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
        <link type="text/css" rel="stylesheet" href="/_css/style.css"/>
		<meta http-equiv="X-UA-Compatible" content="IE=11"/>		
	</head>
	<body> 
	<!-- --------------------------------------------------------------------------------------- -->
	<script type="text/javascript">
		function Formatadata(Campo, teclapres)
		{
			var tecla = teclapres.keyCode;
			var vr = new String(Campo.value);
			vr = vr.replace("/", "");
			vr = vr.replace("/", "");
			vr = vr.replace("/", "");
			tam = vr.length + 1;
			if (tecla != 8 && tecla != 8)
			{
				if (tam > 0 && tam < 2)
					Campo.value = vr.substr(0, 2) ;
				if (tam > 2 && tam < 4)
					Campo.value = vr.substr(0, 2) + '/' + vr.substr(2, 2);
				if (tam > 4 && tam < 7)
					Campo.value = vr.substr(0, 2) + '/' + vr.substr(2, 2) + '/' + vr.substr(4, 7);
			}
		}
	</script>
	
	<script language="javascript">
	
		function valida_dados(agendar)
		{
			if (agendar.transp.selectedIndex == 0) {
				if (agendar.novo_transp.value == "") {
					alert("Por favor, selecione um Transportador ou Digite um Novo !");
					agendar.novo_transp.focus();
					return false;
				}
			}

			if (agendar.fornec.selectedIndex == 0) {
				if (agendar.novo_fornec.value == "") {
					alert("Por favor, selecione um Fornecedor ou Digite um Novo !");
					agendar.novo_fornec.focus();
					return false;
				}
			}

			if (agendar.produto.value == "") {
				alert("Por favor digite o Produto !");
				agendar.produto.focus();
				return false;
			}

			if (agendar.qtd.value == "") {
				alert("Por favor digite a quantidade !");
				agendar.qtd.focus();
				return false;
			}

			if (agendar.qtd_palletes.checked == false) {
				if (agendar.qtd_volumes.checked == false) {
					alert("Por favor, Marque se Palletes ou Volumes !");
					agendar.qtd_palletes.focus();
					return false;
				}
			}

			if (agendar.qtd_palletes.checked == true) {
				if (agendar.qtd_volumes.checked == true) {
					alert("Por favor, Marque se Palletes ou Volumes !");
					agendar.qtd_palletes.focus();
					return false;
				}
			}

			if (agendar.data_descarrego.value == "") {
				alert("Por favor digite a Data do Descarrego !");
				agendar.data_descarrego.focus();
				return false;
			}

			if (agendar.nome.value == "") {
				alert("Por favor digite o Nome do Contato !");
				agendar.nome.focus();
				return false;
			}

			if (agendar.telefone.value == "") {
				alert("Por favor digite o Telefone do Contato !");
				agendar.telefone.focus();
				return false;
			}

			return true;
		}
	</script>
	<!-- --------------------------------------------------------------------------------------- -->
		<div id="interface">
			<?php include('../menu.php'); ?>
			<div id="Conteudo">
				<div align="center">
					<br/>
					<h2 align="center"> <font color="336699"> Agendar </font></h2> 
					<br/>
					<hr width="80%"/>
					<br/>
					<table border="0" align="center" width="99%">
						<tr> 
							<td align="right">
								<form action="../controller/query_agendar.php" method="post" name="agendar" id="agendar" onSubmit="return valida_dados(this)">

									<label> <font color="336699"> *Transportador: </label> &nbsp;
									<select size="1" name="transp">
										<option value="NOVO"> Novo Transportador | Digite -> </option>
										<?php
										while ($lista_transportador1 = mysql_fetch_array($lista_transportador)) {
											?>
											<option value="<?php echo $lista_transportador1[nome_transportador] ?>"> <?php echo $lista_transportador1[nome_transportador] ?></option>
										<?php } ?>	
									</select> &nbsp; &nbsp;
									</br> </br> 
									<label> <font color="336699"> *Fornecedor: </label> &nbsp;
									<select size="1" name="fornec">
										<option value="NOVO"> Novo Fornecedor | Digite -> </option>
										<?php
										while ($lista_fornecedor1 = mysql_fetch_array($lista_fornecedor)) {
											?>
											<option value="<?php echo $lista_fornecedor1[nome_fornecedor] ?>"> <?php echo $lista_fornecedor1[nome_fornecedor] ?></option>
										<?php } ?>	
									</select> &nbsp; &nbsp;
									</br> </br>
									<label> <font color="336699"> *Produto: </label> &nbsp;
									<input name="produto" type="text" size="30" maxlength="30"> &nbsp; &nbsp;
									</br> </br> 
									<label> <font color="336699">  Data do Agendamento: </label> &nbsp;
									<input  value="<?php echo date('d/m/Y')?>" type="text" name="data_cadastro" size="10" maxlength="10" onkeyup="Formatadata(this,event)" /> &nbsp; &nbsp;
									
									</td>

									<td align="left">
										<label> <font color="336699"> Novo ? </label> &nbsp;
										<input name="novo_transp" type="text" size="30" maxlength="30">
										</br> </br> 
										<label> <font color="336699"> Novo ? </label> &nbsp;
										<input name="novo_fornec" type="text" size="30" maxlength="30">
										</br> </br> 
										<label> <font color="336699"> *Quantidade: </label> &nbsp;
										<input name="qtd" type="text" size="5" maxlength="5"> &nbsp;
										<input type="checkbox" name="qtd_palletes" value="palletes" /> Palletes</label>
										<input type="checkbox" name="qtd_volumes" value="volumes" /> Volumes</label>
										</br> </br> 
										<label> <font color="336699">  *Data do Descarrego: </label> &nbsp;
										<input type="text" name="data_descarrego" size="10" maxlength="10" onkeyup="Formatadata(this,event)" /> &nbsp; &nbsp; &nbsp;
									</td>
									<tr>
										<td colspan="2" align="center">
											</br> </br> 
											<h4> <font color="336699"> Contato do Agendamento: </h4>
										</td>
									</tr>
									<tr>
										<td align="right">
											<label> <font color="336699"> *Nome: </label> &nbsp;
											<input name="nome" type="text" size="30" maxlength="30"> &nbsp; &nbsp;
										</td>
										<td align="left">
											<label> <font color="336699"> *Telefone: </label> &nbsp;
											<input name="telefone" type="text" size="15" maxlength="15">
										</td>
									</tr>
									<tr>
										<td colspan="2" align="center">
											</br>
											<input align="center" type="submit" name="salvar" value="salvar">
											</br> </br> 
										</td>
									</tr>
								</form>
						</tr>
					</table>
					<hr width="80%"/>
					<br/> <br/>
				</div>
				<?php 
					include('../../rodape.php');
				?>
			</div> <!--/conteudo -->
        </div> <!--/interface -->
		
    </body>
</html>