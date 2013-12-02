$(function() {
	var err = $('#err').attr('value');
	var question = '';
	var answer = [];

	switch (err) {
	case '1':
		$('div.container').hide();
		$('#l2a').attr('href', 'stat.php?id=' + $('#sid').val());
		$('#nav').show();
		$('#vv').html('You cannot vote for the poll you created').show();
		loadQuestion();
		loadRecipients();
		break;
	case '2':
		$('div.container').hide();
		$('#l2a').attr(
				'href',
				'stat.php?id=' + $('#sid').val() + '&responder='
						+ $('#rid').val());
		$('#nav').show();
		$('#vv').html('You have already voted').show();
		loadQuestion();
		loadRecipients();
		break;
    //no responder
    case '3':
        $('div.container').hide();
        $('#l2a').attr(
                 'href',
                 'stat.php?id=' + $('#sid').val());
        $('#nav').show();
        loadQuestion();
        loadRecipients();
        loadOptions();
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

	$('#root').show();
});

function loadNevigation()
{
    var contain = $('#exist').attr('value');
    if (contain == "false")
    {
        $('#l2').attr('href', 'stat.php?id=' + $('#sid').val());
        $('#l3').attr('href', 'stat2.php?id=' + $('#sid').val());
    }
    else
    {
    $('#l2').attr('href', 'stat.php?id=' + $('#sid').val() + '&responder='
                  + $('#rid').val()   );
    $('#l3').attr('href', 'stat2.php?id=' + $('#sid').val()  + '&responder='
                  + $('#rid').val()  );
    }
}

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

function submitIt(index) {
	$.ajax({
		type : "GET",
		url : 'server/response.php',
		data : {
			id : $('#sid').val(),
			respondant : $('#rid').val(),
			choice : index
		},
		success : function(data) {
			if (data == 'success') {
				location.replace($('#l2a').attr('href'));
			}
		}
	});
}