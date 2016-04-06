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
  <link href="css/kylecss.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

</head>

<body id="page-top" class="index">

  <!-- Navigation -->
  <nav class="navbar navbar-default navbar-fixed-top navbar-shrink">
    <div class="container">

      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header page-scroll">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand page-scroll" href="./#page-top">Hour of Power</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li class="hidden">
            <a href="./#page-top"></a>
          </li>
          <li>
            <a class="page-scroll" href="./#mostpopular">Most Popular</a>
          </li>
          <li>
            <a class="page-scroll" href="./#about">About</a>
          </li>
          <li>
            <a class="page-scroll" href="./#contact">Contact</a>
          </li>
          <li>
            <a class="page-scroll" href="./myplaylist.html">My List</a>
          </li>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
  </nav>
	
	<section>
	<div class="container">
		<form class="navbar-form" role="search" id="search_bar" action="results.php" method="GET">
			<div class="input-group" id="mid-page">
				<input type="text" class="form-control searchBar" name="search_query" id="query_bot" value="<?php echo $_GET["search_query"] ?>">
				<div class="input-group-btn">
					<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
				</div>
			</div>
		</form>
		<div class="row" id="search-results">
	</div>

	</section>

</body>

<!-- jQuery -->
<script src="js/jquery.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/lodash.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="js/classie.js"></script>


<!-- Contact Form JavaScript -->
<script src="js/jqBootstrapValidation.js"></script>

<!-- Custom Theme JavaScript -->
<script src="js/agency.js"></script>

<title>Search Results</title>

<script type = "text/javascript">

    var totalVideoCount = 0;
    var videoIds = [];
    var playlistId;
    var thumbnails = [];
    var query = getQueryVariable("search_query");
    if(!query) {
      window.location.replace("index.php");
    }
		//$(document).ready(function(){
			//$(".searchBar").val(query);
		//});

    function onClientLoad() {
      gapi.client.setApiKey('AIzaSyCR5In4DZaTP6IEZQ0r1JceuvluJRzQNLE');
      gapi.client.load('youtube', 'v3', onYouTubeApiLoad);
    }

    function onYouTubeApiLoad() {
      search();
    }

    function search() {
      var request = gapi.client.youtube.search.list({
        part: 'snippet',
        q:query,
        maxResults:10,
        type:"playlist",
    				//author: "Most Popular",
    				order:"viewCount",
    	});
      request.execute(onSearchResponse);
    }

    function onSearchResponse(response) 
    {
      for(var i=0; i<response.items.length; ++i)
      {
        var playlistTitle = response.items[i].snippet.title;
        var playlistId = response.items[i].id.playlistId;
        var thumbnail_url = response.items[i].snippet.thumbnails.medium.url;

        var thumb = "<div class='col-sm-6 portfolio-item'>";
        thumb += "<a href=./playlist.html?plist=" + playlistId + " class='portfolio-link' data-toggle='modal'>";
        thumb += "<div class='caption'><div class='caption-content'>";
        thumb += playlistTitle;
        thumb += "</div></div>";
        thumb += "<img src='" + thumbnail_url + "'>";
        thumb += "</a>";
        thumb += "</div>";
        thumbnails.push(thumb);
      }

      $(document).ready(function(){
        for(i = 0; i <thumbnails.length; i++)
        {
          $("#search-results").append(thumbnails[i]);
        }
      });
    }

    function getQueryVariable(variable)
    {
      var query = window.location.search.substring(1);
      var vars = query.split("&");
      for (var i=0;i<vars.length;i++) 
      {
        var pair = vars[i].split("=");
        if(pair[0] == variable){return pair[1];}
      }
      return(false);
    }

</script>
<script src="https://apis.google.com/js/client.js?onload=onClientLoad"></script>

</html>