 <?php          if($_SESSION["role"] == "admin") {
                 include(dirname(__DIR__).'/includes/adminNavbar.php'); }
                else if($_SESSION["role"] == "staff") {
                    include(dirname(__DIR__).'/includes/staffNavbar.php');
                } else if ($_SESSION["role"] == "user") {
                    include(dirname(__DIR__).'/includes/userNavbar.php');
                }
            ?>