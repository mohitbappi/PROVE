<?php
$pdo = new PDO('mysql:host=localhost;port=8888;dbname=PROVE', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
