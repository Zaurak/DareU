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
				'firstname' => 'Buster',
				'lastname' => 'Benson', 
				'email' => 'benson@ece.fr',
				'url' => 'www.dareu.com/benson'),
				1 => array(
				'firstname' => 'Laura',
				'lastname' => 'Mayes', 
				'email' => 'mayes@ece.fr',
				'url' => 'www.dareu.com/mayes'),
				2 => array(
				'firstname' => 'Geoffrey',
				'lastname' => 'Ellis', 
				'email' => 'ellis@ece.fr',
				'url' => 'www.dareu.com/ellis'));
               
							   
			   	echo "<table>";
				echo "<tr>
						<th>Name</th>
						<th>E-mail</th>
						<th>Profile</th>
					</tr>";
			   	foreach($members As $member) {
					
					echo "<tr><td>";
					echo $member['firstname'] . ' ' . $member['lastname'];
					echo "</td><td>";
					echo '<a href="mailto:' . $member['email'] . '">' . $member['email'] . '</a>';
					echo "</td><td>";
					echo '<a href="' . $member['url'] . '">' . $member['url'] . '</a>';
					echo "</td>\n";

				}
				echo "</table>";
				?>
            
            </article>
        </section>
        
        <!-- Chargement du pied de page (lien contact, twitter etc...)-->
        <!-- <?php include("footer.php") ?>
		-->
        </div>
    </body>
</html>
