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
$guardarlogs = [];
$data = date('d/m/Y H:i:s');


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
    global $data;
    global $usuario;

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
    verificarLog("O usuário $usuario foi registrado em $data\n"); 
}

//funcao de logar
function login($opcao){
    global $registros;
    global $controle;
    global $usuarioLogado;
    global $data;
    $controle = '';
    $usuario = readline("Digite seu usuário : \n");
    $password = readline("Digite sua senha : \n");

    if(array_key_exists($usuario,$registros)){
        echo "Logado com sucesso!\n";
        $usuarioLogado = $usuario;
        $controle = (true);
        verificarLog("O usuario $usuario logou em $data");
    }
}


//função de vender
function vender(){
    global $listaProd;
    global $cont;
    global $data;
    global $valor;
    global $produto;

    do{
        $produto = readline ("Qual produto foi vendido? \n");
        $valor = readline("Valor: R$\n");
        $voltar = readline("Deseja continuar?\n 1- SIM\n 2- NÃO \n");
        $listaProd [$produto] = $valor;
        $cont += $valor;
    }while($voltar != 2);
    echo"O total da compra foi de R$$cont\n"; 
    verificarLog("O $produto foi vendido por R$$valor as $data");
}

//funcao de deslogar
function deslogar($controle){
    global $usuarioLogado;
    global $data;
    $usuarioLogado = null;
    echo "Deslogado com sucesso!\n";
    verificarLog("Usuario $usuarioLogado deslogou na $data");

}


//funcao de menu
function menu(){
    global $usuarioLogado;
    echo "Bem vindo $usuarioLogado!\n";
    echo "1 - Vender\n";
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
        global $guardarlogs;
        print_r($guardarlogs);
    }
    else if($escolha == "4"){
        deslogar($escolha);
    }
    elseif($escolha == "5"){
        encerrarSistema($escolha);
    }
}

function verificarLog($log){
    global $guardarlogs;
    $guardarlogs [] = $log;
}


function encerrarSistema(){
    echo "Sessão encerrada, até breve!\n";
    exit(); // Encerra o script
}

while(true){
    if ($usuarioLogado == null) {
        echo "Faça o registro antes de fazer o login, por gentileza\n";
        echo "O que você deseja fazer?\n";
        $opcao = readline("1 - logar\n2 - registrar\n");
        start($opcao);
    }
    else {
        menu();
    }
}





