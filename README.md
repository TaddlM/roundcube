## Table of Contents

1. [Configuration prerequisites](#Configuration-prerequisites)
2. [Common places to find config.inc.php](#Common-places-to-find-config.inc.php)
3. [How to use this script](#How-to-use-this-script)
4. [How this script works](#How-this-script-works)

# Configuration prerequisites

If Roundcube Webmail is configured with the `des_key` to encrypt passwords, and the configuration file contains a setup like
```php
$config['des_key'] = 'rcmail-!24ByteDESkey*Str';
```
then this script can be used to decrypt them.

# Common places to find `config.inc.php`

Here are the typical paths, depending on how Roundcube was installed:

| Installation Type      | Possible Config Path                                       |
| ---------------------- | ---------------------------------------------------------- |
| Manual (Apache/Nginx)  | `/var/www/html/roundcube/config/config.inc.php`            |
| Debian/Ubuntu via APT  | `/etc/roundcube/config.inc.php`                            |
| Red Hat/CentOS via RPM | `/etc/roundcubemail/config.inc.php`                        |
| Docker                 | Inside the container, e.g. `/roundcube/config/...`         |
| Custom Installation    | Anywhere you set during install (check Apache/Nginx vhost) |

# How to use this script
```shell
git clone https://github.com/TaddlM/roundcube.git
cd roundcube
```

- Open the PHP script `decrypt_roundcube_password.php`.
- Replace `encrypted string` with your encrypted password on line 15.
- Replace `des_key` with your `des_key` from Roundcube config that was used to encrypt the password.
- Execute the script
```shell
php decrypt_roundcube_password.php
``

# How this script works

This PHP script decrypts IMAP passwords stored by Roundcube Webmail. It takes a Base64-encoded encrypted password, extracts the initialization vector (IV), and decrypts the remaining ciphertext using the Triple DES (3DES) algorithm in CBC mode. The `des_key` used in the Roundcube configuration is required to perform the decryption.
