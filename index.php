<?php

/**
 * WARNING !!! DO NOT USE THIS CODE FOR YOUR APP!
 * THIS IS JUST AN EXAMPLE OF ASYMMETRIC ENCRYPTION.
 * REAL ASYMMETRIC ENCRYPTION NEED A HUGE RANDOM PRIVATE KEY/PUBLIC KEY
 */

$priv_key = [ // Private key keep secret
  120, 96, 230
];

$pub_key = []; // Public key will be [136, 160, 26]

// Generate public key from private key.
foreach ($priv_key as $key) {
  $pub_key[] = 256 - $key; // 256 as an example modulo.
}

function decrypt ($text) {
  global $priv_key;
  $ac = 0;
  $ch = '';
  
  $len = strlen($text);
  for ($a = 0; $a < $len; $a++) {
    $ac = (ord(substr($text, $a, 1)) + $priv_key[$a % 3]) % 256;
    $ch .= chr($ac);
  }
  return $ch;
}

function encrypt ($text) {
  global $pub_key;
  $ac = 0;
  $ch = '';
  
  $len = strlen($text);
  for ($a = 0; $a < $len; $a++) {
    $ac = (ord(substr($text, $a, 1)) + $pub_key[$a % 3]) % 256;
    $ch .= chr($ac);
  }
  return $ch;
}

$encrypted = encrypt('Hello World! You will be encrypted');
// Do send $encrypted variable to server HERE.

$decrypted = decrypt($encrypted);
// You will see the decrypted message below.
echo($decrypted); // print 'Hello World! You will be encrypted'

?>
