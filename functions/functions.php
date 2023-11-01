<?php

function showData($title, $data)
{
    echo "</br></br><h2>" . $title . "</h2>";
    var_dump($data);
}

function selectUserByIdIndex($id)
{
    // récupérer une ligne dans user
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM user WHERE id = " . $id);

    // avec fetch row : tableau indexé
    $data = mysqli_fetch_row($result);

    return $data;
}

function selectUserByIdAssoc($id)
{
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM user WHERE id = " . $id);

    // avec fetch row : tableau indexé
    $data = mysqli_fetch_assoc($result);

    return $data;
}

function getAllUsersAssoc()
{
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM user");

    $data = [];
    $i = 0;
    while ($rangeeData = mysqli_fetch_assoc($result)) {
        $data[$i] = $rangeeData;
        $i++;
    };

    /* $imax = mysqli_num_rows($result);

    for ($i = 0; $i < $imax; $i++) {
        $rangeeData = mysqli_fetch_assoc($result);
        $data[$i] = $rangeeData;
    } */

    return $data;
}


function getAllUsersIndex()
{
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM user");

    $data = [];
    $i = 0;
    while ($rangeeData = mysqli_fetch_row($result)) {
        $data[$i] = $rangeeData;
        $i++;
    };

    /* $imax = mysqli_num_rows($result);

    for ($i = 0; $i < $imax; $i++) {
        $rangeeData = mysqli_fetch_row($result);
        $data[$i] = $rangeeData;
    } */

    return $data;
}


//Creation de ma fonction global
function createUser($data){
    global $conn;

    //creation d'une requete SQL preparer en vue d'une insertion
    $query = "INSERT INTO user VALUES(NULL,?,?,?)";

    // L'utilisation de ma fonction php mysqli_prepare(),pour preparer ma requete et creer le statement.
    //et cela permet de verifier que la connexion est bonne et la requete est valider sur la BD utilisee

    if ($stmt = mysqli_prepare($conn ,$query)) {

        //lecture des marqueurs (les 3 '?' dans la query)
        // Et on bind les param
        //en indiquant leur type (s=string , i=integer)
        //en donnant la valeur des param a inserer dans la BD($data[key])

        mysqli_stmt_bind_param($stmt,"sss",$data['user_name'],$data['email'],$data['pwd']);

        //Execution de la requete
        $result=mysqli_stmt_execute($stmt);
    }
}
 function updateUser($data) {
    global $conn;
    $query = "UPDATE user
                SET 'user_name' = ? , 'email' = ? 
                WHERE 'user.id' = ? ;";
    
    if ($stmt= mysqli_prepare($conn,$query)){

        mysqli_stmt_bind_param(
            $stmt,
            "sssi",
            $data['user_name'],
            $data['email'],
            $data['user_id'],
            $data['pwd'],
            $data['id'],
        );
        $result=mysqli_stmt_execute($data);
    }
 }
 function unlink($data) {
    global $conn;
    
 }
?>
