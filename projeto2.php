<?php
$usuario ='';
$password ='';
$regUsuario ='';
$regPassword = '';
$registros =[
    'rafa' => '2302'
];     
$usuarioLogado = null;
$listaProd = [];
$cont = 0;


//função para escolher
function start($opcao){
    if($opcao == "1"){
       login($opcao);
    }
    elseif($opcao == "2"){
        registro($opcao);
    } else{
        echo "Erro, tente novamente\n";
    }
}

//funcao de registrar
function registro($opcao){

    global $registros;

    $regUsuario = readline("Registre seu nome de usuário : \n");
    $regPassword = readline("Crie uma senha : ");

    // se a regUsuario existir dentro de registro, roda o restante do código                  
    if(array_key_exists($regUsuario,$registros)){
        echo "Este usuário já existe\n";
        do{
            $regUsuario = readline("Registre seu nome de usuário : \n");
            $regPassword = readline("Crie uma senha : \n");
        }while($regUsuario == $registros);
    }
    $registros [$regUsuario] = $regPassword;
    print_r($registros);
    echo "Seu usuário foi registrado com sucesso!\n";   
}

//funcao de logar
function login($opcao){
    global $registros;
    global $controle;
    global $usuarioLogado;
    $controle = '';
    $usuario = readline("Digite seu usuário : \n");
    $password = readline("Digite sua senha : \n");

    if(array_key_exists($usuario,$registros)){
        echo "Logado com sucesso!\n";
        $usuarioLogado = $usuario;
        $controle = (true);
    }
}


//função de vender
function vender(){
    global $listaProd;
    global $cont;
    do{
        $produto = readline ("Qual produto você vendeu? \n");
        $valor = readline("Valor: R$\n");
        $voltar = readline("Deseja continuar?\n 1- SIM\n 2- NÃO \n");
        $listaProd [$produto] = $valor;
        $cont += $valor;
    }while($voltar != 2);
    print_r($listaProd); 
    echo"O total da compra foi de R$$cont\n";  

}

//funcao de deslogar
function deslogar($controle){
    global $usuarioLogado;
    $usuarioLogado = null;
    echo "Deslogado com sucesso!\n";
    
}


//funcao de menu
function menu(){
    global $usuarioLogado;

    echo "Bem vindo $usuarioLogado! \n ";
    echo"1 - Vender\n";
    echo "2 - Cadastrar novo usuário\n";
    echo "3 - Verificar Log\n";
    echo "4 - Deslogar\n";
    echo "5 - Encerrar :(\n";
    do{
        $escolha = readline("O que você deseja fazer?\n ");
    } while($escolha < 1 and $escolha > 4);

    if($escolha == "1"){
        vender($escolha);
    } 
    else if($escolha == "2" ){
        registro($escolha);
    }
    else if($escolha == "3"){
        log($escolha);
    }
    else if($escolha == "4"){
        deslogar($escolha);
    }
}




while(true){
    if ($usuarioLogado == null) {
        echo "Faça o registro antes de fazer o login\n";
        echo "O que você deseja fazer?\n";
        $opcao = readline("1 - logar\n2 - registrar\n");
        start($opcao);
    }
    else {
        menu();
    }
}





