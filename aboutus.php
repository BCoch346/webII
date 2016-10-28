<?php include("includes/functions.inc.php"); ?>

<!DOCTYPE html>
<html lang=en>

<head>
    <meta charset=utf-8 />
    <link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css' />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="css/semantic.js"></script>
    <script src="js/misc.js"></script>

    <link href="css/semantic.css" rel="stylesheet" />
    <link href="css/icon.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />

</head>

<body>

    <header>
        <?php include('includes/header.inc.php'); ?>
    </header>

    <h2 class="ui horizontal divider">
        <i class="tag icon"></i>About Us
    </h2>

    <main>
        <br />
        <div class="ui container grid">
            <div class="bordered ui segments">
                <div class="ui top attached label">
                    <h3>WEB II - Assignment 1</h3>
                </div>
                <div class="ui centered three column grid">
                    <div class="equal height row">
                        <div class="column">
                            <div class="ui segments">
                                <div class="ui top attached label">
                                    <h4 class="header">Course Information</h4>
                                </div>
                                <div class="ui segment">
                                    <p>
                                        <strong>COMP 3512 - 001</strong>
                                        <br />
                                        <strong>Winter 2016</strong>
                                        <br />
                                        <strong>Instructor: </strong>&nbsp; Randy Connolly
                                        <br />
                                        <strong>Lecture: </strong>&nbsp; MW 8:00 - 9:00
                                        <br />
                                        <strong>Lab: </strong>&nbsp; T 9:00 - 10:00
                                        <br />
                                        <strong>Textbook: </strong>&nbsp; Fundamentals of Web Development (Connoly, Hoar)
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="ui segments">
                                <div class="ui top attached label">
                                    <h4 class="header">Assignment Information</h4>
                                </div>
                                <div class="ui segment">
                                    <p>
                                        <strong>Assignment 1</strong>
                                        <br />
                                        <strong>Assigned Date:</strong>&nbsp; October 7, 2016
                                        <br />
                                        <strong>Due Date:</strong>&nbsp;October 22, 2016
                                        <br />
                                        <strong>Course Weight:</strong>&nbsp;11%
                                        <br />
                                        <strong>Objective:</strong>&nbsp; Dynamically generated web pages from a database context using PHP.
                                        <br />
                                        <p></p>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="ui segments">
                                <div class="ui top attached label">
                                    <h4 class="header">Resources</h4>
                                </div>
                                <div class="ui segment">
                                    <strong>Development Environment: </strong>&nbsp; Visual Studio 2015 - Enterprise
                                    <br />
                                    <strong>Languages:</strong>&nbsp; CSS, HTML, PHP, MYSQL
                                    <br />
                                    <strong>Frameworks:</strong>&nbsp;Semantic UI Framework
                                    <br />
                                    <strong>Additional Resources:</strong>&nbsp;Bacon Ipsum. Site content is part of art.db provided by Instructor. Course Textbook
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <br />
        <div class="ui hidden divider"></div>
        <div class="ui bordered segments relaxed container">
            <div class="ui top attached label">
                <h3 class="header">Meet The Team</h3>
            </div>
            <div class="ui hidden divider"></div>
                <div class="ui divided items">
                    <div class="item">
                        <div class="ui small circular image">
                            <img src="https://media.licdn.com/mpr/mpr/shrinknp_400_400/AAEAAQAAAAAAAATaAAAAJDg4Y2JiNzBkLTA2MTAtNGI1YS1hMmYwLTRiOTBlZmViZjFiMQ.jpg" alt="Brandon Cochrane headshot" title="Headshot of Brandon Cochrane" />
                        </div>

                        <div class="ui content">
                            <div class="header">
                                <h3>Brandon Cochrane - Student</h3>
                            </div>
                            <div class="ui segment">
                                <h5>About me:</h5>
                                <p class="text">
                                    Spicy jalapeno bacon ipsum dolor amet hamburger shankle sausage jerky chuck kevin. Spare ribs doner tri-tip andouille leberkas. Turducken short loin burgdoggen short ribs hamburger pancetta. Shoulder kevin boudin short loin. Biltong tenderloin tongue cupim, short ribs jowl shankle burgdoggen ground round landjaeger meatball.
                                </p>
                            </div>

                        </div>
                    </div>

                </div>
            <div class="ui hidden divider"></div>
        </div>

    </main>
    <footer>
        <br />
        <?php include('includes/footer.inc.php'); ?>
    </footer>
</body>
</html>