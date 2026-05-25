<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'agenda');
 echo "<style>*{margin:0}</style>";
try {
	$dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4';
	$pdo = new PDO($dsn, DB_USER, DB_PASS, [
    	PDO::ATTR_ERRMODE         => PDO::ERRMODE_EXCEPTION,
    	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    	PDO::ATTR_EMULATE_PREPARES   => false,
	]);
    
} catch (PDOException $e) {
	die('Erro de conexão: ' . $e->getMessage());
}

// PDO::ERRMODE_EXCEPTION: 
// Lanza un error (PDOException) e interrumpe el código. Te obliga a usar try {} catch {}. 
// Es el estándar actual (PHP 8+).PDO::ERRMODE_SILENT: No hace nada visible. El código sigue corriendo y tú debes revisar el error manualmente con $pdo->errorInfo().