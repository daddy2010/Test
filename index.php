<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="windows-1251">
        <title></title>
    </head>
    <body>
        <?php
        $ch = curl_init('my-hit.org');
        $fp = fopen("test.txt", "w");
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $a = curl_exec($ch);
        curl_close($ch);
        fclose($fp);
        ?>
    </body>
</html>
