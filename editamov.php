<!DOCTYPE html>
<!--****
	Tela de alteração de movimento recebe via GET da pagina index. 
-->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Controle de Pessoas e Equipamentos</title>
		<style type="text/css">
		 
		</style>
	</head>
    <body bgcolor="#FFFFF0" onload='getTabEmbarc();'>
        <script type="text/javascript" src="ajax.js" ></script>
		<?php 
			include("conexao.php");
			//Pega os parâmetros da página anterior ID do registro
			$idmov = $_GET ["idmov"];
			//consulta tabela pra saber os outros valores do registro
			$sql = mysqli_query($cx, "SELECT * FROM ZZ4 LEFT JOIN ZZ2 ON ZZ2_IDPES=ZZ4_IDPES LEFT JOIN ZZ3 ON ZZ3_IDEQU=ZZ4_IDEQU WHERE ZZ4_IDMOV='$idmov'");
			$aux = mysqli_fetch_assoc($sql);
			$datmov=$aux["ZZ4_DATMOV"];
			$hormov=$aux["ZZ4_HORMOV"];
			$tipmov=$aux["ZZ4_TIPMOV"];
			$finali=$aux["ZZ4_FINALI"];
			$obs   =$aux["ZZ4_OBS"];
			$idpes =$aux["ZZ4_IDPES"];
			$idequ =$aux["ZZ4_IDEQU"];
			$nompes=$aux["ZZ2_NOMPES"];
			$placa =$aux["ZZ3_PLACA"];
			$embarc=$aux["ZZ4_EMBARC"];
			$desloc=$aux["ZZ4_DESLOC"];
		  // transforma a data do formato YYYYMMDD para YYYY-MM-DD para ser lido no campo tipo "date"
			$DAT_MOV_TRACO_1 = substr_replace($datmov, '-', 4, 0);
			$DAT_MOV_TRACO_2 = substr_replace($DAT_MOV_TRACO_1, '-', 7, 0);	  
		?>

        <div id="Container">
		
			<h2><img src=img/logo.jpg>Edição de Movimento</td>
			<input type="button" value="Voltar" onClick="history.go(-1)" align="center"></h2>
			<div id="PesquisarPessoa">
				<table width="100%" border="0">
					<td width="138" align="right">ID:</td><td><input type="text" name="txtIdMov" id="txtIdMov" value="<?php echo $idmov; ?>" size="7" maxlength="7" readonly="true"/></td>
					<td>  
					</td>
					<tr>
					<td width="138" align="right">Data Movimento:</td><td><input type="date" required="required" value="<?php echo $DAT_MOV_TRACO_2; ?>" maxlength="10" name="DataMov" id="DataMov" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}$" min="2012-01-01" max="2300-08-03" readonly="true"/></td>
					<tr>
					<td width="138" align="right">Hora:</td><td><input type="text" name="txthora" id="txthora" value="<?php echo $hormov; ?>" size="5" maxlength="5" placeholder="hh:mm" readonly="true"/></td>
					<tr/> 
					<td width="138" align="right">Tipo Movimento:</td><td>
						<select name="TipMov" id="TipMov" readonly="true" >
							<option value="1"<?=($tipmov=='1')?'selected':''?>>Chegada</option>
							<option value="2"<?=($tipmov=='2')?'selected':''?>>Saida</option>
						</select>
					</td>
					<tr>
					<td width="138" align="right">Pessoa:</td>
					<td><input type="text" name="txtnome" id="txtnome"/>
						<input type="button" name="btnPessoa" value=".." onclick="getPessoaPes();"/>
						<select name="ResultadoPessoa" id="ResultadoPessoa" value="<?php echo $idpes; ?>" style="background: #831d1c; color: #FFF;">
							<option value="<?php echo $idpes; ?>"><?php echo $nompes; ?></option>"
						</select>
					</td>
					<input type="hidden" name="IdPesAnt" id="IdPesAnt" value="<?php echo $idpes; ?>"/>
					<tr>
					<td width="138" align="right">Equipamento:</td>
					<td style="font-size:12px" width="138">
						Placa<input type="radio" value ="1" class="placaFrota" name="placaFrota" id="placaFrota1" checked /> 
						Frota<input type="radio" value ="2" class="placaFrota" name="placaFrota" id="placaFrota2" />
						<input type="hidden" name="IdEquAnt" id="IdEquAnt" value="<?php echo $idequ; ?>"/>
						<input type="text" name="txtEquipamento" id="txtEquipamento" size="7" maxlength="7" pattern="\s*(\S\s*){6,}"/> 
						<input type="button" name="btnEquipamento" value=".." onclick="getEquipamentoPes();"/>
						<input type="radio" value ="1" class="overWrite" name="overWrite" id="radio1" onclick="getLimpaPlaca()" checked />
						<select name="ResultadoEquipamento" id="ResultadoEquipamento" value="<?php echo $idequ; ?>" style="background: #831d1c; color: #FFF;">
							<option value="<?php echo $idequ; ?>"><?php echo $placa; ?></option>"
						</select>
					</td>
					<tr>
					<td width="138" align="right">Finalidade:</td><td>
						<select name="finalidade" id="finalidade">
							<option value="0"<?=($finali=='0')?'selected':''?>></option>
							<option value="1"<?=($finali=='1')?'selected':''?>>A Servico</option>
							<option value="2"<?=($finali=='2')?'selected':''?>>Desembarque</option>
							<option value="3"<?=($finali=='3')?'selected':''?>>Embarque</option>
							<option value="4"<?=($finali=='4')?'selected':''?>>Entrega</option>
							<option value="5"<?=($finali=='5')?'selected':''?>>Retirada</option>
							<option value="6"<?=($finali=='6')?'selected':''?>>Visita</option>
						</select>
					</td>
					<tr>
					<td width="138" align="right">
						Embarcacao:<input type="hidden" value="<?php echo $embarc; ?>" name="embarc" id="embarc" size="7" />			
					</td>
					<td> <div id="ResultadoEmbarcacao"></div> </td>
					<tr>
					<td width="138" align="right">Origem/destino:</td><td>
						<select name="deslocamento" id="deslocamento">
							<option value="0"<?=($desloc=='0')?'selected':''?>></option>
							<option value="1"<?=($desloc=='1')?'selected':''?>>Belem</option>
							<option value="2"<?=($desloc=='2')?'selected':''?>>Manaus</option>
							<option value="3"<?=($desloc=='3')?'selected':''?>>Santarem</option>
							<option value="4"<?=($desloc=='4')?'selected':''?>>Trombetas</option>
							<option value="5"<?=($desloc=='5')?'selected':''?>>Cliente</option>
							<option value="6"<?=($desloc=='6')?'selected':''?>>Fornecedor</option>
							<option value="7"<?=($desloc=='7')?'selected':''?>>Outros</option>
						</select>
					</td>
					<tr>
					<td width="138" align="right">Observação:</td><td><input name="obs" type="text" id="obs" value="<?php echo $obs; ?>" size="100" maxlength="100" /></td>
					<tr>
					<td></td>
					<td align="center"><input type="button" name="btnMovimento" value="Confirmar Alterar" onclick="getAlteraMov();"/></td>
				</table>
			</div>
		</div>
		<div id="ResultadoMovimento"> </div> 
	</body>
</html>