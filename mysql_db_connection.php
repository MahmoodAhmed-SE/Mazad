<?PHP
$host = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'MazadDB';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    
    
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    
    return $pdo;
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

?>