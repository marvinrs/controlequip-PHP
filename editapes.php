<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Manutencao de Pessoas</title>
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
    <body bgcolor="#FFFFF0" >
        <script type="text/javascript" src="ajax.js" ></script>
		<?php 
			include("conexao.php");
			//Pega o parâmetro GET da página anterior ID do registro
			$idpes = $_GET ["idpes"];
			//consulta tabela pra saber os outros valores do registro
			$sql = mysqli_query($cx, "SELECT * FROM ZZ2 LEFT JOIN ZZ3 ON ZZ3_PLACA=ZZ2_PLACA WHERE ZZ2_IDPES='$idpes'");
			$aux = mysqli_fetch_assoc($sql);
			$nompes=$aux["ZZ2_NOMPES"];
			$tipdoc=$aux["ZZ2_TIPDOC"];
			$numdoc=$aux["ZZ2_NUMDOC"];
			$emppes=$aux["ZZ2_EMPPES"];
			$obs   =$aux["ZZ2_OBS"];
			$idequ =$aux["ZZ2_IDEQU"];
			$placa =$aux["ZZ2_PLACA"];
		?>

        <div id="Container">
		
			<h2><img src=img/logo.jpg>Manutenção de Pessoas</td>
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
			<table width="75%" border="0">
				<td width="138" align="right">ID:</td><td> <input type="text" name="IdPes" id="IdPes"  size="9" maxlength="9" value="<?php echo $idpes?>" readonly="true" ></td>
				<tr>
				<td width="138" align="right">Nome:</td><td> <input type="text" name="txtNomPes" id="txtNomPes"  size="40" maxlength="40" value="<?php echo $nompes?>" ></td>
				<tr>
				<td align="right">Tipo Doc:</td>
				<td><select name="txtTipDoc" id="txtTipDoc">
						<option value="0"></option>
						<option value="RG"<?=($tipdoc=='RG')?'selected':''?>>Carteira Identidade</option>
						<option value="CNH"<?=($tipdoc=='CNH')?'selected':''?>>Carteira Motorista</option>
						<option value="CTPS"<?=($tipdoc=='CTPS')?'selected':''?>>Carteira Trabalho</option>
						<option value="CRA"<?=($tipdoc=='CRA')?'selected':''?>>Cracha</option>
						<option value="CPF"<?=($tipdoc=='CPF')?'selected':''?>>CPF</option>
						<option value="CNPJ"<?=($tipdoc=='CNPJ')?'selected':''?>>CNPJ</option>
						<option value="OUT"<?=($tipdoc=='OUT')?'selected':''?>>Outros</option>
					</select>
				</td>
				<tr>
				<td width="138" align="right">Num Doc:</td><td> <input type="text" name="txtNumDoc" id="txtNumDoc"  size="20" maxlength="20" value="<?php echo $numdoc?>" ></td>
				<tr>
				<td width="138" align="right">Empresa:</td><td><input type="text" name="txtEmpPes" id="txtEmpPes"  size="15" maxlength="20" value="<?php echo $emppes?>" ></td>
				<tr>
				<td  align="right">Obs:</td><td><input name="obs" type="text" id="obs" size="50" maxlength="100"  value="<?php echo $obs ?>" ></td>
				<tr>
				<td  align="right">Equipamento:</td>
				<td width="138">
					Placa<input type="radio" value ="1" class="placaFrota" name="placaFrota" id="placaFrota1" checked /> 
					Frota<input type="radio" value ="2" class="placaFrota" name="placaFrota" id="placaFrota2" />
					<input type="text" name="txtEquipamento" id="txtEquipamento" class="pula" size="7" maxlength="7"/> 
					<input type="button" name="btnEquipamento" value=".." class="pula" onclick="getEquipamentoPes();"/>
					<input type="hidden" value ="1" class="overWrite" name="overWrite" id="radio1" checked />
					<select name="ResultadoEquipamento" id="ResultadoEquipamento" style="background: #B80000; color: #FFF;">
						<option value="<?php echo $idequ ?>"><?php echo $placa ?></option>"
					</select>
				</td>
				<tr>
				<td  align="right"><input type="button" value="Voltar" onClick="history.go(-1)" align="center"></td>
				<td align="center"><input  type="button" name="btnPessoa" value="Confimar Alterar" onclick="getAlteraPes();" ></td>
			</table>
			<div id="ResultadoPessoa"> </div> 
        </div>
    </body>
</html>