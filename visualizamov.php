<!DOCTYPE html>
<!--****
	Tela de alteração de movimento recebe via GET da pagina index. 
-->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Controle de Pessoas e Equipamentos - visualizacao de movimento</title>
<style type="text/css">
 
</style>
	</head>
    <body bgcolor="#FFFFF0" onload='getIniciaEditaMov()'>
        <script type="text/javascript" src="ajax.js" ></script>
		<?php 
			include("verifica.php");
			include("conexao.php");
			//Pega os parâmetros da página anterior ID do registro
			$idmov = $_GET ["idmov"];
			//consulta tabela pra saber os outros valores do registro
			$sql = mysqli_query($cx, "SELECT * FROM ZZ4 LEFT JOIN ZZ2 ON ZZ2_IDPES=ZZ4_IDPES LEFT JOIN ZZ3 ON ZZ3_IDEQU=ZZ4_IDEQU WHERE ZZ4_IDMOV='$idmov'");
			$aux = mysqli_fetch_assoc($sql);
			$filial=$aux["ZZ4_FILIAL"];
			$portal=$aux["ZZ4_PORTAL"];
			$datmov=$aux["ZZ4_DATMOV"];
			$hormov=$aux["ZZ4_HORMOV"];
			$tipmov=$aux["ZZ4_TIPMOV"];
			$finali=$aux["ZZ4_FINALI"];
			$obs   =$aux["ZZ4_OBS"];
			$idpes =$aux["ZZ4_IDPES"];
			$nompes=$aux["ZZ2_NOMPES"];
			$tipdoc=$aux["ZZ2_TIPDOC"];
			$numdoc=$aux["ZZ2_NUMDOC"];
			$emppes=$aux["ZZ2_EMPPES"];
			$idequ =$aux["ZZ3_IDEQU"];
			$placa =$aux["ZZ3_PLACA"];
			$frota =$aux["ZZ3_FROTA"];
			$empequ=$aux["ZZ3_EMPEQU"];
			$posse =$aux["ZZ3_POSSE"];
			$tipequ=$aux["ZZ3_TIPEQU"];
			$embarc=$aux["ZZ4_EMBARC"];
			$desloc=$aux["ZZ4_DESLOC"];
			// monta descricao do tipo de movimento a partir do codigo
			if ($tipmov == '1') {
				$nometipmov = "Chegada";
			}else if ($tipmov == '2') {
				$nometipmov = "Saida";
			}else{
				$nometipmov = "";
			}
			// monta descricao da finalidade a partir do codigo
			if ($finali == '1') {
				$nomefinali = "A servico";
			} else if ($finali == '2') {
				$nomefinali = "Desembarque";
			} else if ($finali == '3') {
				$nomefinali = "Embarque";
			} else if ($finali == '4') {
				$nomefinali = "Entrega";
			} else if ($finali == '5') {
				$nomefinali = "Retirada";
			} else if ($finali == '6') {
				$nomefinali = "Visita";
			} else {
				$nomefinali = "";
			}
			// monta descricao do deslocamento a partir do codigo
			if ($desloc == '1') {
				$nomedesloc = "Belem";
			}else if ($desloc == '2') {
				$nomedesloc = "Manaus";
			}else if ($desloc == '3') {
				$nomedesloc = "Santarem";
			}else if ($desloc == '4') {
				$nomedesloc = "Trombetas";
			}else if ($desloc == '5') {
				$nomedesloc = "Cliente";
			}else if ($desloc == '6') {
				$nomedesloc = "Fornecedor";
			}else if ($desloc == '7') {
				$nomedesloc = "Outros";
			}else{
				$nomedesloc = "";
			}
			// monta descricao da posse a partir do codigo
			if ($posse == '1') {
				$nomeposse = "Cliente";
			}else if ($posse == '2') {
				$nomeposse = "Fornecedor";
			}else if ($posse == '3') {
				$nomeposse = "Particular";
			}else if ($posse == '4') {
				$nomeposse = "LINAVE";
			}else{
				$nomeposse = "";
			}
			// transforma a data do formato YYYYMMDD para YYYY-MM-DD para ser lido no campo tipo "date"
			$DAT_MOV_TRACO_1 = substr_replace($datmov, '-', 4, 0);;
			$DAT_MOV_TRACO_2 = substr_replace($DAT_MOV_TRACO_1, '-', 7, 0);;	  
		?>

        <div id="Container">
		
			<h2><img src=img/logo.jpg>Visualização de Movimento
				<input type="button" value="Voltar" onClick="history.go(-1)" align="center">
			</h2>
			<div id="VisualizaMovimento">
				<table width="75%" border="2">
					<td style="font-size:12px" width="5%">ID:</td><td><input type="text" name="txtIdMov" id="txtIdMov" value="<?php echo $idmov; ?>" size="7" maxlength="7" readonly="true"/></td>
					<tr/> 
					<td style="font-size:12px" width="5%">Filial:</td><td>	<input type="text" name="txtfilial" id="txtfilial" value="<?php echo $filial; ?>" size="4" maxlength="4" readonly="true"/></td>
					<tr/> 
					<td style="font-size:12px" width="5%">Portal:</td><td>	<input type="text" name="txtportal" id="txtportal" value="<?php echo $portal; ?>" size="1" maxlength="1" readonly="true"/></td>
					<tr>
					<td style="font-size:12px" width="5%">Data Mov:</td><td><input type="date" required="required" value="<?php echo $DAT_MOV_TRACO_2; ?>" maxlength="10" name="DataMov" id="DataMov" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}$" min="2012-01-01" max="2300-08-03" readonly="true"/></td>
					<tr>
					<td style="font-size:12px" width="5%">Hora:</td><td>	<input type="text" name="txthora" id="txthora" value="<?php echo $hormov; ?>" size="5" maxlength="5" placeholder="hh:mm" readonly="true"/></td>
					<tr/> 
					<td style="font-size:12px" width="5%">Tipo Mov:</td><td>	<input type="text" name="NomeTipMov" id="NomeTipMov" value="<?php echo $nometipmov; ?> " size="20" maxlength="20"></td>
					<tr>
					<td style="font-size:12px" width="5%">Pessoa:</td><td><input type="text" name="Pessoa" id="Pessoa" value="<?php echo $nompes;?>" readonly="true" size="40" maxlength="40"></td>	
					<tr>
					<td style="font-size:12px" width="5%">Tipo Doc:</td><td><input type="text" name="TipDoc" id="TipDoc" value="<?php echo $tipdoc;?>" readonly="true" size="20" maxlength="20"></td>
					<tr>
					<td style="font-size:12px" width="5%">Num Doc:</td><td><input type="text" name="NumDoc" id="NumDoc" value="<?php echo $numdoc;?>" readonly="true" size="30" maxlength="30"></td>
					<tr>
					<td style="font-size:12px" width="5%">Empresa:</td><td><input type="text" name="EmpPes" id="EmpPes" value="<?php echo $emppes;?>" readonly="true" size="30" maxlength="30"></td>
					<tr>
					<td style="font-size:12px" width="5%">Placa:</td><td><input type="text" name="Placa" id="Placa" value="<?php echo $placa;?>" readonly="true" size="7" maxlength="7"></td>
					<tr>
					<td style="font-size:12px" width="5%">Frota:</td><td><input type="text" name="Frota" id="Frota" value="<?php echo $frota;?>" readonly="true" size="6" maxlength="6"></td>
					<tr>
					<td style="font-size:12px" width="5%">Empr Equipam:</td><td><input type="text" name="EmpEqu" id="EmpEqu" value="<?php echo $empequ;?>" readonly="true" size="30" maxlength="30"></td>
					<tr>
					<td style="font-size:12px" width="5%">Posse equipam:</td><td><input type="text" name="NomePosse" id="NomePosse" value="<?php echo $nomeposse;?>" readonly="true" size="20" maxlength="20"></td>
					<tr>
					<td style="font-size:12px" width="5%">Tipo Equipam:</td><td><input type="text" name="TipEqu" id="TipEqu" value="<?php echo $tipequ;?>" readonly="true" size="6" maxlength="6"></td>
					<tr>
					<td style="font-size:12px" width="5%">Finalidade:</td><td><input name="finalidade" id="finalidade" value="<?php echo $nomefinali; ?>" readonly="true" size="30" maxlength="30"></td>
					<tr>
					<td style="font-size:12px" width="5%">Embarcacao:</td><td><input name="embarcacao" id="embarcacao" value="<?php echo $embarc; ?>" readonly="true" size="30" maxlength="30"></td>
					<tr>
					<td style="font-size:12px" width="5%">Origem/destino::</td><td><input name="finalidade" id="finalidade" value="<?php echo $nomedesloc; ?>" readonly="true" size="30" maxlength="30"></td>
					<tr>
					<td style="font-size:12px" width="5%">Observações:</td><td><input name="obs" type="text" id="obs" value="<?php echo $obs; ?>" size="100" maxlength="100" /> <span class="style1" readonly="true">*</span></td>
				</table>
			</div>
 		</div>
	</body>
</html>