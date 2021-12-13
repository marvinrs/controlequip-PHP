	if (DataMov=="") {
		alert("Data Movimento e´campo obrigatorio");
		return false;
	}else{
		string += "DataMov="+DataMov;
	}
	if (nomepessoa==""){
		alert("Pessoa e´campo obrigatorio");
		return false;
	}else{
		string += "&pessoa="+nomepessoa;
	}
	if (hora==""){
		alert("Hora e´campo obrigatorio");
		return false;
	}else{
		string += "&hora="+hora;
	}
	if (finalidade==""){
		alert("finalidade e´campo obrigatorio");
		return false;
	}else{
		string += "&finalidade="+finalidade;
	}
	if (obs <>""){
		string += "&obs="+obs;
	}
	if (equipamento <>""){
		string += "&equipamento="+equipamento;
	}
	if (equipamento2 <>""){
		string += "&equipamento2="+equipamento2;
	}
	if (equipamento3 <>""){
		string += "&equipamento3="+equipamento3;
	}
	if (equipamento4 <>""){
		string += "&equipamento4="+equipamento4;
	}
