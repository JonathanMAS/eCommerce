<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
            <title><?php echo $pagetitle; ?></title>
            <link rel="stylesheet" type="text/css" href="<?php echo File::build_HTMLpath(array("style", "css", "styles.css"))?>">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                    <link rel="icon" type="image/png" href="<?php echo File::build_HTMLpath(array("style", "img", "favicon.png"))?>" />
                    </head>
    
    <body>
        
        <header>
            <?php
                require_once( File::build_path(array("view", "nav", "firstNav_no_resp.php")));
                require_once( File::build_path(array("view", "nav", "secondNav_no_resp.php")));
                require_once( File::build_path(array("view", "nav", "nav_resp.php")));
                ?>
        </header>
        
        <?php
            
            $filepath = File::build_path(array("view", "$controller", "$view.php"));
            require $filepath;
            ?>
        
        <footer>
            <?php
                require_once( File::build_path(array("view", "footer", "footer.php")));
                ?>
        </footer>
    </body>
    
</html>
