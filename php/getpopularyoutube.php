<!doctype html>
<html>
<head>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript">

    var query = "tove lo";
    

    function onClientLoad() {
        gapi.client.setApiKey('AIzaSyCR5In4DZaTP6IEZQ0r1JceuvluJRzQNLE');
        gapi.client.load('youtube', 'v3', runsearch);
    }

    function runsearch() {
        $.ajax({
            type: "GET",
            url: "./unmarkmostpop.php"
        });

        var request = gapi.client.youtube.search.list({
            part: 'snippet',
            q:query,
            maxResults:6,
            type:"playlist",
        });

        request.execute(function(response) {
            for(i=0; i<response.items.length; i++){
                requestPlaylistFromYoutube(response.items[i].id.playlistId);
            }
        });
    }

    function requestPlaylistFromYoutube(playlistId, pageToken) {
            // Only get the videoIds and the nextpage token
            var videoIds = [];
            var requestOptions = {
                playlistId: playlistId,
                part: 'snippet',
                fields: 'items/snippet/channelTitle,items/snippet/title,items/snippet/resourceId/videoId,nextPageToken',
                maxResults: 50
            };
            
            // If there is a pageToken, add it to the request options
            if (pageToken) {
                requestOptions.pageToken = pageToken;
            }
            
            // Formulate and execute the api request
            var request = gapi.client.youtube.playlistItems.list(requestOptions);
            request.execute(function(response) {
                var ids = [];
                var titles = [];
                
                for(var i=0; i<response.items.length; ++i) {
                    if(response.items[i].snippet.title && response.items[i].snippet.title != 'Private video') {
                        var id = response.items[i].snippet.resourceId.videoId;
                        var title = response.items[i].snippet.title;
                        ids.push(id);
                        titles.push(title);
                    }   
                }
                
                // Append the videoIds to the complete videoIds array
                videoIds = videoIds.concat(ids);
                
                // Start getting metadata of the retrieved videoIds
                storeMetadata(ids, titles, playlistId);
                
                nextPageToken = response.result.nextPageToken;
                // If there is another page of results, retrieve it
                if(nextPageToken) {
                    requestPlaylistFromYoutube(playlistId, nextPageToken);
                }
                // If all videoIds have been retrieved, then store them in session storage
                else {
                    requestOptions = {
                        id: playlistId,
                        part: 'snippet',
                        //fields: 'items/snippet/channelTitle,items/snippet/title,items/snippet/resourceId/videoId,nextPageToken',
                    };
                    request = gapi.client.youtube.playlists.list(requestOptions);
                    request.execute(function(response) {
                        console.log(response);
                        var q = Math.floor(videoIds.length/4);
                        storePlaylist(playlistId, response.items[0].snippet.title, videoIds[0], videoIds[q], videoIds[2*q], videoIds[3*q], videoIds.length); 
                    });             
                }
            });
}

    function storeMetadata(ids, titles, plistId) {
        $.ajax({
            type: 'POST',
            url: './storemetadata.php',
            data: {ids: ids, playlistid: plistId, metadata: titles},
            success: function(data) { console.log(data); },
        });
    }

    function storePlaylist(plistId, t, v1, v2, v3, v4, len) {
        $.ajax({
            type: 'POST',
            url: './storemostpopular.php',
            data: {playlistid: plistId, title: t, vid1: v1, vid2: v2, vid3: v3, vid4: v4, pop: 'yes', length: len},
            success: function(data) { console.log(data); },
        });
    }


</script>
<script src="https://apis.google.com/js/client.js?onload=onClientLoad"></script>
</head>
<html>
