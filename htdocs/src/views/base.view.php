<?php
/**
 * src/views/base.view.php
 *  Squelette de base pour l'affichage des pages web
 */
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0, minimum-scale=1.0">

        <title>Base View</title>

        <!-- Link required CSS dynamically -->
    </head>

    <body>
        <div class="container">
            <header>
                <h1>Main single page title</h1>

                <?php
                    if (array_key_exists('menu', $controller->getGlobalControllers())) {
                        $menuController = $controller->getGlobalControllers()['menu'];
                        echo $menuController->renderView();
                    }
                ?>
            </header>

            <main>
                <?php echo $controller->renderView(); ?>
            </main>

            <footer>
                <!-- Display footer (from the footerController) -->
            </footer>
        </div>

        <!-- For web purpose only : add required JS script tags -->
    </body>
</html>