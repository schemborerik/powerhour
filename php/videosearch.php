<?php

function searchListByKeyword($youtube, $part, $maxResults, $q, $type) {
    $response = $youtube->search->listSearch(
        $part,
        array(
            'maxResults' => $maxResults,
            'q' => $q,
            'type' => $type
        )
    );

    printResults($response);
}

?>