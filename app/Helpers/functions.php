<?php

function validaCNPJ($cnpj)
{
    $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
    $cnpj = (string)$cnpj;
    $cnpj_original = $cnpj;
    $primeiros_numeros_cnpj = substr($cnpj, 0, 12);

    if (!function_exists('multiplica_cnpj')) {
        function multiplica_cnpj($cnpj, $posicao = 5)
        {
            $calculo = 0;
            for ($i = 0; $i < strlen($cnpj); $i++) {
                $calculo = $calculo + ($cnpj[$i] * $posicao);
                $posicao--;
                if ($posicao < 2) {
                    $posicao = 9;
                }
            }
            return $calculo;
        }
    }

    $primeiro_calculo = multiplica_cnpj($primeiros_numeros_cnpj);
    $primeiro_digito = ($primeiro_calculo % 11) < 2 ? 0 :  11 - ($primeiro_calculo % 11);
    $primeiros_numeros_cnpj .= $primeiro_digito;
    $segundo_calculo = multiplica_cnpj($primeiros_numeros_cnpj, 6);
    $segundo_digito = ($segundo_calculo % 11) < 2 ? 0 :  11 - ($segundo_calculo % 11);

    $cnpj = $primeiros_numeros_cnpj . $segundo_digito;

    if ($cnpj === $cnpj_original) {
        return true;
    }
}

function validaCPF($cpf = null)
{

    if (empty($cpf)) {
        return false;
    }

    $cpf = preg_replace("/[^0-9]/", "", $cpf);
    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

    if (strlen($cpf) != 11) {
        return false;
    } else if (
        $cpf == '00000000000' ||
        $cpf == '11111111111' ||
        $cpf == '22222222222' ||
        $cpf == '33333333333' ||
        $cpf == '44444444444' ||
        $cpf == '55555555555' ||
        $cpf == '66666666666' ||
        $cpf == '77777777777' ||
        $cpf == '88888888888' ||
        $cpf == '99999999999'
    ) {
        return false;
    } else {

        for ($t = 9; $t < 11; $t++) {

            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }
}

function tofloat($num)
{
    $dotPos = strrpos($num, '.');
    $commaPos = strrpos($num, ',');
    if (($dotPos > $commaPos) && $dotPos) {
        $sep = $dotPos;
    } elseif (($commaPos > $dotPos) && $commaPos) {
        $sep = $commaPos;
    } else {
        $sep = false;
    }

    if (!$sep) {
        return strval(floatval(preg_replace("/[^0-9]/", "", $num)));
    }
    return strval(floatval(
        preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
            preg_replace("/[^0-9]/", "", substr($num, $sep + 1, strlen($num)))
    ));
}

function numberFormat($number, $decimals = 2, $sep = ",", $k = "")
{
    $var = number_format($number, $decimals, $sep, $k);
    return  $var;
}

function hoje(){
    return date("Y-m-d");
}

function agora(){
    return date("H:i:s");
}

function databr($data) {
    $data = extrair_data($data, 1);
    return $data[0] . "/" .$data[1] ."/" .$data[2];        
}

function extrair_data($data, $opcao=1){
    //Opção 1-EN 2-BR
    if ($opcao==1){
        $dia = substr($data,8,2);
        $mes = substr($data,5,2);
        $ano = substr($data,0,4);      
    }
    else{
        $dia = substr($data,0,2);
        $mes = substr($data,3,2);
        $ano = substr($data,6,4);
    }
    return array($dia,$mes,$ano);
}