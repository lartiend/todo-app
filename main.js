$(document).ready(function() {

	var d = new Date();
	$("small#time").html(d.toDateString());
	
	// delete All
	$("input[name='deleteAll']").click(function(e) {
		if (confirm("Are you sure you want to delete all unlocked entries? This cannot be undone.")) {
			$('form#deleteAll').submit();
		} else {
        	e.preventDefault();
    	}
	});

	// modal
	$(document).on('click', '.edit_data', function() {
		var id = $(this).attr('id');
		// console.log(id);
		$.ajax({
			url: 'fetch.php',
			method: 'GET',
			dataType: 'json',
			data: {modal_taskID: id},
			success:function(data){
				$('#modal_structure').modal('show'); 
				$('#modal_taskID').val(data.id);
				$('#modal_taskDesc').val(data.description);
			},
		    error: function (jqXHR, exception) {
				console.log(jqXHR);
				console.log(exception);
		    },
		})
	});

	$('#modal_form').on('submit', function(e) {
		var formData =
				{
					'id': 	$('input[name=taskID]').val(),
					'desc': $('input[name=taskDesc]').val(),
				}
		$.ajax({
			url: 'inc/action.php',
			type: 'POST',
			dataType:'json',
			data: {
					action: 'edit', // action.php flag
					data: formData,
				},
			success:function(res){
				// console.log(res);
				$('#modal_form')[0].reset();
				$('#modal_structure').modal('hide');
				$('span#descFromTable'+'_'+res.id).html(res.desc);
			},
			error: function (jqXHR, exception) {
				console.log(jqXHR);
				console.log(exception);
			},
		})
		e.preventDefault();
	});

	// lock/unlock
	$("button[name='lock']").click(function(e) {
		var id = $(this).attr('id');
		$(this).toggleClass('btn-outline-danger btn-outline-success');
		$(this).find('i').toggleClass('fa-lock fa-unlock');
		$('button#delete_'+id).toggleDisabled();
		
		$.ajax({
			url: 'inc/action.php',
			type: 'POST',
			data: {
					action: 'lock', // action.php flag
					data: id,
				},
			success:function(res){
				console.log(res);
			},
			error: function (jqXHR, exception) {
				console.log(jqXHR);
				console.log(exception);
			},
		})
	});

    $.fn.toggleDisabled = function(){
        return this.each(function(){
            this.disabled = !this.disabled;
        });
    };

});

