class Sistema{
    constructor(){
        this.receitas = [];
        this.usuarios = [];
        this.popupativo = undefined;
        this.autenticado = false;
    }

sha256(message) {
    // encode as UTF-8
    const msgBuffer = new TextEncoder().encode(message);                    

    // hash the message
    const hashBuffer = crypto.subtle.digest('SHA-256', msgBuffer);

    // convert ArrayBuffer to Array
    const hashArray = Array.from(new Uint8Array(hashBuffer));

    // convert bytes to hex string                  
    const hashHex = hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
    return hashHex;
}

hashAndSave(){
    // Como a função de sha256 é "async" ela retorna um objeto do tipo "Promise" com o valor de retorno...
    // ... esperado como o atributo valor deste objeto e para acessá-lo se faz o seguinte:
    let p = sha256("Bruno");
    p.then(value => {
        console.log(value);
    }).catch(err => {
        console.log(err); // "Something went wrong"
    });
}


checkSignUpDate(){
    const today = new Date;
    const yyyy = today.getFullYear();
    let mm = today.getMonth() + 1;
    let dd = today.getDate();

    const data_de_nascimento = document.getElementById("data_de_nascimento").value;

    if(Number(data_de_nascimento.slice(0, 3+1)) >= Number(yyyy) - 10){
        document.getElementById("warning_data_de_nascimento").innerHTML = "<font color='red'> A idade minínima é 10 anos </font>";
        return false;
    }
    return true;
}

checkSignUpPassword(){
    var password = document.getElementById("senha_sign_up").value; 
    var confirmedPassWord = document.getElementById("senha_confirmada").value;
    
    console.log(password);
    console.log(confirmedPassWord);
    
    if(password.toString() === confirmedPassWord.toString() != true){
        document.getElementById("warning_senha").innerHTML = "<font color='red'> <br> Senhas diferentes! </font>";
        return false;
    }
    else if(password.length < 8){
        document.getElementById("warning_senha").innerHTML = "<font color='red'> <br> A senha deve conter pelo menos 8 dígitos! </font>";
        return false;
    }
    return true;
}

checkTermsAndConditions(){
    var b = document.getElementById("termos_e_condicoes").checked;
    console.log(b);
    if(b == false){
        document.getElementById("warning_termos_e_condicoes").innerHTML = 
        "<font color='red'> <br> Você deve aceitar os termos e condições para continuar. </font>";
        return false
    }
    return true;
}

checkCPF(){
    var cpf = document.getElementById("cpf").value;

    console.log("Últimos digitios:")
    console.log(cpf[9])
    console.log(cpf[10])

    var firstDigit = 0, i = 0;
    for(var count = 10; count > 1; count--){
        firstDigit += parseInt(cpf[i]) * count; 
        i++;
    }
    firstDigit = firstDigit % 11;
    if(firstDigit < 2) firstDigit = 0;
    else firstDigit = 11 - firstDigit;
    
    secondDigit = 0, i = 0;
    for(var count = 11; count > 1; count--){
        secondDigit += parseInt(cpf[i]) * count; 
        i++;
    }
    secondDigit = secondDigit % 11;
    if(secondDigit < 2) secondDigit = 0;
    else secondDigit = 11 - secondDigit;

    if(cpf[9] == firstDigit && cpf[10] == secondDigit) return true;
    document.getElementById("warning_cpf").innerHTML = "<font color='red'> CPF inválido! <br> </font>";
    return false;
}

checkEmptyNameEmailCPF(){
    let cpf = document.getElementById("cpf").value;
    let email = document.getElementById("email_cadastro").value;
    let name = document.getElementById("primeiroNomeCadastro").value;
    let lastName = document.getElementById("ultimoNomeCadastro").value;
    
    if(cpf.length != 11 || name === "" || lastName === "" || email === ""){
        document.getElementById("warning_cadastro").innerHTML = "<font color='red'> Campos vazios! <br> </font>";
        return false;
    }
    return true;
}

clearAllInnerHTML(){
    document.getElementById("warning_cadastro").innerHTML = "";
    document.getElementById("warning_cpf").innerHTML = "";
    document.getElementById("warning_termos_e_condicoes").innerHTML = "";
    document.getElementById("warning_senha").innerHTML = "";
}

checkSignIn(){
    clearAllInnerHTML();

    let email = document.getElementById("email").value;
    var senha = document.getElementById("senha_sign_in").value; 
    
    var resp = "teste";

    fetch(url+"insert_sign_in.php", {
        method: "POST",
        headers: {
                "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
            },
            body: `email=${email}&senha=${senha}`,
        })
    .then((response) => response.text())
    .then((res) => {
        resp = res;

        console.log("warning_login: ");
        console.log(resp);
        console.log("result:");
        console.log(resp.length);

        if(resp.length == 1){
            location.reload();
        }
        else{
            document.getElementById("warning_login").innerHTML = res;
        }
    });
    
    document.getElementById('sign_in').reset();
}

checkSignUp(){
    clearAllInnerHTML();

    if(checkEmptyNameEmailCPF() && checkCPF() && checkTermsAndConditions() && checkSignUpDate() && checkSignUpPassword()){

        let cpf = document.getElementById("cpf").value;
        let email = document.getElementById("email_cadastro").value;
        let nome = document.getElementById("primeiroNomeCadastro").value;
        let sobrenome = document.getElementById("ultimoNomeCadastro").value;
        var senha = document.getElementById("senha_sign_up").value; 
        var senha_confirmada = document.getElementById("senha_confirmada").value;
        
        fetch(url+"insert_sign_up.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
            },
            body: `cpf=${cpf}&email=${email}&nome=${nome}&sobrenome=${sobrenome}
            &senha=${senha}&senha_confirmada=${senha_confirmada}`,
        })
        .then((response) => response.text())
        .then((res) => (document.getElementById("warning_cadastro").innerHTML = res));
        
        document.getElementById('sign_up').reset();
    }
    else{
        document.getElementById('sign_up').reset();
    }
}

logout(){
    var stuff;
    fetch(url+"sair.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
            },
            body: ``,
        })
        .then((response) => response.text())
        .then((res) => (stuff = res));
    location.reload();
}

setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }

// handles the click event for link 1, sends the query
getOutputInsertInDataBase() {
    getRequest(
        'insert_sign_up.php', // URL for the PHP file
         drawOutput,  // handle successful request
         drawError    // handle error
    );
    return false;
  }  
  // handles drawing an error message
drawError() {
      var container = document.getElementById('output');
      container.innerHTML = 'Bummer: there was an error!';
  }
  // handles the response, adds the html
drawOutput(responseText) {
      var container = document.getElementById('output');
      container.innerHTML = responseText;
  }
  // helper function for cross-browser request object
 getRequest(url, success, error) {
      var req = false;
      try{
          // most browsers
          req = new XMLHttpRequest();
      } catch (e){
          // IE
          try{
              req = new ActiveXObject("Msxml2.XMLHTTP");
          } catch(e) {
              // try an older version
              try{
                  req = new ActiveXObject("Microsoft.XMLHTTP");
              } catch(e) {
                  return false;
              }
          }
      }
      if (!req) return false;
      if (typeof success != 'function') success = function () {};
      if (typeof error!= 'function') error = function () {};
      req.onreadystatechange = function(){
          if(req.readyState == 4) {
              return req.status === 200 ? 
                  success(req.responseText) : error(req.status);
          }
      }
      req.open("GET", url, true);
      req.send(null);
      return req;
}

exibirReceitas() {
    var container = $('#receitas-container');
    
    // Itera sobre as receitas e adiciona ao container
    for (var i = 0; i < Sys.receitas.length; i++) {
        var receita = Sys.receitas[i];
        var html = `
            <div class="receita">
                <h2>Nome da Receita: ${receita.getNome()}</h2>
                <p>Ingredientes: ${receita.getIngredientes()}</p>
                <p>Preparo: ${receita.getPreparo()}</p>
                <p>Tempo de preparo: ${receita.getTempo()} minutos</p>
                <p>Avaliação: ${receita.getAvaliacao()} estrelas</p>
                <p>Usuário: ${receita.getUsuario()}</p>
            </div>
        `;
        container.append(html);
    }
}

setReceitas(){
    $.ajax({
        url: "persistencia/receita.php",
            data:"op=0",
            type:"POST",
            cache:false,
            success: function(r){
                const o = JSON.parse(r);
                var key;
                for(key in o){
                    if(o[key] != ""){
                        var b = o[key];
                        var e = new Receita(b[0],b[1],b[2],b[3],b[4],b[5],b[6], b[7]);
                        Sys.receitas.push(e);
                    }
                }
                Sys.exibirReceitas();
            }
    })
}

insertUsuario(){
    var primeiroNomeCadastro = document.getElementById("primeiroNomeCadastro").value;
    var ultimoNomeCadastro = document.getElementById("ultimoNomeCadastro").value;
    var email_cadastro = document.getElementById("email_cadastro").value;
    var senha_sign_up = document.getElementById("senha_sign_up").value;

    var dados = primeiroNomeCadastro+"^"+email_cadastro+"^"+senha_sign_up+"^"+ultimoNomeCadastro;

    $.ajax({
        url: "persistencia/usuario.php",
        data:"op=1&dados="+dados,
        type:"POST",
        cache:false,
        success: function(r){
            var a = new Usuario(primeiroNomeCadastro, email_cadastro, senha_sign_up, ultimoNomeCadastro);
            Sys.usuarios.push(a);
        }
    });

}

setUsuarios(){
    $.ajax({
        url: "persistencia/usuario.php",
            data:"op=0",
            type:"POST",
            cache:false,
            success: function(r){
                const o = JSON.parse(r);
                var key;
                for(key in o){
                    if(o[key] != ""){
                        var b = o[key];
                        var e = new Usuario(b[0],b[1],b[2],b[3],b[4]);
                        console.log(e);
                        Sys.usuarios.push(e);
                    }
                }
            }
    })
}

loginUsuario(){
    var email = document.getElementById("email").value;
    var senha_sign_in = document.getElementById("senha_sign_in").value;
    var popup = document.getElementById('menu-login');

    const dados = email+"^"+senha_sign_in;

    $.ajax({
        url: "persistencia/usuario.php",
            data:"op=2&dados="+dados,
            type:"POST",
            cache:false,
            success: function(r){
                const o = JSON.parse(r);
                if(Object.keys(o).length > 0){
                    //Armazena o login
                    sessionStorage.setItem('autenticado', 'true');
                    sessionStorage.setItem('usuarioLogado', JSON.stringify(r));

                    //Muda os botoes de cadastro e login
                    document.getElementById('ButtonSair').style.display = 'block';
                    document.getElementById('BotaCadastro').style.display = 'none';
                    document.getElementById('BotaoLogin').style.display = 'none';
                    console.log('Usuário autenticado!');
                    popup.style.display = 'none';
                }else{
                    alert('Email ou senha incorretos. Tente novamente.');
                }
            }
    })
}

sairUsuario(){

    document.getElementById('ButtonSair').style.display = 'none';
    document.getElementById('BotaoLogin').style.display = 'block';
    document.getElementById('BotaCadastro').style.display = 'block';

    sessionStorage.removeItem('autenticado');
    sessionStorage.removeItem('usuarioLogado');
}

verificarAutenticacao() {
    var autenticado = sessionStorage.getItem('autenticado');

    if (autenticado) {
      document.getElementById('ButtonSair').style.display = 'block';
      document.getElementById('BotaoLogin').style.display = 'none';
      document.getElementById('BotaCadastro').style.display = 'none';
    } else {
      document.getElementById('ButtonSair').style.display = 'none';
      document.getElementById('BotaoLogin').style.display = 'block';
      document.getElementById('BotaCadastro').style.display = 'block';
    }
}

insertReceitas(){
    var nome_receita = document.getElementById("nome_receita").value;
    var ingredientes = document.getElementById("Ingredientes").value;
    var modo_de_preparo = document.getElementById("modo_de_preparo").value;
    var tempo_de_preparo = document.getElementById("tempo_de_preparo").value;
    var aux = JSON.parse(sessionStorage.getItem('usuarioLogado'));
    var usuarioLogado = Object.values(JSON.parse(aux));
    var b = usuarioLogado[0];
    var c = b[0].split(',');

    var dados = nome_receita+"^"+ingredientes+"^"+modo_de_preparo+"^"+tempo_de_preparo+"^"+c;

    $.ajax({
        url: "persistencia/receita.php",
            data:"op=1&dados="+dados,
            type:"POST",
            cache:false,
            success: function(r){
                console.log(r);
                var a = new Receita(nome_receita, ingredientes, modo_de_preparo, tempo_de_preparo, c);
                Sys.receitas.push(a);            
            }
    })
}


}

Sys = new Sistema();

$(document).ready(function() {
    $("#ListaReceitas").click(function(){ Sys.setReceitas();});
    $("#ButtonCadastro").click(function(){ Sys.insertUsuario();});
    $("#ButtonLogin").click(function(){ Sys.loginUsuario();});
    $("#ButtonSair").click(function(){ Sys.sairUsuario();});
    $("#ButtonPostar").click(function(){ Sys.insertReceitas();});

    Sys.setReceitas();
    Sys.verificarAutenticacao();
});

