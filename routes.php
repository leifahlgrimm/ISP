<?php

$url = $_SERVER['REQUEST_URI'];
$indexPHPPosition = strpos($url, 'index.php');
$baseUrl = $url;
if(false !== $indexPHPPosition){
    $baseUrl = substr($baseUrl,0,$indexPHPPosition);
}
if(substr($baseUrl,-1) !== '/'){
    $baseUrl .='/';
}

$route = null;
$_SESSION['redirectTarget'] = $baseUrl.'index.php';
if(false !== $indexPHPPosition){
    $route = substr($url, $indexPHPPosition);
    $route = str_replace('index.php', '', $route);
}

// Momentane UserID sowie Warenkorb-Items
$userId = getCurrentUserId();
$countCartItems = getAllProductQuantityFromCart($userId);
// Setzen eines Cookies mit eigener UserID für 30 Tage
setcookie('userId',$userId,strtotime('+30 days'),$baseUrl);

// Startseite
if(!$route){
    $products = getAllProducts();
    require __DIR__.'/templates/main.php';
    exit();
}

// In den Warenkorb
if(strpos($route,'/cart/add/') !== false){
    require __DIR__ . '/actions/addToCart.php';
    exit();
}

// Aus dem Warenkorb entfernen
if(strpos($route,'/cart/remove') !== false){
    require __DIR__ . '/actions/removeFromCart.php';
    exit();
}

// Warenkorb
if(strpos($route,'/cart') !== false){
    $cartItems = getCartItemsForUserId($userId);
    $cartSum = getCartSumForUserId($userId);
    require __DIR__ . '/templates/cartPage.php';
    exit();
}

// Kasse
if(strpos($route,'/checkout') !== false){
    // Wenn nicht eingeloggt, sende zur Loginseite
    if(!isLoggedIn()){
        header("Location: /index.php/login");
        exit();
    }
    // Falls Lieferadresse bereits vorhanden
    // lösche Warenkorb und leite an Bestellbestätigungsseite weiter
    require __DIR__.'/actions/checkout.php';
    // Sonst zeige Seite zum Hinzufügen einer Lieferadresse
    require __DIR__ . '/templates/addressAddPage.php';
    exit();
}

// Hinzufügen einer Adresse
if(strpos($route,'/deliveryAddress/add') !== false){
    // Wenn nicht eingeloggt, sende zur Loginseite
    if(!isLoggedIn()){
        $_SESSION['redirectTarget'] = $baseUrl.'index.php/deliveryAdress/add';
        header("Location: ".$baseUrl."index.php/login");
        exit();
    }
    // Falls POST
    // Füge Adresse hinzu und leite an Bestellbestätigungsseite weiter
    require __DIR__ . '/actions/addAddress.php';
    // Sonst zeige Seite zum Hinzufügen einer neuen Adresse
    require __DIR__ . '/templates/addressAddPage.php';
    exit();
}

// Bestellbestätigung
if(strpos($route,'/thankyou') !== false){
    // Wenn nicht eingeloggt, sende zur Loginseite
    if(!isLoggedIn()){
        $_SESSION['redirectTarget'] = $baseUrl.'index.php/deliveryAdress/add';
        header("Location: ".$baseUrl."index.php/login");
        exit();
    }
    // Sonst zeige Bestellbestätigungsseite
    require __DIR__ . '/templates/thankyou.php';
    exit();
}

// Detailansicht Produkt
if(strpos($route,'/product') !== false){
    $routeParts = explode("/",$route);
    $productId = (int)$routeParts[2];
    if($routeParts[2] === "edit"){
        $productId = (int)$routeParts[3];
    }
    $product = getSingleProduct($productId);
    // Falls Produkt bearbeitet werden soll und User admin ist
    if($routeParts[2] === "edit" and isUserAdmin($userId)){
        // Zeige Seite zum Bearbeiten des Produkts
        require __DIR__ . '/templates/productEditPage.php';
        exit();
    }
    // Sonst zeige Detailansicht des Produkts
    require __DIR__ . '/templates/productDetailView.php';
    exit();
}

// Registrierung
if(strpos($route,'/register') !== false){
    // Falls bereits eingeloggt, sende an Accountseite
    if(isLoggedIn()){
        $_SESSION['redirectTarget'] = $baseUrl.'index.php/register';
        header("Location: ".$baseUrl."index.php/account");
        exit();
    }
    // Falls POST
    // Erstelle Account und leite zur Loginseite weiter
    require __DIR__.'/actions/register.php';
    // Sonst zeige Registrierungsseite
    require __DIR__ . '/templates/register.php';
    exit();
}

// Login
if(strpos($route,'/login') !== false){
    // Falls POST
    // Logge user ein und bewege Warenkorb von Cookie-User zu eingeloggtem User
    // Leite zur Hauptseite weiter
    require __DIR__.'/actions/login.php';
    // Sonst zeige Loginseite
    require __DIR__.'/templates/login.php';
    exit();
}

// Logout
if(strpos($route,'/logout') !== false){
    // Falls nicht eingeloggt, sende Nutzer zur Hauptseite
    if(!isLoggedIn()){
        header("Location: ".$baseUrl."index.php");
        exit();
    }
    // Sonst logge aus und leite an Hauptseite weiter
    require __DIR__.'/actions/logout.php';
    exit();
}

// Accountseite
if(strpos($route,'/account') !== false){
    // Falls nicht eingeloggt, sende Nutzer zur Loginseite
    if(!isLoggedIn()){
        header("Location: ".$baseUrl."index.php/login");
        exit();
    }
    // Falls POST
    // Bearbeite Account und leite an Accountseite weiter
    require __DIR__ . '/actions/editAccount.php';
    // Sonst zeige Accountseite
    require __DIR__ . '/templates/accountPage.php';
    exit();
}

// Produkt hinzufügen (Adminpanel)
if(strpos($route,'/admin/addproduct') !== false){
    // Falls nicht eingeloggt, sende Nutzer zur Loginseite
    if(!isLoggedIn()){
        header("Location: ".$baseUrl."index.php/login");
        exit();
    }
    // Falls kein Admin, sende Nutzer zur Accountseite
    if(!isUserAdmin($userId)){
        header("Location: ".$baseUrl."index.php/account");
        exit();
    }
    // Falls POST
    // Füge Produkt hinzu und leite an Adminseite weiter
    require __DIR__ .'/actions/addProduct.php';
    // Sonst zeige Seite zum Hinzufügen der Kategorie
    require __DIR__ . '/templates/productAddPage.php';
    exit();
}

// Produkt editieren (Adminpanel)
if(strpos($route,'/admin/editproduct') !== false){
    // Falls nicht eingeloggt, sende Nutzer zur Loginseite
    if(!isLoggedIn()){
        header("Location: ".$baseUrl."index.php/login");
        exit();
    }
    // Falls kein Admin, sende Nutzer zur Accountseite
    if(!isUserAdmin($userId)){
        header("Location: ".$baseUrl."index.php/account");
        exit();
    }
    $categories = getAllCategories();
    // Falls POST
    // Bearbeite Produkt und leite an Adminseite weiter
    require __DIR__ .'/actions/editProduct.php';
    // Sonst zeige Seite zum Bearbeiten der Kategorie
    require __DIR__ . '/templates/productEditPage.php';
    exit();
}

// Produkt löschen (Adminpanel)
if(strpos($route,'/admin/deleteproduct') !== false){
    // Falls nicht eingeloggt, sende Nutzer zur Loginseite
    if(!isLoggedIn()){
        header("Location: ".$baseUrl."index.php/login");
        exit();
    }
    // Falls kein Admin, sende Nutzer zur Accountseite
    if(!isUserAdmin($userId)){
        header("Location: ".$baseUrl."index.php/account");
        exit();
    }
    // Lösche Produkt und leite an Adminseite weiter
    $routeParts = explode("/",$route);
    $productId = (int)$routeParts[3];
    deleteProduct($productId);
    header("Location: ".$baseUrl."index.php/admin/");
    exit();
}

// Kategorie hinzufügen (Adminpanel)
if(strpos($route,'/admin/addcategory') !== false){
    // Falls nicht eingeloggt, sende Nutzer zur Loginseite
    if(!isLoggedIn()){
        header("Location: ".$baseUrl."index.php/login");
        exit();
    }
    // Falls kein Admin, sende Nutzer zur Accountseite
    if(!isUserAdmin($userId)){
        header("Location: ".$baseUrl."index.php/account");
        exit();
    }
    // Falls POST
    // Füge Kategorie hinzu und leite an Adminseite weiter
    require __DIR__.'/actions/addCategory.php';
    // Sonst zeige Seite zum Hinzufügen der Kategorie
    require __DIR__ . '/templates/categoryAddPage.php';
    exit();
}

// Kategorie editieren (Adminpanel)
if(strpos($route,'/admin/editcategory') !== false){
    // Falls nicht eingeloggt, sende Nutzer zur Loginseite
    if(!isLoggedIn()){
        header("Location: ".$baseUrl."index.php/login");
        exit();
    }
    // Falls kein Admin, sende Nutzer zur Accountseite
    if(!isUserAdmin($userId)){
        header("Location: ".$baseUrl."index.php/account");
        exit();
    }
    // Falls POST
    // Bearbeite Kategorie und leite an Adminseite weiter
    require __DIR__.'/actions/editCategory.php';
    // Sonst zeige Seite zum Bearbeiten der Kategorie
    require __DIR__ . '/templates/categoryEditPage.php';
    exit();
}

// Kategorie löschen (Adminpanel)
if(strpos($route,'/admin/deletecategory') !== false){
    // Falls nicht eingeloggt, sende Nutzer zur Loginseite
    if(!isLoggedIn()){
        header("Location: ".$baseUrl."index.php/login");
        exit();
    }
    // Falls kein Admin, sende Nutzer zur Accountseite
    if(!isUserAdmin($userId)){
        header("Location: ".$baseUrl."index.php/account");
        exit();
    }
    // Lösche Kategorie und leite an Adminseite weiter
    $routeParts = explode("/",$route);
    $categoryId = (int)$routeParts[3];
    deleteCategory($categoryId);
    header("Location: ".$baseUrl."index.php/admin/");
    exit();
}

// Benutzer editieren (Adminpanel)
if(strpos($route,'/admin/edituser') !== false){
    // Falls nicht eingeloggt, sende Nutzer zur Loginseite
    if(!isLoggedIn()){
        header("Location: ".$baseUrl."index.php/login");
        exit();
    }
    // Falls kein Admin, sende Nutzer zur Accountseite
    if(!isUserAdmin($userId)){
        header("Location: ".$baseUrl."index.php/account");
        exit();
    }
    // Falls POST
    // Bearbeite Nutzer und leite an Adminseite weiter
    require __DIR__.'/actions/editUser.php';
    // Sonst zeige Seite zum Bearbeiten des Nutzers
    require __DIR__ . '/templates/userEditPage.php';
    exit();
}

// Benutzer löschen (Adminpanel)
if(strpos($route,'/admin/deleteuser') !== false){
    // Falls nicht eingeloggt, sende Nutzer zur Loginseite
    if(!isLoggedIn()){
        header("Location: ".$baseUrl."index.php/login");
        exit();
    }
    // Falls kein Admin, sende Nutzer zur Accountseite
    if(!isUserAdmin($userId)){
        header("Location: ".$baseUrl."index.php/account");
        exit();
    }
    // Lösche Nutzer und leite an Adminseite weiter
    $routeParts = explode("/",$route);
    $userId = (int)$routeParts[3];
    deleteUser($userId);
    header("Location: ".$baseUrl."index.php/admin/");
    exit();
}

// Adminpanel
if(strpos($route,'/admin') !== false){
    // Falls nicht eingeloggt, sende Nutzer zur Loginseite
    if(!isLoggedIn()){
        header("Location: ".$baseUrl."index.php/login");
        exit();
    }
    // Falls kein Admin, sende Nutzer zur Accountseite
    if(!isUserAdmin($userId)){
        header("Location: ".$baseUrl."index.php/account");
        exit();
    }
    // Zeige Adminseite
    $users = getAllUsers();
    $products = getAllProducts();
    $categories = getAllCategories();
    require __DIR__ . '/templates/adminPage.php';
    exit();
}