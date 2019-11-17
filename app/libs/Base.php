<?php



class Base
{
    
    private $host = DB_HOST;
    private $dbname = DB_NAME;
    private $user = DB_USER;
    private $password = DB_PASSWORD;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct()
    {
        $dns = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

        $options = [
            PDO::ATTR_ERRMODE => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->dbh = new PDO($dns, $this->user, $this->password,$options);
            $this->dbh->exec('set names utf8');
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    public function bind($param, $value, $tipe = null)
    {
        if (is_null($tipe)) {
            switch (true) {
                case is_int($value):
                    $tipe = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $tipe = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $tipe = PDO::PARAM_NULL;
                    break;
                default:
                    $tipe = PDO::PARAM_STR;
                    break;
            }
        }

        return $this->stmt->bindValue($param, $value, $tipe);
    }

    public function execute()
    {
        return $this->stmt->execute();
    }

    public function registers()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function register()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}
