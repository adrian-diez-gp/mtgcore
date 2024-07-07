<div id="navbar-wrapper">
    <div id="navbar">
    <ul>
        <?php
            if (isset($_COOKIE['rol'])) {
                $rol = $_COOKIE['rol'];
                if ($rol == 'admin') {
                    $navbarItems = array('home','noticias','admin','perfil');
                } else if ($rol == 'user') {
                    $navbarItems = array('home','noticias','inscripciones','perfil');
                } 
            } else {
                $navbarItems = array('home','noticias','registro','login');
            }
    
            foreach ($navbarItems as $item) {
                $upper_case_item = strtoupper($item);

                $admin_true = $upper_case_item == 'ADMIN' ? 'admin-tab' : '';

                if (strtoupper($crumb) == $upper_case_item) {
                    echo('<li class="selected '.$admin_true.'"><a href="'.$item.'.php">'.$upper_case_item.'</a></li>');
                }
                else {
                    echo('<li class="'.$admin_true.'"><a href="'.$item.'.php">'.$upper_case_item.'</a></li>');
                }
            }
        ?>
        </ul>
    </div>
    <div id="admin-dropdown-container" style="display: none;">
    </div>
    <?php
        if (isset($_COOKIE['rol'])) {
            echo('
            <a class="login-btn" href="logout.php">
                <span>
                    Log out
                </span>
            </a>');
        } else {
            echo('
                <a class="login-btn" href="login.php">
                    <span>
                        Log in
                    </span>
                </a>'
        );
        }
    ?>

    
</div>