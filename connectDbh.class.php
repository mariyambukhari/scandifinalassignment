 <?php

    class ConnectDbh
    {
        // private $servername;
        // private $username;
        // private $password;
        // private $dbname;
        private $charset;
        // public $connection;
        public $cleardb_server;
        public $cleardb_url;
        public $cleardb_username;
        public $cleardb_password;
        public $cleardb_db;

        public function connect()
        {
            $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));

            $this->charset = "utf8mb4";
            $this->cleardb_server = $cleardb_url["host"];
            $this->cleardb_username = $cleardb_url["user"];
            $this->cleardb_password = $cleardb_url["pass"];
            $this->cleardb_db = substr($cleardb_url["path"], 1);
            $active_group = 'default';
            $query_builder = TRUE;



            try {


                $dsn = "mysql:host=" . $this->cleardb_server . ";dbname=" . $this->cleardb_db . ";charset=" . $this->charset;
                $pdo = new PDO($dsn, $this->cleardb_username, $this->cleardb_password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $pdo;
            } catch (PDOException $e) {
                echo 'connection failed: ' . $e->getMessage();
            }
        }
    }
