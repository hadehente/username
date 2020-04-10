<?php  

echo "Username instagram checker available\n";
echo "Follow instagram @inuubae\n";
echo "\n";

echo "[1] Random \n";
echo "[2] Username list \n";
echo "Pilih Opsi : ";
$opsi = trim(fgets(STDIN));




if ($opsi == 1) {
    echo "Panjang huruf : ";
    $q = trim(fgets(STDIN));
    echo "Jumlah : ";
    $jmlh = trim(fgets(STDIN));
   for ($i = 0; $i < $jmlh ; $i++) {
        $username = generateRandomString($q);
        $cek = cek($username);
        if ($cek == 404) {
            echo "\033[31m Username Tidak Tersedia => ".$username."\n";
        }else {
             echo "\033[32m Username Tersedia => ".$username."\n";
             fwrite(fopen('available-user.txt', 'a'), "$username \n");
        }

    }   
}

if ($opsi == 2) {
    
echo "Username list : ";
$file = file(trim(fgets(STDIN)));

foreach ($file as $user) {
    $username = trim($user);
     $cek = cek($username);
        if ($cek == 404) {
            echo "\033[31m Username Tidak Tersedia => ".$username."\n";
        }else {
             echo "\033[32m Username Tersedia => ".$username."\n";
             fwrite(fopen('available-user.txt', 'a'), "$username \n");
        }
}

}

function cek($username){
$url = "https://instagram.com/$username/";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_TIMEOUT,10);
    $output = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $httpcode;
}

function generateRandomString($length) {
    return substr(str_shuffle(str_repeat($x='abcdefghijklmnopqrstuvwxyz', ceil($length/strlen($x)) )),1,$length);
}
?>
