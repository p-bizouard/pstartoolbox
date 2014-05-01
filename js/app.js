$(document).ready(function() {

	$('body').click(function() {
		$('.simple_content .container .row').animate({'opacity': '1'}, 1000);
	});

	$('[data-toggle=popover]').popover({
		'placement':($(document).width() <= 767 ? 'top' : 'left'),
		'html':'true',
		'trigger':'hover'
	});

	$('#re').change(function() {
		calcFromGun();
	});

	$('#gun-settings').on('keyup', 'input', function() {
		if ($(this).val() == '' || isNaN($(this).val() - 0.0))
		{
			$(this).parents('.form-group').addClass('has-error');
			return ;
		}

		$(this).parents('.form-group').removeClass('has-error');
		
		calcFromGun();
	});

	$('#rps-settings').on('keyup', 'input', function() {
		if ($(this).val() == '' || isNaN($(this).val() - 0.0))
		{
			$(this).parents('.form-group').addClass('has-error');
			return ;
		}

		$(this).parents('.form-group').removeClass('has-error');
		
		calcFromGun();
	});

	$('#fcu-settings').on('keyup', 'input', function() {
		if ($(this).val() == '' || isNaN($(this).val() - 0.0))
		{
			$(this).parents('.form-group').addClass('has-error');
			return ;
		}

		$(this).parents('.form-group').removeClass('has-error');
		
		calcRps();
	});

	$('#btn_advanced_mode').click(function() {
		if ($(this).hasClass('active'))
		{
			// Désactivé
			$('.advanced').slideUp();
			$('input[name=btn_advanced_mode]').val(0);
		}
		else
		{
			// Activé
			$('.advanced').slideDown();
			$('input[name=btn_advanced_mode]').val(1);
		}
	});

	$('#settings_form input, #settings_form textarea').keyup(function() {
		if ($(this).attr('id') == 'submit_get_link')
			return ;

		if ($('#submit_link').data('edit') == 1)
		{
			$('#submit_link').removeAttr('disabled');
			$('#submit_link').val($('#submit_link').data('edit-text'));
		}
	});

	$('#settings_form').on('change', 'select', function() {
		if ($('#submit_link').data('edit') == 1)
		{
			$('#submit_link').removeAttr('disabled');
			$('#submit_link').val($('#submit_link').data('edit-text'));
		}
	});

	$('.btn-lock').click(function() {
		if ($(this).val() == 0)
		{
			$(this).val('1');
			$('#' + $(this).data('btn')).val('1');
			$(this).addClass('btn-warning');	
		}
		else
		{
			$(this).val('0');
			$('#' + $(this).data('btn')).val('0');
			$(this).removeClass('btn-warning');	
		}
		return (false);
	});

	$('#settings_form').submit(function(event) {
		event.preventDefault();

		$.post('?get_link', $(this).serialize(), function(result) {
			if (result.result == 'ok')
			{
				var pageurl = window.location.origin + base_href + result.message;
   				window.history.pushState({path:pageurl},'' ,pageurl);
				$('#submit_get_link').val(pageurl);
				$('#submit_get_link').fadeIn();
				$('#submit_link').attr('disabled', 'disabled');
				$('#submit_link').data('edit', '1');
			}
			else
				alert('Ops, something went wrong.');
		}, 'json');
	});

	$('#contact_form input, #contact_form textarea').keyup(function(event) {
		if (event.keyCode == 9)
			return ;
		var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

		$(this).parents('.form-group').removeClass('has-error');
		if ($(this).val() == '')
			$(this).parents('.form-group').addClass('has-error');
		if ($(this).attr('id') == 'email' && !regex.test($('#email').val()))
			$(this).parents('.form-group').addClass('has-error');
	});

	$('#contact_form').submit(function(event) {
		event.preventDefault();
		var test = true;
   		var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

		$('.form-group', this).removeClass('has-error');
		if ($('#email').val() == '' || !regex.test($('#email').val()))
		{
			$('#email').parents('.form-group').addClass('has-error');
			test = false;
		}
		if ($('#message').val() == '')
		{
			$('#message').parents('.form-group').addClass('has-error');
			test = false;
		}

		if (!test)
			return ;

		$('#contact_form input[type=submit]').attr('disabled','disabled');
		$.post('?contact', $(this).serialize(), function(result) {
			if (result.result == 'ok')
			{
				$('#contact_form input[type=submit]').removeAttr('disabled');
				alert(CONTACT_OK);
			}
			else
				alert('Ops, something went wrong.');
		}, 'json');
	});

	$('#reset_form').click(function() {
		$('#settings_form select').val('');
		$('#settings_form textarea').val('');
		$('#settings_form input').each(function() {
			$(this).val($(this).data('default'));
		});
		$('.advanced').slideUp();
		$('#btn_advanced_mode').removeClass('active');
	});

	$('#fcu_shot').keyup(function() {
		$(this).parents('.form-group').removeClass('has-error');
		var reg = new RegExp("^[0-9abcdefABCDEF]+$");

		if (!reg.test($(this).val()))
		{
			$(this).parents('.form-group').addClass('has-error');
			return ;
		}
			$(this).parents('.form-group').removeClass('has-error');

		$('#fcu_shot_calc').val(parseInt($(this).val(), 16));
	});

	var last_tank_shot_capacity = 'tank_capacity_ci';
	$('#tank_shot_form').on('keyup', 'input', function() {
		if ($(this).val() == '' || isNaN($(this).val() - 0.0))
		{
			$(this).parents('.form-group').addClass('has-error');
			return ;
		}

		$(this).parents('.form-group').removeClass('has-error');

		if ($(this).attr('id') == 'tank_capacity_ci')
		{
			$('#tank_capacity_l').val(Math.floor($(this).val() / 6.1023744) / 10);
			last_tank_shot_capacity = $(this).attr('id');
		}
		else if ($(this).attr('id') == 'tank_capacity_l')
		{
			$('#tank_capacity_ci').val(Math.ceil($(this).val() * 610.23744) / 10);
			last_tank_shot_capacity = $(this).attr('id');
		}

		$('#tank_shot').val(Math.round($('#tank_psi').val() * $('#tank_capacity_ci').val() / ($('#regulator_psi').val() - ($('#regulator_psi').val() / 6))));
	});
});

function getDp() {
	if ($('#lock_dp').val() == 1)
		return ($('#dp').val());
	var ms_exit_barrel = (($('#barrel').val() * 1.0) / ($('#fps').val() * 304.8)) * 1000;
	$('#ms_exit_barrel').val(Math.round(ms_exit_barrel * 100) / 100 + ' ms');

	var dp = Math.ceil((ms_exit_barrel - ($('#re option:selected').data('dp') / 10)) * 10) + 2;

	if (dp < 18)
		dp = 18;

	return (dp);
}

// dn = T pendant lequel le nozzle recule, et est en position reculée
// dr = T pendant lequel le nozzle recommence à avancer, et le moment où la FE envoie l'air (MIN 12)
// dp = T pendant lequel la FE envoie l'air
// rf = T pendant lequel la FE attend entre l'arrêt de l'envoie d'air, et elle commence à reculer le nozzle (MIN 4)

function calcRps() {
	var time = $('#dn').val() * 1 + $('#dr').val() * 1 + $('#dp').val() * 0.1 + $('#rf').val() * 1 + ($('#re option:selected').data('dp') / 10);

	$('#rps').val(Math.round((1000 / time) * 10) / 10);
}

function calcFromGun() {
	var dn = 0;
	var dr = 0;
	var rf = 0;
	var dp = getDp();

	var dp_time = Math.round(dp / 10 + ($('#re option:selected').data('dp') / 10));

	var time_max = Math.round((1000 / $('#rps').val()));

	if ($('#lock_dn').val() == 1)
	{
		dn = $('#dn').val();
		dr = 12;
		rf = 4;

		var rest = time_max - dp_time - 12 - 4 - $('#dn').val();
		if (rest > 0)
		{
			while (rest)
			{
				if (rest % 2 == 0)
					dr++;
				else if (rest % 2 == 1)
					rf++;
				rest--;
			}
		}
		else
		{
			while (rest != 0)
			{
				if (-rest % 4 <= 2)
					dr--;
				else
					rf--;
				rest++;
			}
		}
	}
	else
	{
		dn = 14;
		dr = 12;
		rf = 4;

		var rest = time_max - dp_time - 12 - 4 - 14; // 14 = dN default
		if (rest > 0)
		{
			while (rest)
			{
				if (rest % 3 == 0 && dn < 20)
					dn++;
				else if (rest % 3 == 1)
					dr++;
				else if (rest % 3 == 2 || (rest % 3 == 0 && dn >= 20))
					rf++;
				rest--;
			}
		}
		else
		{
			while (rest != 0)
			{
				if (-rest % 6 == 0 || -rest % 6 == 2 || -rest % 6 == 4)
					dn--;
				else if (-rest % 6 == 1 || -rest % 6 == 5)
					dr--;
				else if (-rest % 6 == 3)
					rf--;
				rest++;
			}
		}
	}

	$('#dn').val(dn);
	$('#dr').val(dr);
	$('#dp').val(dp);
	$('#rf').val(rf);

	return ;

	var rest_min = time_max - 14 - 4 - dp_time; // Min dr & rF & dp // Rest dn

	if (time_max < 25)
	{
		dn = time_max - 10 - 3 - dp_time;
		dr = 10;
		rf = 3;
	}
	else if (time_max < 32)
	{
		dn = time_max - 12 - 4 - dp_time;
		dr = 12;
		rf = 4;
	}
	else if (time_max > 50)
	{
		dn = 14;
		dr = 22;
		rf = (time_max - dn - dr - dp_time);
	}
	else
	{
		dn = 14;
		dr = 20;
		rf = (time_max - dn - dr - dp_time);
		if (rf < 4)
		{
			var to_split = 4 - rf;
			dn -= Math.floor(to_split / 2);
			dr -= Math.ceil(to_split / 2);
			rf = 4;
		}
	}

	$('#dn').val(dn);
	$('#dr').val(dr);
	$('#dp').val(dp);
	$('#rf').val(rf);
}