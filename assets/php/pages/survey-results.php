<?php
    include("../connection/connection.php");
    include("../functions.php");
    $totalNumber = count(fetchAllFromDatabase('survey'));
    $html = "<h3 class='font-large'>Results</h3><ul id='surveyResults' class='font-small'>";
    for($i = 1; $i <= 5; $i++) {
        $percentage = round(getSurveyResults($i) / $totalNumber * 100, 2);
        $html .= "<li><label class='answer'>$i</label><div class='progress' data-label='$percentage%'><span class='progressValue' style='width: $percentage%;'></span></div></li>";
    }
    $html .= "</ul>";
    $response = ["response"=>$html];
    http_response_code(200);
    echo(json_encode($response));
?>