<?php

$l_init = array(
	'title' => array(
		'en' => 'Polarstar Toolbox <small>- Beta</small>',
		'fr' => 'Boîte à outils Polarstar <small>- Beta</small>',
	),
	'language' => array(
		'en' => '<img src="' . $base_href . 'img/en.png" alt="" /> <span class="hidden-sm">English</span>',
		'fr' => '<img src="' . $base_href . 'img/fr.png" alt="" /> <span class="hidden-sm">Français</span>',
	),
	'menu_calc' => array(
		'en' => 'FCU Configuration Editor',
		'fr' => 'Éditeur de configuration du FCU',
	),
	'menu_help' => array(
		'en' => 'Help',
		'fr' => 'Aide',
	),
	'menu_issues' => array(
		'en' => 'Issues',
		'fr' => 'Problèmes et solutions',
	),
	'menu_fcu_shot' => array(
		'en' => 'FCU Shots fired',
		'fr' => 'Nombre de tirs du FCU',
	),
	'menu_sources' => array(
		'en' => 'Sources and acknowledgments',
		'fr' => 'Sources et remerciements',
	),
	'menu_tank_shot' => array(
		'en' => 'Air tank shots capacity',
		'fr' => 'Nombre de tirs selon la bouteille d\'air',
	),
	'baseline' => array(
		'en' => 'This application will help you to configure your FCU and share your setup. Don\'t forget that every airsoft gun is different, and do not hesitate to try different setup to get the best or your Polarstar !',
		'fr' => 'Cette application vous servira à paramétrer votre FCU et à partager votre configuration. N\'oubliez pas que chaque réplique est spécifique, et n\'hésitez pas à tester différents paramètres pour arriver au meilleur de votre Polarstar !',
	),
	're_help' => array(
		'en' => 'The FCU version impact the dP value, and the equation for the rate of fire.',
		'fr' => 'La version du FCU influe sur le calcul du dP et de la cadence',
	),
	're_title' => array(
		'en' => 'Re : FCU Version',
		'fr' => 'Re : Version de votre FCU',
	),
	'calc_fps_help' => array(
		'en' => 'BB Real output velocity. Regardless of the BB weight (do not convert to 0.20g if you run heavier BBs)',
		'fr' => 'Vitesse d\'expédition des billes réel, indépendamment du grammage (ne pas &#148;rapporter&#148; en 0.20g par exemple)',
	),
	'calc_fps_title' => array(
		'en' => 'BB output velocity in FPS',
		'fr' => 'Vitesse d\'expédition des billes en FPS',
	),
	'calc_barrel_help' => array(
		'en' => 'Your barrel length, in milimeters',
		'fr' => 'Indiquez la longueur de votre canon, en millimètres',
	),
	'calc_barrel_title' => array(
		'en' => 'Barrel length in mm',
		'fr' => 'Longueur du canon en mm',
	),
	'calc_ms_exit_barrel_help' => array(
		'en' => 'BB time to travel the barrel in milliseconds',
		'fr' => 'Temps que mets la bille à parcourir le canon',
	),
	'calc_ms_exit_barrel_title' => array(
		'en' => 'BB time to travel the barrel in ms',
		'fr' => 'Sortie de la bille en ms',
	),
	'calc_rps_help' => array(
		'en' => 'Set your target Rate of Fire, in BBs per seconds. The formula is more or less : <br /><br /><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><br />Dn + dr + rF + 2 + (dP / 10)',
		'fr' => 'Indiquez le nombre de billes que vous souhaitez tirer par seconde. La formule est plus ou moins : <br /><br /><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><br />Dn + dr + rF + 2 + (dP / 10)',
	),
	'calc_rps_title' => array(
		'en' => 'Rate of Fire in BB/s',
		'fr' => 'Cadence en BB/s',
	),
	'calc_dn_help' => array(
		'en' => 'Time between the nozzle start to move backward, and stay backward. If you got misfeeds, increase this value',
		'fr' => 'Durée pendant laquelle le nozzle se replie, et reste en arrière. Si vous avez des missfeeds, augmentez cette valeur',
	),
	'calc_dn_title' => array(
		'en' => 'Dn : Nozzle Dwell',
		'fr' => 'Dn : Nozzle Dwell',
	),
	'calc_dr_help' => array(
		'en' => 'Time bewteen the nozzle star to move forward, and the moment where the FE shoot air. As the nozzle get a minimum of 9ms to move <u>without pushing bb</u> (at dryfire), this value should not be above 12.',
		'fr' => 'Délais d\'attente entre le moment où le nozzle commence à avancer, et le moment où la FE expédie l\'air. Ne pas descendre en dessous de 12 (le nozzle mets au <u>minimum</u> 9ms à avancer)',
	),
	'calc_dr_title' => array(
		'en' => 'dr : Return to battery delay',
		'fr' => 'dr : Return to battery delay',
	),
	'calc_dp_help' => array(
		'en' => 'This value should be manualy set (see below). Once you get it, fill in the field, and freeze the value with the padlock. 18 is the default value.',
		'fr' => 'Son réglage devrait se faire manuellement (voir plus bas). Une fois configuré, renseignez ce champs, et appuyez sur le cadenas. La valeur par défaut est 18',
	),
	'calc_dp_title' => array(
		'en' => 'dP : Poppet dwell',
		'fr' => 'dP : Poppet dwell',
	),
	'calc_rf_help' => array(
		'en' => 'Time between the closure of the poppet (stop sending air), and the nozzle start to step backward. This should not be above 4',
		'fr' => 'Durée entre la fermeture du poppet (arrêt de l\'expulsion d\'air) et le recul du nozzle. Ne jamais descendre en dessous de 4',
	),
	'calc_rf_title' => array(
		'en' => 'rF : Rate of Fire',
		'fr' => 'rF : Rate of Fire',
	),
	'toggle_advanced_title' => array(
		'en' => 'Advanced mode',
		'fr' => 'Mode avancé',
	),
	'toggle_advanced_help' => array(
		'en' => '',
		'fr' => 'Cliquez pour activer le mode avancé. Cela vous permettra de renseigner des champs optionnels, et ainsi pouvoir renseigner votre configuration matérielle.',
	),
	'toggle_advanced_button' => array(
		'en' => 'Enable',
		'fr' => 'Activer',
	),
	'surname_help' => array(
		'en' => 'Your nickname, to identify this configuration',
		'fr' => 'Votre pseudonyme, pour identifier cette configuration',
	),
	'surname_title' => array(
		'en' => 'Nickname',
		'fr' => 'Pseudonyme',
	),
	'gun_name_help' => array(
		'en' => 'Type / Name and brand of your gun. For example &#171;HK 416D VFC&#187;',
		'fr' => 'Type / nom et marque de la réplique. Par exemple &#171;HK 416 VFC&#187;',
	),
	'gun_name_title' => array(
		'en' => 'Gun',
		'fr' => 'Réplique',
	),
	'barrel_type_help' => array(
		'en' => 'This field do not change anything on your FCU setting, but you can register it if you want to share your gun setup',
		'fr' => 'Type de canon. Ce choix ne change rien au paramétrage de votre FCU, mais servira si vous souhaitez partager les détails de votre réplique',
	),
	'barrel_type_title' => array(
		'en' => 'Barrel',
		'fr' => 'Canon',
	),
	'hopup_rubber_help' => array(
		'en' => 'This field do not change anything on your FCU setting, but you can register it if you want to share your gun setup',
		'fr' => 'Type de joint hop-up. Ce choix ne change rien au paramétrage de votre FCU, mais servira si vous souhaitez partager les détails de votre réplique',
	),
	'hopup_rubber_title' => array(
		'en' => 'Hop-up rubber',
		'fr' => 'Joint hop-up',
	),
	'range_help' => array(
		'en' => 'Effective range in a flat shot, on a human-like target (meters / feet)',
		'fr' => 'Portée effective en tir tendu de la réplique sur cible de taille humaine (mètres / pieds)',
	),
	'range_title' => array(
		'en' => 'Range',
		'fr' => 'Portée',
	),
	'psi_help' => array(
		'en' => '',
		'fr' => '',
	),
	'psi_title' => array(
		'en' => 'Regulator output psi',
		'fr' => 'PSI en sortie de régulateur',
	),
	'bb_weight_help' => array(
		'en' => 'For Polarstar guns, you should use 0.28g or heavier.',
		'fr' => 'Pour les systèmes Polarstar, il est recommendé d\'utiliser des billes en 0.28 ou supérieur',
	),
	'bb_weight_title' => array(
		'en' => 'BB weight',
		'fr' => 'Gramage de billes',
	),
	'comment_help' => array(
		'en' => 'Additional comment',
		'fr' => 'Commentaire libre',
	),
	'comment_title' => array(
		'en' => 'Comment',
		'fr' => 'Commentaire',
	),
	'fcu_shot_help' => array(
		'en' => 'With your FCU, you can show how many shot were fired. Put your FCU on safe, press to the right, then press down.',
		'fr' => 'Nombre de tirs effectués. Passez votre FCU en safe, appuyez sur le bouton droite, puis sur le bouton bas.',
	),
	'fcu_shot_title' => array(
		'en' => 'FCU hexadecimal value',
		'fr' => 'Valeur Hexadécimal du FCU',
	),
	'fcu_shot_calc_title' => array(
		'en' => 'Number of shots fired',
		'fr' => 'Nombre de tirs effectués',
	),
	'tank_capacity_ci_help' => array(
		'en' => 'Air tank capacity, in cubic inch (13, 48, 68). You can set it in inch here, or in liter bellow',
		'fr' => 'Taille de votre bouteille d\'air, en pouces cube (13, 48, 68). Vous pouvez aussi la préciser en litre dans le champs suivant',
	),
	'tank_capacity_ci_title' => array(
		'en' => 'Air tank capacity in in<sup>3</sup>',
		'fr' => 'Taille de la bouteille en pouces<sup>3</sup>',
	),
	'tank_capacity_l_help' => array(
		'en' => 'Air tank capacity, in liter (0.2, 0.8, 1.1). You can set it in liter here, or in cubic inch above',
		'fr' => 'Taille de votre bouteille d\'air, en litre (0.2, 0.8, 1.1). Vous pouvez aussi la préciser en pouces cube dans le champs suivant',
	),
	'tank_capacity_l_title' => array(
		'en' => 'Air tank capacity in liter',
		'fr' => 'Taille de la bouteille en litre',
	),
	'tank_psi_help' => array(
		'en' => 'Set your current air tank pressure, in psi (3000, 4500)',
		'fr' => 'Pression actuelle de votre bouteille en psi (3000, 4500)',
	),
	'tank_psi_title' => array(
		'en' => 'Air tank pressure in psi',
		'fr' => 'Pression de votre bouteille in psi',
	),
	'regulator_psi_help' => array(
		'en' => 'This value should be between 70 and 120 psi',
		'fr' => 'Cette valeur devrait se situer entre 70 et 120 psi',
	),
	'regulator_psi_title' => array(
		'en' => 'Regulator output psi',
		'fr' => 'Psi en sortie de régulateur',
	),
	'tank_shot_help' => array(
		'en' => 'This value depends of your nozzle, poppet and dP configuration, so we can\'t be precisely accurate',
		'fr' => 'Cette valeur dépend du nozzle,, du poppet, de votre dP, et est une estimation.',
	),
	'tank_shot_title' => array(
		'en' => 'Shots (approximative)',
		'fr' => 'Nombre de tirs (approximatif)',
	),
	'submit_link' => array(
		'en' => 'Get a share-link of this settings',
		'fr' => 'Obtenir un lien de partage pour cette configuration',
	),
	'submit_link_edit' => array(
		'en' => 'Get a share-link of this eddited settings',
		'fr' => 'Re-génerer un lien de partage pour cette configuration',
	),
	'reset_form' => array(
		'en' => 'Reset form',
		'fr' => 'Réinitialiser le formulaire',
	),
	'help_text' => array(
		'en' => '
						<p>The editor is split in four parts :</p>
						<ul>
							<li>First : FE Revision, BB Velocity output and barrel. This fields will be useful to get the dP value.</li>
							<li>Second : Rate of fire. This will be used to get Dn, dr and rF</li>
							<li>Third : Your FCU configuration.</li>
							<li>Fourth (advanced) : Gun details. This will not be used to configure your FCU, but you can register some informations if you want to share your setup over the web, or save it for later use.</li>
						</ul>
						<p>These data are indicative, and theorical. You must take it as "base" setup, then tweek your FCU specifically for your gun.</p>
						<p>For a manual configuration, see notes below :</p>
						<ul>
							<!--<li>dP : Lower your dP as far as your fps do not drop. When they start to drop, increment by 3</li>-->
							<li>dP : This value is the most difficult to set. It depends of a lot of variables, like your nozzle rubber, your psi, the current climat. It will influe on your air consumption and your accuracy.
								<ul>
									<li>Step 1 : Insert an empty magazine, fire some shots to be sure you don\'t have any BB in your mag/hop-up.</li>
									<li>Step 2 : Lower your dP by 2</li>
									<li>Step 3 : Wait 5 minutes</li>
									<li>Step 4 : Put your hand in front of your nozzle or your barrel, fire two shots in semi</li>
									<li>If the first shot throwed air, go back to the Step 2</li>
									<li>If not, increase your dP by 2 : this is your minimal dP value for this configuration (Nozzle, PSI, atmospheric pressure).</li>
									<li>If you use a long barrel, heavy bbs or if you shoot at low fps, you can increase your dP by 2-5 depending of your configuration. The best way to configure it now is to shoot, and try to see if you are most accurate if you increae it.</li>
								</ul>
							</li>
							<li>Dn : Take your weakest magazine (the one who release BBs the slowest), decrease your Dn, then empty your magazine. If you don\'t have misfeed, you can decrease again. Repeat until you get misfeed, and go back to the last working value</li>
							<li>dr : You can lower it if you want a better RoF, but <b>never go under 12</b>, or your nozzle will not have the time to be in position before shooting.</li>
							<li>rF : Like the dr, but <b>never go lower than 4</b></li>
						</ul>',
		'fr' => '
						<p>Le tableau de calcul est séparé en trois parties</p>
						<ul>
							<li>Première : Puissance et canon. Ces données servent notamment à calculer la variable "dP".</li>
							<li>Seconde : Cadence en BB/s. Sert à calculer "Dn", "dr" et "rF"</li>
							<li>Troisième : Les paramètres de votre FCU.</li>
							<li>Quatrième (avancé) : Détails de votre réplique. Ne rentre pas en compte dans le paramètrage du FCU, mais utile si vous souhaitez partager votre configuration</li>
						</ul>
						<p>Ces données sont indicatives et théoriques. Elles doivent être prises en temps que "base" de votre configuration.</p>
						<p>Pour une configuration optimale : </p>
						<ul>
							<!--<li>dP : Baissez votre dP tant que vos fps ne commencent pas à chuter (d\'une valeur de dP à l\'autre). Une fois que vous percevez une baisse de fps, remontez de 3 ou 5 unité.</li>-->
							<li>dP : Ce paramètre est le plus compliqué à trouver, car il dépend de plusieurs variables : votre nozzle, les psi en sortie de régulateur, le climat, le grammage de vos billes et votre canon. Votre dP influencera votre consomation d\'air ainsi que votre précision.</li>
								<ul>
									<li>Étape 1 : Engagez un chargeur <b>vide</b>. Tirez quelques coups pour vous assurer que vous n\'avez pas de bille engagée.</li>
									<li>Étape 2 : Baissez votre dP de 2</li>
									<li>Étape 3 : Attendez 5 minutes</li>
									<li>Étape 4 : Mettez votre main devant votre nozzle ou votre canon, tirez 2 coups en semi</li>
									<li>Si vos 2 tirs ont envoyé de  l\'air, recommencez à l\'étape 2.</li>
									<li>Sinon, augmentez votre dP par 2 : c\'est la valeur minimale de dP pour cette configuration (nozzle, psi, climat).</li>
									<li>Si vous utilisez un canon long, un grammage lourd ou que vous tirez à de faibles fps, vous pouvez augmenter légèrement votre dP par 2-5 selon votre configuration. Maintenant le meilleur moyen d\'affiner votre dP est de tirer quelques billes, et de regarder si en augmentant votre dP, vous gagnez en précision. Si ce n\'est pas le cas, laissez le tel quel, il est correctement configuré.</li>
								</ul>
							</li>
							<li>Dn : Prenez votre chargeur qui remonte les billes le plus lentement, et baissez le Dn jusqu\'à optenir des misfeed. Une fois la valeur minimale ateinte, augmentez celle ci de 5 pour avoir une marge</li>
							<li>dr : L\'important est de <b>ne pas descendre en dessous de 12</b>. Baissez le si vous souhaitez augmenter votre cadence</li>
							<li>rF : Tout comme le dr, mais <b>ne descendez pas en dessous de 4</b></li>
						</ul>',
	),
	'issue_text' => array(
		'en' => '
						<p><b>Sometimes, my gun gets misfeeds</b><br />Your magazine do not eject BBs fast enough : increase your Dn</p>
						<br />
						<p><b>BBs fall or turn randomly</b><br />Maybe your dP need to be optimized. Try to set it manualy. It\'s not recommended to run with light BBs (<.28g)</p>',
		'fr' => '
						<p><b>Certaines fois, ma réplique tire à vide</b><br />Votre chargeur ne remonte pas les billes assez vite : Augmentez votre dn</p>
						<br />
						<p><b>Mes billes tombent ou dévient aléatoirement</b><br />Il se peut que votre dP ne soit pas optimisé. Essayez de le régler manuellement. Il est aussi déconseillé d\'utiliser des billes inférieur à 0.28g</p>',
	),
	'sources_p6' => array(
		'en' => 'Powair6, for their help and the server hosting',
		'fr' => 'Powair6, pour leur aide et l\'hébergement de l\'application',
	),
	'menu_contact' => array(
		'en' => 'Contact',
		'fr' => 'Contact',
	),
	'email' => array(
		'en' => 'Email',
		'fr' => 'Email',
	),
	'message' => array(
		'en' => 'Message',
		'fr' => 'Message',
	),
	'form_send' => array(
		'en' => 'Send',
		'fr' => 'Envoyer',
	),
	'contact_ok' => array(
		'en' => 'Thank you for contacting us. We will reply as soon as possible',
		'fr' => 'Nous vous remercions pour votre message. Nous vous recontacterons aussi tôt que possible',
	),
	'' => array(
		'en' => '',
		'fr' => '',
	),
	'' => array(
		'en' => '',
		'fr' => '',
	),
);

						