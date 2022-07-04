<?php

use Model\Pages;

require_once "./bootstrap.php";

$rootDir = '/bit_pp8';

// Login

session_start();
if (
    isset($_POST['login'])
    && !empty($_POST['username'])
    && !empty($_POST['password'])
) {
    if (
        $_POST['username'] === 'admin' &&
        $_POST['password'] === 'admin'
    ) {
        $_SESSION['logged-in'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['username'] = $_POST['username'];
    } else {
        print('<script type="text/javascript">alert("Wrong username or password.");</script>');
    }
}

// Logout

if (isset($_GET['action']) == 'logout') {
    session_start();
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    unset($_SESSION['logged-in']);
    session_destroy();
    print('<script type="text/javascript">alert("You have been logged out successfully.");</script>');
    header('Location:' . $rootDir . '/admin');
}

// Delete page logic

if (isset($_POST['delete'])) {
    $id = $_POST['delete'];
    $update = $entityManager->find('Model\Pages', $id);
    $entityManager->remove($update);
    $entityManager->flush();
    header('Location:' . $rootDir . '/admin');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>
    <link rel="stylesheet" href="./src/css/styles.css">
    <link rel="stylesheet" href="./src/css/admin.css">
</head>

<body>
    <div class="container">
        <?php

        if (!isset($_SESSION['logged-in'])) {
            print('<div align="center"><h4>Enter your login information</h4>
                   <div class="login-info">
                        <p>Login : admin </p>
                        <p>Password : admin </p>
                   </div>
                   <form class="login-form" action="" method="post">
                        <input type="text" name="username" placeholder="username = admin" required><br>
                        <input type="password" name="password" placeholder="password = admin" required><br>
                        <button class="login-btn" type="submit" name="login">Login</button>
                   </form></div>');
        } else {
            print('<header><nav>
                <ul>
                    <li><a href="./admin">Admin</a></li>
                    <li><a href="./">View Project</a></li>
                    <li><a href=?action=logout>Logout</a></li>
                </ul>
            </nav></header>');
            print('<table>
            <tr>
                <th>Page</th>
                <th>Actions</th>
            </tr>');

            $nav = $entityManager->getRepository("Model\Pages")->findAll();

            foreach ($nav as $link) {

                print('<tr>
                       <td>' . $link->getPageName() . '</td>');

                $link->getId() === 1 ?
                    print('<td>
                        <form action="" method="POST">
                            <input type="hidden" name="current_name" value="' . $link->getPageName() . '" />
                            <input type="hidden" name="current_content" value="' . $link->getPageContent() . '" />
                            <input type="hidden" name="current_id" value="' . $link->getId() . '" />
                            <button type="submit" name="edit-page" value="">Edit</button>
                        </form>
                        </td>
                    </tr>') :
                    print('<td>
                            <form action="" method="POST">
                                <input type="hidden" name="current_name" value="' . $link->getPageName() . '" />
                                <input type="hidden" name="current_content" value="' . $link->getPageContent() . '" />
                                <input type="hidden" name="current_id" value="' . $link->getId() . '" />
                                <button type="submit" name="edit-page" value="">Edit</button>
                            </form>        
                            <form action="" method="POST">
                                <button type="submit" name="delete" value="' . $link->getId() . '" onclick="return confirm(\'Are you sure?\')">Delete</button>
                            </form>
                       </td>
                </tr>');
            }
            print('</table>');

            print('<form class="new-entry" action="" method="POST">
                    <button type="submit" name="add-page">Add New Page</button>
                </form>');

            // Add page

            if (isset($_POST['add-page'])) {
                print('<form class="page-mod" action="" method="POST">
                        <label for="title">Title</label><br>
                        <input type="text" name="new-title" class="title-input"><br>
                        <label for="content">New Content</label><br>
                        <textarea name="new-content" cols="100" rows="30"></textarea><br>
                        <button type="submit" name="add-content">Create Page</button>
                   </form>');
            }
            if (isset($_POST['add-content'])) {
                $title = $_POST['new-title'];
                $content = $_POST['new-content'];
                if (!empty($title)) {
                    $newPage = new Pages();
                    $newPage->setPageName($title);
                    $newPage->setPageContent($content);
                    $entityManager->persist($newPage);
                    $entityManager->flush();
                    header('Location:' . $rootDir . '/admin');
                }
            }

            // Update page

            if (isset($_POST['edit-page'])) {
                print('<form class="page-mod" action="" method="POST">
                            <input type="hidden" name="current_id" value="' . $_POST['current_id'] . '">
                            <label for="title">Title</label><br>
                            <input class="title-input" type="text" name="edit-title" value="' . $_POST['current_name'] . '"><br>
                            <label for="content">Page Content</label><br>
                            <textarea name="edit-content" cols="100" rows="30">' . $_POST['current_content'] . '</textarea><br>
                            <button type="submit" name="update-page">Update Page</button>
                       </form>');
            }
            if (isset($_POST['update-page'])) {
                $id = $_POST['current_id'];
                $title = $_POST['edit-title'];
                $content = $_POST['edit-content'];
                if (!empty($title)) {
                    $update = $entityManager->find('Model\Pages', $id);
                    $update->setPageName($title);
                    $update->setPageContent($content);
                    $entityManager->persist($update);
                    $entityManager->flush();
                    header('Location:' . $rootDir . '/admin');
                }
            }
        }

        ?>
    </div>
</body>

</html>