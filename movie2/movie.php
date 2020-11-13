<?php  
$movie = $_GET["film"];
$image = $movie . "/overview.png";

$info = file($movie . "/info.txt");
$title = $info[0];
$year = $info[1];
$rating = $info[2];

if($rating >= 60){
    $tomato ="freshlarge.png";
}else{
    $tomato = "rottenlarge.png";
}


//review stuff
$reviewsArray = glob($movie."/r?*");




?>

<!DOCTYPE html>
<html>
	<head>
		<title>Rancid Tomatoes</title>

		<meta charset="utf-8" />
		<link href="movie.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<div id="banner">
			<img src="https://webster.cs.washington.edu/images/rancidbanner.png" alt="Rancid Tomatoes" />
		</div>

		<h1><?php echo $title . "($year)"; ?></h1>
		
        <div id="main">
            
            <section id="GenOv">
                <div>
                    <img src= "<?php echo $image; ?>" alt="general overview" />
                </div>

                <dl>
                    <?php  
                    $temp =file($movie . "/overview.txt");
                    foreach($temp as $value){
                        $bold = explode(":",$value);
                        $text = explode(",",$value);
                      echo "<dt>" . $bold[0] . "</dt>"; 
                      echo "<dd>". substr($text[0], strpos($text[0],':')+1) . "</dd>";
                    }
                    ?>     
                </dl>
            </section>


            <section class="reviewsbg">
                <div id="rotten_banner">
                    <img id= rot src= "<?php echo "https://webster.cs.washington.edu/images/" . $tomato; ?>" alt="Rotten" />
                    <span><?php echo $rating . "%";?></span>
                </div>
                
                <article id="review_columns">
                    
                        <?php
                        $rnum = count($reviewsArray);
                        for($i=0; $i<$rnum; $i++){
                            $revcurr = file($reviewsArray[$i]);
                            list($review,$freshness,$name,$pub) = $revcurr; 
                            
                            if(trim($freshness) == "ROTTEN"){
                                
                                $freshness = "rotten";
                            }else{
                                $freshness = "fresh";
                            }
                            //html style
                            if($i == 0){
                                echo "<div id='c1'>";
                            }else if($i == floor($rnum/2)+1){
                                echo "</div>";
                                echo "<div id='c2'>"; 
                            }
                            echo "<p id='quote'>";
                            echo "<img src='https://webster.cs.washington.edu/images/".$freshness.".gif' />";
                            
                            echo "<span><q>$review</q></span></p>";
                            echo "<p id='cite'>
                            <img src='https://webster.cs.washington.edu/images/critic.gif' alt='Critic' />
                            <span>$name<br />
                            <i>$pub</i></span>
                        </p>";
                        }
                        echo "</div>";
                        ?>
                                            
                    
                    
                    
                </article>   
                
            </section>
            
        <span id="pagen"><?php echo "(1-$rnum) of $rnum" ?></span>
        </div>
        
        <div id= "w3c">
                <a href="https://webster.cs.washington.edu/validate-html.php"><img src="https://webster.cs.washington.edu/images/w3c-html.png" alt="Valid HTML5" /></a><br />
                <a href="https://webster.cs.washington.edu/validate-css.php"><img src="https://webster.cs.washington.edu/images/w3c-css.png" alt="Valid CSS" /></a>
        </div>
	</body>
</html>