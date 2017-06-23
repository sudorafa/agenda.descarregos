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
	
	$lista_transportador = mysql_query("select * from transportador order by nome_transportador");
	$lista_fornecedor = mysql_query("select * from fornecedor order by nome_fornecedor");

	$id1 = $_GET[id];

	$registros = mysql_query("select * from agendadescarrego where id = '$id1'");
	$dados_registros = mysql_fetch_array($registros);

	$data_descarrego1 = $dados_registros[data_descarrego];
	$data_descarrego1 = explode("-", $data_descarrego1);

	$data_descarrego1 = $data_descarrego1[2] . "/" . $data_descarrego1[1] . "/" . $data_descarrego1[0];
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
					<h2 align="center"> <font color="336699"> Editar </font></h2> 
					<br/> <br/> 
					<table border="0" align="center" width="75%">
                        <tr> 
                            <td align="right">
                                <form action="../controller/query_editar.php" method="post" name="editar" id="agendar" onSubmit="return valida_dados(this)">

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
                                    <input name="produto" value="<?php echo $dados_registros[produto] ?>" type="text" size="30" maxlength="30"> &nbsp; &nbsp;
                                    </br> </br> 
                                    <label> <font color="336699">  Data Alteração: </label> &nbsp;
                                    <input type="text" value="<?php echo date('d/m/Y');?>" name="data_cadastro" size="10" maxlength="10" onkeyup="Formatadata(this,event)" /> &nbsp; &nbsp; &nbsp;
									
                                    </td>

                                    <td align="left">
                                        <label> <font color="336699"> Novo ? </label> &nbsp;
                                        <input name="novo_transp" value="<?php echo $dados_registros[nome_transportador] ?>" type="text" size="30" maxlength="30">
                                        </br> </br> 
                                        <label> <font color="336699"> Novo ? </label> &nbsp;
                                        <input name="novo_fornec" value="<?php echo $dados_registros[nome_fornecedor] ?>" type="text" size="30" maxlength="30">
                                        </br> </br> 
                                        <label> <font color="336699"> *Quantidade: </label> &nbsp;
                                        <input name="qtd" value="<?php echo $dados_registros[qtd] ?>" type="text" size="5" maxlength="5"> &nbsp;
                                        
                                        <?php
                                        if ($dados_registros[qtd] == "palletes"){
                                            $status = "checked";
                                        } else {
                                            $status = "";
                                        }
                                        if ($dados_registros[qtd] == "volumes"){
                                            $status = "checked";
                                        } else {
                                            $status = "";
                                        }
                                        ?>
                                        
                                        <input type="checkbox" name="qtd_palletes" value="palletes" <?php if ($dados_registros[tipo_qtd] == "palletes") { ?> checked <?php } ?> />Palletes</label>
                                        <input type="checkbox" name="qtd_volumes" value="volumes" <?php if ($dados_registros[tipo_qtd] == "volumes") { ?> checked <?php } ?> />Volumes</label>
                                        
                                        
                                        </br> </br> 
                                        <label> <font color="336699">  *Data do Descarrego: </label> &nbsp;
                                        <input type="text" name="data_descarrego" size="10" maxlength="10" onkeyup="Formatadata(this,event)" />
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
                                            <input name="nome" value="<?php echo $dados_registros[nome_contato] ?>" type="text" size="30" maxlength="30"> &nbsp; &nbsp;
                                        </td>
                                        <td align="left">
                                            <label> <font color="336699"> *Telefone: </label> &nbsp;
                                            <input name="telefone" value="<?php echo $dados_registros[telefone_contato] ?>" type="text" size="15" maxlength="15">
                                            <input type="hidden" name="id2" value="<?php echo $dados_registros[id]?>" >
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
				</div>
				<br/><br/>
				<?php 
					include('../../rodape.php');
				?>
			</div> <!--/conteudo -->
        </div> <!--/interface -->
		
    </body>
</html>