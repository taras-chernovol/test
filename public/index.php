<?php

define('APPLICATION_ROOT', realpath(dirname(__DIR__)));
define('DOCUMENT_ROOT', realpath(dirname(__DIR__ . '/public')));

define('env', 'local');

// require_once DOCUMENT_ROOT . '/Debug.php';
require_once APPLICATION_ROOT . '/core/Application.php';

Application::processRoute();

session_start();
?>
<!DOCTYPE html >
<html lang="en" class="h-100">
    <head>
        <meta charset="utf-8">
        <title>Test</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
            integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="/vendor/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker.min.css">
        <link rel="stylesheet" href="/styles/main.css">
    </head>
    <body class="d-flex flex-column h-100">
        <div class="container">
            <header class="blog-header py-3">
                <?php require_once APPLICATION_ROOT . '/application/view/menu.php' ?>
            </header>
        </div>

        <main role="main" class="flex-shrink-0">
            <div class="container">
                <?php Application::runController() ?>
            </div>
        </main>

        <footer class="footer mt-auto py-3">
            <div class="container">
                <span class="text-muted"><?php echo date('Y') ?>. Taras Chornovol</span>
            </div>
        </footer>

        <?php if (!empty($_SESSION['messageList'])): ?>
            <div id="messageWrapper">
                <?php foreach ($_SESSION['messageList'] as $message): ?>
                    <div><?php echo $message ?></div>
                <?php endforeach ?>
            </div>
        <?php endif ?>
        <?php unset($_SESSION['messageList']) ?>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
            crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
            integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
            crossorigin="anonymous"></script>
        <script src="/vendor/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.min.js"></script>

        <script>
            $('.form-input__date input').datepicker({});
            $('.alert').alert('close');
        </script>
    </body>
</html>