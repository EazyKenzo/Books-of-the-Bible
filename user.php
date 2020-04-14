<?php
require 'db_connect.php';
require 'login/vendor/autoload.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$set = false;
$userId = $auth->getUserId();

try {
    if (!$_SESSION['admin'])
        throw new Exception("You must be an admin to make changes to the database");

    if (isset($id)) {
        $set = true;

        $query = "SELECT * FROM users WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $user = $statement->fetchAll()[0];
    }
} catch (Exception $e) {
    $_SESSION['message'] = 'Error: ' . $e->getMessage();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport"
              content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>
            Project
        </title>
        <link rel="stylesheet"
              href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Amaranth">
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Lora">
        <link rel="stylesheet"
              href="assets/fonts/ionicons.min.css">
        <link rel="stylesheet"
              href="assets/css/Article-Clean.css">
        <link rel="stylesheet"
              href="assets/css/Contact-Form-Clean.css">
        <link rel="stylesheet"
              href="assets/css/Footer-Dark.css">
        <link rel="stylesheet"
              href="assets/css/Highlight-Blue.css">
        <link rel="stylesheet"
              href="assets/css/Login-Form-Dark.css">
        <link rel="stylesheet"
              href="assets/css/styles.css">
    </head>

    <body style="background-color: rgb(56,66,67);color: #ffffff;font-family: Amaranth, sans-serif;">
        <?php require 'header.php' ?>
        <div class="contact-clean"
             style="padding: 0px;background-color: #384243;">
            <div style="background-image: url(&quot;assets/img/bible.jpg&quot;);background-size: cover;background-position: center;padding: 80px 0px;">
                <form id="book_edit"
                      method="post"
                      style="background-color: rgba(56,66,67,0.76);color: rgba(45,45,45,0.85);"
                      action="process.php<?php if ($set): ?>?id=<?= $id ?><?php endif ?>">
                    <h2 class="text-center"
                        style="color: #c6c6c6;">
                        User
                        <br>
                    </h2>
                    <div class="form-group">
                        <label>Username</label>
                        <input
                                class="form-control"
                                type="text"
                                name="username"
                                required=""
                                maxlength="100" <?php if ($set): ?> value="<?= $user['username'] ?>" disabled<?php else: ?>required=""<?php endif ?>>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input
                                class="form-control"
                                type="email"
                                name="email"
                                required=""
                                maxlength="249"
                                inputmode="email"<?php if ($set): ?> value="<?= $user['email'] ?>" disabled<?php else: ?>required=""<?php endif ?>>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input
                                class="form-control"
                                type="password"
                                name="password"
                                maxlength="255"
                                <?php if ($set): ?>placeholder="Enter a new password (optional)"
                                <?php else: ?>required=""<?php endif ?>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input"
                               type="checkbox"
                               id="formCheck-1"
                               name="admin"<?php if ($set && $auth->admin()->doesUserHaveRole($user['id'], \Delight\Auth\Role::ADMIN)): ?> checked <?php endif ?>>
                        <label class="form-check-label"
                               for="formCheck-1">Admin
                        </label>
                    </div>
                    <div class="form-group d-flex d-xl-flex justify-content-center justify-content-xl-center"
                         style="margin: 30px 0px 0px 0px;width: 100%;">
                        <button class="btn btn-secondary"
                                type="submit"
                                name="command"
                                value="update"
                                style="background-color: rgba(220,53,69,0.83);width: 109px;margin: 0px 15px;">
                            SAVE
                        </button>
                        <?php if ($set): ?>
                            <button class="btn btn-secondary"
                                    type="submit"
                                    name="command"
                                    value="delete"
                                    style="background-color: rgba(220,53,69,0.83);width: 109px;margin: 0px 15px;"
                                    onclick="return confirm('Are you sure you wish to delete this user?')">
                                DELETE
                            </button>
                        <?php endif ?>
                        <a
                                class="text-uppercase border rounded border-dark"
                                href="users.php"
                                style="width: 109px;border-color: green;margin: 0px 15px;padding: 16px 32px;background-color: rgba(220,53,69,0.77);color: rgba(255,255,255,0.88);font-size: 13px;font-weight: bold;">CANCEL
                        </a>
                    </div>
                    <input class="form-control"
                           type="hidden"
                           name="operation"
                           value="users">
                </form>
            </div>
        </div>
        <?php require 'footer.php' ?>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>