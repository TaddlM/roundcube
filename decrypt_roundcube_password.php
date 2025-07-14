<?php
function decrypt_roundcube_password($encrypted_base64, $des_key) {
    $cipher = "DES-EDE3-CBC";  // Triple DES in CBC mode
    $encrypted = base64_decode($encrypted_base64);
    
    // First 8 bytes are the IV
    $iv = substr($encrypted, 0, 8);
    $ciphertext = substr($encrypted, 8);
    
    $decrypted = openssl_decrypt($ciphertext, $cipher, $des_key, OPENSSL_RAW_DATA, $iv);
    return $decrypted;
}

// decryption
$encrypted = 'encrypted string';
$des_key = 'des_key';
$plain = decrypt_roundcube_password($encrypted, $des_key);
echo "Decrypted password: $plain\n";


