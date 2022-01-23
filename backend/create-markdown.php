<?php
session_start();

//empty message variables
unset($_SESSION["msgType"]);
unset($_SESSION["Msg"]);

// If form is submitted, insert values into the database.



if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty($_POST["markdown"])) {
        $_SESSION["msgType"] = "red";
        $_SESSION["Msg"] = "markdown is required";

        header("location: ../index.php");
        exit();
    } else {
        $markdown = test_input($_POST["markdown"]);
    }


    // generate code for file
    $length = 4;
    $characters = 'abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $random_id = $randomString;

    //create a new markdown file and populate with markdown syntax

    $myfile = fopen("markdown" . "$random_id.md", "w") or die("Unable to open file!");
    $txt = $markdown;


    fwrite($myfile, $txt);
    fclose($myfile);

    $page_name = "markdown" . "$random_id.md";


    //command line argument to create a markdown file
    $com = "showdown makehtml -i " . $page_name . " -o .\sample.html";

    //store file name in a session for rendering.
    $_SESSION['file_name'] = "sample.html";


    $output = shell_exec($com);

    $_SESSION["msgType"] = "green";
    $_SESSION["Msg"] = $output;

    header("location: ../index.php");
    exit();
}

// data cleaner
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
