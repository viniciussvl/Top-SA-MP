<?php

class Helper {
    public function buscarIp() {
        $http_client_ip = (isset($_SERVER['HTTP_CLIENT_IP'])) ? $_SERVER['HTTP_CLIENT_IP'] : null;
        $http_x_forwarded_for = (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : null;
        $remote_addr = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : null;

        /* VERIFICO SE O IP REALMENTE EXISTE NA INTERNET */
        if (!empty($http_client_ip)) {
            $ip = $http_client_ip;
            /* VERIFICO SE O ACESSO PARTIU DE UM SERVIDOR PROXY */
        } elseif (!empty($http_x_forwarded_for)) {
            $ip = $http_x_forwarded_for;
        } else {
            /* CASO EU NÃO ENCONTRE NAS DUAS OUTRAS MANEIRAS, RECUPERO DA FORMA TRADICIONAL */
            $ip = $remote_addr;
        }
        return $ip;
    }
}
