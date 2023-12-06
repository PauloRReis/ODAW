class Receita{
    constructor(id_receita, nome, preparo, avaliacao, tempo, imagem, usuario){
        this.id_receita = id_receita;
        this.nome = nome;
        this.preparo = preparo;
        this.avaliacao = avaliacao;
        this.tempo = tempo;
        this.imagem = imagem;
        this.usuario = usuario;
    }

    getReceita(){
        return this.id_receita;
    }
    getNome(){
        return this.nome;
    }
    getPreparo(){
        return this.preparo;
    }
    getAvaliacao(){
        return this.avaliacao;
    }
    getTempo(){
        return this.tempo;
    }
    getImagem(){
        return this.imagem;
    }
    getUsuario(){
        return this.usuario;
    }

    equals(outraReceita) {
        return (
            this.id_receita === outraReceita.id_receita &&
            this.nome === outraReceita.nome &&
            this.preparo === outraReceita.preparo &&
            this.avaliacao === outraReceita.avaliacao &&
            this.tempo === outraReceita.tempo &&
            this.imagem === outraReceita.imagem &&
            this.usuario === outraReceita.usuario
        );
    }

}