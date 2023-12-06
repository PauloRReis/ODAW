class Usuario{
    constructor(id_usuario, nome, email, senha, sobrenome){
        this.id_usuario = id_usuario;
        this.nome = nome;
        this.email = email;
        this.senha = senha;
        this.sobrenome = sobrenome;
    }
    
    getUsuario(){
        return this.id_usuario;
    }
    getNome(){
        return this.nome;
    }
    getEmail(){
        return this.email;
    }
    getSenha(){
        return this.senha;
    }
    getSobrenome(){
        return this.sobrenome
    }


}