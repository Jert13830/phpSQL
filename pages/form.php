<?php
require_once '../inc/db.php';
session_start();

$modifying = false;

$errors = [];

     if (isset($_POST["email"])){
       //  die("email found");
        if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/",htmlspecialchars($_POST["email"]))){
            $errors["email"] = "Please enter a valid email address";
        }
    }


if (isset($_GET["action"]) && $_GET["action"] == "modify") {
    if (htmlspecialchars($_GET["action"]) === "modify") {
        $modifying = true;
    } else {
        $modifying = false;
    }
    $query = $db->prepare("SELECT * FROM users where id = :id");
    $query->bindParam("id", $_GET["user"]);
    $query->execute();
    $user = $query->fetch();
}

if (isset($_POST["submit"])){
    if ($modifying)
    {
        require("../action/update.php");
    }
    else {
        require("../action/add.php");
    }

}

if (isset($_POST["btnCancel"])){
    echo "Canceling";
    Header("Location: ./index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Form</title>
</head>

<body>
    <section>
 
        <form method="post" enctype = "multipart/form-data" id="userForm">
           <div id="formContent">
                <div id="names">
                    <label for="surname">Surname :</label>
                    <input type="text" id="surname" name="surname" required placeholder="Surname" value="<?php echo $modifying == true ? $user['surname'] : ""; ?>" />
                    <label for="firstname">First name :</label>
                    <input type="text" id="firstname" name="firstname" required placeholder="First name" value="<?php echo $modifying == true ? $user['first_name'] : ""; ?>" />
                </div>
                <div id="email">
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" required placeholder="Email address" value="<?php echo $modifying == true ? $user['email'] : ""; ?>" />
                </div>
                <?php if(isset($errors["email"])) echo "<p>" . $errors["email"] . "</p>" ?>
           
            <div id="postcode">
                <label for="postcode">Post code :</label>
                <input type="text" id="postcode" name="postcode" required placeholder="Post code" value="<?php echo $modifying == true ? $user['post_code'] : ""; ?>" />
            </div>
           
            <div id="buttons">
                <button type="submit" id="submit" name="submit">Submit</button>
                <button type="reset" id="btnCancel" name="btnCancel" >Reset</button>
            </div>
            
                
            </div>
        </form>
    </section>
</body>

</html>