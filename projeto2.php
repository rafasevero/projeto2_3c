<?php
$usuario ='';
$password ='';
$regUsuario ='';
$regPassword = '';
$registros =[
    'rafa' => '2302'
];     
$usuarioLogado = '';

//função para escolher
function menu($opcao){
    if($opcao == "1"){
       login($opcao);
    }
    elseif($opcao == "2"){
        registro($opcao);
    } else{
        echo "Erro, tente novamente\n";
    }
}

//funcao de logar
function login($opcao){
    global $registros;
    global $controle;
    $controle = '';
    $usuario = readline("Digite seu usuário : \n");
    $password = readline("Digite sua senha : \n");

    if(array_key_exists($usuario,$registros)){
        echo "Logado com sucesso!\n";
        $controle = (true);
    }
}

//funcao de deslogar
function deslogar($controle){
    if($controle == (true) ){
        echo "Deslogado com sucesso!\n";
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
while(true){
    echo "Faça o registro antes de fazer o login\n";
    echo "O que você deseja fazer?\n";
    $opcao = readline("1 - logar\n2 - registrar\n");
    menu($opcao);
}





