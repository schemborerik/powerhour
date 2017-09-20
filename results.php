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
            <a class="page-scroll" href="./#mostpopular">Popular</a>
          </li>
          <li>
            <a class="page-scroll" href="./#about">About</a>
          </li>
          <li>
            <a class="page-scroll" href="./#contact">Contact</a>
          </li>
          <li>
            <div id="noti_Container">
							<a class="page-scroll" href="./mylist.html">My List</a>
							<div class="noti_bubble" style="display:none"></div>
						</div>
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
		<div>
			<button id="prev" class="btn">Prev</button>
			<button id="next" class="btn">Next</button>
		</div>
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

		$(document).ready(function(){
			if(sessionStorage.getItem('myListMap_size') > 0) {
				$(".noti_bubble").text(sessionStorage.getItem('myListMap_size'));
				$(".noti_bubble").show();
				console.log(sessionStorage.getItem('myListMap_size'));
			}
		});

    var totalVideoCount = 0;
    var videoIds = [];
    var playlistId;
    var thumbnails = [];
    var query = getQueryVariable("search_query");
    if(!query) {
      window.location.replace("index.php");
    }
		
		var nextPageToken;
		var prevPageToken;
		$(document).ready(function() {
			$("#next").click(function() {
				$("#search-results").empty();
				thumbnails=[];
				search(nextPageToken);
			}); 
			
			$("#prev").click(function() {
				$("#search-results").empty();
				thumbnails=[];
				search(prevPageToken);
			});
		});

    function onClientLoad() {
      gapi.client.setApiKey('AIzaSyCR5In4DZaTP6IEZQ0r1JceuvluJRzQNLE');
      gapi.client.load('youtube', 'v3', onYouTubeApiLoad);
    }

    function onYouTubeApiLoad() {
      search();
    }

    function search(pagetoken) {
      var request = gapi.client.youtube.search.list({
        part: 'snippet',
        q:query,
        maxResults:12,
				pageToken:pagetoken,
        type:"playlist",
 				order:"viewCount"
    	});
      request.execute(onSearchResponse);
    }

    function onSearchResponse(response) 
    {
			
			
			nextPageToken = response.nextPageToken;
			$("#next").prop("disabled", nextPageToken == null);
				
			prevPageToken = response.prevPageToken;
			$("#prev").prop("disabled", prevPageToken == null);
			
			console.log(nextPageToken);
			console.log(prevPageToken);
			
      for(var i=0; i<response.items.length; ++i)
      {
        var playlistTitle = response.items[i].snippet.title;
        var playlistId = response.items[i].id.playlistId;
        var thumbnail_url = response.items[i].snippet.thumbnails.medium.url;
				
				var col = document.createElement("div");
				col.className = "col-md-4 videoGridItem";
				
				var plistDiv = document.createElement("div");
				plistDiv.className = "videoInfo";
				col.appendChild(plistDiv);
				
				var link = document.createElement("a");
				link.href = "./playlist.html?plist=" + playlistId;
				plistDiv.appendChild(link);
				
				var thumbnailContainer = document.createElement("div");
				thumbnailContainer.className= "thumbnailContainer";
				link.appendChild(thumbnailContainer);
				
				var thumbnail = document.createElement("img");
				thumbnail.src = thumbnail_url;
				thumbnail.className ="img-responsive videoInfoImg centeredVertically";
				thumbnailContainer.appendChild(thumbnail);
				
				var caption = document.createElement("div");
				caption.className = "caption";
				link.appendChild(caption)
				
				var titlePara = document.createElement("p");
				titlePara.className = "videoInfoText centeredVertically";
				caption.appendChild(titlePara);
				
				var titleNode = document.createTextNode(playlistTitle);
				titlePara.appendChild(titleNode);
				
				thumbnails.push(col);

        var thumb = "<div class='col-sm-6 portfolio-item'>";
        thumb += "<a href=./playlist.html?plist=" + playlistId + " class='portfolio-link' data-toggle='modal'>";
        thumb += "<div class='caption'><div class='caption-content'>";
        thumb += playlistTitle;
        thumb += "</div></div>";
        thumb += "<img src='" + thumbnail_url + "'>";
        thumb += "</a>";
        thumb += "</div>";
        //thumbnails.push(thumb);
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
