<?php
/*
	Form Criado para carregar o menu do Portal
	Rafael Eduardo L @sudorafa
	Recife, 08 de Outubro de 2016
*/
	session_start();
?>

<html>
    <head>
		<meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>
        <link type="text/css" rel="stylesheet" href="/_css/style.css"/>
		<meta http-equiv="X-UA-Compatible" content="IE=11"/>
		<script>
			//window.location.href='#foo';
		</script>
	</head>
    <body>
		<!--<a href="#" id="foo"></a>-->
		<!-- -------------------------------------------------------------------- -->
		<!-- ------------------------- Barra de Menu ---------------------------- -->
		<!-- -------------------------------------------------------------------- -->
			<section id="menu">
                <ul>
					<li><a href="#" title="Descrição" target="_blank">MENU SYS</a></li>
						<li><a> | </a></li>
                    <li><a href="#" title="Descrição" target="_blank">MENU SYS</a></li>
						<li><a> | </a></li>
                    <li><a href="#" title="Descrição" target="_blank">MENU SYS</a></li>
						<li><a> | </a></li>
                    <li><a href="#" title="Descrição" target="_blank">MENU SYS</a></li>
						<li><a> | </a></li>
                    <li><a href="#" title="Descrição" target="_blank">MENU SYS</a></li>
						<li><a> | </a></li>
                    <li><a href="#" title="Descrição" target="_blank">MENU SYS</a></li>
						<li><a> | </a></li>
                    <li><a href="#" title="Descrição" target="_blank">MENU SYS</a></li>
						<li><a> | </a></li>
                    <li><a href="#" title="Descrição" target="_blank">MENU SYS</a></li>
						<li><a> | </a></li>
                    <li><a href="#" title="Descrição" target="_blank">MENU SYS</a></li>
				</ul>
			</section>
			<section id="menuLogado3">
				<ul>
					<li><a href="/agenda.descarregos/view/form_agendar.php" title="Inicio/Registrar Entradas e Saídas - Agenda Descarregos">AGENDAR</a></li>
						<li><a> | </a></li>
					<li><a href="/agenda.descarregos/view/form_outro_dia.php" title="Estoque - Agenda Descarregos">CONSULTAR AGENDADOS</a></li>
						<li><a> | </a></li>
					<li><a href="/agenda.descarregos/view/lista_agendados_hoje.php" title="Auditorias - Agenda Descarregos">AGENDADOS HOJE</a></li>
				</ul>
			</section>
		<!-- ---------------------------------------------------------------------- -->
		<!-- ----------------------- Barra de Menu Fim ---------------------------- -->
		<!-- ---------------------------------------------------------------------- -->
    </body>
</html>