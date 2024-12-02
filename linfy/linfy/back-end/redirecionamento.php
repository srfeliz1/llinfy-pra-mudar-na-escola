<?php
// Função para redirecionar para a página de login
function validaUrl($url, $url_permetidas): bool {
    return array_key_exists(key: $url, array: $url_permetidas);
}

?>