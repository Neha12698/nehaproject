
<?php  


    class dbConnect {  

        function __construct() {  
            define("DB_HOST", '127.0.0.1');  
		    define("DB_USER", 'root');  
		    define("DB_PASSWORD", 'Teamwebethics3');  
		    define("DB_DATABSE", 'neha');   
            
		       $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);  
                       mysqli_select_db(DB_DATABSE, $conn);  

                if(!$conn)// testing the connection  
                    {  
                        die ("Cannot connect to the database");  
                    }   
                return $conn;  
        }  
        public function Close(){  
            mysql_close();  
        }  

    }  
?>  