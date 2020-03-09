<?php
    /**
     * Assignment: Final Project (Final Diet)
     * Date: April 29th, 2019
     * Class: CSE383E
     * Members: Asim Fauzi, Alex Kwon
     */
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Final Diet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/stylesheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="./js/function.js?v=3"></script>
    <link rel="shortcut icon" type="image/x-icon" href="./images/ban.png"/>
</head>
<body> 
    <div id="loginPage">
        <h1>
            <p>Diary App</p>
        </h1>
        <div class="container container-fluid">
            <div class="row">
                <div class ="col-md-12">     
                    <label for="user">User:</label>
                    <input type="text" name="user" class="form-control" id="user">
                </div>
            </div>
        <div class="row">
            <div class ="col-md-12">     
                <label for="password">Password:</label>
                <input type="text" name="password" class="form-control" id="password">
            </div>
        </div>
        <br>
            <button type="button" id="login">Log in</button>
            <br>
            <br>
            <br>
            <br>
            <br>
            <button type="button" id="authorPageButton">Authors</button>
        </div> 
        
    </div>
    <div id="authorPage">
    <h1>Authors</h1>
    <div class="container container-fluid">
        <div class="row">
            <div class="col-md-3">
                <img src="./images/me.jpg" class="img-responsive img-rounded img-fluid" alt="">
            </div>
            <div class="col-md-6 ml-2">
                <p id="myName"><strong>Alex Kwon</strong></p>
                <p>
                    I am Alex Kwon, a junior Computer Science Major with a Business Analytics Minor at Miami University.
                    I was born and raised in Seoul, South Korea. My mission statement is: to give positive influence to the people
                    around me and one day to give that influence to beyond those people. 
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 ml-2">
            <img src="./images/me2.JPG" class="img-responsive img-rounded img-fluid" alt="">
            </div>
            <div class="col-md-6">
                <p id="myName"><strong>Asim Fauzi</strong></p>
                <p>
                    I am Asim Fauzi, a junior Computer Science Major with a Statistics Minor at Miami University.
                    I was born and raised in Athens, Ohio. My mission statement is: to travel the world, eat good food, and start my own
                    international business and non-profit.
                </p>
            </div>
        </div>
        <br><br><br><br><br><br><br>
        <button type="button" id="loginPageButton">Log in</button>
    </div>
    </div>
    <div id="diaryPage">
        <h1>
            <p>Diary App</p>
        </h1>
        <div class="container container-fluid">
            <div class="row">
                <div class ="col text-center" id="buttons">     
                </div>
            </div>
            <div class="row">
                <div class ="col align-self-center">     
                    <table class="table" id = "itemSummary">
                        <thead>
                            <tr>
                                <th scope="col">Item</th>
                                <th scope="col">Count</th>
                            </tr>
                        </thead>
                        <tbody id="summaryBody">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class ="col align-self-center">     
                    <table class="table" id ="timestampTbl">
                        <thead>
                            <tr>
                                <th scope="col">Item</th>
                                <th scope="col">Timestamp</th>
                            </tr>
                        </thead>
                        <tbody id="timestampBody">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
