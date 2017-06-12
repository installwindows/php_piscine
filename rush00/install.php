<?php
mkdir('users');
mkdir('products');
mkdir('orders');
$admin = ['login' => 'admin', 'passwd' => hash('whirlpool', 'admin'), 'type' => 'admin'];
file_put_contents('users/admin', serialize($admin));
