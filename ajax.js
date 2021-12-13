/**
  * Função para criar um objeto XMLHTTPRequest
  */
 function CriaRequest() {
     try{
         request = new XMLHttpRequest();        
     }catch (IEAtual){
          
         try{
             request = new ActiveXObject("Msxml2.XMLHTTP");       
         }catch(IEAntigo){
          
             try{
                 request = new ActiveXObject("Microsoft.XMLHTTP");          
             }catch(falha){
                 request = false;
             }
         }
     }
      
     if (!request) 
         alert("Seu Navegador não suporta Ajax!");
     else
         return request;
 }
  
/**
 * Função para iniciar os valores da movimentacao
 */
 function getvaloresIniciaisMov() {
	// transforma data atual para o formato AAAA-MM-DD
	var data = new Date();
	var dia =data.getDate();
	var mes =data.getMonth()+1;
	var ano = data.getFullYear();
	var datahoje = ''
    var result = document.getElementById("ResultadoMovimento");
    var xmlreq = CriaRequest();
	// transforma o formato da data atual do php para o formato AAAAMMDD
	if (dia < 10) {
		dia = '0'+dia;
	}
	if (mes < 10) {
		mes ='0' + mes;
	}
	datahoje = ano+'-'+mes+'-'+dia;

      
    // Exibi a imagem de progresso
    result.innerHTML = '<img src="img/ajax_clock_small.gif"/>';
     
    // Iniciar uma requisição
    xmlreq.open("GET", "movimento.php?DataMov=" + datahoje, true);
     
    // Atribui uma função para ser executada sempre que houver uma mudança de ado
    xmlreq.onreadystatechange = function(){
         
		// Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
        if (xmlreq.readyState == 4) {
             
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                 result.innerHTML = xmlreq.responseText;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
        }
	};
	xmlreq.send(null);
	
	document.getElementById("DataMov").value=datahoje;
	document.getElementById("txthora").focus();
	
 }

 
 /**
 * Função gera lista de pessoas para consulta
 */
 function getPessoa() {

	// Declaração de Variáveis
     var nome   = document.getElementById("txtnome").value;
     var result = document.getElementById("ResultadoPessoa");
     if (nome == ""){
		alert("Informe nome para pesquisa");
		document.getElementById("txtnome").focus();
		return false;
	 } 
     var xmlreq = CriaRequest();
     // Exibi a imagem de progresso
     result.innerHTML = '<img src="img/ajax_clock_small.gif"/>';
      
     // Iniciar uma requisição
     xmlreq.open("GET", "pessoa.php?pessoa=" + nome, true);
      
     // Atribui uma função para ser executada sempre que houver uma mudança de ado
     xmlreq.onreadystatechange = function(){
          
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
              
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                 result.innerHTML = xmlreq.responseText;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
     xmlreq.send(null);
 }

 
 /**
 * Função para enviar os dados pessoa para a movimentacao
 */
 function getPessoaPes() {
      
     // Declaração de Variáveis
     var nome   = document.getElementById("txtnome").value;
     var result = document.getElementById("ResultadoPessoa");
     var xmlreq = CriaRequest();
      
     // Exibi a imagem de progresso
     result.innerHTML = '<img src="img/ajax_clock_small.gif"/>';
     if (nome == ""){
		alert("Informe nome para pesquisa");
		document.getElementById("txtnome").focus();
		return false;
	 } 
     // Iniciar uma requisição
     xmlreq.open("GET", "pessoapes.php?txtnome=" + nome, true);
      
     // Atribui uma função para ser executada sempre que houver uma mudança de ado
     xmlreq.onreadystatechange = function(){
          
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
              
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                 result.innerHTML = xmlreq.responseText;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
     xmlreq.send(null);
 }
 
/**
 * Função que pesquisa placa/frota na tabela equipamento para o movimento
 */
 function getEquipamentoPes() {
	// Declaração de Variáveis 
	if (document.getElementById("ResultadoPessoa").value) {
		pessoa = document.getElementById("ResultadoPessoa").value;
	}else{
		pessoa = "";
	}
	
	var nome   = document.getElementById("txtEquipamento").value;
	var flag   = document.getElementById("placaFrota1").checked;

	//Verifica se a pesquisa do equipamento é por placa (flag=1) ou por frota (flag=2).
	if (flag) {placafrota="PLACA";}
	else {placafrota="FROTA";}
	
	// critica o preeenchimento dos campos da tela
/*    if (nome == ""){
		alert("Informe o equipamento para pesquisa");
		document.getElementById("txtEquipamento").focus();
		return false;
	} */ 

	// A variavel (seq) aponta a sequencia das placas para inclusao
	if (document.getElementById("radio1").checked) {
		var result = document.getElementById("ResultadoEquipamento");
		seq = "1";
	}else if (document.getElementById("radio2").checked) {
		var result = document.getElementById("ResultadoEquipamento2");
		seq = "2";
	}else if (document.getElementById("radio3").checked){
		var result = document.getElementById("ResultadoEquipamento3");
		seq = "3";
	}else if (document.getElementById("radio4").checked){
		var result = document.getElementById("ResultadoEquipamento4");
		seq = "4";
	}
    var xmlreq = CriaRequest();
      
    // Exibi a imagem de progresso
    result.innerHTML = '<img src="img/ajax_clock_small.gif"/>';
    // Iniciar uma requisição
    xmlreq.open("GET", "equipamentopes.php?txtEquipamento=" + nome + "&placafrota=" + placafrota + "&seq=" + seq + "&pessoa=" + pessoa, true);
      
    // Atribui uma função para ser executada sempre que houver uma mudança de ado
    xmlreq.onreadystatechange = function(){
          
        // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
		if (xmlreq.readyState == 4) {
              
			// Verifica se o arquivo foi encontrado com sucesso
			if (xmlreq.status == 200) {
				result.innerHTML = xmlreq.responseText;
			}else{
				result.innerHTML = "Erro: " + xmlreq.statusText;
			}
         }
    };
    xmlreq.send(null);
	if (seq == "1") {
		document.getElementById("radio2").checked=true;  
	}
	if (seq == "2") {
		document.getElementById("radio3").checked=true;  
	}
	if (seq == "3") {
		document.getElementById("radio4").checked=true;  
	}
	if (seq == "4") {
		document.getElementById("radio1").checked=true;  
	}
 }
 
/**
 * Função para Listar os dados do Movimento de acordo com data
 */
 function getMovimento() {
      
     // Declaração de Variáveis
	var nome   = document.getElementById("DataMov").value;
    var result = document.getElementById("ResultadoMovimento");
    var xmlreq = CriaRequest();
      
    // Exibi a imagem de progresso
    result.innerHTML = '<img src="img/ajax_clock_small.gif"/>';
     
    // Iniciar uma requisição
    xmlreq.open("GET", "movimento.php?DataMov=" + nome, true);
     
    // Atribui uma função para ser executada sempre que houver uma mudança de ado
    xmlreq.onreadystatechange = function(){
         
		// Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
        if (xmlreq.readyState == 4) {
             
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                 result.innerHTML = xmlreq.responseText;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
        }
	};
	xmlreq.send(null);
 }
 
 
/**
 * Função para Incluir Movimento
 */
 function getIncluiMov() {
     // Declaração de Variáveis
	var filial		= document.getElementById("txtfilial").value;
	var portal		= document.getElementById("txtportal").value;
	var DataMov		= document.getElementById("DataMov").value;
	var tipmov		= document.getElementById("TipMov").value;
    var nomepessoa	= document.getElementById("ResultadoPessoa").value;
	var equipamento	= document.getElementById("ResultadoEquipamento").value;	   
	var equipamento2= document.getElementById("ResultadoEquipamento2").value;	   
	var equipamento3= document.getElementById("ResultadoEquipamento3").value;	   
	var equipamento4= document.getElementById("ResultadoEquipamento4").value;	   
	var hora		= document.getElementById("txthora").value;	   
	if (portal == '1'){
		var finalidade	= document.getElementById("finalidade").value;	   
		var embarcacao	= "0";	   
		var deslocamento= "0";	   
	}else{
		var embarcacao	= document.getElementById("embarcacao").value;	   
		var deslocamento= document.getElementById("deslocamento").value;	   
		var finalidade	= "0";	   
	}
	var obs			= document.getElementById("obs").value;	   
 	
	var result		= document.getElementById("ResultadoMovimento");
	var xmlreq		= CriaRequest();

	var a		="";
	if (DataMov=="") {
		alert("Data Movimento e´obrigatorio");
		return false;}
	if (hora==""){
		alert("Hora e´ obrigatoria");
		return false;}
	if (tipmov=="0"){
		alert("Tipo Movimento e´obrigatorio");
		return false;}
	if (nomepessoa==""){
		alert("Pessoa e´obrigatorio");
		return false;}
	if (finalidade=='0' && portal == '1'){
		alert("finalidade e´ obrigatoria");
		return false;}
	a  = "filial="+filial+"&portal="+portal+"&tipmov=" + tipmov + "&DataMov=" + DataMov + "&pessoa=" + nomepessoa + "&hora=" + hora + "&finalidade=" + finalidade;
	a += "&embarcacao="+embarcacao+"&deslocamento="+deslocamento+"&obs="+obs;
//	alert(a);
	if (equipamento !== "") {
		a +=  "&equipamento=" + equipamento; }
	if (equipamento2 !== "") {
		a += "&equipamento2=" + equipamento2; }
	if (equipamento3 !== "") {
		a += "&equipamento3=" + equipamento3; }
	if (equipamento4 !== "") {
		a += "&equipamento4=" + equipamento4; }
    // Exibi a imagem de progresso
    result.innerHTML = '<img src="img/ajax_clock_small.gif"/>';
     
    // Iniciar uma requisição
    xmlreq.open("GET", "incluimov.php?" + a, true);
     
    // Atribui uma função para ser executada sempre que houver uma mudança de ado
    xmlreq.onreadystatechange = function(){
         
		// Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
        if (xmlreq.readyState == 4) {
             
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                 result.innerHTML = xmlreq.responseText;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
	};
	xmlreq.send(null);
	document.getElementById("txtnome").value='';  
	document.getElementById("txtEquipamento").value='';  
	document.getElementById("radio1").checked=true;  
	document.getElementById("ResultadoPessoa").value='';
	document.getElementById("ResultadoEquipamento").value='';	   
	document.getElementById("ResultadoEquipamento2").value='';	   
	document.getElementById("ResultadoEquipamento3").value='';	   
	document.getElementById("ResultadoEquipamento4").value='';	   
	if (portal=='1'){
		document.getElementById("TipMov").value='0';
		document.getElementById("txthora").value='';	   
		document.getElementById("finalidade").value='0';	   
		document.getElementById("obs").value='';	   
		document.getElementById("txthora").focus();	   
	}else{
		document.getElementById("txtnome").focus();	   
	}
 }
 
/**
 * Função para Incluir Pessoa
 */
 function getIncluiPes() {
     // Declaração de Variáveis entrada
	var pessoa		= document.getElementById("txtPessoa").value;
	var tipdoc		= document.getElementById("txtTipDoc").value;
	var numdoc		= document.getElementById("txtNumDoc").value;
	var equipamento	= document.getElementById("ResultadoEquipamento").value;	   
	var emppes		= document.getElementById("txtEmpresa").value;	   
	var obs			= document.getElementById("obs").value;	   
	var result		= document.getElementById("ResultadoPessoa");
	var xmlreq		= CriaRequest();

	var a		="";
	if (pessoa==""){
		alert("Nome da Pessoa e´obrigatorio");
		return false;}
	if (tipdoc=="0"){
		alert("Tipo de documento e´obrigatorio");
		return false;}
	if (numdoc=="") {
		alert("Numero do documento e´obrigatorio");
		return false;}
	if (emppes==""){
		alert("Empresa da pessoa e´ obrigatoria");
		return false;}
	a = "tipdoc=" + tipdoc + "&numdoc=" + numdoc + "&pessoa=" + pessoa + "&emppes=" + emppes;
	a += "&obs=" + obs;
 	if (equipamento !== "") {
		a +=  "&equipamento=" + equipamento; }
//	alert(a);
   // Exibi a imagem de progresso
    result.innerHTML = '<img src="img/ajax_clock_small.gif"/>';
     
    // Iniciar uma requisição
    xmlreq.open("GET", "incluipes.php?" + a, true);
     
    // Atribui uma função para ser executada sempre que houver uma mudança de ado
    xmlreq.onreadystatechange = function(){
         
		// Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
        if (xmlreq.readyState == 4) {
             
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                 result.innerHTML = xmlreq.responseText;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
	};
	xmlreq.send(null);
//	document.getElementById("txtnome").value='';  
//	document.getElementById("txtEquipamento").value='';  
//	document.getElementById("radio1").visibility=false;  
//	document.getElementById("txtTipDoc").value='0';
//	document.getElementById("ResultadoEquipamento").value='';	   
//	document.getElementById("txtNumDoc").value='';	   
//	document.getElementById("txtEmpresa").value='';	   
//	document.getElementById("obs").value='';	   
//	document.getElementById("txtnome").focus();	   
 }
 

/**
 * Função gera lista de equipamentos
 */
 function getEquipamento() {

	// Declaração de Variáveis
    var equipamento	= document.getElementById("txtEquipamento").value;
    var result = document.getElementById("ResultadoEquipamento");
	//Verifica se a pesquisa do equipamento é por placa (flag=1) ou por frota (flag=2).
	if (document.getElementById("placaFrota1").checked) 	{placafrota="PLACA";}
	else if (document.getElementById("placaFrota2").checked){placafrota="FROTA";}
	else if (document.getElementById("placaFrota3").checked){placafrota="EMPEQU";}
	else if (document.getElementById("placaFrota4").checked){placafrota="POSSE";}
	//Critica o campo de pesquisa equipamento
    if (equipamento == ""){
		alert("Informe o equipamento para pesquisa");
		document.getElementById("txtEquipamento").focus();
		return false;
		} 

     var xmlreq = CriaRequest();
     // Exibi a imagem de progresso
     result.innerHTML = '<img src="img/ajax_clock_small.gif"/>';
     // Iniciar uma requisição
     xmlreq.open("GET", "equipamento.php?equipamento=" + equipamento + "&placafrota=" + placafrota, true);
      
     // Atribui uma função para ser executada sempre que houver uma mudança de ado
     xmlreq.onreadystatechange = function(){
          
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
              
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                 result.innerHTML = xmlreq.responseText;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
     xmlreq.send(null);
 }
 
/**
 * Função para Incluir Equipamento
 */
 function getIncluiEqu() {
     // Declaração de Variáveis entrada
	var placa		= document.getElementById("txtPlaca").value;
	var frota		= document.getElementById("txtFrota").value;
	var tipequ		= document.getElementById("txtTipEqu").value;
	var posse		= document.getElementById("txtPosse").value;	   
	var empequ		= document.getElementById("txtEmpresa").value;	   
	var obs			= document.getElementById("obs").value;	   
	var result		= document.getElementById("ResultadoEquipamento");
	var xmlreq		= CriaRequest();

	var a ="";
	if (placa==""){
		alert("Placa do equipamento e´obrigatorio");
		return false;}
	if (placa.length!==7){
		alert("Placa do equipamento 7 caracteres obrigatorios");
		return false;}
	if (tipequ=="0"){
		alert("Tipo equipamento e´obrigatorio");
		return false;}
	if (posse=="0"){
		alert("Posse é obrigatoria, quando for da nossa frota, selecionar LINAVE");
		return false;}
	a = "placa=" + placa + "&frota=" + frota + "&tipequ=" + tipequ + "&posse=" + posse + "&empequ=" + empequ;
	a += "&obs=" + obs;

	// Exibi a imagem de progresso
    result.innerHTML = '<img src="img/ajax_clock_small.gif"/>';
     
    // Iniciar uma requisição
    xmlreq.open("GET", "incluiequ.php?" + a, true);
     
    // Atribui uma função para ser executada sempre que houver uma mudança de ado
    xmlreq.onreadystatechange = function(){
         
		// Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
		if (xmlreq.readyState == 4) {
             
             // Verifica se o arquivo foi encontrado com sucesso
			if (xmlreq.status == 200) {
				result.innerHTML = xmlreq.responseText;
			}else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
			}
		}
	};
	xmlreq.send(null);
	document.getElementById("txtPlaca").value='';  
	document.getElementById("txtFrota").value='';  
	document.getElementById("txtTipEqu").value='CSC';  
	document.getElementById("txtPosse").value='0';
	document.getElementById("txtEmpresa").value='';	   
	document.getElementById("obs").value='';	   
	document.getElementById("txtplaca").focus();	   
 }
 
/**
 * Função Inicia Edita de Movimento carrega dados da tabela ZZ7-tipo de equipamento
 */
 function getIniciaEqu() {

	// Declaração de Variáveis

	// Verifica o campo embarc se vem da pagina editamov para cair elect da tabela de embarcacoes
	if (document.getElementById("equAnt")) {
		var equAnt = document.getElementById("equAnt").value;
	} else {
		var equAnt = '';
	}
	var result = document.getElementById("txtTipEqu");
	var xmlreq = CriaRequest();
	// Exibi a imagem de progresso
	result.innerHTML = '<img src="img/ajax_clock_small.gif"/>';
      
	// Iniciar uma requisição
	a = "?equAnt=" + equAnt;
	xmlreq.open("GET", "iniciaequ.php" + a, true);
      
	// Atribui uma função para ser executada sempre que houver uma mudança de ado
	xmlreq.onreadystatechange = function(){
          
		// Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
		if (xmlreq.readyState == 4) {
              
			// Verifica se o arquivo foi encontrado com sucesso
			if (xmlreq.status == 200) {
				result.innerHTML = xmlreq.responseText;
			}else{
				result.innerHTML = "Erro: " + xmlreq.statusText;
			}
		}
	};
	xmlreq.send(null);
 }


 
/**
 * Função Altera Equipamento
 */
 function getAlteraEqu() {

	// Declaração de Variáveis
	var idequ	= document.getElementById("IdEqu").value;
	var placa	= document.getElementById("txtPlaca").value;
	var frota	= document.getElementById("txtFrota").value;
	var tipequ	= document.getElementById("txtTipEqu").value;
	var posse	= document.getElementById("txtPosse").value;
	var empequ	= document.getElementById("txtEmpresa").value;
	var obs		= document.getElementById("obs").value;

	var result	= document.getElementById("ResultadoEquipamento");
	var xmlreq	= CriaRequest();
	// Exibi a imagem de progresso
	result.innerHTML = '<img src="img/ajax_clock_small.gif"/>';
    a = "?id="+idequ+"&placa="+placa+"&frota="+frota+"&tipequ="+tipequ+"&posse="+posse+"&empequ="+empequ+"&obs="+obs;
//	alert(a);  
	// Iniciar uma requisição
	xmlreq.open("GET", "alteraequ.php" + a, true);
      
	// Atribui uma função para ser executada sempre que houver uma mudança de ado
	xmlreq.onreadystatechange = function(){
          
		// Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
		if (xmlreq.readyState == 4) {
              
			// Verifica se o arquivo foi encontrado com sucesso
			if (xmlreq.status == 200) {
				result.innerHTML = xmlreq.responseText;
			}else{
				result.innerHTML = "Erro: " + xmlreq.statusText;
			}
		}
	};
	xmlreq.send(null);
 }

/**
 * Função Altera de Movimento
 */
 function getAlteraMov() {

	// Declaração de Variáveis
	var idmov	= document.getElementById("txtIdMov").value;
	var tipmov	= document.getElementById("TipMov").value;
	var pessoa	= document.getElementById("ResultadoPessoa").value;
	var placa	= document.getElementById("ResultadoEquipamento").value;
	var finali	= document.getElementById("finalidade").value;
	if (document.getElementById("embarcacao")) {
		var embarcacao	= document.getElementById("embarcacao").value;
	}else{
		var embarcacao	= '0';
	}
	if (document.getElementById("deslocamento")) {
	var deslocamento	= document.getElementById("deslocamento").value;
	}else{
		var deslocamento	= '0';
	}
	var obs 	= document.getElementById("obs").value;
	var pessoant= document.getElementById("IdPesAnt").value;
	var placant = document.getElementById("IdEquAnt").value;

	var result	= document.getElementById("ResultadoMovimento");
	var xmlreq	= CriaRequest();
	// Exibi a imagem de progresso
	result.innerHTML = '<img src="img/ajax_clock_small.gif"/>';
    a  = "?id="+idmov+"&tipmov="+tipmov+"&pessoa="+pessoa+"&placa="+placa+"&finali="+finali+"&obs="+obs+"&pessoant="+pessoant+"&placant="+placant;
	a += "&embarcacao="+embarcacao+"&deslocamento="+deslocamento;
//	alert(a);  
	// Iniciar uma requisição
	xmlreq.open("GET", "alteramov.php" + a, true);
      
	// Atribui uma função para ser executada sempre que houver uma mudança de ado
	xmlreq.onreadystatechange = function(){
          
		// Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
		if (xmlreq.readyState == 4) {
              
			// Verifica se o arquivo foi encontrado com sucesso
			if (xmlreq.status == 200) {
				result.innerHTML = xmlreq.responseText;
			}else{
				result.innerHTML = "Erro: " + xmlreq.statusText;
			}
		}
	};
	xmlreq.send(null);
 }
 
 /**
 * Função Altera Pessoa
 */
 function getAlteraPes() {

	// Declaração de Variáveis
	var idpes  	= document.getElementById("IdPes").value;
	var nompes 	= document.getElementById("txtNomPes").value;
	var tipdoc	= document.getElementById("txtTipDoc").value;
	var numdoc  = document.getElementById("txtNumDoc").value;
	var emppes  = document.getElementById("txtEmpPes").value;
	var obs    	= document.getElementById("obs").value;
	var idequ	= document.getElementById("ResultadoEquipamento").value;
	var result = document.getElementById("ResultadoPessoa");
	var xmlreq = CriaRequest();
	// Exibi a imagem de progresso
	result.innerHTML = '<img src="img/ajax_clock_small.gif"/>';
    a = "?id="+idpes+"&nompes="+nompes+"&tipdoc="+tipdoc+"&numdoc="+numdoc+"&emppes="+emppes+"&obs="+obs+"&idequ="+idequ;
//	alert(a);  
	// Iniciar uma requisição
	xmlreq.open("GET", "alterapes.php" + a, true);
      
	// Atribui uma função para ser executada sempre que houver uma mudança de ado
	xmlreq.onreadystatechange = function(){
          
		// Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
		if (xmlreq.readyState == 4) {
              
			// Verifica se o arquivo foi encontrado com sucesso
			if (xmlreq.status == 200) {
				result.innerHTML = xmlreq.responseText;
			}else{
				result.innerHTML = "Erro: " + xmlreq.statusText;
			}
		}
	};
	xmlreq.send(null);
 }

/**
 * Função testa hora e minuto do movimento
 */
 function getHora() {
	// transforma hora acrescentando o campo
	var flag ="0";
    var hora = document.getElementById("txthora").value;
	if (hora.length != 5) {
		result  ="informe a hora e minuto com quatro digitos";
		flag="1";
	}
	if (hora.substring(0,2) > 23) {
		result  ="hora invalida";
		flag="1";
	}
	if (hora.substring(3,5) > 60) {
		result +=" minuto invalido";
		flag="1";
	}
	if (flag =="1") {
		alert(result);
		document.getElementById("txthora").focus();
	}
 }

/**
 * Função para Lista os dados do Rastreamento de acordo com os parametros informados
 */
 function getRastreamento() {
      
    // Declaração de Variáveis
	var dataini = document.getElementById("dataini").value;
	var datafim = document.getElementById("datafim").value;
	var posse   = document.getElementById("posse").value;
	var equipa2 = document.getElementById("equipamento2");
	var equipa3 = document.getElementById("equipamento3");
	var equipamento= document.getElementById("txtEquipamento").value;
	var radio2  = document.getElementById("radio2");
	var radio3  = document.getElementById("radio3");
	var radio4  = document.getElementById("radio4");
	var pessoa  = document.getElementById("txtPessoa").value;
    var result  = document.getElementById("ResultadoRastreamento");
    var xmlreq  = CriaRequest();
    var a = "";

	// Verifica se o periodo é valido
	if (dataini != "") {
		if (dataini > datafim) {
			alert("datas entre periodo invalido");
			return false;
		}else{
			if (a == "") {a = "?";}else{a += "&";}
			a += "dataini="+dataini+"&datafim="+datafim;	
		}
	}
	if (posse != '0'){
		if (a == "") {a = "?";}else{a += "&";}
		a += "posse="+posse;	
	}
	if (equipa2.checked) {
		// filtra por placa
		if (equipamento == ""){
			alert("Informe a placa");
			return false;
		}
		if (a == "") {a = "?";}else{a += "&";}
		a += "tipequ=" + equipa2.value + "&equipamento=" + equipamento;	
	}else if (equipa3.checked) {   
		// filtra por frota
		if (equipamento == ""){
			alert("Informe o frota");
			return false;
		}
		if (a == "") {a = "?";}else{a += "&";}
		a += "tipequ=" + equipa3.value + "&equipamento=" + equipamento;	
	}
	if (radio2.checked) {
		// filtra por pessoa
		if (pessoa == ""){
			alert("Informe a pessoa");
			return false;
		}
		if (a == "") {a = "?";}else{a += "&";}
		a += "tippes=" + radio2.value + "&pessoa=" + pessoa;	
	}else if (radio3.checked) {
		// filtra por empresa
		if (pessoa == ""){
			alert("Informe a empresa");
			return false;
		}
		if (a == "") {a = "?";}else{a += "&";}
		a += "tippes=" + radio3.value + "&pessoa=" + pessoa;	
	}else if (radio4.checked) {
		// filtra por filial
		if (pessoa == ""){
			alert("Informe a filial");
			return false;
		}
		if (a == "") {a = "?";}else{a += "&";}
		a += "tippes=" + radio4.value + "&pessoa=" + pessoa;	
	}
	if (a == "") {
		alert("Informe pelo menos um parametro");
		return false;}
	// Exibi a imagem de progresso
    result.innerHTML = '<img src="img/ajax_clock_small.gif"/>';
    // Iniciar uma requisição
    xmlreq.open("GET", "rastreamento.php" + a , true);
     
    // Atribui uma função para ser executada sempre que houver uma mudança de ado
    xmlreq.onreadystatechange = function(){
         
		// Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
        if (xmlreq.readyState == 4) {
             
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                 result.innerHTML = xmlreq.responseText;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
        }
	};
	xmlreq.send(null);
 }
 
 /**
 * Função para Lista os dados do Historico de movimento de acordo com os parametros informados
 */
 function getHistorico() {
      
    // Declaração de Variáveis
	var dataini = document.getElementById("dataini").value;
	var datafim = document.getElementById("datafim").value;
	var posse   = document.getElementById("posse").value;
	var equipa2 = document.getElementById("equipamento2");
	var equipa3 = document.getElementById("equipamento3");
	var equipamento= document.getElementById("txtEquipamento").value;
	var radio2  = document.getElementById("radio2");
	var radio3  = document.getElementById("radio3");
	var radio4  = document.getElementById("radio4");
	var pessoa  = document.getElementById("txtPessoa").value;
    var result  = document.getElementById("ResultadoRastreamento");
    var xmlreq  = CriaRequest();
    var a = "";

	// Verifica se o periodo é valido
	if (dataini != "") {
		if (dataini > datafim) {
			alert("datas entre periodo invalido");
			return false;
		}else{
			if (a == "") {a = "?";}else{a += "&";}
			a += "dataini="+dataini+"&datafim="+datafim;	
		}
	}
	if (posse != '0'){
		if (a == "") {a = "?";}else{a += "&";}
		a += "posse="+posse;	
	}
	if (equipa2.checked) {
		// filtra por placa
		if (equipamento == ""){
			alert("Informe a placa");
			return false;
		}
		if (a == "") {a = "?";}else{a += "&";}
		a += "tipequ=" + equipa2.value + "&equipamento=" + equipamento;	
	}else if (equipa3.checked) {   
		// filtra por frota
		if (equipamento == ""){
			alert("Informe o frota");
			return false;
		}
		if (a == "") {a = "?";}else{a += "&";}
		a += "tipequ=" + equipa3.value + "&equipamento=" + equipamento;	
	}
	if (radio2.checked) {
		// filtra por pessoa
		if (pessoa == ""){
			alert("Informe a pessoa");
			return false;
		}
		if (a == "") {a = "?";}else{a += "&";}
		a += "tippes=" + radio2.value + "&pessoa=" + pessoa;	
	}else if (radio3.checked) {
		// filtra por empresa
		if (pessoa == ""){
			alert("Informe a empresa");
			return false;
		}
		if (a == "") {a = "?";}else{a += "&";}
		a += "tippes=" + radio3.value + "&pessoa=" + pessoa;	
	}else if (radio4.checked) {
		// filtra por filial
		if (pessoa == ""){
			alert("Informe a filial");
			return false;
		}
		if (a == "") {a = "?";}else{a += "&";}
		a += "tippes=" + radio4.value + "&pessoa=" + pessoa;	
	}
	if (a == "") {
		alert("Informe pelo menos um parametro");
		return false;}
  
	// Exibi a imagem de progresso
    result.innerHTML = '<img src="img/ajax_clock_small.gif"/>';
    // Iniciar uma requisição
    xmlreq.open("GET", "historico.php" + a , true);
     
    // Atribui uma função para ser executada sempre que houver uma mudança de ado
    xmlreq.onreadystatechange = function(){
         
		// Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
        if (xmlreq.readyState == 4) {
             
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                 result.innerHTML = xmlreq.responseText;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
        }
	};
	xmlreq.send(null);
 }

/**
 * Função carrega combobox com tabela de embarcacao
 */
 function getTabEmbarc() {
	// Preenche combo de embarcacao

	// Verifica o campo embarc se vem da pagina editamov para cair elect da tabela de embarcacoes
	if (document.getElementById("embarc")) {
		var embarc = document.getElementById("embarc").value;
	} else {
		var embarc= '0';
	}
	// Verifica o portal do movimento
    var result = document.getElementById("ResultadoEmbarcacao");
    var xmlreq = CriaRequest();
	// transforma o formato da data atual do php para o formato AAAAMMDD
      
    // Exibi a imagem de progresso
    result.innerHTML = '<img src="img/ajax_clock_small.gif"/>';
     
    // Iniciar uma requisição
	a ="?embarc="+embarc;
    xmlreq.open("GET", "embarcacao.php" + a, true);
     
    // Atribui uma função para ser executada sempre que houver uma mudança de ado
    xmlreq.onreadystatechange = function(){
         
		// Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
        if (xmlreq.readyState == 4) {
             
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                 result.innerHTML = xmlreq.responseText;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
        }
	};
	xmlreq.send(null);
 }

/**
 * Função para alternar Combobox entre finalidade e deslocamento dependendo do portal usado
 */
 function getAlternaCombobox() {
	// Verifica o portal do movimento
	var result = document.getElementById("ResultadoDeslocamento");
	var xmlreq = CriaRequest();
	// transforma o formato da data atual do php para o formato AAAAMMDD
      
    // Exibi a imagem de progresso
    result.innerHTML = '<img src="img/ajax_clock_small.gif"/>';
    // Iniciar uma requisição
    xmlreq.open("GET", "alternacombo.php", true);
     
    // Atribui uma função para ser executada sempre que houver uma mudança de ado
    xmlreq.onreadystatechange = function(){
         
		// Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
        if (xmlreq.readyState == 4) {
             
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                 result.innerHTML = xmlreq.responseText;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
        }
	};
	xmlreq.send(null);
 }
 
 /**
 * Função que retorna a filial e o portal do usuario logado
 */
 function getFilialPortal() {
	// Objeto para qual retornara A filial e o portal do usuario'
	var result = document.getElementById("FilialPortal");
	var xmlreq = CriaRequest();
	// transforma o formato da data atual do php para o formato AAAAMMDD
      
    // Exibi a imagem de progresso
    result.innerHTML = '<img src="img/ajax_clock_small.gif"/>';
    // Iniciar uma requisição
    xmlreq.open("GET", "filialportal.php", true);
     
    // Atribui uma função para ser executada sempre que houver uma mudança de ado
    xmlreq.onreadystatechange = function(){
         
		// Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
        if (xmlreq.readyState == 4) {
             
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                 result.innerHTML = xmlreq.responseText;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
        }
	};
	xmlreq.send(null);
 }


  /**
 * Função limpa os campos placa1, placa2, placa3, placa4 na pagina de movimento
 */
 function getLimpaPlaca() {
	// A variavel (seq) aponta a sequencia das placas para inclusao
	if (document.getElementById("radio1").checked) {
		var result = document.getElementById("ResultadoEquipamento");
	}else if (document.getElementById("radio2").checked) {
		var result = document.getElementById("ResultadoEquipamento2");
	}else if (document.getElementById("radio3").checked){
		var result = document.getElementById("ResultadoEquipamento3");
	}else if (document.getElementById("radio4").checked){
		var result = document.getElementById("ResultadoEquipamento4");
	}
    result.innerHTML = '<img src="img/ajax_clock_small.gif"/>';
}