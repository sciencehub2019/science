<?php
     require_once("includes/connection.php");
    $ussr=3;
    if ($_POST['id'] != null)
    {
        $result = pg_query("
                           SELECT * FROM incNewsOpens(".$ussr.",".$_POST['id'].");
                           
                           SELECT * FROM NEWS WHERE NEWS_ID=".$_POST['id']);
        $numrows=pg_num_rows($result);
        if($numrows != 0)
        {
            while($row=pg_fetch_assoc($result))
            {
                $news_url=$row['news_url'];
        
                           echo '<iframe style="
                           height: 500px;
                           " src="'.$news_url.'" width="100%">';
            }
            
    }

    }
                           
                           
                           if ($_POST['articid'] != null)
                           {
                           $result = pg_query("
                                             
                                              SELECT * FROM incarticleOpens(".$ussr.",".$_POST['articid'].");
                                              SELECT * FROM articles WHERE article_ID=".$_POST['articid']);
                                              $numrows=pg_num_rows($result);
                                              if($numrows != 0)
                                              {
                                              while($row=pg_fetch_assoc($result))
                                              {
                                              $news_url=$row['source'];
                                              
                                              echo '<iframe style="
                                              height: 500px;
                                              " src="'.$news_url.'" width="100%">';
                                              }
                                              
                                              }
                                              
                                              }
                           
                           
                           if ($_POST['newsstopid'] != null)
                           {
                          
                           $result = pg_query("
                                              SELECT * FROM incNewsViews(".$ussr.",".$_POST['newsstopid'].")");
                                              
                                              
                                              $numrows=pg_num_rows($result);
                                              if($numrows != 0)
                                              {
                                              
                                             }
                                              
                                              }
                           if ($_POST['vidstopid'] != null)
                           {
                           $result = pg_query("
                                              SELECT * FROM incVideoViews(".$ussr.",".$_POST['vidstopid'].")");
                                              
                                              
                                                             $numrows=pg_num_rows($result);
                                                           if($numrows != 0)
                                                         {
                                              
                                                       }
                                              
                                              }
                                              
                            if ($_POST['articstopid'] != null)
                                              {
                                              $result = pg_query("
                                                                 SELECT * FROM incArticleViews(".$ussr.",".$_POST['articstopid'].")");
                                                                 
                                                                 
                                                                 $numrows=pg_num_rows($result);
                                                                 if($numrows != 0)
                                                                 {
                                                                 
                                                                 }
                                                                 
                                                                 }
                                              
                           
                           
                           
                           
                           
    if ($_POST['vidid'] != null)
                           {
                           $result = pg_query("
                                              SELECT * FROM incvideoOpens(".$ussr.",".$_POST['vidid'].");
                                              
                                              SELECT * FROM videos WHERE video_ID=".$_POST['vidid']);
                                              $numrows=pg_num_rows($result);
                                              if($numrows != 0)
                                              {
                                              while($row=pg_fetch_assoc($result))
                                              {
                                              $news_url=$row['video_url'];
                                              
                                              echo '<iframe style="
                                              height: 500px;
                                              "src="'.$news_url.'" width="100%">';
                                              }
                                              
                                              }
                                              
                                              }
                           
                           
    
    function loadVideo()
    {
        $news='<div class="row">';
        $result = pg_query("SELECT * FROM videos order by video_index desc,  video_date desc");
        $numrows=pg_num_rows($result);
        if($numrows != 0)
        {
            while($row=pg_fetch_assoc($result))
            {
                $news_title=$row['video_title'];
                $news_img=$row['video_img'];
                $news_date=$row['video_date'];
                $news_id=$row['video_id'];
                $source=$row['video_url'];
                $news_index=$row['video_index'];
                
                $news .=
                '<div class="col-sm-12"><div class="card">
                <img src="'.$news_img.'" class="card-img-top" alt="'.$news_title.'">
                <div class="card-body">
                <p class="card-text"><small class="text-muted">Индекс:'.$news_index.'</small></p>
                <h5 class="card-title">'.$news_title.'</h5>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollablevid'.$news_id.'"
                                              onclick=\'$.ajax({
                                              type: "POST",
                                              url: "modules.php",
                                              data: "vidid='.$news_id.'",
                                              success: function(data){
                                              $(".vide'.$news_id.'").html(data);
                                              }
                                              });\'>
                Читать
                </button>
                <p class="card-text"><small class="text-muted">'.$news_date.'</small></p>
                </div>
                </div></div>
                
                
                                            <!-- Modal -->
                                              <div class="modal fade" id="exampleModalScrollablevid'.$news_id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                              <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                                              <div class="modal-content">
                                              <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalScrollableTitle">видео</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                              </button>
                                              </div>
                                              <div class="modal-body vide'.$news_id.'">
                                              фрейм
                                              </div>
                                              <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal"onclick=\'$.ajax({
                                              type: "POST",
                                              url: "modules.php",
                                              data: "vidstopid='.$news_id.'",
                                              success: function(data){
                                              }
                                              });\'>
                                              Close</button>
                                              
                                              </div>
                                              </div>
                                              </div>
                                              </div>
                
                ';
                
            }
            
        }
        $news .='</div>';
        return $news;
    }
    
    
    function loadNews()
    {
        $news='<div class="row">';
        
        
        $result = pg_query("SELECT * FROM news order by news_index desc, news_date desc");
        $numrows=pg_num_rows($result);
        if($numrows != 0)
        {
            while($row=pg_fetch_assoc($result))
            {
                $news_title=$row['news_title'];
                $news_img=$row['news_img'];
                $news_date=$row['news_date'];
                $news_id=$row['news_id'];
                $news_index=$row['news_index'];
                $source=$row['news_url'];
                
                $news .=
                '<div class="col-sm-12"><div class="card">
                <img src="'.$news_img.'" class="card-img-top" alt="'.$news_title.'">
                <div class="card-body">
                             <p class="card-text"><small class="text-muted">Индекс:'.$news_index.'</small></p>
                <h5 class="card-title">'.$news_title.'</h5>
                         

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable'.$news_id.'"
                onclick=\'$.ajax({
            type: "POST",
            url: "modules.php",
            data: "id='.$news_id.'",
            success: function(data){
                $(".news'.$news_id.'").html(data);
            }
            });\'>
                Читать
                </button>
                <p class="card-text"><small class="text-muted">'.$news_date.'</small></p>
                </div>
                </div></div>
                
                
                
                
                
                
                
                
                <!-- Modal -->
                <div class="modal fade" id="exampleModalScrollable'.$news_id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">'.$news_title.'</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body news'.$news_id.'">
                фрейм
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
        onclick=\'$.ajax({
    type: "POST",
    url: "modules.php",
    data: "newsstopid='.$news_id.'",
    success: function(data){
    }
    });\'>Close</button>
                </div>
                </div>
                </div>
                </div>
                
                ';
                
            }
            
        }
        $news .='</div>';
        return $news;
    }
    
    function loadArtic()
    {
        $news='<div class="row">';
        
        
        $result = pg_query("SELECT * from articles order by article_index desc, article_date desc");
        $numrows=pg_num_rows($result);
        if($numrows != 0)
        {
            while($row=pg_fetch_assoc($result))
            {
                $news_title=$row['article_title'];
              //  $news_img=$row['news_img'];
                $news_date=$row['article_date'];
                $news_id=$row['article_id'];
                $news_index=$row['article_index'];
                $source=$row['article_url'];
                
                $news .=
                '<div class="col-sm-12"><div class="card">
                
                <div class="card-body">
                <p class="card-text"><small class="text-muted">Индекс:'.$news_index.'</small></p>
                <h5 class="card-title">'.$news_title.'</h5>
                
                
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollableartic'.$news_id.'"
                onclick=\'$.ajax({
            type: "POST",
            url: "modules.php",
            data: "articid='.$news_id.'",
                           success: function(data){
                $(".artic'.$news_id.'").html(data);
            }
            });\'>
            Читать
            </button>
            <p class="card-text"><small class="text-muted">'.$news_date.'</small></p>
            </div>
            </div></div>
            
            
            
            
            
            
            
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModalScrollableartic'.$news_id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollableTitle">'.$news_title.'</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body artic'.$news_id.'">
            фрейм
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"
            onclick=\'$.ajax({
        type: "POST",
        url: "modules.php",
        data: "articstopid='.$news_id.'",
        success: function(data){
        }
        });\'>Close</button>
        </div>
        </div>
        </div>
        </div>
        
        ';
        
    }
    
    }
    $news .='</div>';
    return $news;
    }
    
    function loadConf()
    {
        $news='<div class="row">';
        
        
        $result = pg_query("SELECT * FROM conferences");
        $numrows=pg_num_rows($result);
        if($numrows != 0)
        {
            while($row=pg_fetch_assoc($result))
            {
                $conf_name=$row['conf_name'];
                $conf_description=$row['conf_description'];
                $date_begin=$row['date_begin'];
                $date_end=$row['date_end'];
                $source=$row['organizer'];
                
                $organizer=$row['organizer'];
                $site=$row['site'];
                $email=$row['email'];
                $phonenumber=$row['phonenumber'];
                $place=$row['place'];
                
                
                $news .=
                '<div class="col-sm-12"><div class="card">
                <div class="card-body">
                <h5 class="card-title">'.$conf_name.'</h5>
                <p class="card-text">'.$conf_description.'</p>
                <p class="card-text"> c '.$date_begin.' по '.$date_end.'</p>
                <p class="card-text">контакты '.$phonenumber.' '.$email.' '.$site.'</p>
                <p class="card-text"><small class="text-muted">'.$news_date.'</small></p>
                </div>
                </div></div>
                
                ';
                
            }
            
        }
        $news .='</div>';
        return $news;
    }
    
    function printhead(){
        
        
        
    echo '
        
        <div class="row">
        <div class="tab-content col" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        '.loadNews().'
        </div>
        <div class="tab-pane fade" id="news" role="tabpanel" aria-labelledby="news-tab">'.loadNews().'</div>
        <div class="tab-pane fade" id="artic" role="tabpanel" aria-labelledby="artic-tab">'.loadArtic().'</div>
         <div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="video-tab">'.loadVideo().'</div>
        <div class="tab-pane fade" id="confer" role="tabpanel" aria-labelledby="confer-tab">'.loadConf().'</div>
        
        </div>
        
        
        
        <div class="col-4">
         <h3>Бьёрн Страуструп</h3>
        <img width="100%" class="rounded float-left" src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/0e/Bjarne-stroustrup_%28cropped%29.jpg/225px-Bjarne-stroustrup_%28cropped%29.jpg"/>
          <span>Учёная степень</span>
       <p>доктор философии</p>
        
        <span>Научная сфера</span>
        <p>программист</p>
        
        <span>Место работы</span>
        <p>AT&T Bell Laboratories, AT&T</p>
        
        
        <span>Награды и премии</span>
        <p>Премия Дрейпера (2018) </p>
        </div>
        </div>
        
        ' ;   }
    
    ?>
