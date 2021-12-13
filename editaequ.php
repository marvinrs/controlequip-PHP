<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Alteracao de Equipamentos</title>
		<style type="text/css">
	 
			/*Configurações Padrões*/
			ul.menu, .menu li, .menu a{ margin:0; padding:0; list-style:none; text-decoration:none;}
			ul.menu ul{ position:absolute; display:none; box-shadow:3px 3px 2px #333;}
			 
			/* Configurações nivel 1*/
			ul.menu{ float:left; font-family:Verdana, Geneva, sans-serif; font-size:15px; border-radius:5px; padding:0 5px;}
			.menu li{ float:left; width:auto; position:relative;}
			.menu li a{ display:block; padding:0 20px; line-height:25px; height:25px; float:left; transition:all 0.1s linear; }
			 
			/* Configurações nivel 2*/
			.menu li:hover > ul.submenu-1{ display:block; top:25px; left:0; padding:5px; width:200px; border-radius:0 0 5px 5px;   }
			.menu ul.submenu-1 a{  width:160px; padding:0 20px; border-radius:5px;  }
			 
			/* Configurações nivel 2*/
			.menu li:hover > ul.submenu-2{ display:block; top:0; left:195px; padding:5px; width:200px;  border-radius: 0 5px 5px 5px; }
			.menu ul.submenu-2 a{  width:160px; padding:0 20px; border-radius:5px; }
			 
			/* Configurações nivel 3*/
			.menu li:hover > ul.submenu-3{ display:block; top:0; left:195px; padding:5px; width:200px;  border-radius: 0 5px 5px 5px; }
			.menu ul.submenu-3 a{  width:160px; padding:0 20px; border-radius:5px; }
			 
			 
			/*Configurações de cores*/
			 
			/*nivel 1*/
			.menu{background:#CCC; }
			.menu a{ color:#000;}
			.menu li:hover > a{ background:#999;  color:#fff;}
			 
			/*nivel 2*/
			.submenu-1{ background:#999;}
			.submenu-1 a{color:#fff;}
			.submenu-1 li:hover > a{ background:#666; }
			 
			/*nivel 3*/
			.submenu-2{ background:#666;}
			.submenu-2 a{color:#fff;}
			.submenu-2 li:hover > a{ background:#333; }
			 
			/*nivel 3*/
			.submenu-3{ background:#333;}
			.submenu-3 a{color:#fff;}
			.submenu-3 li:hover > a{ background:#000; }
		 
		</style>
	</head>
    <body bgcolor="#FFFFF0" onload="getIniciaEqu();">
        <script type="text/javascript" src="ajax.js" ></script>
		<?php 
			include("conexao.php");
			//Pega os parâmetros da página anterior ID do registro
			$idequ = $_GET ["idequ"];
			//consulta tabela pra saber os outros valores do registro
			$sql = mysqli_query($cx, "SELECT * FROM ZZ3 LEFT JOIN ZZ7 ON ZZ7_TIPEQU=ZZ7_ID WHERE ZZ3_IDEQU='$idequ'");
			$aux = mysqli_fetch_assoc($sql);
			$placa =$aux["ZZ3_PLACA"];
			$frota =$aux["ZZ3_FROTA"];
			$empequ=$aux["ZZ3_EMPEQU"];
			$posse =$aux["ZZ3_POSSE"];
			$tipequ=$aux["ZZ3_TIPEQU"];
			$obs   =$aux["ZZ3_OBS"];
			$nomequ=$aux["ZZ7_NOMEQU"];
		// 	transforma a data do formato YYYYMMDD para YYYY-MM-DD para ser lido no campo tipo "date"
		//	$DAT_MOV_TRACO_1 = substr_replace($datmov, '-', 4, 0);;
		//	$DAT_MOV_TRACO_2 = substr_replace($DAT_MOV_TRACO_1, '-', 7, 0);;	  
		?>

        <div id="Container">
		
			<h2><img src=img/logo.jpg>Manutenção de Equipamentos</td>
				<div id="menu">
					<ul class="menu"> <!-- Esse é o 1 nivel ou o nivel principal -->
						<li><a href="index.html">Movimento</a></li>
						<li><a href="pessoa.html">Pessoa</a></li>
						<li><a href="equipamento.html">Equipamento</a></li>
						<li><a href="#">Contato</a>
						</li>
						<li><a href="#">Consultas</a>
							<ul class="submenu-1"> <!-- Esse é o 2 nivel ou o primeiro Drop Down -->
								<li><a href="#">Historico</a></li>
								<li><a href="#">Rastreamento</a></li>
								<li><a href="#">Pesquisa</a>
										<ul class="submenu-2"> <!-- Esse é o 3 nivel ou o Segundo Drop Down -->
											<li><a href="#">Submenu 4</a></li>
											<li><a href="#">Submenu 5</a></li>
											<li><a href="#">Submenu 6</a>
														<ul class="submenu-3"> <!-- Esse é o 4 nivel ou o Terceiro Drop Down -->
																<li><a href="#">Submenu 7</a></li>
																<li><a href="#">Submenu 8</a></li>
																<li><a href="#">Submenu 9</a></li>
														</ul>
											</li>
										</ul>
								 </li>
							</ul>
						</li>
					</ul>			
				</div>
			</h2>
			<table width="100%" border="0">
				<td width="138" align="right">ID:</td><td> <input type="text" name="IdEqu" id="IdEqu"  size="7" maxlength="7" value="<?php echo $idequ?>" readonly="true" ></td>
				<tr>
				<td width="138" align="right">Placa:</td><td> <input type="text" name="txtPlaca" id="txtPlaca"  size="7" maxlength="7" value="<?php echo $placa?>" ></td>
				<tr>
				<td width="138" align="right">Frota:</td><td> <input type="text" name="txtFrota" id="txtFrota"  size="5" maxlength="5" value="<?php echo $frota?>" ></td>
				<tr>
				<td width="138" align="right">Tipo:</td>
				<td>
					<input type="hidden" value="<?php echo $tipequ; ?>" name="equAnt" id="equAnt" size="7" />
					<select name="txtTipEqu" id="txtTipEqu" >
						<option value="<?php echo $tipequ?>" selected >"<?php echo $nomequ?>"</option>
					</select>
				</td>
				<tr>
				<td align="right">Posse:</td>
				<td><select name="txtPosse" id="txtPosse" >
						<option value="0"></option>
						<option value="1"<?=($posse=='1')?'selected':''?>>Cliente</option>
						<option value="2"<?=($posse=='2')?'selected':''?>>Fornecedor</option>
						<option value="3"<?=($posse=='3')?'selected':''?>>Particular</option>
						<option value="4"<?=($posse=='4')?'selected':''?>>LINAVE</option>
					</select>
				</td>
				<tr>
				<td width="138" align="right">Empresa:</td><td><input type="text" name="txtEmpresa" id="txtEmpresa"  size="15" maxlength="20" value="<?php echo $empequ?>" ></td>
				<tr>
				<td  align="right">Obs:</td>
				<td><input name="obs" type="text" id="obs" size="100" maxlength="100"  value="<?php echo $obs ?>" ></td>
				<tr>
				<td  align="right"><input type="button" value="Voltar" onClick="history.go(-1)" align="center"></td>
				<td align="center"><input  type="button" name="btnPessoa" value="Altera" onclick="getAlteraEqu();" ></td>
			</table>
			<div id="ResultadoEquipamento"> </div> 
        </div>
    </body>
</html>