<!DOCTYPE html>
<?php session_start();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Markdown engine</title>

    <link rel="stylesheet" href="assets/css/w3css.css">
</head>

<script src="assets/js/jquery.js"></script>
<script>
    $(document).ready(function() {
        $("#content").load("backend/<?php if (isset($_SESSION['file_name'])) {
                                        echo $_SESSION['file_name'];
                                    } else {
                                        echo "init.html";
                                    } ?> ")
    });
</script>

<body>

    <?php
    //get error/success messages
    if (isset($_SESSION["msgType"]) && isset($_SESSION["Msg"])) {
        $MSG_TYPE = $_SESSION["msgType"];
        $MSG = $_SESSION["Msg"];
        $_SESSION["msgType"] = "";
        $_SESSION["Msg"] = "";

        echo '<div class="w3-panel w3-round w3-';
        echo $MSG_TYPE;
        echo 'w3-display-container w3-card" id="alert">
            <span onclick="this.parentElement.style.display="none"" class="w3-button w3-round w3-hover-white w3-small w3-display-topright">&times;</span>
            <p>';
        echo $MSG;
        echo '</p>
        </div>';
    }
    ?>

    <div class="w3-row-padding">

        <div class="w3-col s12 m8 l8 ">
            <div class="w3-card-4">
                <div class="w3-container w3-brown">
                    <h2>Markdown Engine</h2>
                </div>
                <form class="w3-container" method="POST" action="backend/create-markdown.php">
                    <p>
                        <label class="w3-text-brown"><b>File name</b></label>
                        <input class="w3-input w3-border w3-round w3-sand" name="file_name" type="text">
                    </p>
                    <p>
                    <div class="w3-right w3-ripple w3-tag w3-round w3-brown" style="padding:3px; cursor: pointer;" onclick="document.getElementById('markdown').value = ''">
                        <div class="w3-tag w3-round w3-brown w3-border w3-border-white">
                            Write your own markdown
                        </div>
                    </div>
                    <label class="w3-text-brown"><b>Markdown code</b></label>

                    <textarea class="w3-input w3-border w3-round w3-sand" name="markdown" id="markdown" cols="30" rows="10"># Markdown: Syntax

- [Overview](#overview)
  - [Philosophy](#philosophy)
  - [Inline HTML](#html)
  - [Automatic Escaping for Special Characters](#autoescape)
- [Block Elements](#block)
  - [Paragraphs and Line Breaks](#p)
  - [Headers](#header)
  - [Blockquotes](#blockquote)
  - [Lists](#list)
  - [Code Blocks](#precode)
  - [Horizontal Rules](#hr)
- [Span Elements](#span)
  - [Links](#link)
  - [Emphasis](#em)
  - [Code](#code)
  - [Images](#img)
- [Miscellaneous](#misc)
  - [Backslash Escapes](#backslash)
  - [Automatic Links](#autolink)

**Note:** This document is itself written using Markdown; you
can [see the source for it by adding '.text' to the URL](/projects/markdown/syntax.text).

---
</textarea>
                    </p>
                    <p>
                        <button class="w3-btn w3-round w3-block w3-brown">Submit</button>
                    </p>
                </form>
            </div>
        </div>

        <label for="" class=""><u>Rendered html</u></label>
        <div class="w3-col s12 m4 l4 " id="content">
            &nbsp;
        </div>
    </div>
</body>

</html>