<?php

echo "<div class=\"navbar-title-container\">";
echo "<h1 class=\"navbar-title\">Movie Blog</h1>";
echo "</div>";
echo "<nav class=\"navbar\">";

echo "<h3 class=\"navbar-username-container\">";
if (isset($_SESSION["username"])) {
    //echo $_SESSION["username"];
    echo "Logged in as <span class=\"navbar-username\">" . $_SESSION["username"] . "</span>";
}
echo "</h3>";
echo "<div class=\"nav-mobile-menu-container\" onclick=\"showMenu()\">";
echo "<img src=\"images/bars.png\" class=\"nav-mobile-menu\" />";
echo "</div>";
echo "<ul class=\"nav-items\">";
echo "<li class=\"nav-item nav-item-index\">";
echo "<button onclick=\"location.href='index.php'\">Home</button>";
echo "</li>";
echo "<li class=\"nav-item nav-item-about\">";
echo "<button onclick=\"location.href='about.php'\">About</button>";
echo "</li>";
//if visitor role hide this
if (isset($_SESSION["role"]) && $_SESSION["role"] != "Visitor") {
    echo "<li class=\"nav-item nav-item-archive\">";
    echo "<button onclick=\"location.href='archive.php'\">Archive</button>";
    echo "</li>";
    //logout button here
    echo "<li class=\"nav-item nav-item-login\">";
    echo "<button onclick=\"location.href='logout.php'\">Logout</button>";
    echo "</li></ul>";
    echo "</nav>";
} else {
    //login button because they are visitor
    echo "<li class=\"nav-item nav-item-login\">";
    echo "<button onclick=\"location.href='login.php'\">Login</button>";
    echo "</li></ul>";
    echo "</nav>";
}
