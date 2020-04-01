function getConnection(){
    connection_str = $.post("../api/db.php");
    console.log("Connection String :" + connection_str);
}