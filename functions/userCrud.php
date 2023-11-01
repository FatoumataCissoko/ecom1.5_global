<?php
/**
 * Create user 
 * 
  */
function createUser(array $data)
{
    global $conn;
    /**
     * Création du'une requete SQL préparée 
     * en vue  d'une insertion 
     */
    $query = "INSERT INTO user VALUES (NULL, ?, ?, ?)";

    /**
     * utilisation de la fonction php mysqli_prepare() 
     * pour préparer la requete et créer le statement.
     * Cela vérifie que la connexion est bonne 
     * et que la requete est valide sur la DB utilisée
     */
    if ($stmt = mysqli_prepare($conn, $query)) {
        /** Lecture des marqueurs (les 3 "?" dans la query)
         * Et on bind les param 
         * en indiquant leur type ( s = string, i = integer)
         * en donnant la valeur des param a inserer dans la DB ($data[key])
         */
        mysqli_stmt_bind_param(
            $stmt,
            "sss",
            $data['user_name'],
            $data['email'],
            $data['pwd']
        );

        /* Exécution de la requête */
        $result = mysqli_stmt_execute($stmt);
    }
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

function selectUserByIdAssoc(int $id)
{
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM user WHERE id = " . $id);

    // avec fetch row : tableau indexé
    $data = mysqli_fetch_assoc($result);

    return $data;
}

function updateUser(array $data)
{
    global $conn;

    $query = "UPDATE user SET user_name = ?, email = ?, pwd = ?
            WHERE user.id = ?;";

    if ($stmt = mysqli_prepare($conn, $query)) {

        mysqli_stmt_bind_param(
            $stmt,
            "sssi",
            $data['user_name'],
            $data['email'],
            $data['pwd'],
            $data['id'],
        );

        /* Exécution de la requête */
        $result = mysqli_stmt_execute($stmt);
    }
}

function deleteUser(int $id)
{
    global $conn;

    $query = "DELETE FROM user
                WHERE user.id = ?;";

    if ($stmt = mysqli_prepare($conn, $query)) {

        mysqli_stmt_bind_param(
            $stmt,
            "i",
            $id,
        );

        /* Exécution de la requête */
        $result = mysqli_stmt_execute($stmt);
    }
}
?>