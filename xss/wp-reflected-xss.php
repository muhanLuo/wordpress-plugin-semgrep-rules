<?php

// example key-value: name=%3Cscript%3Econfirm%28%29%3C%2Fscript%3E
function dangerousEchoUsage() {
    $name = $_REQUEST['name'];
    // ruleid: wp-reflected-xss
    echo("Hello : $name");
    // ruleid: wp-reflected-xss
    echo "Hello : " . $name;
}

function dangerous_sprintf()
{
    // ruleid: wp-reflected-xss
    $message = sprintf("My name is %s and I am %d years old.", $_REQUEST['name'], $_REQUEST['age']);
    return $message;
}

function safeEchoUsage() {
    $name = $_REQUEST['name'];
    // ok: wp-reflected-xss
    echo "Hello : " . htmlentities($name);
}

function doSmth() {
    $name = $_REQUEST['name'];
    // ruleid: wp-reflected-xss
    echo "Hello :".$name;
}

function doSmth2() {
    // ruleid: wp-reflected-xss
    echo "Hello ".$_GET['name']." !";
}

function doSmth3() {
    $name = $_GET['name'];
    if (str_contains($name, 'foobar')) {
        // ruleid: wp-reflected-xss
        die("Hello :".$name);
    }
}

function doSmth4() {
    // ruleid: wp-reflected-xss
    echo "Hello ".htmlentities($_GET['name'])." !".$_GET['lastname'];
}

function doSmth5() {
     // ruleid: wp-reflected-xss
    printf("Hello %s", $_GET['name']);
}

function doSmth6() {
   $VAR = $_GET['someval'];
    if(isset($VAR)){ 
        // ruleid: wp-reflected-xss
        echo $VAR; 
    }
}

function doSmth7() {
    $VAR = $_GET['someval'];
     if(empty($VAR)){ 
         // ruleid: wp-reflected-xss
         echo $VAR; 
     }
 }

function doOK1() {
    // ok: wp-reflected-xss
    echo "Hello ".htmlentities($_GET['name'])." !";
}

function doOK2() {
    $input = $_GET['name'];
    // ok: wp-reflected-xss
    echo "Hello ".htmlspecialchars($input)." !";
}

function doOK3() {
    $safevar = "Hello ".htmlentities(trim($_GET['name']));
    // ok: wp-reflected-xss
    echo $safevar;
}

function doOK4() {
    // ok: wp-reflected-xss
    echo "Hello ".sanitize_text_field($_GET['name'])." !";
}

function doOK5() {
    $safevar = esc_attr($_GET['name']);
    // ok: wp-reflected-xss
    echo "Hello $safevar !";
}

function doOK6() {
    $safevar = "Hello ".htmlentities($_GET['name']);
    // ok: wp-reflected-xss
    echo $safevar;
}

function doOK7() {
    $safevar = "Hello ".htmlspecialchars($_GET['name']);
    // ok: wp-reflected-xss
    echo $safevar;
}

function doOK8() {
    // ok: wp-reflected-xss
    echo "Hello ".isset($_GET['name'])." !";
}

function doOK9() {
    $safevar = empty($_GET['name']);
    // ok: wp-reflected-xss
    echo "Hello $safevar !";
}

