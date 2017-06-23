<?php
	session_start();
	/*
	Form . do sistema
	Rafael Eduardo L @sudorafa
	Recife, 08 de Outubro de 2016
	*/
	include('../../global/conecta.php');
	include('../../global/libera.php');
	include('../../negocio/agenda.descarregos.php');
	include('../cabecalho.php');
	//include("/controller/ip.php");
	//include('../menu.php');
	if (($_SESSION[perfil] != "GERENCIA") && ($_SESSION[perfil] != "GERENTE") && ($_SESSION[perfil] != "PREVENCAO") && ($_SESSION[perfil] != "RM") && ($_SESSION[perfil] != "CPD")){
		header("Location:/");
	}
?>

<html>
    <head>
		<meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
        <link type="text/css" rel="stylesheet" href="/_css/style.css"/>
		<meta http-equiv="X-UA-Compatible" content="IE=11"/>		
	</head>
	<body onLoad="document.agenda_outro_dia.data_inicio.focus()"> 
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
	<!-- --------------------------------------------------------------------------------------- -->
	<script language="javascript">
	function valida_dados (agenda_outro_dia)
		if (agenda_outro_dia.data_inicio.value=="") {
			alert ("Por favor digite a data inicio !");
			agenda_outro_dia.data_inicio.focus();
			return false;
		}
		if (agenda_outro_dia.data_fim.value=="") {
			alert ("Por favor digite a data fim !");
			agenda_outro_dia.data_fim.focus();
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
					<h2 align="center"> <font color="336699"> Consultar Agendados </font></h2> 
					<br/>
					<hr width="70%"/>
					<table cellpadding="0" border="1" width="50%" align="center">
					<tr align="center">
						<form action="lista_agenda_outro_dia.php" method="post" name="agenda_outro_dia" id="agenda_outro_dia" align="center" onSubmit="return valida_dados(this)">
						<td >
						<br/> <br/>
							<label> <font color="336699">  Data Inicio: </label> &nbsp;
							<input type="text" name="data_inicio" size="10" maxlength="10" onkeyup="Formatadata(this,event)" />&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;
							<label> <font color="336699">  Data Fim: </label> &nbsp;
							<input type="text" name="data_fim" size="10" maxlength="10" onkeyup="Formatadata(this,event)" />&nbsp; &nbsp; &nbsp;
						<br/>
							<label> <font color="336699">  (Digite apenas numeros para ficar assim: 01/02/2016) </label> &nbsp;
						<br/> <br/> <br/>
						<center><input type="submit" value="gerar relatorio" name="gerar_relatorio"><center>
						<br/>
						</td>
						</form>
					</tr>
					</table>
					<hr width="70%"/>
				</div>
				<br/><br/><br/><br/>
				<?php 
					include('../../rodape.php');
				?>
			</div> <!--/conteudo -->
        </div> <!--/interface -->
		
    </body>
</html>