<?PHP
session_start();

require_once('session.php');
require 'config.php';

$idag = $_SESSION['id'];
$_SESSION['idag'] = $walo;
$_SESSION['useri'] = $walo;

$update = false;

$id_Agence = "";
$date_ajt = "";
$Nom_Agence_ar = "";
$Ville_ar = "";
$Adresse_ar = "";
$NOM = "";
$Tel_AG = "";
$Login = "";
$Passwd = "";
$Adresse = "";
$Ville = "";
$nbr_cnx = "";


$email = "";
$id_agence = $_SESSION['id'];

$user = $_SESSION['user'];
//ici c ' est  l'ajout des clients
if (isset($_POST['add'])) {
    $id_Agence = $_POST['id_Agence'];
    $date_ajt = $_POST['date_ajt'];
    $Nom_Agence_ar = $_POST['Nom_Agence_ar'];
    $Ville_ar = $_POST['Ville_ar'];
    $Adresse_ar = $_POST['Adresse_ar'];
    $NOM = addslashes($_POST['Nom_Agence']);
    $Tel_AG = $_POST['Tel_AG'];
    $Login = $_POST['Login'];
    $Passwd = md5(md5(($_POST['Passwd'])));
    $Ville = addslashes($_POST['Ville']);
    $email = $_POST['email'];
    $Adresse = addslashes($_POST['Adresse']);
    $nbr_cnx = $_POST['nbr_cnx'];


    $active = $_POST['active'];


    //  $id_agence = $_SESSION['id'];
    $query1 = "SELECT * FROM Agences WHERE Nom='$NOM' and Telephone='$Tel_AG' and upper(Compte)=upper('$Login') ";

    $result2 = mysqli_query($mysqli, $query1);
    $total_data = mysqli_num_rows($result2);
    if ($total_data > 0) {
        $row = mysqli_fetch_array($result2);
        $already_existe = $row["id"];
        header("location:Client.php?edit=$already_existe");

        $_SESSION['response'] = "Ce Client Existe déja, Vous pouvez proceder à sa Mise à Jour";
        $_SESSION['res_type'] = "danger";
    } else {
        $query1 = "SELECT * FROM Agences WHERE upper(Compte)=upper('$Login') ";
        $result2 = mysqli_query($mysqli, $query1);
        $total_data = mysqli_num_rows($result2);
        if ($total_data > 0) {
            header("location:Client.php");

            $_SESSION['response'] = "Login déjà éxiste essayer de le changer!";
            $_SESSION['res_type'] = "danger";
            $_SESSION['verif'] = array(
                //'id_Agence' => $id_Agence,
                //'date_ajt' => $date_ajt,
                'Nom_Agence_ar' => $Nom_Agence_ar,
                'Ville_ar' => $Ville_ar,
                'Adresse_ar' => $Adresse_ar,
                'Nom_Agence' => $_POST['Nom_Agence'],
                'Tel_AG' => $Tel_AG,
                'Login' => $Login,
                'NOM' => $NOM,
                //'Passwd' => "",
                'Ville' => $_POST['Ville'],
                'email' => $email,
                'Adresse' => $_POST['Adresse'],
                'nbr_cnx' => $_POST['nbr_cnx'],
            );
        } else {
            $reponse = mysqli_query($mysqli, "INSERT INTO `Agences` (`Nom`,`الإسم`,`Adresse`,`العنوان`,`ville`,`المدينة`,`Telephone`,`Compte`,`Mot_Passe`,`email`,`nbr_connect`)
                  
                                     VALUES('$NOM','$Nom_Agence_ar','$Adresse','$Adresse_ar','$Ville','$Ville_ar','$Tel_AG','$Login','$Passwd','$email','$nbr_cnx')");

            /*$reponse1 = mysqli_query($mysqli, "SELECT * FROM Agences WHERE Nom='$NOM' and Compte='$Login'");
            $row = mysqli_fetch_array($reponse1);
            $Num_Permis = $row['Num_Permis'];
            $reponse_historique = mysqli_query($mysqli, "INSERT INTO `historique_client` VALUES('$Num_Permis','$Type_Permis','$NOM','$Prenom','$Adresse','$Ville','$Telephone','$email','$id_agence')");*/

            header("location:Client.php");

            $_SESSION['response'] = "Inséré avec succès dans la base de donnée !.";
            $_SESSION['res_type'] = "success";
        }
    }
}
//ici c'est  la supprission des clients
if (isset($_GET['delete'])) {

    $idd = $_GET['delete'];
    $reponse2 = mysqli_query($mysqli, "SELECT * FROM Agences WHERE id='$idd'");

    $row = mysqli_fetch_array($reponse2);
    $NOM = $row['Nom'];;
    $Tel_AG = $row['Telephone'];
    $Login = $row['Compte'];
    $Passwd = $row['Mot_Passe'];
    $Ville = $row['ville'];
    $email = $row['email'];
    $Adresse = $row['Adresse'];
    $id_ag = $row['id'];

    $reponse_historique1 = mysqli_query($mysqli, "INSERT INTO `historique_agences` SELECT * FROM Agences WHERE id='$idd'");

    if ($reponse_historique1 > 0) {

        $query = "DELETE FROM Agences WHERE  id='$idd'";
        $result = mysqli_query($mysqli, $query);

        if ($result > 0) {
            header("location: Client.php");

            $_SESSION['response'] = "Supprimé avec succès!.";
            $_SESSION['res_type'] = "danger";
        }
    }
}
//ici  faire display les informations des clients

if (isset($_GET['verif'])) {
    $update = true;
}

if (isset($_GET['edit'])) {

    $_SESSION['idd'] = $_GET['edit'];
    $idd = $_SESSION['idd'];
    $query = "SELECT * FROM Agences WHERE id='$idd'";
    $result = mysqli_query($mysqli, $query);
    $row = mysqli_fetch_array($result);

    $Nom_Agence = $row['Nom'];
    $Tel_AG = $row['Telephone'];
    $Login = $row['Compte'];
    //$Passwd= $row['Mot_Passe'];
    $Ville = $row['ville'];
    $email = $row['email'];
    $Adresse = $row['Adresse'];
    $nbr_cnx = $row['nbr_connect'];
    $id_ag = $row['id'];
    $id_Agence = $row['id_Agence'];
    $date_ajt = $row['date_con'];
    $Nom_Agence_ar = $row['الإسم'];
    $Ville_ar = $row['المدينة'];
    $Adresse_ar = $row['العنوان'];

    $_SESSION['idag'] = $id_ag;
    $_SESSION['useri'] = $Login;
    $update = true;

}

//ici en a faire la modification des clients
if (isset($_POST['update'])) {
    $idd = $_SESSION['idd'];
    $_SESSION['idperx'] = $idd;

    $id_Agence = $_POST['id_Agence'];
    $date_ajt = $_POST['date'];
    $NOM = addslashes($_POST['Nom_Agence']);
    $Tel_AG = $_POST['Tel_AG'];
    $Login = $_POST['Login'];
    $Passwd = md5(md5(($_POST['Passwd'])));
    $Ville = addslashes($_POST['Ville']);
    $email = $_POST['email'];
    $Adresse = addslashes($_POST['Adresse']);

    $id_Agence = $_POST['id_Agence'];
    $Nom_Agence_ar = $_POST['Nom_Agence_ar'];
    $Ville_ar = $_POST['Ville_ar'];
    $Adresse_ar = $_POST['Adresse_ar'];
    $nbr_cnx = $_POST['nbr_cnx'];

    $query1 = "SELECT * FROM Agences WHERE upper(Compte)=upper('$Login') and id<>'$idd' ";
    $result2 = mysqli_query($mysqli, $query1);
    $total_data = mysqli_num_rows($result2);
    if ($total_data > 0) {
        header("location:Client.php?verif=true");

        $_SESSION['response'] = "Login déjà éxiste essayer de le changer!";
        $_SESSION['res_type'] = "danger";
        $_SESSION['verif'] = array(
            'id_Agence' => $id_Agence,
            'date_ajt' => $date_ajt,
            'Nom_Agence_ar' => $Nom_Agence_ar,
            'Ville_ar' => $Ville_ar,
            'Adresse_ar' => $Adresse_ar,
            'Nom_Agence' => $_POST['Nom_Agence'],
            'Tel_AG' => $Tel_AG,
            'Login' => $Login,
            'NOM' => $NOM,
            //'Passwd' => "",
            'Ville' => $_POST['Ville'],
            'email' => $email,
            'Adresse' => $_POST['Adresse'],
            'nbr_cnx' => $_POST['nbr_cnx'],
        );
    } else {
        $Passwd = ($Passwd=="")?"":",Mot_Passe='$Passwd'";
        $query = "UPDATE Agences SET  Nom='$NOM',الإسم='$Nom_Agence_ar',Adresse='$Adresse',العنوان='$Adresse_ar',ville='$Ville',المدينة='$Ville_ar',Telephone='$Tel_AG', Compte='$Login'".$Passwd.", email='$email',nbr_connect='$nbr_cnx' WHERE id='$idd'";

        /* $reponse_historique2 =mysqli_query($db,"INSERT INTO `historique_admin`(`id_client`, `id_agent`, `id_compteur`, `nom`, `prenom`, `adresse`, `cin`, `password`, `secteur`, `active`, `id_categorie`, `numero_serie`, `type`, `id_admin`, `action`) VALUES('$id_client','----','----','$nom','$prenom','$adresse','$cin','----','----','$active','$id_categorie','----','----','$user','modifier')");
        */
        $result = mysqli_query($mysqli, $query);
        // header("location: Client.php");

        if ($result > 0) {
            header("location: Client.php");
//echo $id;
            $_SESSION['response'] = "Mise à jour réussie!. $NOM";
            $_SESSION['res_type'] = "primary";

        }

    }
}