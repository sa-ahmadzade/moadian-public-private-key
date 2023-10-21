// تبدیل فایل
// cer
// به 
// public key

<?php


$command = "openssl x509 -pubkey -noout -in Test.cer > pubkey.txt";
$x = shell_exec($command);

