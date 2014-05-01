<?php
		$version = "1.0.5";

		$_datas = array();
		function get_data($f, $default) { global $_datas; if (isset($_datas->$f)) return htmlentities($_datas->$f); else return $default; }

		$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
		if (empty($url['path']))
		{
			if (file_exists('config.php'))
				require_once('config.php');
			else
			{
				$url = array();
				$url['host'] = 'localhost';
				$url['user'] = 'user';
				$url['pass'] = 'pass';
				$url['path'] = '.database'; # dot_database
			}
		}

		$server = $url["host"];
		$username = $url["user"];
		$password = $url["pass"];
		$db = substr($url["path"], 1);

		mysql_connect($server, $username, $password) or die('connect error');
		mysql_select_db($db) or die('connect db error');
		
		$query = mysql_query("SELECT * FROM settings WHERE `key`='" . mysql_real_escape_string($_GET['id_conf']) . "'");
		if($query === FALSE)
		{
			mysql_query("
				CREATE TABLE IF NOT EXISTS `settings` (
					`id` int(11) NOT NULL AUTO_INCREMENT,
					`key` varchar(8) NOT NULL,
					`config` text NOT NULL,
					`created_at` datetime NOT NULL,
					PRIMARY KEY (`id`),
					KEY `key` (`key`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;
			");
		}
		else
		{
			if (mysql_num_rows($query))
			{
				$_datas = mysql_fetch_assoc($query);
				$_datas = json_decode($_datas['config']);
				$id_conf = $_GET['id_conf'];
			}
		}

		if (count($_POST) && isset($_POST['re']))
		{
			while ($sha = substr(sha1(md5(uniqid(microtime(), TRUE))), 0, 4))
			{
				if (mysql_num_rows(mysql_query("SELECT id FROM `settings` WHERE `key`='" . $sha . "';")) == 0)
				break;
			}
			mysql_query("SET NAMES 'utf8'");
			mysql_query("INSERT INTO settings (`key`, config, created_at) VALUES ('" . $sha . "', '" . mysql_real_escape_string(json_encode($_POST)) . "', NOW())");
			die(json_encode(array('result' => 'ok', 'message' => $sha)));
		}
		elseif (count($_POST) && isset($_POST['email']))
		{
			$mail = "
Nouveau message :

Email : " . $_POST['email'] . "
Message : " . $_POST['message'] . "
Date : " . date('Y-m-d H:i:s') . "
Referer : " . $_SERVER['HTTP_REFERER'] . "
";

			mail('bizouap+pstartoolbox@gmail.com', '[PStarToolbox] Nouveau message', $mail);
			die(json_encode(array('result' => 'ok', 'message' => 'ok')));
		}


		if (!isset($_GET['lang']) && !isset($_COOKIE['language']))
		{
			$language = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
			$language = strtolower(substr(chop($language[0]),0,2));


			if (!in_array($language, array('en', 'fr')))
				$language = 'en';
		}

		if (isset($_COOKIE['language']))
		{
			if (!in_array($_COOKIE['language'], array('en', 'fr')))
				$language = 'en';
			else
				$language = $_COOKIE['language'];
		}

		if (isset($_GET['lang']))
		{
			if (!in_array($_GET['lang'], array('en', 'fr')))
				$language = 'en';
			else
				$language = $_GET['lang'];
		}

		setcookie("language", $language, time() + 3600 * 24 * 30, '/', $_SERVER['HTTP_HOST']);

		$base_href = (preg_match('@ftweb.fr@', $_SERVER['HTTP_HOST']) ? '/p-fcu/' : '/');

		$link_href = $base_href . ($language == 'en' ? '' : 'fr/') . (!is_null($id_conf) ? $id_conf . '/' : '');

		require_once('locale.php');
		
		$language_url = array();
		foreach(array('fr','en') as $l)
			$language_url[$l] = '//' . $_SERVER['HTTP_HOST'] . (preg_match('@ftweb.fr@', $_SERVER['HTTP_HOST']) ? '/p-fcu/' : '/') . ($l == 'en' ? 'en/' : 'fr/') . (!is_null($id_conf) ? $id_conf . '/' : '');


		if (($language != 'en' && !preg_match('@/' . $language . '/@', $_SERVER['REQUEST_URI'])) || ($language == 'en' && preg_match('@/' . $language . '/@', $_SERVER['REQUEST_URI'])))
			die(header('location:' . ($_SERVER['HTTPS'] ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $link_href));


		$l = array();
		foreach($l_init as $k => $v)
			if (empty($v[$language]))
				$l[$k] = $v['fr'];
			else	
				$l[$k] = $v[$language];

		$barrels = array(
			'1' => 'Deepfire (6.02)',
			'2' => 'Deepfire (6.04)',
			'3' => 'Dytac (6.01)',
			'4' => 'Guarder (6.02)',
			'5' => 'Lonex (6.03)',
			'6' => 'MadBull (6.01)',
			'7' => 'MadBull (6.03)',
			'8' => 'Orga Magnus (6.03)',
			'9' => 'Orga Magnus (6.10)',
			'10' => 'Orga Super Power (6.00)',
			'11' => 'PDI (6.01)',
			'12' => 'PDI (6.05)',
			'13' => 'PDI Raven (6.01)',
			'14' => 'Prometheus (6.03)',
			'15' => 'Miracle (6.06)',
			'16' => 'AAC (6.03)',
			'17' => 'Laylax (6.03)',
			'18' => 'Modify (6.01)',
			'19' => 'Modify (6.03)',
			'20' => 'SRC (6.03)',
		);
		asort($barrels);
		$barrels[98] = 'Stock';
		$barrels[99] = 'Other';



		$hopup_rubbers = array(
			'1' => 'Prometheus (soft - purple)',
			'2' => 'Prometheus (hard - red)',
			'3' => 'Madbull (soft - blue)',
			'4' => 'Madbull (hard - red)',
			'5' => 'Tokyo Marui',
			'6' => 'Guarder (soft - transparent)',
			'7' => 'Guarder (hard - black)',
			'8' => 'Modify',
			'9' => 'Lonex',
			'10' => 'A+ 60',
			'11' => 'A+ 70',
			'12' => 'PDI',
		);
		asort($hopup_rubbers);
		$hopup_rubbers[50] = 'R-hop';
		$hopup_rubbers[51] = 'V-hop';
		$hopup_rubbers[52] = 'Flat-hop';

		$hopup_rubbers[98] = 'Stock';
		$hopup_rubbers[99] = 'Other';

		$ranges = array(
			'1' => '40m / 130f',
			'2' => '45m / 145f',
			'3' => '50m / 165f',
			'4' => '55m / 180f',
			'5' => '60m / 195f',
			'6' => '65m / 215f',
			'7' => '70m / 230f',
			'8' => '75m / 245f',
			'9' => '80m / 260f',
			'10' => '85m / 280f',
			'11' => '90m / 295f',
			'12' => '95m / 310f',
			'13' => '100m / 328f',
		);
		asort($ranges);

?><!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php echo $l['baseline']; ?>">
	<meta name="author" content="Paul Bizouard">



	<title>Polarstar Toolbox</title>


	<link rel="stylesheet" href="<?php echo $base_href; ?>css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo $base_href; ?>css/style.css?<?php echo $version; ?>">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->


	<script type="text/javascript">
		var base_href = '<?php echo htmlentities($base_href); ?>';
		var CONTACT_OK = '<?php echo addslashes($l["contact_ok"]); ?>';
	</script>


</head>
<body class="<?php echo (is_null($id_conf) ? '' : 'simple_content'); ?>">
		<div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
			<div class="container">
				<div class="navbar-header">
				
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					
					<a class="navbar-brand hidden-sm hidden-md" href="<?php echo $base_href; ?>">www.pstartoolbox.com</a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li><a href="<?php echo $link_href; ?>#calc"><?php echo $l['menu_calc']; ?></a></li>
						<li><a href="<?php echo $link_href; ?>#m_fcu_shot"><?php echo $l['menu_fcu_shot']; ?></a></li>
						<li><a href="<?php echo $link_href; ?>#m_tank_shot"><?php echo $l['menu_tank_shot']; ?></a></li>
						<li class="hidden-xs hidden-sm"><a href="<?php echo $link_href; ?>#m_contact"><?php echo $l['menu_contact']; ?></a></li>
					</ul>

					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $l['language']; ?> <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<?php
									foreach ($l_init['language'] as $k => $v)
										echo '<li><a href="' . $language_url[$k] . '">' . $v . '</a></li>';
								?>
							</ul>
						</li>
					</ul>

				</div><!-- /.nav-collapse -->
			</div><!-- /.container -->
		</div><!-- /.navbar -->

		<div class="container">
			<div class="row" id="simple_content_show">
				<div class="col-xs-12">
					<div class="jumbotron">
						<h1><?php echo $l['title'];?></h1>
						<p><?php echo $l['baseline']; ?></p>
					</div>

					<div id="calc" class="anchor"></div>

					<div class="col-xs-12">
						<h2><?php echo $l['menu_calc']; ?> <button id="reset_form" class="pull-right btn btn-danger"><?php echo $l['reset_form']; ?></button></h2>

						<div class="clearfix"></div>
						
						<form id="settings_form" class="form-horizontal" role="form">

							<div class="form-group">
								<label class="col-sm-4 control-label"><u data-toggle="popover" data-content="<?php echo $l['toggle_advanced_help']; ?>" data-title="<?php echo $l['toggle_advanced_title']; ?>"><?php echo $l['toggle_advanced_title']; ?></u></label>
								<div class="col-sm-8">
									<button type="button" class="btn <?php echo (get_data('btn_advanced_mode', 0) == 1 ? 'active' : '');?>" id="btn_advanced_mode" data-toggle="button"><?php echo $l['toggle_advanced_button']; ?></button>
									<input type="hidden" name="btn_advanced_mode" value="<?php echo get_data('btn_advanced_mode', 0); ?>" data-default="0" />
								</div>
							</div>

							<hr />

							<div id="gun-settings">
								<div class="form-group">
									<label class="col-sm-4 control-label"><u data-toggle="popover" data-content="<?php echo $l['re_help']; ?>" data-title="<?php echo $l['re_title']; ?>"><?php echo $l['re_title']; ?></u></label>
									<div class="col-sm-8">
										<select name="re" class="form-control" id="re">
											<option value="15" data-dp="20" <?php echo (get_data('re', '20') == 15 ? 'selected' : ''); ?>>15</option>
											<option value="16" data-dp="20" <?php echo (get_data('re', '20') == 16 ? 'selected' : ''); ?>>16</option>
											<option value="17" data-dp="20" <?php echo (get_data('re', '20') == 17 ? 'selected' : ''); ?>>17</option>
											<option value="18" data-dp="25" <?php echo (get_data('re', '20') == 18 ? 'selected' : ''); ?>>18</option>
											<option value="19" data-dp="25" <?php echo (get_data('re', '20') == 19 ? 'selected' : ''); ?>>19</option>
											<option value="20" data-dp="27" <?php echo (get_data('re', '20') == 20 ? 'selected' : ''); ?>>20</option>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-4 control-label"><u data-toggle="popover" data-content="<?php echo $l['calc_fps_help']; ?>" data-title="<?php echo $l['calc_fps_title']; ?>"><?php echo $l['calc_fps_title']; ?></u></label>
									<div class="col-sm-8">
										<input type="text" name="fps" class="form-control" id="fps" value="<?php echo get_data('fps', 350); ?>" data-default="350">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-4 control-label"><u data-toggle="popover" data-content="<?php echo $l['calc_barrel_help']; ?>" data-title="<?php echo $l['calc_barrel_title']; ?>"><?php echo $l['calc_barrel_title']; ?></u></label>
									<div class="col-sm-8">
										<input type="text" name="barrel" class="form-control" id="barrel" value="<?php echo get_data('barrel', 450); ?>" data-default="450">
									</div>
								</div>

								<div class="form-group advanced <?php echo (get_data('btn_advanced_mode', 0) == 1 ? '' : 'nodisplay');?>">
									<label class="col-sm-4 control-label"><u data-toggle="popover" data-content="<?php echo $l['calc_ms_exit_barrel_help']; ?>" data-title="<?php echo $l['calc_ms_exit_barrel_title']; ?>"><?php echo $l['calc_ms_exit_barrel_title']; ?></u></label>
									<div class="col-sm-8">
										<input type="text" disabled name="ms_exit_barrel" class="form-control" id="ms_exit_barrel" value="<?php echo get_data('ms_exit_barrel', ''); ?>" data-default="">
									</div>
								</div>

							</div>

							<hr />

							<div id="rps-settings">
								<div class="form-group">
									<label class="col-sm-4 control-label"><u data-toggle="popover" data-content="<?php echo $l['calc_rps_help']; ?>" data-title="<?php echo $l['calc_rps_title']; ?>"><?php echo $l['calc_rps_title']; ?></u></label>
									<div class="col-sm-8">
										<input type="text" name="rps" class="form-control" id="rps" value="<?php echo get_data('rps', 19); ?>" data-default="19">
									</div>
								</div>
							</div>

							<hr />

							<div id="fcu-settings">
								<div class="form-group">
									<label class="col-sm-4 control-label"><u data-toggle="popover" data-content="<?php echo $l['calc_dn_help']; ?>" data-title="<?php echo $l['calc_dn_title']; ?>"><?php echo $l['calc_dn_title']; ?></u></label>
									<div class="col-sm-8">
										<input type="text" name="dn" class="form-control input-can-lock" id="dn" value="<?php echo get_data('dn', 14); ?>" data-default="14">
										<button class="btn btn-lock <?php echo (get_data('lock_dn', 0) == 1 ? 'btn-warning' : ''); ?>" data-btn="lock_dn" id="lock_dn_btn" name="lock_dn_btn" value="<?php echo get_data('lock_dn', 0); ?>"><i class="glyphicon glyphicon-lock"></i></button>
										<input type="hidden" value="<?php echo get_data('lock_dn', 0); ?>" name="lock_dp" id="lock_dn" />
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-4 control-label"><u data-toggle="popover" data-content="<?php echo $l['calc_dr_help']; ?>" data-title="<?php echo $l['calc_dr_title']; ?>"><?php echo $l['calc_dr_title']; ?></u></label>
									<div class="col-sm-8">
										<input type="text" name="dr" class="form-control" id="dr" value="<?php echo get_data('dr', 22); ?>" data-default="22">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-4 control-label"><u data-toggle="popover" data-content="<?php echo $l['calc_dp_help']; ?>" data-title="<?php echo $l['calc_dp_title']; ?>"><?php echo $l['calc_dp_title']; ?></u></label>
									<div class="col-sm-8">
										<input class="form-control input-can-lock" type="text" name="dp" id="dp" value="<?php echo get_data('dp', 18); ?>" data-default="18">
										<button class="btn btn-lock <?php echo (get_data('lock_dp', 0) == 1 ? 'btn-warning' : ''); ?>" data-btn="lock_dp" id="lock_dp_btn" name="lock_dp_btn" value="<?php echo get_data('lock_dp', 0); ?>"><i class="glyphicon glyphicon-lock"></i></button>
										<input type="hidden" value="<?php echo get_data('lock_dp', 0); ?>" name="lock_dp" id="lock_dp" />
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-4 control-label"><u data-toggle="popover" data-content="<?php echo $l['calc_rf_help']; ?>" data-title="<?php echo $l['calc_rf_title']; ?>"><?php echo $l['calc_rf_title']; ?></u></label>
									<div class="col-sm-8">
										<input type="text" name="rf" class="form-control" id="rf" value="<?php echo get_data('rf', 13); ?>" data-default="13">
									</div>
								</div>
							</div>

							<div id="advanced-settings" class="advanced <?php echo (get_data('btn_advanced_mode', 0) == 1 ? '' : 'nodisplay');?>">

								<hr />


								<div class="form-group">
									<label class="col-sm-4 control-label"><u data-toggle="popover" data-content="<?php echo $l['surname_help']; ?>" data-title="<?php echo $l['surname_title']; ?>"><?php echo $l['surname_title']; ?></u></label>
									<div class="col-sm-8">
										<input type="text" name="surname" class="form-control" id="surname" value="<?php echo get_data('surname', ''); ?>" data-default="">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label"><u data-toggle="popover" data-content="<?php echo $l['gun_name_help']; ?>" data-title="<?php echo $l['gun_name_title']; ?>"><?php echo $l['gun_name_title']; ?></u></label>
									<div class="col-sm-8">
										<input type="text" name="gun_name" class="form-control" id="gun_name" value="<?php echo get_data('gun_name', ''); ?>" data-default="">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-4 control-label"><?php echo $l['barrel_type_title']; ?></label>
									<div class="col-sm-8">
										<select name="barrel_type" class="form-control" id="barrel_type">
											<option value=""></option>
											<?php
											foreach($barrels as $k => $barrel)
											{
												if ($k == 98)
													echo '<option value="" disabled>-----------------</option>';
												echo '<option value="' . $k . '" ' . (get_data('barrel_type', '') == $k ? 'selected' : '') . '>' . $barrel . '</option>';
											}
											?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-4 control-label"><?php echo $l['hopup_rubber_title']; ?></label>
									<div class="col-sm-8">
										<select name="hopup_rubber" class="form-control" id="hopup_rubber">
											<option value=""></option>
											<?php
											foreach($hopup_rubbers as $k => $hopup_rubber)
											{
												if ($k == 98)
													echo '<option value="" disabled>-----------------</option>';
												echo '<option value="' . $k . '" ' . (get_data('hopup_rubber', '') == $k ? 'selected' : '') . '>' . $hopup_rubber . '</option>';
											}
											?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-4 control-label"><u data-toggle="popover" data-content="<?php echo $l['range_help']; ?>" data-title="<?php echo $l['range_title']; ?>"><?php echo $l['range_title']; ?></u></label>
									<div class="col-sm-8">
										<select name="range" class="form-control" id="range">
											<option value=""></option>
											<?php
											foreach($ranges as $k => $range)
											{
												if ($k == 98)
													echo '<option value="" disabled>-----------------</option>';
												echo '<option value="' . $k . '" ' . (get_data('range', '') == $k ? 'selected' : '') . '>' . $range . '</option>';
											}
											?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-4 control-label"><u data-toggle="popover" data-content="<?php echo $l['bb_weight_help']; ?>" data-title="<?php echo $l['bb_weight_title']; ?>"><?php echo $l['bb_weight_title']; ?></u></label>
									<div class="col-sm-8">
										<select name="bb_weight" class="form-control" id="bb_weight">
											<option value=""></option>
											<?php
											foreach(explode(' ', '0.20 0.23 0.23 0.28 0.30 0.36 0.40 0.45') as $bb_weight)
												echo '<option value="' . $bb_weight . '" ' . (get_data('bb_weight', '') == $bb_weight ? 'selected' : '') . '>' . $bb_weight . '</option>';
											?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-4 control-label"><?php echo $l['psi_title']; ?></label>
									<div class="col-sm-8">
										<input type="text" name="psi" class="form-control" id="psi" value="<?php echo get_data('psi', ''); ?>" data-default="">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-4 control-label"><u data-toggle="popover" data-content="<?php echo $l['comment_help']; ?>" data-title="<?php echo $l['comment_title']; ?>"><?php echo $l['comment_title']; ?></u></label>
									<div class="col-sm-8">
										<textarea rows="5" name="comment" class="form-control" id="comment"><?php echo get_data('comment', ''); ?></textarea>
									</div>
								</div>
							</div>

							<hr />

							<div class="row form-inline col-md-offset-4 col-sm-offset-1 col-md-8 col-sm-12">
								<div class="col-md-7 col-sm-12">
									<input id="submit_link" data-default="<?php echo $l['submit_link']; ?>" data-edit="<?php echo (count($_datas) ? '1' : '0'); ?>" <?php echo (count($_datas) ? 'disabled' : ''); ?> class="btn btn-success" type="submit" value="<?php echo $l['submit_link' . (count($_datas) ? '_edit' : '')]; ?>" data-edit-text="<?php echo $l['submit_link_edit']; ?>">
								</div>
								<div class="col-md-5 col-sm-12">
									<input type="text" value="" id="submit_get_link" class="form-control nodisplay" />
								</div>							
							</div>
						</form>

						<?php if (!is_null($id_conf)) { ?>
						<div class="row form-inline col-md-offset-4 col-sm-offset-1 col-md-8 col-sm-12">
							<br /><br />

						</div>
						<?php } ?>

					</div><!--/row-->
				</div><!--/span-->

			</div><!--/row-->

			<br />

			<div class="row">
				<div id="help" class="anchor"></div>

				<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title"><?php echo $l['menu_help']; ?></h3>
					</div>
					<div class="panel-body">
						<?php echo $l['help_text']; ?>
					</div>
				</div>
			</div>
			<div class="row">

				<div id="issues" class="anchor"></div>

				<div class="panel panel-danger">
					<div class="panel-heading">
						<h3 class="panel-title"><?php echo $l['menu_issues']; ?></h3>
					</div>
					<div class="panel-body">
						<?php echo $l['issue_text']; ?>						
					</div>
				</div>
			</div>

			<div class="row">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title"><?php echo $l['menu_sources']; ?></h3>
					</div>
					<div class="panel-body">
							<ul>
								<li><a href="http://www.pstartalk.com/showthread.php?1890-Settings-by-PolarStar">http://www.pstartalk.com/showthread.php?1890-Settings-by-PolarStar</a></li>
								<li><a href="http://www.powair6.com/"><?php echo $l['sources_p6']; ?></a></li>
							</ul>
					</div>
				</div>
			</div>



			<div class="row">
				<div id="m_fcu_shot" class="anchor"></div>

				<div class="col-xs-12">
					<h2><?php echo $l['menu_fcu_shot']; ?></h2>

					<form id="fcu_shot_form" class="form-horizontal" role="form">
						<div class="form-group">
							<label class="col-sm-4 control-label"><u data-toggle="popover" data-content="<?php echo $l['fcu_shot_help']; ?>" data-title="<?php echo $l['fcu_shot_title']; ?>"><?php echo $l['fcu_shot_title']; ?></u></label>
							<div class="col-sm-8">
								<input type="text" name="fcu_shot" class="form-control" id="fcu_shot" value="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label"><?php echo $l['fcu_shot_calc_title']; ?></label>
							<div class="col-sm-8">
								<input type="text" name="fcu_shot_calc" class="form-control" id="fcu_shot_calc" value="" disabled>
							</div>
						</div>
					</form>
				</div>
			</div>


			<div class="row">
				<div id="m_tank_shot" class="anchor"></div>

				<div class="col-xs-12">
					<h2><?php echo $l['menu_tank_shot']; ?></h2>

					<form id="tank_shot_form" class="form-horizontal" role="form">
						<div class="form-group">
							<label class="col-sm-4 control-label"><u data-toggle="popover" data-content="<?php echo $l['tank_capacity_ci_help']; ?>" data-title="<?php echo $l['tank_capacity_ci_title']; ?>"><?php echo $l['tank_capacity_ci_title']; ?></u></label>
							<div class="col-sm-8">
								<input type="text" name="tank_capacity_ci" class="form-control" id="tank_capacity_ci" value="48">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label"><u data-toggle="popover" data-content="<?php echo $l['tank_capacity_l_help']; ?>" data-title="<?php echo $l['tank_capacity_l_title']; ?>"><?php echo $l['tank_capacity_l_title']; ?></u></label>
							<div class="col-sm-8">
								<input type="text" name="tank_capacity_l" class="form-control" id="tank_capacity_l" value="0.8">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label"><u data-toggle="popover" data-content="<?php echo $l['tank_psi_help']; ?>" data-title="<?php echo $l['tank_psi_title']; ?>"><?php echo $l['tank_psi_title']; ?></u></label>
							<div class="col-sm-8">
								<input type="text" name="tank_psi" class="form-control" id="tank_psi" value="3000">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label"><u data-toggle="popover" data-content="<?php echo $l['regulator_psi_help']; ?>" data-title="<?php echo $l['regulator_psi_title']; ?>"><?php echo $l['regulator_psi_title']; ?></u></label>
							<div class="col-sm-8">
								<input type="text" name="regulator_psi" class="form-control" id="regulator_psi" value="120" disabled>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label"><u data-toggle="popover" data-content="<?php echo $l['tank_shot_help']; ?>" data-title="<?php echo $l['tank_shot_title']; ?>"><?php echo $l['tank_shot_title']; ?></u></label>
							<div class="col-sm-8">
								<input type="text" name="tank_shot" class="form-control" id="tank_shot" value="1440" disabled>
							</div>
						</div>
					</form>
				</div>
			</div>

			<div class="row">
				<div id="m_contact" class="anchor"></div>

				<div class="col-xs-12">
					<h2><?php echo $l['menu_contact']; ?></h2>

					<form id="contact_form" class="form-horizontal" role="form">
						<div class="form-group">
							<label for="email" class="col-sm-4 control-label"><?php echo $l['email']; ?></label>
							<div class="col-sm-8">
								<input type="text" name="email" class="form-control" id="email" value="">
							</div>
						</div>
						<div class="form-group">
							<label for="message" class="col-sm-4 control-label"><?php echo $l['message']; ?></label>
							<div class="col-sm-8">
								<textarea rows="5" name="message" class="form-control" id="message"></textarea>
							</div>
						</div>
						<div class="row form-inline col-sm-offset-4 col-sm-8">
							<input type="submit" class="btn btn-success" value="<?php echo $l['form_send']; ?>" />
						</div>
					</form>
				</div>
			</div>



			<footer>
				<p>&copy; <?php echo date('Y'); ?> www.pstartoolbox.com</p>
			</footer>

		</div><!--/.container-->

	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
	<script src="<?php echo $base_href; ?>js/app.js?<?php echo $version; ?>"></script>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-47313380-2', 'pstartoolbox.com');
		ga('send', 'pageview');
	</script>
</body>
</html>
