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
					// Initialisation du tableau (plus tard a faire a part via la bdd)
					$members = array(
					0 => array(
					'image' => 'http://www.boldacademy.com/wp-content/uploads/2012/05/Buster-Benson.png',
					'firstname' => 'Buster',
					'lastname' => 'Benson',
					'description' => 'Hi, I am Buster Benson !'),
					1 => array(
					'image' => 'http://cdn4.blogs.babble.com/babble-voices/laura-mayes-hitting-refresh/files/2012/10/photo-1-300x300.jpg',
					'firstname' => 'Laura',
					'lastname' => 'Mayes',
					'description' => 'Hi, I love my son !'),
					2 => array(
					'image' => 'http://b.vimeocdn.com/ps/100/239/1002390_300.jpg',
					'firstname' => 'Geoffrey',
					'lastname' => 'Ellis',
					'description' => 'Hi, I rox !'));
	               

			 		echo "<table><tr>";
			 		foreach($members As $member) {
						echo "<td>";
				   		echo $member['firstname'] . ' ' . $member['lastname'] . '<br />';
				   		?>

				   		<img 	src="<?php echo $member['image']; ?>"
				   				alt="Profile image"
				  	 	/>
				   		<br />
				  
				  		<?php
				   		echo $member['description'] . '<br />';
				   		echo "</td>\n";
					}
			 		echo "</tr></table>";
					?>
				
				</article>
			</section>
		
			<!-- Chargement du pied de page (lien contact, twitter etc...)-->
			<!-- <?php include("footer.php") ?>
			-->
		
		</div>
	</body>
</html>
