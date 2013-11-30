$(function() {
	var err = $('#err').attr('value');
	var question = '';
	var answer = [];

	switch (err) {
	case '1':
		$('div.container').hide();
		$('#errStr').html('Broken URL, Missing survey id or responder!');
		$('#fv').show();
		break;
	case '2':
		$('div.container').hide();
		$('#l2a').attr('href', 'stat.php?id=' + $('#sid').val());
		$('#l3a').attr('href', 'stat2.php?id=' + $('#sid').val());
		$('#nav').show();
		$('#vv').html('You cannot vote for the poll you created').show();
		loadQuestion();
		break;
	case '3':
		$('div.container').hide();
		$('#errStr').html('You have no authentication to see this poll');
		$('#fv').show();
		break;
	case '4':
		$('div.container').hide();
		$('#l2a').attr(
				'href',
				'stat.php?id=' + $('#sid').val() + '&responder='
						+ $('#rid').val());
		$('#nav').show();
		$('#vv').html('You have already voted').show();
		loadQuestion();
		break;
	default:
		$('div.container').hide();
		$('#l2a').attr(
				'href',
				'stat.php?id=' + $('#sid').val() + '&responder='
						+ $('#rid').val());
		$('#nav').show();
		loadQuestion();
		loadRecipients();
		loadOptions();
	}

});

function loadQuestion() {
	$.ajax({
		type : "GET",
		url : 'server/surveyapi.php?f=survey&id=' + $('#sid').val(),
		success : function(data) {
			var question = $.parseJSON(data).question;
			$('#qt').html('Question: ' + question);
			$('#infov').show();
		}
	});
}

function loadRecipients() {
	$.ajax({
		type : "GET",
		url : 'server/surveyapi.php?f=recipient&id=' + $('#sid').val(),
		success : function(data) {
			$('#ar').html('(Other Recipients: ');
			var emails = $.parseJSON(data);
			var i = 0;
			for (; i < emails.length - 1; i++) {
				$('#ar').append(emails[i] + ', ');
			}
			$('#ar').append(emails[i] + ')');
			$('#infov').show();
		}
	});
}

function loadOptions() {
	$.ajax({
		type : "GET",
		url : 'server/surveyapi.php?f=survey&id=' + $('#sid').val(),
		success : function(data) {
			var answers = $.parseJSON(data).answer;
			for (var i = 0; i < answers.length; i++) {
				$('#vf').append(
						'<p><button class="choiceButton btn btn-default" type="button">'
								+ answers[i] + '</button></p>');
			}
			$('#vf button').each(function(index) {
				$(this).attr('onClick', 'submitIt(' + index + ')');
			});
			$('#vv').show();
		}
	});
}

function submitIt(index){
	$.ajax({
		type : "GET",
		url : 'server/response.php',
		data :{
			id : $('#sid').val(),
			respondant : $('#rid').val()
		}
		success : function(data) {
			if(data == 'success'){
				location.replace( $('#l2a').attr('href'));
			}
		}
	});
}