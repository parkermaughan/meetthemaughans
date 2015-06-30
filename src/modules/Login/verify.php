<?php 

/** 
 * @author Ryan Naddy <ryan@ryannaddy.com> 
 * @updated 3/15/2015 
 * @note Feel free to replace the pdo found below with the pdo wrapper 
 * @see http://phpsnips.com/616/PDO-Wrapper 
 */ 
if(isset($_POST['submit'])){ 
    $dbHost     = "localhost";  //Location Of Database usually its localhost 
    $dbUser     = "xxxx";   //Database User Name 
    $dbPass     = "xxxxxx";   //Database Password 
    $dbDatabase = "db_name"; //Database Name 
    //Connect to the databasse 
    $db         = new PDO("mysql:dbname=$dbDatabase;host=$dbHost;port=3306", $dbUser, $dbPass); 

    $sql = $db->prepare("SELECT * FROM users_table 
        WHERE username = ? AND 
        password = ? 
        LIMIT 1"); 

    //Lets search the databse for the user name and password 
    //Choose some sort of password encryption, I choose sha256 
    //Password function (Not In all versions of MySQL). 
    $pas = hash('sha256', $_POST['password']); 
     
    $sql->bindValue(1, $_POST["username"]); 
    $sql->bindValue(2, $pas); 

    $sql->execute(); 

    // Row count is different for different databases 
    // Mysql currently returns the number of rows found 
    // this could change in the future. 
    if($sql->rowCount() == 1){ 
        $row                  = $sql->fetch($sql); 
        session_start(); 
        $_SESSION['username'] = $row['username']; 
        $_SESSION['fname']    = $row['first_name']; 
        $_SESSION['lname']    = $row['last_name']; 
        $_SESSION['logged']   = TRUE; 
        header("Location: users_page.php"); // Modify to go to the page you would like 
        exit; 
    }else{ 
        header("Location: login_page.php"); 
        exit; 
    } 
}else{ //If the form button wasn't submitted go to the index page, or login page 
    header("Location: index.php"); 
    exit; 
}
?>