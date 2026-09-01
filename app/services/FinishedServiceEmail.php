<?php

class FinishedServiceEmail
{
    public static function send($service, $commission)
    {
        $to = $service['email'];

        $subject = 'Serviço Finalizado';

        $message = "
            Olá, {$service['name']}!

            O serviço '{$service['description']}' foi finalizado com sucesso.

            Valor do serviço: R$ " . number_format($service['price'], 2, ',', '.') . "

            Sua comissão: R$ " . number_format($commission, 2, ',', '.') . "

            Obrigado!
            JM Informática
            ";

        $headers = "From: noreply@jminformatica.com\r\n";
        $headers .= "Reply-To: noreply@jminformatica.com\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        return mail($to, $subject, $message, $headers);
    }
}