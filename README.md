# Markdown engine

### **Problem 4** 

## Description

    Technology used:
    
    1. Command line arguments
    2. Showdown 
    3. PHP
    4. Javascript
    5. Jquery
    6. HTML5
    7: W3css

    
## Setting up and how to start the application

* Install showdown using ```npm install showdown -g```
* Clone the repo into an apache server in your local machine or online 
* Start your apache server
* On your browser, enter ```localhost/mardown-engine``` or ```yourOnlineURL/mardown-engine``` if you have done online hosting.

## Implementation

* To solve this problem I took advantage of showdown which is a the tool that will enable us to convert our markdowns into html.

* From the interface, we request the user to enter the syntax of the markdown they want to be converted. To begin with, I have provided a default syntax that the user can start with. On the right side of the page, I am displaying the results of the generated html file.

* Once the data is received in the backend, PHP creates a new markdown file containing the syntax sent from the form. The name of this file is what we send to showdown using command line arguments.

 _Command line argument syntax:_
``` $com = "showdown makehtml -i " . $page_name . " -o ." . $file_name;```

