<!DOCTYPE html>
<html>
	<!-- Chargement du <head> -->
    <!-- <?php include("head.php") ?>
    -->
    <body>
	<div id="page">
        
        <!-- Chargement de l'en-tête de la page (incluant bandeau de login) -->
		<!-- <?php include("header.php") ?>
        -->
        <!-- Chargement du panneau de navigation -->
        <!-- <?php include("nav.php") ?>
        -->
        
        <section>
            <article>
            
		<?php
		$wall[0]['content'] = "This is another tweet about life";
		$wall[0]['comment'] = "It sucks most of the time. Enjoy the few times it doesn't !";
		$wall[0]['date'] = "2012-07-05";
		$wall[0]['service'] = "TWEETER";
		
		$wall[1]['content'] = "This is another tweet about winter....";
		$wall[1]['comment'] = "It's cold and useless. Enjoy the Snowman !";
		$wall[1]['date'] = "2012-11-10";
		$wall[1]['service'] = "TWEETER;FACEBOOK";

		$wall[2]['content'] = "CHRISTMAS ! LIFE IS WONDERFULL";
		$wall[2]['comment'] = "MAKE A SMILE, DON'T LOOK SO SAAAAAAD";
		$wall[2]['date'] = "2012-12-25";
		$wall[2]['service'] = "TWEETER;FACEBOOK;FLICKER;GOOGLE+";

		foreach ($wall as $val)
		{ 
		    echo "<p>\n";
		    echo "Content: ".$val['content']."\n<br/>";
		    echo "Comment: ".$val['comment']."\n<br/>";
		    echo "Date: ".$val['date']."\n<br/>";
		    echo "Services: ".$val['service']."\n";
		    echo "</p>\n\n";
		}

		?>                
            
            </article>
        </section>
        
        <!-- Chargement du pied de page (lien contact, twitter etc...)-->
        <!-- <?php include("footer.php") ?>
		-->
        </div>
    </body>
</html>
