<?php 
$filename = "u.png";
//encrypt file
encrypt_file($filename, "encrypted/".$filename,'secret-password');
//decrypt file
/*
$decrypted = decrypt_file('encrypted/'.$filename,'secret');
header('Content-type:application/png');
fpassthru($decrypted);  */ 

function encrypt_file($file, $destination, $passphrase){
  $handle = fopen($file, "rb") or die("could not open the file");
  $contents = fread($handle,filesize($file));
  fclose($handle);
  $iv = substr(md5("\x18\x3C\x58".$passphrase,true),0,8);
  $key = substr(md5("\x2D\xFC\xD8".$passphrase,true).md5("\x2D\xFC\xD8".$passphrase,true),0,24);
  $opts = array('iv'=>$iv, 'key'=>$key, 'mode'=>'stream');
  $fp = fopen($destination,'wb') or die("Could not opn file for writing");
  stream_filter_append($fp, 'mcrypt.tripledes',STREAM_FILTER_WRITE, $opts);
  fwrite($fp, $contents) or die('Could not write to file');
  fclose($fp);
}
function decrypt_file($file,$passphrase){
  $iv = substr(md5("\x18\x3C\x58".$passphrase,true),0,8);
  $key = substr(md5("\x2D\xFC\xD8".$passphrase,true).md5("\x2D\xFC\xD8".$passphrase,true),0,24);
  $opts = array('iv'=>$iv, 'key'=>$key);
  $fp = fopen($file,'rb');
  stream_filter_append($fp, 'mdecrypt.tripledes', STREAM_FILTER_READ, $opts);
  return $fp;
}
