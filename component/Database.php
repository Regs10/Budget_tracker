<?php
    class Database{
        public $connection;
        function __construct(){
            $servername='localhost';
            $username='root';
            $password='';
            $database='transaction_tracker';
            /* -----------------object------------------------------------------*/
            $this->connection = new mysqli($servername,$username,$password,$database);
            
            if($this->connection->connect_error){
                die("database not connected".$this->connection->connect_error);
            }
    }

    // function to check the user and password
        function CheckUserExist($username,$password){
            $stmt = $this->connection->prepare("SELECT * FROM users WHERE user_name = ? AND password = ?");
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                return $user;
            } else {
                return false;
            }
        }

        // function to insert data for registration
        function insertUser($username,$password){
            $checkQuery = $this->connection->prepare("SELECT * FROM users WHERE user_name = ?");
            $checkQuery->bind_param("s", $username);
            $checkQuery->execute();
            $existingUser = $checkQuery->get_result()->fetch_assoc();
        
            if ($existingUser) {
                return false; // Username already exists
            } else {
                // Use prepared statements to prevent SQL injection
                $stmt = $this->connection->prepare("INSERT INTO users (user_name, password) VALUES (?, ?)");
                $stmt->bind_param("ss", $username, $password);
                
                if ($stmt->execute()) {
                    return true; // Registration successful
                } else {
                    return false; // Registration failed
                }
            }
        }

    //  function to add income
        function insertExpenditure($categories,$date,$remark,$amount,$expType,$userId){
            $query="INSERT INTO transactions (categories,exp_type,date,user_id,amount,remark) VALUES('$categories','$expType','$date','$userId','$amount','$remark')";
            $this->connection->query($query);
            
        }

        function getExpenditures(){
            $userid=$_SESSION['user_id'];
            $query="SELECT * FROM transactions WHERE user_id = '$userid' ORDER BY date DESC";
            $result = $this->connection->query($query);
            
            return $result;
        }
    // ----------------------function add new categories----------
    function addCategories($transactionType,$catImage_location,$categoriesName){

        $query="INSERT INTO category(image_loc,categories_type,category_name) VALUES ('$catImage_location','$transactionType','$categoriesName')";
        $this->connection->query($query);
    }

    function getCategoryIncome(){
         // Fetch categories from the database
        $sql = "SELECT cid, image_loc, categories_type, category_name FROM category WHERE categories_type = 'income'";
        return $this->connection->query($sql);
    }

    function getCategoryExpense(){
        // Fetch categories from the database
       $sql = "SELECT cid, image_loc, categories_type, category_name FROM category WHERE categories_type = 'expense'";
       return $this->connection->query($sql);
   }
    
   function getTransactionData($id){
    $sql = "SELECT * FROM transactions WHERE transaction_id = '$id'";
    return $this->connection->query($sql);
   }
// function update
   function updateTransactionData($id,$date,$remark,$amount){
    $sql="UPDATE transactions SET date='$date',amount='$amount',remark='$remark' WHERE transaction_id='$id'";
    return $this->connection->query($sql);
    }

    // delete function
    function deleteTransactionData($id){
        $sql="DELETE FROM transactions WHERE transaction_id='$id'";
        return $this->connection->query($sql);
    }

    // date sort
    function getSortedData($fromDate,$toDate){
        $userid=$_SESSION['user_id'];
        $sql="SELECT * FROM transactions WHERE date >= '$fromDate' AND date <= '$toDate' AND user_id = '$userid'";
        return $this->connection->query($sql);

    }
    function getGrandTotal(){
        $userid=$_SESSION['user_id'];
        $query="SELECT * FROM transactions WHERE user_id = '$userid' ORDER BY date DESC";
        $result = $this->connection->query($query);
        
        if ($result && $result->num_rows > 0){
            $grandTotal=0;
            while($row = mysqli_fetch_array($result)){
                if($row['exp_type']=='income'){
                    $grandTotal=$grandTotal+$row['amount'];
        
                }
                else{
                    $grandTotal=$grandTotal-$row['amount'];
                }
            }
            return $grandTotal;
        }
        else{
            return 0;
        }
       
    }
    // --------dashboard----
    // function getLatestItem(){
    //     $query="SELECT * FROM expenditures ORDER BY date DESC";
    //     $result = $this->connection->query($query);
        
    // }
    function getCategoryImage($categories){
        $sql="SELECT image_loc FROM category WHERE category_name='$categories'";
        return $this->connection->query($sql);
    }
    function getLastMonthTotal(){
        $userid=$_SESSION['user_id'];
           // Calculate the start and end dates of the last month
        $startDate = date("Y-m-d", strtotime("first day of last month"));
        $endDate = date("Y-m-d", strtotime("last day of last month"));

        // SQL query to fetch data for the last month
        $sql = "SELECT * FROM transactions WHERE date >= '$startDate' AND date <= '$endDate' AND  user_id = '$userid'";

        // Execute the query
        $result= $this->connection->query($sql);
        if ($result && $result->num_rows > 0){
            $grandTotal=0;
        while($row = mysqli_fetch_array($result)){
            if($row['exp_type']=='income'){
                $grandTotal=$grandTotal+$row['amount'];
    
            }
            else{
                $grandTotal=$grandTotal-$row['amount'];
            }
        }
        return $grandTotal;
        }
        else{
            return 0;
        }
        
    }
}

?>   
