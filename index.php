<?php

require __DIR__ . '/vendor/autoload.php';

$mail = (new Symfony\Component\Mime\Email())
    ->from(new Symfony\Component\Mime\Address(
        'test@example.com',
        'fóó  bár'
    ))
    ->html('test');

$mime = $mail->toString();

echo $mime;
/* OUTPUT (output.eml):
From: =?utf-8?Q?f=C3=B3=C3=B3?=  =?utf-8?Q?b=C3=A1r?= <test@example.com>
MIME-Version: 1.0
Date: Thu, 17 Oct 2024 09:08:34 +0000
Message-ID: <7e9c6c16db5e0720f4940b6c8e76a3b7@example.com>
Content-Type: text/html; charset=utf-8
Content-Transfer-Encoding: quoted-printable

test
*/



echo "\n-----------\n";

$mailParser = new ZBateson\MailMimeParser\MailMimeParser();
$parsedMail = $mailParser->parse($mime, false);
$parsedFrom = $parsedMail->getHeader(ZBateson\MailMimeParser\Header\HeaderConsts::FROM);

var_dump($parsedFrom->getPersonName());
/* OUTPUT:
string(9) "fóóbár"
*/

var_dump($parsedFrom->getEmail());
/* OUTPUT:
string(16) "test@example.com"
*/
