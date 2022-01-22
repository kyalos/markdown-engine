<?php
session_start();

//empty message variables
unset($_SESSION["msgType"]);
unset($_SESSION["Msg"]);

// If form is submitted, insert values into the database.



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["file_name"])) {

        $_SESSION["msgType"] = "red";
        $_SESSION["Msg"] = "File name is required";

        header("location: ../index.php");
        exit();
    } else {
        $file_name = test_input($_POST["file_name"]);

        // Concatenate file name with  backslash
        $file_name = $file_name . '\ ';

        // Using str_ireplace() function 
        // to remove all whitespaces  
        $file_name = str_ireplace(' ', '', $file_name);

        $_SESSION['file_name'] = "." . $file_name;
    }

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


    $myfile = fopen("markdown" . "$random_id.md", "w") or die("Unable to open file!");
    $txt = $markdown;


    fwrite($myfile, $txt);
    fclose($myfile);

    $page_name = "markdown" . "$random_id.md";

    // $com = "showdown makehtml -i markd.md -o .\sample_readme.html";

    //command line argument to create a markdown file
    $com = "showdown makehtml -i " . $page_name . " -o ." . $file_name;

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
