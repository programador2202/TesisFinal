<?php


//clase de conexion SERVER > BD

class conexion{
    private static $host = "localhost";
    private static $user = "root";
    private static $password = "";
    private static $dbname = "SISTEMA_RUTA_DEL_SABOR";

    private static $charset = "utf8mb4";
    
    private static $conexion = null;

    public static function getConexion(): mixed{
        if(self::$conexion===null){
        try {
            //Estructurar la cadena de conexión
            $dsn = "mysql:host=" . self::$host .";port=3306 ;dbname=" . self::$dbname . ";charset=" . self::$charset;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ];
            self::$conexion = new PDO($dsn, self::$user, self::$password, $options);
        }catch(PDOException $e){
            //Si hay un error, se captura y se muestra
         throw new PDOException(message: $e->getMessage());
        }
    }
    return self::$conexion;
    }
    public static function cerrar(): void{
        self::$conexion = null;
    }
}