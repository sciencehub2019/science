<?php
    require_once("includes/connection.php");
   // include 'includes/header.php';
   // include 'modules.php';
    $dataPoints1 = array();
    $dataPoints2 = array();
     $dataPoints3 = array();
  //  $handle = $link->prepare('select x, y from datapoints');
    $ussser=1;
   
    $result = pg_query("
                       SELECT sum(view_history.view_time) as x, category.category_name FROM view_history
                       inner join news on news.news_id=view_history.content_id and content_type=1
                       inner join category on category.category_id=news.category_id
                       where user_id=".$ussser."
                       group by category.category_name
                       union
                       SELECT sum(view_history.view_time) as x,  category.category_name FROM view_history
                       inner join videos on videos.video_id=view_history.content_id and content_type=2
                       inner join category on category.category_id=videos.category_id
                       where user_id=".$ussser."

                       group by category.category_name
                       union
                       SELECT sum(view_history.view_time) as x, category.category_name FROM view_history
                       inner join articles on articles.article_id=view_history.content_id and content_type=3
                       inner join category on category.category_id=articles.category_id
                       where user_id=".$ussser."
                       group by category.category_name"
                       
 );
    $numrows=pg_num_rows($result);
    
    if($numrows != 0)
    {
        
        while($row=pg_fetch_assoc($result))
        {
            
            array_push($dataPoints1, array("label"=> $row['category_name'], "y"=> $row['x']));
            array_push($dataPoints3, array("label"=> $row['x'], "y"=> $row['y']));
            
           
        }
        
    }
    
    $result = pg_query("
                       SELECT (view_history.view_time) as x, category.category_name FROM view_history
                       inner join news on news.news_id=view_history.content_id and content_type=1
                       inner join category on category.category_id=news.category_id
                       where user_id=".$ussser."
                      
                       union
                       SELECT (view_history.view_time) as x,  category.category_name FROM view_history
                       inner join videos on videos.video_id=view_history.content_id and content_type=2
                       inner join category on category.category_id=videos.category_id
                       where user_id=".$ussser."
                       
                       union
                       SELECT (view_history.view_time) as x, category.category_name FROM view_history
                       inner join articles on articles.article_id=view_history.content_id and content_type=3
                       inner join category on category.category_id=articles.category_id
                       where user_id=".$ussser
                       
                       );
    $numrows=pg_num_rows($result);
    
    if($numrows != 0)
    {
        
        while($row=pg_fetch_assoc($result))
        {
            
            array_push($dataPoints3, array("label"=> $row['category_name'], "y"=> $row['x']));
           
            
            
        }
        
    }
    
    
    $result = pg_query("
                      
                      
                       SELECT (view_history.datetime_start), view_history.view_time, 'новости' as typecontent FROM view_history
                       inner join news on news.news_id=view_history.content_id and content_type=1
                       inner join category on category.category_id=news.category_id
                       where user_id=1
                       
                       union
                       SELECT (view_history.datetime_start), view_history.view_time, 'видео' as typecontent FROM view_history
                       inner join videos on videos.video_id=view_history.content_id and content_type=2
                       inner join category on category.category_id=videos.category_id
                       where user_id=1
                       
                       union
                       SELECT (view_history.datetime_start), view_history.view_time, 'статья' as typecontent FROM view_history
                       inner join articles on articles.article_id=view_history.content_id and content_type=3
                       inner join category on category.category_id=articles.category_id
                       where user_id=1
                       "


                       
                       );
    $numrows=pg_num_rows($result);
    
    if($numrows != 0)
    {
        
        while($row=pg_fetch_assoc($result))
        {
            
            array_push($dataPoints2, array("label"=> $row['view_time'], "y"=> $row['datetime_start']));
            
            
            
        }
        
    }
    
    
    
    
    
    ?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {
    
    
    var chart = new CanvasJS.Chart("chartContainer", {
                                   animationEnabled: true,
                                   title: {
                                   text: "Интересы пользователя"
                                   },
                                   subtitles: [{
                                   text: " "
                                   }],
                                   data: [{
                                   type: "pie",
                                   yValueFormatString: "#",
                                   indexLabel: "{label} ({y})",
                                   dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
                                   }]
                                   });
    chart.render();
    
    
    var chart2 = new CanvasJS.Chart("chartContainer2", {
                                   animationEnabled: true,
                                   title: {
                                   text: "посещения пользователя"
                                   },
                                   subtitles: [{
                                   text: " "
                                   }],
                                   data: [{
                                   type: "pie",
                                   yValueFormatString: "#",
                                   indexLabel: "{label} ({y})",
                                   dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
                                   }]
                                   });
    chart2.render();
    
    
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>

<div id="chartContainer2" style="height: 370px; width: 100%;"></div>



<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
