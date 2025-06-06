<?php
session_start();
include 'tu_conexion.php'; // si tienes un archivo de conexión

// obtener datos del formulario
$email = $_POST['email'];
$password = $_POST['password'];

// consulta para verificar usuario
$query = "SELECT * FROM users WHERE email = '$email'";
$result = pg_query($conn, $query);
$user = pg_fetch_assoc($result);

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['username'] = $user['firstname'] . ' ' . $user['lastname'];
    header("Location: dashboard.php");
} else {
    echo "Credenciales inválidas";
}
?>


   $email= $_POST['e_mail'];
   $passw= $_POST['p_assw'];

  // $hashed_password = password_hash($passw, PASSWORD_DEFAULT);
   $hashed_password = $passw;
   $sql ="
     
            SELECT
           --u.id,
            COUNT(u.id) as total
        FROM
            users u 
        WHERE
            email= '$email' and 
            password= '$hashed_password'
            --group by
            	--id
   ";

   $res=pg_query($conn, $sql);
   if ($res){
        $row = pg_fetch_assoc($res);
        if($row['total']>0){

             $sql_data ="
     
            SELECT
           u.id, u.firstname
        
        FROM
            users u 
        WHERE
            email= '$email' and 
            password= '$hashed_password'
            LIMIT 1
    
   ";
   $res_data=pg_query($conn, $sql_data);
    $row_data = pg_fetch_assoc($res_data);
    $_SESSION['users_id']=$row_data['id'];
    $_SESSION['users_name']=$row_data['firstname'];
            header('Refresh:0; URL=http://localhost/pet-store2/src/');
        }else{

            echo "<script>alert( 'Login failed !!!')</script>";
            header('Refresh:0;URL=http://localhost/pet-store2/src/login.html');

        }

   }

?>
