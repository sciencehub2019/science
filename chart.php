<?php
    require_once("includes/connection.php");
   // include 'includes/header.php';
   // include 'modules.php';
    $dataPoints1 = array();
    $dataPoints2 = array();
     $dataPoints3 = array();
  //  $handle = $link->prepare('select x, y from datapoints');
    
   
    $result = pg_query("(SELECT category.category_name as x,  Avg(view_history.view_time) AS y
                       FROM usertbl
                       INNER JOIN view_history ON usertbl.id = view_history.user_id
                       inner join news on view_history.content_id = news.news_id and view_history.content_type = 1
                       inner join category on category.category_id = news.category_id
                       WHERE (((usertbl.sex)=1) AND ((view_history.view_time) Is Not Null))
                       GROUP BY view_history.content_type, category.category_name)");
    $numrows=pg_num_rows($result);
    
    if($numrows != 0)
    {
        
        while($row=pg_fetch_assoc($result))
        {
            
            array_push($dataPoints1, array("label"=> $row['x'], "y"=> $row['y']));
             array_push($dataPoints3, array("label"=> $row['x'], "y"=> $row['y']));
            
           
        }
        
    }
    
    $result = pg_query("(SELECT category.category_name as x,  Avg(view_history.view_time) AS y
                       FROM usertbl
                       INNER JOIN view_history ON usertbl.id = view_history.user_id
                       inner join news on view_history.content_id = news.news_id and view_history.content_type = 1
                       inner join category on category.category_id = news.category_id
                       WHERE (((usertbl.sex)=0) AND ((view_history.view_time) Is Not Null))
                       GROUP BY view_history.content_type, category.category_name)");
    $numrows=pg_num_rows($result);
    
    if($numrows != 0)
    {
        
        while($row=pg_fetch_assoc($result))
        {
            
        
            array_push($dataPoints2, array("label"=> $row['x'], "y"=> $row['y']));
            
        }
        
    }

    
    
    
    ?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {
    
    var chart = new CanvasJS.Chart("chartContainer", {
                                   animationEnabled: true,
                                   theme: "light2",
                                   title:{
                                   text: "Среднее время просмотра категорий новостей по полу"
                                   },
                                   legend:{
                                   cursor: "pointer",
                                   verticalAlign: "center",
                                   horizontalAlign: "right",
                                   itemclick: toggleDataSeries
                                   },
                                   data: [{
                                   type: "column",
                                   name: "Муж.",
                                   indexLabel: "{y}",
                                   yValueFormatString: "#",
                                   showInLegend: true,
                                   dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
                                   },{
                                   type: "column",
                                   name: "Жен.",
                                   indexLabel: "{y}",
                                   yValueFormatString: "#",
                                   showInLegend: true,
                                   dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
                                   }]
                                   });
    chart.render();
    
    function toggleDataSeries(e){
        if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
            e.dataSeries.visible = false;
        }
        else{
            e.dataSeries.visible = true;
        }
        chart.render();
    }
    
}


</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
