<?php
    require_once("./inc/db.php");

    if (session_status() === PHP_SESSION_NONE) {
         session_start();
        $modify = false;
        $adding = false;
    }
    

    $errors = [];

     if (isset($_POST["email"])){
       //  die("email found");
        if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/",htmlspecialchars($_POST["email"]))){
            $errors["email"] = "Please enter a valid email address";
        }
    }


    if (isset($_POST["buttons"])){
        
        $values = explode(',', htmlspecialchars($_POST['buttons'])); 
        $action = $values[0];
        $userId = $values[1];

        switch ($action)
        {
            case 'add':
                $adding = true;
                break;
            
            case 'delete':
                require("./action/delete.php");
                break;

            case 'modify':
                $modify = true;
                break;
            case 'update':
                require("./action/update.php");
                $modify = false;
                break;
            case 'append':
                $adding = false;
                require("./action/add.php");
                break;
            
        }
    }

   // reload the table
    require_once("./action/select.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Users</title>
</head>
<body>
    <section>
        <div id="userTable">
            <table>
                <tr>
                    <th>Id</th>
                    <th>Surname</th>
                    <th>Fisrt Name</th>
                    <th>Email</th>
                    <th>Post Code</th>
                    <th colspan="2">Actions</th>
                    <th><form method="post">
                                <button  id='btnAdd' value="add," name='buttons'>Add</button>
                            </form> 
                    </th>
                </tr>
                <?php foreach($users as $user) :     
                    $_SESSION["user"] = $user ?>
                    <tr class="userLine">
                        <?php if ($modify && $userId == $user['id']) : ?>
                            <form method="post">
                                <td><?= $user['id'] ?>
                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                </td>
                                <td><input type="text" name="surname" value="<?= htmlspecialchars($user['surname'])?>"></td>
                                <td><input type="text" name="first_name" value="<?= htmlspecialchars($user['first_name'])?>"></td>
                                <td><input type="text" name="email" value="<?= htmlspecialchars($user['email']) ?>"></td>
                                <td><input type="text" name="post_code" value="<?= htmlspecialchars($user['post_code'])?>"></td>
                                <td>
                                    <button  id='btnUpdate' value="update,<?php echo $user['id'] ?>"] name='buttons'>Update</button>
                                    <button  id='btnCancel' value="cancel,<?php echo $user['id'] ?>" name='buttons'>Cancel</button> 
                                </td>
                                 <?php $modify = false;?> 
                            </form>
                        <?php elseif ($adding) : ?>
                            <form method="post">
                                <td></td>
                                <td><input type="text" name="surname" value="<?= htmlspecialchars($user['surname'])?>"></td>
                                <td><input type="text" name="first_name" value="<?= htmlspecialchars($user['first_name'])?>"></td>
                                <input type="email" id="email" name="email" required placeholder="Email address" value="<?php echo $modifying == true ? $user['email'] : ""; ?>" />
                                <td><input type="text" name="post_code" value="<?= htmlspecialchars($user['post_code'])?>"></td>
                                <td>
                                    <button  id='btnUpdate' value="append,<?php echo $user['id'] ?>"] name='buttons'>Append</button>
                                    <button  id='btnCancel' value="cancel,<?php echo $user['id'] ?>" name='buttons'>Cancel</button> 
                                </td>
                                 <?php $modify = false;?> 
                            </form>
                        <?php else: ?>
                            <td><?php echo $user['id']?></td>
                            <td><?php echo $user['surname'] ?></td>
                            <td><?php echo $user['first_name'] ?></td>
                            <td><?php echo $user['email'] ?></td>
                            <td><?php echo $user['post_code'] ?></td>
                          
                            <td> 
                                <form method="post">
                                    <button  id='btnDelete' value="delete,<?php echo $user['id'] ?>"] name='buttons'>Delete</button>
                                    <button  id='btnModify' value="modify,<?php echo $user['id'] ?>" name='buttons'>Modify</button>
                                </form> 
                           </td>
                        <?php endif; ?>  
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </section>
</body>
</html>