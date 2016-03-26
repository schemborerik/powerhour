<!--
  "index.php"
  This page uses the youtube api in order to load the videoIds from a playlistId.
  As it gets the videoIds, it sends them to the server through an ajax call to
  "server.php". The server then scrapes youtube for the metadata and stores it all
  in the database. Additionally, it stores the videoIds in a session variable so when
  this page redirects to the player, the videoIds are stored in the session variable.

  TODO
  -Before even calling the youtube api, it should check if the playlist is on the
  database, in which case it shouldn't even call the youtube api as all the info is
  in the database
  -Most of kyle's work should be incorporated here as his work is used to get the
  playlistId which my code then uses
  -Additionally, I think user's should be able to pick more than one playlist as most
  aren't at least 60 videos. This wouldn't be too difficult as the play.php just needs
  the videoIds stored in the session variable and then pulls the metadata from the
  database
  -fix search IDs into classes since we use them in 2 different spots
-->

<?php
include("./php/setpopularyoutube.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Hour of Power</title>

  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="css/agency.css" rel="stylesheet">
  <link href="css/freewall.css">

  <!-- Custom Fonts -->
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
</head>

<body id="page-top" class="index">
  <!-- Navigation -->
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header page-scroll">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand page-scroll" href="#page-top">Hour of Power</a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li class="hidden">
            <a href="#page-top"></a>
          </li>
          <li>
            <a class="page-scroll" href="#mostpopular">Popular</a>
          </li>
          <li>
            <a class="page-scroll" href="#about">About</a>
          </li>
<!--           <li>
            <a class="page-scroll" href="#team">Team</a>
          </li> -->
          <li>
            <a class="page-scroll" href="#contact">Contact</a>
          </li>
          <li>
            <a class="page-scroll" href="./show.html">My List</a>
          </li>
        </ul>
        <div id="topsearch" class="col-sm-4 col-md-4">
          <form class="navbar-form" role="search" id="search_bar" action="results.html" method="GET">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search" name="search_query" id="query_top">
              <div class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
  </nav>

  <!-- Header -->
  <header>
    <div class="container">
      <form class="navbar-form" role="search" id="search_bar" action="results.html" method="GET">
        <div class="input-group" id="mid-page">
          <input type="text" class="form-control" name="search_query" id="query_bot" placeholder="Start Searching, So We Can Start Drinking!">
          <div class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
          </div>
        </div>
      </form>
      <div class="intro-text">
        <div class="intro-lead-in">You Look A Little Thirsty!</div>
        <div class="intro-heading">We Can Fix That.</div>
        <a href="#mostpopular" class="page-scroll btn btn-xl">Let's Drink!</a>
      </div>
    </div>
  </header>

  <!-- Services Section -->
  <section id="mostpopular">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading">Most Popular</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4 portfolio-item">
          <a href="playlist.html?plist=<?php echo $mostpopularids[0];?>" class="portfolio-link" data-toggle="modal">
            <div class="caption">
              <div class="caption-content">
                <?php echo $titles[0]; ?>
                <!--<i class="fa fa-search-plus fa-3x">HELLO</i>-->
              </div>
            </div>

            <table>
             <tr>
              <td><img src="http://img.youtube.com/vi/<?php echo $vid1[0]; ?>/mqdefault.jpg" width="180px" alt=""></td>
              <td><img src="http://img.youtube.com/vi/<?php echo $vid2[0]; ?>/mqdefault.jpg" width="180px" alt=""></td>
            </tr>
            <tr>
              <td><img src="http://img.youtube.com/vi/<?php echo $vid3[0]; ?>/mqdefault.jpg" width="180px" alt=""></td>
              <td><img src="http://img.youtube.com/vi/<?php echo $vid4[0]; ?>/mqdefault.jpg" width="180px" alt=""></td>
            </tr>
          </table>
        </a>
      </div>
      <div class="col-sm-4 portfolio-item">
        <a href="playlist.html?plist=<?php echo $mostpopularids[1]?>" class="portfolio-link" data-toggle="modal">
          <div class="caption">
            <div class="caption-content">
              <?php echo $titles[1] ?>
            </div>
          </div>
          <table id="table1">
           <tr>
            <td><img src="http://img.youtube.com/vi/<?php echo $vid1[1]; ?>/mqdefault.jpg" width="180px" alt=""></td>
            <td><img src="http://img.youtube.com/vi/<?php echo $vid2[1]; ?>/mqdefault.jpg" width="180px" alt=""></td>
          </tr>
          <tr>
            <td><img src="http://img.youtube.com/vi/<?php echo $vid3[1]; ?>/mqdefault.jpg" width="180px" alt=""></td>
            <td><img src="http://img.youtube.com/vi/<?php echo $vid4[1]; ?>/mqdefault.jpg" width="180px" alt=""></td>
          </tr>
        </table>
      </a>
    </div>
    <div class="col-sm-4 portfolio-item">
      <a href="playlist.html?plist=<?php echo $mostpopularids[2]?>" class="portfolio-link" data-toggle="modal">
        <div class="caption">
          <div class="caption-content">
            <?php echo $titles[2] ?>
          </div>
        </div>
        <table>
         <tr>
          <td><img src="http://img.youtube.com/vi/<?php echo $vid1[2]; ?>/mqdefault.jpg" width="180px" alt=""></td>
          <td><img src="http://img.youtube.com/vi/<?php echo $vid2[2]; ?>/mqdefault.jpg" width="180px" alt=""></td>
        </tr>
        <tr>
          <td><img src="http://img.youtube.com/vi/<?php echo $vid3[2]; ?>/mqdefault.jpg" width="180px" alt=""></td>
          <td><img src="http://img.youtube.com/vi/<?php echo $vid4[2]; ?>/mqdefault.jpg" width="180px" alt=""></td>
        </tr>
      </table>
    </a>
  </div>
  <div class="col-sm-4 portfolio-item">
    <a href="playlist.html?plist=<?php echo $mostpopularids[3]?>" class="portfolio-link" data-toggle="modal">
      <div class="caption">
        <div class="caption-content">
          <?php echo $titles[3] ?>
        </div>
      </div>
      <table>
       <tr>
        <td><img src="http://img.youtube.com/vi/<?php echo $vid1[3]; ?>/mqdefault.jpg" width="180px" alt=""></td>
        <td><img src="http://img.youtube.com/vi/<?php echo $vid2[3]; ?>/mqdefault.jpg" width="180px" alt=""></td>
      </tr>
      <tr>
        <td><img src="http://img.youtube.com/vi/<?php echo $vid3[3]; ?>/mqdefault.jpg" width="180px" alt=""></td>
        <td><img src="http://img.youtube.com/vi/<?php echo $vid4[3]; ?>/mqdefault.jpg" width="180px" alt=""></td>
      </tr>
    </table>
  </a>
</div>
<div class="col-sm-4 portfolio-item">
  <a href="playlist.html?plist=<?php echo $mostpopularids[4]?>" class="portfolio-link" data-toggle="modal">
    <div class="caption">
      <div class="caption-content">
        <?php echo $titles[4] ?>
      </div>
    </div>
    <table>
     <tr>
      <td><img src="http://img.youtube.com/vi/<?php echo $vid1[4]; ?>/mqdefault.jpg" width="180px" alt=""></td>
      <td><img src="http://img.youtube.com/vi/<?php echo $vid2[4]; ?>/mqdefault.jpg" width="180px" alt=""></td>
    </tr>
    <tr>
      <td><img src="http://img.youtube.com/vi/<?php echo $vid3[4]; ?>/mqdefault.jpg" width="180px" alt=""></td>
      <td><img src="http://img.youtube.com/vi/<?php echo $vid4[4]; ?>/mqdefault.jpg" width="180px" alt=""></td>
    </tr>
  </table>
</a>
</div>
<div class="col-sm-4 portfolio-item">
  <a href="playlist.html?plist=<?php echo $mostpopularids[5]?>" class="portfolio-link" data-toggle="modal">
    <div class="caption">
      <div class="caption-content">
        <?php echo $titles[5] ?>
      </div>
    </div>
    <table>
     <tr>
      <td><img src="http://img.youtube.com/vi/<?php echo $vid1[5]; ?>/mqdefault.jpg" width="180px" alt=""></td>
      <td><img src="http://img.youtube.com/vi/<?php echo $vid2[5]; ?>/mqdefault.jpg" width="180px" alt=""></td>
    </tr>
    <tr>
      <td><img src="http://img.youtube.com/vi/<?php echo $vid3[5]; ?>/mqdefault.jpg" width="180px" alt=""></td>
      <td><img src="http://img.youtube.com/vi/<?php echo $vid4[5]; ?>/mqdefault.jpg" width="180px" alt=""></td>
    </tr>
  </table>
</a>
</div>
</div>
</div>
</section>
<!-- freewall -->
</section>

<!--popular among users -->


<!-- freewall -->
</section>

<!-- About Section -->
<section id="about">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h2 class="section-heading">What Is This Thing?</h2>
        <h3 class="section-subheading text-muted">This is an app used to create your own custom power hour playlist. You pick the songs, we'll handle the rest.</h3>
        <h3 class="section-subheading text-muted">Every time the song changes, take a shot of beer. It's that simple.</h3>
          <h3 class="section-subheading text-muted">This application was made to fill 
            the need of video power hours on the web. Don't you want something
            cool to watch while you drink? But who wants to put in the work of downloading videos,
            cutting them up, and putting them together. That's why we're here. To
            make life simple. We like to drink and we know you do, too.</h3>
          </div>
        </div>
      </section>

      <!-- Team Section -->
<!--       <section id="team">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 text-center">
              <h2 class="section-heading">Our Team</h2>
              <h3 class="section-subheading text-muted">We're Just A Couple Of Guys Trying To Make The World A Better Place.</h3>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-4">
              <div class="team-member">
                <img src="img/team/mike_profile.jpg" class="img-responsive img-circle" alt="">
                <h4>Mike Rogers</h4>
                <p class="text-muted">Downloader/Developer</p>
                <ul class="list-inline social-buttons">
                  <li><a href="#"><i class="fa fa-twitter"></i></a>
                  </li>
                  <li><a href="#"><i class="fa fa-facebook"></i></a>
                  </li>
                  <li><a href="#"><i class="fa fa-linkedin"></i></a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="team-member">
                <img src="img/team/erik_profile.jpg" class="img-responsive img-circle" alt="">
                <h4>Erik Schembor</h4>
                <p class="text-muted">Developer</p>
                <ul class="list-inline social-buttons">
                  <li><a href="#"><i class="fa fa-twitter"></i></a>
                  </li>
                  <li><a href="#"><i class="fa fa-facebook"></i></a>
                  </li>
                  <li><a href="#"><i class="fa fa-linkedin"></i></a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="team-member">
                <img src="img/team/kyle_profile.jpg" class="img-responsive img-circle" alt="">
                <h4>Kyle Lyke</h4>
                <p class="text-muted">Developer</p>
                <ul class="list-inline social-buttons">
                  <li><a href="#"><i class="fa fa-twitter"></i></a>
                  </li>
                  <li><a href="https://www.facebook.com/kyle.lyke.5"><i class="fa fa-facebook"></i></a>
                  </li>
                  <li><a href="https://www.linkedin.com/profile/view?id=230107629&trk=nav_responsive_tab_profile"><i class="fa fa-linkedin"></i></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section> -->

      <section id="contact">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 text-center">
              <h2 class="section-heading">Contact Us At dick@butt.com</h2>
              <h3 class="section-subheading text-muted">We're Still Working On Our Domain.</h3>
            </div>
          </div>
        </div>
      </section>

      <footer>
        <div class="container">
          <div class="row">
            <div class="col-md-4">
              <span class="copyright">Copyright &copy; Your Website 2014</span>
            </div>
            <div class="col-md-4">
              <ul class="list-inline social-buttons">
                <li><a href="#"><i class="fa fa-twitter"></i></a>
                </li>
                <li><a href="#"><i class="fa fa-facebook"></i></a>
                </li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a>
                </li>
              </ul>
            </div>
            <div class="col-md-4">
              <ul class="list-inline quicklinks">
                <li><a href="#">Privacy Policy</a>
                </li>
                <li><a href="#">Terms of Use</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>


      <!-- jQuery -->
      <script src="js/jquery.js"></script>
      <script src="js/jquery-ui.min.js"></script>
      <script src="js/lodash.js"></script>

      <!-- Bootstrap Core JavaScript -->
      <script src="js/bootstrap.min.js"></script>

      <!-- Plugin JavaScript -->
      <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
      <script src="js/classie.js"></script>
      <script src="js/cbpAnimatedHeader.js"></script>

      <!-- Contact Form JavaScript -->
      <script src="js/jqBootstrapValidation.js"></script>

      <!-- Custom Theme JavaScript -->
      <script src="js/agency.js"></script>
      <script src="js/freewall.js"></script>


      <script type="text/javascript">
      function onClientLoad() {
        gapi.client.setApiKey('AIzaSyCR5In4DZaTP6IEZQ0r1JceuvluJRzQNLE');
        gapi.client.load('youtube', 'v3');
      }

      function test(){
        console.log("you pressed enter");
      }
      $(window).scroll(function() {
        if ($(document).scrollTop() > 130) {
          $('#topsearch').fadeIn("slow");
        } else {
          $('#topsearch').fadeOut("slow");
        }
      });


      </script>

      <script src="https://apis.google.com/js/client.js?onload=onClientLoad"></script>
    </body>

    </html>
