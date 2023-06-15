"use strict";


$(document).on('click','.delete_tax',function(e){
	e.preventDefault();
	var id = $(this).data("id");
	swal({
	title: are_you_sure,
	text: you_want_to_delete_this_tax,
	icon: 'warning',
    dangerMode: true,
    buttons: true,
    buttons: [cancel, ok]
	})
	.then((willDelete) => {
		if (willDelete) {
			$.ajax({
				type: "POST",
				url: base_url+'settings/delete-taxes/'+id, 
				data: "id="+id,
				dataType: "json",
				success: function(result) 
				{	
					if(result['error'] == false){
						$('#taxes_list').bootstrapTable('refresh');
					}else{
						iziToast.error({
							title: result['message'],
							message: "",
							position: 'topRight'
						});
					}
				}        
			});
		} 
	});
});

$("#taxes-form").submit(function(e) {
	e.preventDefault();
  let save_button = $(this).find('.savebtn'),
    output_status = $(this).find('.result'),
    card = $('#taxes-card');

  let card_progress = $.cardProgress(card, {
    spinner: true
  });
  save_button.addClass('btn-progress');
  output_status.html('');
  
    var formData = new FormData(this);
    $.ajax({
	    type:'POST',
	    url: $(this).attr('action'),
	    data:formData,
	    cache:false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(result){
		    if(result['error'] == false){
				$('#taxes_list').bootstrapTable('refresh');
		    	output_status.prepend('<div class="alert alert-success">'+result['message']+'</div>');
				$("#update_id").val('');
				$("#title").val('');
				$("#tax").val('');
				$("#tax_cancel").addClass('d-none');
				$(".savebtn").html(create);
		    }else{
		        output_status.prepend('<div class="alert alert-danger">'+result['message']+'</div>');
		    }
		    output_status.find('.alert').delay(4000).fadeOut();    
      		save_button.removeClass('btn-progress');  
      		card_progress.dismiss(function() {
		      $('html, body').animate({
		        scrollTop: output_status.offset().top
		      }, 1000);
		    });
		}
    });
});

$(document).on('click','#tax_cancel',function(e){
	$("#update_id").val('');
	$("#title").val('');
	$("#tax").val('');
	$(".savebtn").html(create);
	$("#tax_cancel").addClass('d-none');
});

$(document).on('click','.edit_tax',function(e){
	e.preventDefault();

    let save_button = $(this);
  	save_button.addClass('btn-progress');

    var id = $(this).data("id");
    $.ajax({
        type: "POST",
        url: base_url+'settings/get_taxes/'+id, 
        data: "id="+id,
        dataType: "json",
        success: function(result) 
        {
			save_button.removeClass('btn-progress');
        	if(result[0].id){
	        	$("#update_id").val(result[0].id);
	        	$("#title").val(result[0].title);
	        	$("#tax").val(result[0].tax);
				$(".savebtn").html(update);
				$("#tax_cancel").removeClass('d-none');
				$('html, body').animate({
					scrollTop: 0
				  }, 1000);
    		}else{
    			iziToast.error({
				    title: something_wrong_try_again,
				    message: "",
				    position: 'topRight'
				});
    		}
        }        
    });
});


$(document).on('click','.modal-edit-card',function(e){
	e.preventDefault();
    let save_button = $(this);
  	save_button.addClass('btn-progress');
    var id = $(this).data("id");
    $.ajax({
        type: "POST",
        url: base_url+'cards/ajax_get_custom_domain_by_id', 
        data: "id="+id,
        dataType: "json",
        success: function(result) 
        {
			save_button.removeClass('btn-progress');
        	if(result['error'] == false){

				$("#card_id").val(result['data'].id);
				
				$("#custom_domain").val(result['data'].custom_domain);

				$("#custom_domain_status").val(result['data'].custom_domain_status);
				$("#custom_domain_status").trigger('change');

	    		$("#modal-edit-card").trigger("click");
    		}else{
    			iziToast.error({
				    title: something_wrong_try_again,
				    message: "",
				    position: 'topRight'
				});
    		}
        }        
    });
});

$("#modal-edit-card").fireModal({
	size: 'modal-lg',
	title: $("#modal-edit-card-part").data('title'),
	body: $("#modal-edit-card-part"),
	footerClass: 'bg-whitesmoke',
	autoFocus: false,
	onFormSubmit: function(modal, e, form) {
    var formData = new FormData(this);
    $.ajax({
	    type:'POST',
	    url: $(this).attr('action'),
	    data:formData,
	    cache:false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(result){
		    if(result['error'] == false){
				location.reload();
		    }else{
		        modal.find('.modal-body').append('<div class="alert alert-danger">'+result['message']+'</div>');
		    }
		    modal.find('.modal-body').find('.alert').delay(4000).fadeOut();    
      		form.stopProgress();  
		}
    });

    e.preventDefault();
  },
  buttons: [
    {
      text: $("#modal-edit-card-part").data('btn'),
      submit: true,
      class: 'btn btn-primary',
      handler: function(modal) {
      }
    }
  ]
});

$(document).on('click','.clone-card',function(e){
	e.preventDefault();
	var id = $(this).data("id");
	swal({
	title: are_you_sure,
	icon: 'warning',
    dangerMode: true,
    buttons: true,
    buttons: [cancel, ok]
	})
	.then((willDelete) => {
		if (willDelete) {
			$.ajax({
				type: "POST",
				url: base_url+'cards/clone/'+id, 
				data: "id="+id,
				dataType: "json",
				success: function(result) 
				{	
					if(result['error'] == false){
						location.reload()
					}else{
						iziToast.error({
							title: result['message'],
							message: "",
							position: 'topRight'
						});
					}
				}        
			});
		} 
	});
});

$("#modal-add-contact_details").fireModal({
	size: 'modal-lg',
	title: $("#modal-add-contact_details-part").data('title'),
	body: $("#modal-add-contact_details-part"),
	footerClass: 'bg-whitesmoke',
	autoFocus: false,
	onFormSubmit: function(modal, e, form) {
	  var formData = new FormData(this);
	  $.ajax({
		  type:'POST',
		  url: $(this).attr('action'),
		  data:formData,
		  cache:false,
		  contentType: false,
		  processData: false,
		  dataType: "json",
		  success:function(result){
			  if(result['error'] == false){
				  location.reload();
			  }else{
				  modal.find('.modal-body').append('<div class="alert alert-danger">'+result['message']+'</div>');
			  }
			  modal.find('.modal-body').find('.alert').delay(4000).fadeOut();    
				form.stopProgress();  
		  }
	  });
  
	  e.preventDefault();
	},
	buttons: [
	  {
		text: $("#modal-add-contact_details-part").data('btn'),
		submit: true,
		class: 'btn btn-primary ',
		handler: function(modal) {
		}
	  }
	]
});


$(document).on('click','.modal-edit-contact_details',function(e){
	e.preventDefault();
    let save_button = $(this);
  	save_button.addClass('btn-progress');
    var id = $(this).data("id");
    $.ajax({
        type: "POST",
        url: base_url+'cards/ajax_get_custom_fields_by_id', 
        data: "id="+id,
        dataType: "json",
        success: function(result) 
        {
			save_button.removeClass('btn-progress');
        	if(result['error'] == false){
				$("#type").val(result['data'][0].type);
				$("#type").trigger('change');

				$("#update_id").val(result['data'][0].id);

				var $type = result['data'][0].type;
				var $field_icon = 'fas fa-link';
				var $placeholder_text = text;
				var $placeholder_url = url;

				if($type == 'mobile'){
				$field_icon = 'fas fa-mobile-alt';
				$placeholder_text = '+001234567890';
				$placeholder_url = '+001234567890';
				}else if($type == 'email'){
				$field_icon = 'far fa-envelope';
				$placeholder_text = 'youremail@example.com';
				$placeholder_url = 'youremail@example.com';
				}else if($type == 'address'){
				$field_icon = 'fas fa-map-marker-alt';
				$placeholder_text = 'Silicon Valley, California, USA';
				$placeholder_url = 'https://goo.gl/maps/';
				}else if($type == 'whatsapp'){
				$field_icon = 'fab fa-whatsapp';
				$placeholder_text = 'WhatsApp';
				$placeholder_url = '001234567890';
				}else if($type == 'linkedin'){
				$field_icon = 'fab fa-linkedin-in';
				$placeholder_text = 'LinkedIn';
				$placeholder_url = 'https://www.linkedin.com/';
				}else if($type == 'website'){
				$field_icon = 'fas fa-link';
				$placeholder_text = website;
				$placeholder_url = base_url;
				}else if($type == 'facebook'){
				$field_icon = 'fab fa-facebook-f';
				$placeholder_text = 'Facebook';
				$placeholder_url = 'https://www.facebook.com/';
				}else if($type == 'twitter'){
				$field_icon = 'fab fa-twitter';
				$placeholder_text = 'Twitter';
				$placeholder_url = 'https://twitter.com/';
				}else if($type == 'instagram'){
				$field_icon = 'fab fa-instagram';
				$placeholder_text = 'Instagram';
				$placeholder_url = 'https://www.instagram.com/';
				}else if($type == 'telegram'){
				$field_icon = 'fab fa-telegram-plane';
				$placeholder_text = 'Telegram';
				$placeholder_url = 'https://t.me/yoururl';
				}else if($type == 'skype'){
				$field_icon = 'fab fa-skype';
				$placeholder_text = 'Skype';
				$placeholder_url = username;
				}else if($type == 'youtube'){
				$field_icon = 'fab fa-youtube';
				$placeholder_text = 'YouTube';
				$placeholder_url = 'https://www.youtube.com/';
				}else if($type == 'tiktok'){
				$field_icon = 'fas fa-microphone-alt';
				$placeholder_text = 'TikTok';
				$placeholder_url = 'https://www.tiktok.com/';
				}else if($type == 'snapchat'){
				$field_icon = 'fab fa-snapchat-ghost';
				$placeholder_text = 'Snapchat';
				$placeholder_url = 'https://www.snapchat.com/';
				}else if($type == 'paypal'){
				$field_icon = 'fab fa-paypal';
				$placeholder_text = 'Paypal';
				$placeholder_url = 'https://www.paypal.com/';
				}else if($type == 'github'){
				$field_icon = 'fab fa-github';
				$placeholder_text = 'Github';
				$placeholder_url = 'https://github.com/';
				}else if($type == 'pinterest'){
				$field_icon = 'fab fa-pinterest-p';
				$placeholder_text = 'Pinterest';
				$placeholder_url = 'https://www.pinterest.com/';
				}else if($type == 'wechat'){
				$field_icon = 'fab fa-rocketchat';
				$placeholder_text = 'WeChat';
				$placeholder_url = username;
				}else if($type == 'signal'){
				$field_icon = 'fas fa-signal';
				$placeholder_text = 'Signal';
				$placeholder_url = '+001234567890';
				}else if($type == 'discord'){
				$field_icon = 'fab fa-discord';
				$placeholder_text = 'Discord';
				$placeholder_url = 'https://discord.com/';
				}else if($type == 'reddit'){
				$field_icon = 'fab fa-reddit-alien';
				$placeholder_text = 'Reddit';
				$placeholder_url = 'https://www.reddit.com/';
				}else if($type == 'spotify'){
				$field_icon = 'fab fa-spotify';
				$placeholder_text = 'Spotify';
				$placeholder_url = 'https://www.spotify.com/';
				}else if($type == 'vimeo'){
				$field_icon = 'fab fa-vimeo-v';
				$placeholder_text = 'Vimeo';
				$placeholder_url = 'https://vimeo.com/';
				}else if($type == 'soundcloud'){
				$field_icon = 'fab fa-soundcloud';
				$placeholder_text = 'Soundcloud';
				$placeholder_url = 'https://soundcloud.com/';
				}else if($type == 'dribbble'){
				$field_icon = 'fab fa-dribbble';
				$placeholder_text = 'Dribbble';
				$placeholder_url = 'https://dribbble.com/';
				}else if($type == 'behance'){
				$field_icon = 'fab fa-behance';
				$placeholder_text = 'Behance';
				$placeholder_url = 'https://www.behance.net/';
				}else if($type == 'flickr'){
				$field_icon = 'fab fa-flickr';
				$placeholder_text = 'Flickr';
				$placeholder_url = 'https://www.flickr.com/';
				}else if($type == 'twitch'){
				$field_icon = 'fab fa-twitch';
				$placeholder_text = 'Twitch';
				$placeholder_url = 'https://www.twitch.tv/';
				}else{
				$type = 'custom'
				result['data'][0].icon = $field_icon = 'fas fa-fire';
				$placeholder_text = text;
				$placeholder_url = url;
				}

				$(".input_fields_wrap").html('<input type="hidden" name="type" value="'+$type+'"><div class="col-md-2">'+
				'<button role="iconpicker" data-icon="'+result['data'][0].icon+'" data-cols="5" data-iconset="fontawesome5" data-label-header="{0} of {1} pages" data-label-footer="{0} - {1} of {2} icons" data-placement="top" data-rows="5" data-search="true" data-search-text="" data-selected-class="btn-success" data-unselected-class="" class="icon m-1 btn btn-block btn-default border iconpicker dropdown-toggle" name="icon"><i class="'+result['data'][0].icon+'"></i><input type="hidden" name="icon" value="'+result['data'][0].icon+'"><span class="caret"></span></button>'+
				'</div>'+
				'<div class="col-md-5">'+
					'<input type="text" name="title" value="'+result['data'][0].title+'" placeholder="'+$placeholder_text+'" class="form-control">'+
				'</div>'+
				'<div class="col-md-5">'+
					'<input type="text" name="url" value="'+result['data'][0].url+'" placeholder="'+$placeholder_url+'" class="form-control">'+
				'</div>');

				$('.icon').iconpicker({  
				cols: 5,
				icon: result['data'][0].icon,
				iconset: 'fontawesome5',
				labelHeader: '{0} of {1} pages',
				labelFooter: '{0} - {1} of {2} icons',
				placement: 'top',
				rows: 5,
				search: true,
				searchText: '',
				selectedClass: 'btn-success',
				unselectedClass: ''
				});

	    		$("#modal-edit-contact_details").trigger("click");
    		}else{
    			iziToast.error({
				    title: something_wrong_try_again,
				    message: "",
				    position: 'topRight'
				});
    		}
        }        
    });
});

$("#modal-edit-contact_details").fireModal({
	size: 'modal-lg',
	title: $("#modal-edit-contact_details-part").data('title'),
	body: $("#modal-edit-contact_details-part"),
	footerClass: 'bg-whitesmoke',
	autoFocus: false,
	onFormSubmit: function(modal, e, form) {
    var formData = new FormData(this);
    $.ajax({
	    type:'POST',
	    url: $(this).attr('action'),
	    data:formData,
	    cache:false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(result){
		    if(result['error'] == false){
				location.reload();
		    }else{
		        modal.find('.modal-body').append('<div class="alert alert-danger">'+result['message']+'</div>');
		    }
		    modal.find('.modal-body').find('.alert').delay(4000).fadeOut();    
      		form.stopProgress();  
		}
    });

    e.preventDefault();
  },
  buttons: [
    {
      text: $("#modal-edit-contact_details-part").data('btn'),
      submit: true,
      class: 'btn btn-primary',
      handler: function(modal) {
      }
    }
  ]
});

$(document).on('click','.delete_contact_details',function(e){
	e.preventDefault();
	var id = $(this).data("id");
	swal({
	title: are_you_sure,
	icon: 'warning',
    dangerMode: true,
    buttons: true,
    buttons: [cancel, ok]
	})
	.then((willDelete) => {
		if (willDelete) {
			$.ajax({
				type: "POST",
				url: base_url+'cards/delete_custom_fields/'+id, 
				data: "id="+id,
				dataType: "json",
				success: function(result) 
				{	
					if(result['error'] == false){
						location.reload()
					}else{
						iziToast.error({
							title: result['message'],
							message: "",
							position: 'topRight'
						});
					}
				}        
			});
		} 
	});
});

$(document).on('click','#user_login_btn',function(e){
	e.preventDefault();
    var id = $("#update_id").val();
    swal({
    title: are_you_sure,
    text: you_will_be_logged_out_from_the_current_account,
    icon: 'warning',
    dangerMode: true,
    buttons: true,
    buttons: [cancel, ok]
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
		        type: "POST",
		        url: base_url+'auth/login_as_admin', 
		        data: "id="+id,
		        dataType: "json",
		        success: function(result) 
		        {	
		        	if(result['error'] == false){
			        	location.reload();
		    		}else{
		    			iziToast.error({
						    title: result['message'],
						    message: "",
						    position: 'topRight'
						});
		    		}
		        }        
		    });
        } 
    });
});

$("#support-form").submit(function(e) {
	e.preventDefault();
  let save_button = $(this).find('.savebtn'),
  output_status = $(this).find('.result'),
    card = $('#support-form-card');

  let card_progress = $.cardProgress(card, {
    spinner: true
  });
  save_button.addClass('btn-progress');
  output_status.html('');
  
    var formData = new FormData(this);
    $.ajax({
	    type:'POST',
	    url: $(this).attr('action'),
	    data:formData,
	    cache:false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(result){
		    if(result['error'] == false){
				location.reload();
		    }else{
		        output_status.prepend('<div class="alert alert-danger">'+result['message']+'</div>');
		    }
		    output_status.find('.alert').delay(4000).fadeOut();    
      		save_button.removeClass('btn-progress');  
      		card_progress.dismiss(function() {
		      $('html, body').animate({
		        scrollTop: output_status.offset().top
		      }, 1000);
		    });
		}
    });
});

$(document).on('click','.delete_support',function(e){
	e.preventDefault();
	var id = $(this).data("id");
	swal({
	title: are_you_sure,
	icon: 'warning',
    dangerMode: true,
    buttons: true,
    buttons: [cancel, ok]
	})
	.then((willDelete) => {
		if (willDelete) {
			$.ajax({
				type: "POST",
				url: base_url+'support/delete/'+id, 
				data: "id="+id,
				dataType: "json",
				success: function(result) 
				{	
					if(result['error'] == false){
						location.reload()
					}else{
						iziToast.error({
							title: result['message'],
							message: "",
							position: 'topRight'
						});
					}
				}        
			});
		} 
	});
});

$("#modal-add-support").fireModal({
	title: $("#modal-add-support-part").data('title'),
	body: $("#modal-add-support-part"),
	footerClass: 'bg-whitesmoke',
	autoFocus: false,
	onFormSubmit: function(modal, e, form) {
	  var formData = new FormData(this);
	  $.ajax({
		  type:'POST',
		  url: $(this).attr('action'),
		  data:formData,
		  cache:false,
		  contentType: false,
		  processData: false,
		  dataType: "json",
		  success:function(result){
			  if(result['error'] == false){
				window.location.replace(base_url+"support/chat/"+result['data']);
			  }else{
				modal.find('.modal-body').append('<div class="alert alert-danger">'+result['message']+'</div>');
			  }
			  modal.find('.modal-body').find('.alert').delay(4000).fadeOut();    
				form.stopProgress();  
		  }
	  });
  
	  e.preventDefault();
	},
	buttons: [
	  {
		text: $("#modal-add-support-part").data('btn'),
		submit: true,
		class: 'btn btn-primary ',
		handler: function(modal) {
		}
	  }
	]
});
$(document).on('click','.modal-edit-support',function(e){
	e.preventDefault();

    let save_button = $(this);
  	save_button.addClass('btn-progress');

    var id = $(this).data("edit");
    $.ajax({
        type: "POST",
        url: base_url+'support/get_support_by_id', 
        data: "id="+id,
        dataType: "json",
        success: function(result) 
        {
			save_button.removeClass('btn-progress');
        	if(result['error'] == false && result['data'] != ''){
				
	        	$("#update_id").val(result['data'][0].id);

				$("#user_id").val(result['data'][0].user_id);
				$("#user_id").trigger("change");

				$("#status").val(result['data'][0].status);
				$("#status").trigger("change");
				
	        	$("#subject").val(result['data'][0].subject);
				
	    		$("#modal-edit-support").trigger("click");
    		}else{
    			iziToast.error({
				    title: something_wrong_try_again,
				    message: "",
				    position: 'topRight'
				});
    		}
        }        
    });
});

$("#modal-edit-support").fireModal({
	title: $("#modal-edit-support-part").data('title'),
	body: $("#modal-edit-support-part"),
	footerClass: 'bg-whitesmoke',
	autoFocus: false,
	onFormSubmit: function(modal, e, form) {
    var formData = new FormData(this);
    $.ajax({
	    type:'POST',
	    url: $(this).attr('action'),
	    data:formData,
	    cache:false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(result){
		    if(result['error'] == false){
				location.reload()
		    }else{
		        modal.find('.modal-body').append('<div class="alert alert-danger">'+result['message']+'</div>');
		    }
		    modal.find('.modal-body').find('.alert').delay(4000).fadeOut();    
      		form.stopProgress();  
		}
    });

    e.preventDefault();
  },
  buttons: [
    {
      text: $("#modal-edit-support-part").data('btn'),
      submit: true,
      class: 'btn btn-primary',
      handler: function(modal) {
      }
    }
  ]
});

$(document).on('click','#agree_regi',function(){
	if($(this).prop('checked') == true){
		$(".savebtn").removeAttr("disabled");
	}else{
		$(".savebtn").attr("disabled", true);
	}
});


$(document).on('click','.delete-card',function(e){
	e.preventDefault();
	var id = $(this).data("id");
	swal({
	title: are_you_sure,
	icon: 'warning',
    dangerMode: true,
    buttons: true,
    buttons: [cancel, ok]
	})
	.then((willDelete) => {
		if (willDelete) {
			$.ajax({
				type: "POST",
				url: base_url+'cards/delete_card/'+id, 
				data: "id="+id,
				dataType: "json",
				success: function(result) 
				{	
					if(result['error'] == false){
						location.reload()
					}else{
						iziToast.error({
							title: result['message'],
							message: "",
							position: 'topRight'
						});
					}
				}        
			});
		} 
	});
});

$("#modal-add-testimonials").fireModal({
	size: 'modal-lg',
	title: $("#modal-add-testimonials-part").data('title'),
	body: $("#modal-add-testimonials-part"),
	footerClass: 'bg-whitesmoke',
	autoFocus: false,
	onFormSubmit: function(modal, e, form) {
	  var formData = new FormData(this);
	  $.ajax({
		  type:'POST',
		  url: $(this).attr('action'),
		  data:formData,
		  cache:false,
		  contentType: false,
		  processData: false,
		  dataType: "json",
		  success:function(result){
			  if(result['error'] == false){
				  location.reload();
			  }else{
				  modal.find('.modal-body').append('<div class="alert alert-danger">'+result['message']+'</div>');
			  }
			  modal.find('.modal-body').find('.alert').delay(4000).fadeOut();    
				form.stopProgress();  
		  }
	  });
  
	  e.preventDefault();
	},
	buttons: [
	  {
		text: $("#modal-add-testimonials-part").data('btn'),
		submit: true,
		class: 'btn btn-primary ',
		handler: function(modal) {
		}
	  }
	]
});


$(document).on('click','.modal-edit-testimonials',function(e){
	e.preventDefault();
    let save_button = $(this);
  	save_button.addClass('btn-progress');
    var id = $(this).data("id");
    $.ajax({
        type: "POST",
        url: base_url+'cards/ajax_get_testimonials_by_id', 
        data: "id="+id,
        dataType: "json",
        success: function(result) 
        {
			save_button.removeClass('btn-progress');
        	if(result['error'] == false){

				$("#update_id").val(result['data'][0].id);

				$("#old_image").val(result['data'][0].image);
				
				$("#title").val(result['data'][0].title);
				$("#description").html(result['data'][0].description);
				$("#rating").val(result['data'][0].rating);

	    		$("#modal-edit-testimonials").trigger("click");
    		}else{
    			iziToast.error({
				    title: something_wrong_try_again,
				    message: "",
				    position: 'topRight'
				});
    		}
        }        
    });
});

$("#modal-edit-testimonials").fireModal({
	size: 'modal-lg',
	title: $("#modal-edit-testimonials-part").data('title'),
	body: $("#modal-edit-testimonials-part"),
	footerClass: 'bg-whitesmoke',
	autoFocus: false,
	onFormSubmit: function(modal, e, form) {
    var formData = new FormData(this);
    $.ajax({
	    type:'POST',
	    url: $(this).attr('action'),
	    data:formData,
	    cache:false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(result){
		    if(result['error'] == false){
				location.reload();
		    }else{
		        modal.find('.modal-body').append('<div class="alert alert-danger">'+result['message']+'</div>');
		    }
		    modal.find('.modal-body').find('.alert').delay(4000).fadeOut();    
      		form.stopProgress();  
		}
    });

    e.preventDefault();
  },
  buttons: [
    {
      text: $("#modal-edit-testimonials-part").data('btn'),
      submit: true,
      class: 'btn btn-primary',
      handler: function(modal) {
      }
    }
  ]
});

$(document).on('click','.delete_testimonials',function(e){
	e.preventDefault();
	var id = $(this).data("id");
	swal({
	title: are_you_sure,
	icon: 'warning',
    dangerMode: true,
    buttons: true,
    buttons: [cancel, ok]
	})
	.then((willDelete) => {
		if (willDelete) {
			$.ajax({
				type: "POST",
				url: base_url+'cards/delete_testimonials/'+id, 
				data: "id="+id,
				dataType: "json",
				success: function(result) 
				{	
					if(result['error'] == false){
						location.reload()
					}else{
						iziToast.error({
							title: result['message'],
							message: "",
							position: 'topRight'
						});
					}
				}        
			});
		} 
	});
});

$("#modal-add-custom_sections").fireModal({
	size: 'modal-lg',
	title: $("#modal-add-custom_sections-part").data('title'),
	body: $("#modal-add-custom_sections-part"),
	footerClass: 'bg-whitesmoke',
	autoFocus: false,
	onFormSubmit: function(modal, e, form) {
	  var formData = new FormData(this);
	  $.ajax({
		  type:'POST',
		  url: $(this).attr('action'),
		  data:formData,
		  cache:false,
		  contentType: false,
		  processData: false,
		  dataType: "json",
		  success:function(result){
			  if(result['error'] == false){
				  location.reload();
			  }else{
				  modal.find('.modal-body').append('<div class="alert alert-danger">'+result['message']+'</div>');
			  }
			  modal.find('.modal-body').find('.alert').delay(4000).fadeOut();    
				form.stopProgress();  
		  }
	  });
  
	  e.preventDefault();
	},
	buttons: [
	  {
		text: $("#modal-add-custom_sections-part").data('btn'),
		submit: true,
		class: 'btn btn-primary ',
		handler: function(modal) {
		}
	  }
	]
});


$(document).on('click','.modal-edit-custom_sections',function(e){
	e.preventDefault();
    let save_button = $(this);
  	save_button.addClass('btn-progress');
    var id = $(this).data("id");
    $.ajax({
        type: "POST",
        url: base_url+'cards/ajax_get_custom_sections_by_id', 
        data: "id="+id,
        dataType: "json",
        success: function(result) 
        {
			save_button.removeClass('btn-progress');
        	if(result['error'] == false){

				$("#update_id").val(result['data'][0].id);
				
				$("#title").val(result['data'][0].title);

				// $("#content").html(result['data'][0].content);

				tinyMCE.get('content').setContent(result['data'][0].content);

				// tinyMCE.activeEditor.setContent(result['data'][0].content);

	    		$("#modal-edit-custom_sections").trigger("click");
    		}else{
    			iziToast.error({
				    title: something_wrong_try_again,
				    message: "",
				    position: 'topRight'
				});
    		}
        }        
    });
});

$("#modal-edit-custom_sections").fireModal({
	size: 'modal-lg',
	title: $("#modal-edit-custom_sections-part").data('title'),
	body: $("#modal-edit-custom_sections-part"),
	footerClass: 'bg-whitesmoke',
	autoFocus: false,
	onFormSubmit: function(modal, e, form) {
    var formData = new FormData(this);
    $.ajax({
	    type:'POST',
	    url: $(this).attr('action'),
	    data:formData,
	    cache:false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(result){
		    if(result['error'] == false){
				location.reload();
		    }else{
		        modal.find('.modal-body').append('<div class="alert alert-danger">'+result['message']+'</div>');
		    }
		    modal.find('.modal-body').find('.alert').delay(4000).fadeOut();    
      		form.stopProgress();  
		}
    });

    e.preventDefault();
  },
  buttons: [
    {
      text: $("#modal-edit-custom_sections-part").data('btn'),
      submit: true,
      class: 'btn btn-primary',
      handler: function(modal) {
      }
    }
  ]
});

$(document).on('click','.delete_custom_sections',function(e){
	e.preventDefault();
	var id = $(this).data("id");
	swal({
	title: are_you_sure,
	icon: 'warning',
    dangerMode: true,
    buttons: true,
    buttons: [cancel, ok]
	})
	.then((willDelete) => {
		if (willDelete) {
			$.ajax({
				type: "POST",
				url: base_url+'cards/delete_custom_sections/'+id, 
				data: "id="+id,
				dataType: "json",
				success: function(result) 
				{	
					if(result['error'] == false){
						location.reload()
					}else{
						iziToast.error({
							title: result['message'],
							message: "",
							position: 'topRight'
						});
					}
				}        
			});
		} 
	});
});


$("#modal-add-portfolio").fireModal({
	size: 'modal-lg',
	title: $("#modal-add-portfolio-part").data('title'),
	body: $("#modal-add-portfolio-part"),
	footerClass: 'bg-whitesmoke',
	autoFocus: false,
	onFormSubmit: function(modal, e, form) {
	  var formData = new FormData(this);
	  $.ajax({
		  type:'POST',
		  url: $(this).attr('action'),
		  data:formData,
		  cache:false,
		  contentType: false,
		  processData: false,
		  dataType: "json",
		  success:function(result){
			  if(result['error'] == false){
				  location.reload();
			  }else{
				  modal.find('.modal-body').append('<div class="alert alert-danger">'+result['message']+'</div>');
			  }
			  modal.find('.modal-body').find('.alert').delay(4000).fadeOut();    
				form.stopProgress();  
		  }
	  });
  
	  e.preventDefault();
	},
	buttons: [
	  {
		text: $("#modal-add-portfolio-part").data('btn'),
		submit: true,
		class: 'btn btn-primary ',
		handler: function(modal) {
		}
	  }
	]
});


$(document).on('click','.modal-edit-portfolio',function(e){
	e.preventDefault();
    let save_button = $(this);
  	save_button.addClass('btn-progress');
    var id = $(this).data("id");
    $.ajax({
        type: "POST",
        url: base_url+'cards/ajax_get_portfolio_by_id', 
        data: "id="+id,
        dataType: "json",
        success: function(result) 
        {
			save_button.removeClass('btn-progress');
        	if(result['error'] == false){

				$("#update_id").val(result['data'][0].id);

				$("#old_image").val(result['data'][0].image);
				
				$("#title").val(result['data'][0].title);
				$("#description").html(result['data'][0].description);
				$("#url").val(result['data'][0].url);

	    		$("#modal-edit-portfolio").trigger("click");
    		}else{
    			iziToast.error({
				    title: something_wrong_try_again,
				    message: "",
				    position: 'topRight'
				});
    		}
        }        
    });
});

$("#modal-edit-portfolio").fireModal({
	size: 'modal-lg',
	title: $("#modal-edit-portfolio-part").data('title'),
	body: $("#modal-edit-portfolio-part"),
	footerClass: 'bg-whitesmoke',
	autoFocus: false,
	onFormSubmit: function(modal, e, form) {
    var formData = new FormData(this);
    $.ajax({
	    type:'POST',
	    url: $(this).attr('action'),
	    data:formData,
	    cache:false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(result){
		    if(result['error'] == false){
				location.reload();
		    }else{
		        modal.find('.modal-body').append('<div class="alert alert-danger">'+result['message']+'</div>');
		    }
		    modal.find('.modal-body').find('.alert').delay(4000).fadeOut();    
      		form.stopProgress();  
		}
    });

    e.preventDefault();
  },
  buttons: [
    {
      text: $("#modal-edit-portfolio-part").data('btn'),
      submit: true,
      class: 'btn btn-primary',
      handler: function(modal) {
      }
    }
  ]
});

$(document).on('click','.delete_portfolio',function(e){
	e.preventDefault();
	var id = $(this).data("id");
	swal({
	title: are_you_sure,
	icon: 'warning',
    dangerMode: true,
    buttons: true,
    buttons: [cancel, ok]
	})
	.then((willDelete) => {
		if (willDelete) {
			$.ajax({
				type: "POST",
				url: base_url+'cards/delete_portfolio/'+id, 
				data: "id="+id,
				dataType: "json",
				success: function(result) 
				{	
					if(result['error'] == false){
						location.reload()
					}else{
						iziToast.error({
							title: result['message'],
							message: "",
							position: 'topRight'
						});
					}
				}        
			});
		} 
	});
});

$("#modal-add-gallery").fireModal({
	size: 'modal-lg',
	title: $("#modal-add-gallery-part").data('title'),
	body: $("#modal-add-gallery-part"),
	footerClass: 'bg-whitesmoke',
	autoFocus: false,
	onFormSubmit: function(modal, e, form) {
	  var formData = new FormData(this);
	  $.ajax({
		  type:'POST',
		  url: $(this).attr('action'),
		  data:formData,
		  cache:false,
		  contentType: false,
		  processData: false,
		  dataType: "json",
		  success:function(result){
			  if(result['error'] == false){
				  location.reload();
			  }else{
				  modal.find('.modal-body').append('<div class="alert alert-danger">'+result['message']+'</div>');
			  }
			  modal.find('.modal-body').find('.alert').delay(4000).fadeOut();    
				form.stopProgress();  
		  }
	  });
  
	  e.preventDefault();
	},
	buttons: [
	  {
		text: $("#modal-add-gallery-part").data('btn'),
		submit: true,
		class: 'btn btn-primary ',
		handler: function(modal) {
		}
	  }
	]
});


$(document).on('click','.modal-edit-gallery',function(e){
	e.preventDefault();
    let save_button = $(this);
  	save_button.addClass('btn-progress');
    var id = $(this).data("id");
    $.ajax({
        type: "POST",
        url: base_url+'cards/ajax_get_gallery_by_id', 
        data: "id="+id,
        dataType: "json",
        success: function(result) 
        {
			save_button.removeClass('btn-progress');
        	if(result['error'] == false){

				$("#update_id").val(result['data'][0].id);

				if(result['data'][0].content_type == 'upload'){
					$("#old_image").val(result['data'][0].url);
				}else{
					$("#old_image").val('');
				}
				
				$("#url").val(result['data'][0].url);

				$("#content_type").val(result['data'][0].content_type);
				$("#content_type").trigger('change');

	    		$("#modal-edit-gallery").trigger("click");
    		}else{
    			iziToast.error({
				    title: something_wrong_try_again,
				    message: "",
				    position: 'topRight'
				});
    		}
        }        
    });
});

$("#modal-edit-gallery").fireModal({
	size: 'modal-lg',
	title: $("#modal-edit-gallery-part").data('title'),
	body: $("#modal-edit-gallery-part"),
	footerClass: 'bg-whitesmoke',
	autoFocus: false,
	onFormSubmit: function(modal, e, form) {
    var formData = new FormData(this);
    $.ajax({
	    type:'POST',
	    url: $(this).attr('action'),
	    data:formData,
	    cache:false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(result){
		    if(result['error'] == false){
				location.reload();
		    }else{
		        modal.find('.modal-body').append('<div class="alert alert-danger">'+result['message']+'</div>');
		    }
		    modal.find('.modal-body').find('.alert').delay(4000).fadeOut();    
      		form.stopProgress();  
		}
    });

    e.preventDefault();
  },
  buttons: [
    {
      text: $("#modal-edit-gallery-part").data('btn'),
      submit: true,
      class: 'btn btn-primary',
      handler: function(modal) {
      }
    }
  ]
});

$(document).on('click','.delete_gallery',function(e){
	e.preventDefault();
	var id = $(this).data("id");
	swal({
	title: are_you_sure,
	icon: 'warning',
    dangerMode: true,
    buttons: true,
    buttons: [cancel, ok]
	})
	.then((willDelete) => {
		if (willDelete) {
			$.ajax({
				type: "POST",
				url: base_url+'cards/delete_gallery/'+id, 
				data: "id="+id,
				dataType: "json",
				success: function(result) 
				{	
					if(result['error'] == false){
						location.reload()
					}else{
						iziToast.error({
							title: result['message'],
							message: "",
							position: 'topRight'
						});
					}
				}        
			});
		} 
	});
});

$(document).on('change', '.gallery_content_type', function() {
	$(".gallery_content_type_url_div").removeClass("d-none");
	$(".gallery_content_type_image_div").addClass("d-none");
	if($(this).val() == 'custom'){
		$('.placeholder_url').attr('placeholder', 'https://www.yourdomain.com/image.jpg');
	}else if($(this).val() == 'youtube'){
		$('.placeholder_url').attr('placeholder', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');
	}else if($(this).val() == 'vimeo'){
		$('.placeholder_url').attr('placeholder', 'https://vimeo.com/80629469');
	}else{
		$(".gallery_content_type_url_div").addClass("d-none");
		$(".gallery_content_type_image_div").removeClass("d-none");
	}  
});

$(document).on('change', '.enquiry_button_type', function() {
	if($(this).val() == 'custom'){
		$(".custom_url_div").removeClass("d-none");
	}else{
		$(".custom_url_div").addClass("d-none");
	}  
});

$(document).on('click', '#landing_page', function(e){
	if($("#landing_page_theme_div").hasClass("d-none")){
		$("#landing_page_theme_div").removeClass("d-none");
		$("#landing_page_theme_div").addClass("d-flex");
	}else{
		$("#landing_page_theme_div").addClass("d-none");
		$("#landing_page_theme_div").removeClass("d-flex");
	}
});

$(document).on('click', '.copy_href', function(e){
	e.preventDefault();
	copyToClipboard($(this).attr('href'))
    .then(() => iziToast.success({
    		title: copied_to_clipboard,
    		message: "",
    		position: 'topRight'
    }))
    .catch(() => iziToast.error({
    		title: something_wrong_try_again,
    		message: "",
    		position: 'topRight'
    }));
});

function copyToClipboard(textToCopy) {
    if (navigator.clipboard && window.isSecureContext) {
        return navigator.clipboard.writeText(textToCopy);
    } else {
        let textArea = document.createElement("textarea");
        textArea.value = textToCopy;
        textArea.style.position = "fixed";
        textArea.style.left = "-999999px";
        textArea.style.top = "-999999px";
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        return new Promise((res, rej) => {
            document.execCommand('copy') ? res() : rej();
            textArea.remove();
        });
    }
}

$(document).on('click', '#select_all', function(){
	if($(this).is(':checked')){
		$('input:checkbox').prop("checked", true).val(1);
	}else{
		$('input:checkbox').prop("checked", false);
	}
});
$(document).on('click', '#select_all_update', function(){
	if($(this).is(':checked')){
		$('input:checkbox').prop("checked", true).val(1);
	}else{
		$('input:checkbox').prop("checked", false);
	}
});

$(document).on('click','.delete_product',function(e){
	e.preventDefault();
	var id = $(this).data("id");
	swal({
	title: are_you_sure,
	icon: 'warning',
    dangerMode: true,
    buttons: true,
    buttons: [cancel, ok]
	})
	.then((willDelete) => {
		if (willDelete) {
			$.ajax({
				type: "POST",
				url: base_url+'cards/delete_product/'+id, 
				data: "id="+id,
				dataType: "json",
				success: function(result) 
				{	
					if(result['error'] == false){
						location.reload()
					}else{
						iziToast.error({
							title: result['message'],
							message: "",
							position: 'topRight'
						});
					}
				}        
			});
		} 
	});
});

$(document).on('click','.modal-edit-product',function(e){
	e.preventDefault();
    let save_button = $(this);
  	save_button.addClass('btn-progress');
    var id = $(this).data("id");
    $.ajax({
        type: "POST",
        url: base_url+'cards/ajax_get_product_by_id', 
        data: "id="+id,
        dataType: "json",
        success: function(result) 
        {
			save_button.removeClass('btn-progress');
        	if(result['error'] == false){

				$("#update_id").val(result['data'][0].id);
				$("#title").val(result['data'][0].title);
				$("#old_image").val(result['data'][0].image);
				$("#description").html(result['data'][0].description);

				$("#custom_url").val(result['data'][0].url);

				if($("#url option[value='"+result['data'][0].url+"']").length > 0){
					$("#url").val(result['data'][0].url);
				}else{
					$("#url").val('custom');
				}

				$("#url").trigger('change', function() {
					if($(this).val() == 'custom'){
						$(".custom_url_div").removeClass("d-none");
					}else{
						$(".custom_url_div").addClass("d-none");
					}  
				});

				$("#price").val(result['data'][0].price);

	    		$("#modal-edit-product").trigger("click");
    		}else{
    			iziToast.error({
				    title: something_wrong_try_again,
				    message: "",
				    position: 'topRight'
				});
    		}
        }        
    });
});

$("#modal-edit-product").fireModal({
	size: 'modal-lg',
	title: $("#modal-edit-product-part").data('title'),
	body: $("#modal-edit-product-part"),
	footerClass: 'bg-whitesmoke',
	autoFocus: false,
	onFormSubmit: function(modal, e, form) {
    var formData = new FormData(this);
    $.ajax({
	    type:'POST',
	    url: $(this).attr('action'),
	    data:formData,
	    cache:false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(result){
		    if(result['error'] == false){
				location.reload();
		    }else{
		        modal.find('.modal-body').append('<div class="alert alert-danger">'+result['message']+'</div>');
		    }
		    modal.find('.modal-body').find('.alert').delay(4000).fadeOut();    
      		form.stopProgress();  
		}
    });

    e.preventDefault();
  },
  buttons: [
    {
      text: $("#modal-edit-product-part").data('btn'),
      submit: true,
      class: 'btn btn-primary',
      handler: function(modal) {
      }
    }
  ]
});

$("#modal-add-card").fireModal({
	size: 'modal-lg',
	title: $("#modal-add-card-part").data('title'),
	body: $("#modal-add-card-part"),
	footerClass: 'bg-whitesmoke',
	autoFocus: false,
	onFormSubmit: function(modal, e, form) {
	  var formData = new FormData(this);
	  $.ajax({
		  type:'POST',
		  url: $(this).attr('action'),
		  data:formData,
		  cache:false,
		  contentType: false,
		  processData: false,
		  dataType: "json",
		  success:function(result){
			  if(result['error'] == false){
				  location.reload();
			  }else{
				  modal.find('.modal-body').append('<div class="alert alert-danger">'+result['message']+'</div>');
			  }
			  modal.find('.modal-body').find('.alert').delay(4000).fadeOut();    
				form.stopProgress();  
		  }
	  });
  
	  e.preventDefault();
	},
	buttons: [
	  {
		text: $("#modal-add-card-part").data('btn'),
		submit: true,
		class: 'btn btn-primary ',
		handler: function(modal) {
		}
	  }
	]
});

$("#modal-add-product").fireModal({
	size: 'modal-lg',
	title: $("#modal-add-product-part").data('title'),
	body: $("#modal-add-product-part"),
	footerClass: 'bg-whitesmoke',
	autoFocus: false,
	onFormSubmit: function(modal, e, form) {
	  var formData = new FormData(this);
	  $.ajax({
		  type:'POST',
		  url: $(this).attr('action'),
		  data:formData,
		  cache:false,
		  contentType: false,
		  processData: false,
		  dataType: "json",
		  success:function(result){
			  if(result['error'] == false){
				  location.reload();
			  }else{
				  modal.find('.modal-body').append('<div class="alert alert-danger">'+result['message']+'</div>');
			  }
			  modal.find('.modal-body').find('.alert').delay(4000).fadeOut();    
				form.stopProgress();  
		  }
	  });
  
	  e.preventDefault();
	},
	buttons: [
	  {
		text: $("#modal-add-product-part").data('btn'),
		submit: true,
		class: 'btn btn-primary ',
		handler: function(modal) {
		}
	  }
	]
});

function queryParams(p){
	return {
		limit:p.limit,
		sort:p.sort,
		order:p.order,
		offset:p.offset,
		search:p.search
	};
}

$(document).on('change', '[name="card_bg_type"]', function() {
    if($(this).val() == 'Color'){
      if($("#card_by_type_color").hasClass("d-none")){
        $("#card_by_type_color").removeClass("d-none");
      }
      if(!$("#card_by_type_image").hasClass("d-none")){
        $("#card_by_type_image").addClass("d-none");
      }
      if(!$("#card_by_type_gradient").hasClass("d-none")){
        $("#card_by_type_gradient").addClass("d-none");
      }
    }else if($(this).val() == 'Gradient'){
      if($("#card_by_type_gradient").hasClass("d-none")){
          $("#card_by_type_gradient").removeClass("d-none");
      }
  
      if(!$("#card_by_type_color").hasClass("d-none")){
        $("#card_by_type_color").addClass("d-none");
      }
  
      if(!$("#card_by_type_image").hasClass("d-none")){
        $("#card_by_type_image").addClass("d-none");
      }
    }else if($(this).val() == 'Image'){
      if($("#card_by_type_image").hasClass("d-none")){
          $("#card_by_type_image").removeClass("d-none");
      }
  
      if(!$("#card_by_type_color").hasClass("d-none")){
        $("#card_by_type_color").addClass("d-none");
      }
      
      if(!$("#card_by_type_gradient").hasClass("d-none")){
          $("#card_by_type_gradient").addClass("d-none");
      }
    }else{
      if(!$("#card_by_type_color").hasClass("d-none")){
          $("#card_by_type_color").addClass("d-none");
      }
        
      if(!$("#card_by_type_gradient").hasClass("d-none")){
          $("#card_by_type_gradient").addClass("d-none");
      }
      
      if(!$("#card_by_type_image").hasClass("d-none")){
          $("#card_by_type_image").addClass("d-none");
      }
    }
  });
  
$(document).on('change', '[name="card_theme_bg_type"]', function() {
  if($(this).val() == 'Color'){
    if($("#theme_by_type_color").hasClass("d-none")){
      $("#theme_by_type_color").removeClass("d-none");
    }
    if(!$("#theme_by_type_image").hasClass("d-none")){
      $("#theme_by_type_image").addClass("d-none");
    }
    if(!$("#theme_by_type_gradient").hasClass("d-none")){
      $("#theme_by_type_gradient").addClass("d-none");
    }
  }else if($(this).val() == 'Gradient'){
    if($("#theme_by_type_gradient").hasClass("d-none")){
		$("#theme_by_type_gradient").removeClass("d-none");
	}

    if(!$("#theme_by_type_color").hasClass("d-none")){
      $("#theme_by_type_color").addClass("d-none");
    }

    if(!$("#theme_by_type_image").hasClass("d-none")){
      $("#theme_by_type_image").addClass("d-none");
    }
  }else if($(this).val() == 'Image'){
	if($("#theme_by_type_image").hasClass("d-none")){
		$("#theme_by_type_image").removeClass("d-none");
	}

    if(!$("#theme_by_type_color").hasClass("d-none")){
      $("#theme_by_type_color").addClass("d-none");
    }
    
    if(!$("#theme_by_type_gradient").hasClass("d-none")){
		$("#theme_by_type_gradient").addClass("d-none");
	}
  }else{
    if(!$("#theme_by_type_color").hasClass("d-none")){
		$("#theme_by_type_color").addClass("d-none");
	}
	  
	if(!$("#theme_by_type_gradient").hasClass("d-none")){
		$("#theme_by_type_gradient").addClass("d-none");
	}
	
	if(!$("#theme_by_type_image").hasClass("d-none")){
		$("#theme_by_type_image").addClass("d-none");
	}
  }
});

$("#save_card").submit(function(e) {
	e.preventDefault();
  let save_button = $(this).find('.savebtn'),
  output_status = $(this).find('.result'),
    card = $('#save_card_card');

  let card_progress = $.cardProgress(card, {
    spinner: true
  });
  save_button.addClass('btn-progress');
  output_status.html('');
  
    var formData = new FormData(this);
    $.ajax({
	    type:'POST',
	    url: $(this).attr('action'),
	    data:formData,
	    cache:false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(result){
		    if(result['error'] == false){
				location.reload();
		    }else{
		        output_status.prepend('<div class="alert alert-danger">'+result['message']+'</div>');
		    }
		    output_status.find('.alert').delay(4000).fadeOut();    
      		save_button.removeClass('btn-progress');  
      		card_progress.dismiss(function() {
		      $('html, body').animate({
		        scrollTop: output_status.offset().top
		      }, 1000);
		    });
		}
    });
});

function doesFileExist(urlToFile) {
    var xhr = new XMLHttpRequest();
    xhr.open('HEAD', urlToFile, false);
    xhr.send();
     
    if (xhr.status == "404") {
        return false;
    } else {
        return true;
    }
}

$(document).on('click','.delete_language',function(e){
	e.preventDefault();
	var id = $(this).data("id");
	if(id == 1){
		swal({
			title: wait,
			text: default_language_can_not_be_deleted,
			icon: 'info',
			dangerMode: true,
			});
	}else{
		swal({
		title: are_you_sure,
		text: you_want_to_delete_this_language,
		icon: 'warning',
		dangerMode: true,
		buttons: true,
		buttons: [cancel, ok]
		})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					type: "POST",
					url: base_url+'Languages/delete/'+id, 
					data: "id="+id,
					dataType: "json",
					success: function(result) 
					{	
						if(result['error'] == false){
							$('#languages_list').bootstrapTable('refresh');
						}else{
							iziToast.error({
								title: result['message'],
								message: "",
								position: 'topRight'
							});
						}
					}        
				});
			} 
		});
	}
});

$(document).on('click','.delete_notification',function(e){
	e.preventDefault();
	var id = $(this).data("id");
	swal({
	title: are_you_sure,
	text: you_want_to_delete_this_notification,
	icon: 'warning',
    dangerMode: true,
    buttons: true,
    buttons: [cancel, ok]
	})
	.then((willDelete) => {
		if (willDelete) {
			$.ajax({
				type: "POST",
				url: base_url+'notifications/delete/'+id, 
				data: "id="+id,
				dataType: "json",
				success: function(result) 
				{	
					if(result['error'] == false){
						$('#notifications_list').bootstrapTable('refresh');
					}else{
						iziToast.error({
							title: result['message'],
							message: "",
							position: 'topRight'
						});
					}
				}        
			});
		} 
	});
});

$(document).on('click','.delete_feature',function(e){
	e.preventDefault();
    var id = $(this).data("id");
    swal({
    title: are_you_sure,
    text: you_want_to_delete_this_feature,
    icon: 'warning',
    dangerMode: true,
    buttons: true,
    buttons: [cancel, ok]
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
		        type: "POST",
		        url: base_url+'front/delete-feature/'+id, 
		        data: "id="+id,
		        dataType: "json",
		        success: function(result) 
		        {	
		        	if(result['error'] == false){
			        	location.reload();
		    		}else{
		    			iziToast.error({
						    title: result['message'],
						    message: "",
						    position: 'topRight'
						});
		    		}
		        }        
		    });
        } 
    });
});

$("#custom_section-form").submit(function(e) {
	e.preventDefault();
  let save_button = $(this).find('.savebtn'),
    output_status = $(this).find('.result'),
    card = $('#custom_section-card');

  let card_progress = $.cardProgress(card, {
    spinner: true
  });
  save_button.addClass('btn-progress');
  output_status.html('');
  
    var formData = new FormData(this);
    $.ajax({
	    type:'POST',
	    url: $(this).attr('action'),
	    data:formData,
	    cache:false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(result){
		    if(result['error'] == false){
				window.location.replace(base_url+"cards/custom-sections");
		    }else{
		        output_status.prepend('<div class="alert alert-danger">'+result['message']+'</div>');
		    }
		    output_status.find('.alert').delay(4000).fadeOut();    
      		save_button.removeClass('btn-progress');  
      		card_progress.dismiss(function() {
		      $('html, body').animate({
		        scrollTop: output_status.offset().top
		      }, 1000);
		    });
		}
    });
});

$("#feature-form").submit(function(e) {
	e.preventDefault();
  let save_button = $(this).find('.savebtn'),
    output_status = $(this).find('.result'),
    card = $('#feature-card');

  let card_progress = $.cardProgress(card, {
    spinner: true
  });
  save_button.addClass('btn-progress');
  output_status.html('');
  
    var formData = new FormData(this);
    $.ajax({
	    type:'POST',
	    url: $(this).attr('action'),
	    data:formData,
	    cache:false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(result){
		    if(result['error'] == false){
				location.reload();
		    }else{
		        output_status.prepend('<div class="alert alert-danger">'+result['message']+'</div>');
		    }
		    output_status.find('.alert').delay(4000).fadeOut();    
      		save_button.removeClass('btn-progress');  
      		card_progress.dismiss(function() {
		      $('html, body').animate({
		        scrollTop: output_status.offset().top
		      }, 1000);
		    });
		}
    });
});

$(document).on('click','#home',function(e){
	
	if($('#home_div').hasClass('d-none')){
		$('#home_div').removeClass('d-none');
	}else{
		$('#home_div').addClass('d-none');
	}
});

$(document).on('click','#features',function(e){
	
	if($('#feature_div').hasClass('d-none')){
		$('#feature_div').removeClass('d-none');
	}else{
		$('#feature_div').addClass('d-none');
	}
});

$(function() {
	$('.home-menu').click(function() {
		if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
			if (target.length) {
				$('html,body').animate({
					scrollTop: target.offset().top
				}, 1000);
				$("body").removeClass("sidebar-show");
				$("body").addClass("sidebar-gone");
				return false;
			}
		}
	});
});

$(document).on('click','.reject_request',function(e){
	e.preventDefault();
    var id = $(this).data("id");
    swal({
    title: are_you_sure,
    text: you_want_reject_this_offline_request_this_can_not_be_undo,
    icon: 'warning',
    dangerMode: true,
    buttons: true,
    buttons: [cancel, ok]
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
				type: "POST",
				url: base_url+'plans/reject-request/', 
				data: "id="+id,
				dataType: "json",
				success: function(result) 
				{	
				  if(result['error'] == false){
					  location.reload();
				  }else{
					iziToast.error({
					  title: result['message'],
					  message: "",
					  position: 'topRight'
					});
				  }
				}        
			});
        } 
    });
});

$(document).on('click','.accept_request',function(e){
	e.preventDefault();
    var id = $(this).data("id");
    var plan_id = $(this).data("plan_id");
    var saas_id = $(this).data("saas_id");
    swal({
    title: are_you_sure,
    text: you_want_accept_this_offline_request_this_can_not_be_undo,
    icon: 'warning',
    dangerMode: true,
    buttons: true,
    buttons: [cancel, ok]
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
				type: "POST",
				url: base_url+'plans/accept-request/', 
				data: "id="+id+"&plan_id="+plan_id+"&saas_id="+saas_id,
				dataType: "json",
				success: function(result) 
				{	
				  if(result['error'] == false){
					  location.reload();
				  }else{
					iziToast.error({
					  title: result['message'],
					  message: "",
					  position: 'topRight'
					});
				  }
				}        
			});
        } 
    });
});

$(document).on('click','.modal-edit-plan',function(e){
	e.preventDefault();

    let save_button = $(this);
  	save_button.addClass('btn-progress');

    var id = $(this).data("id");
    $.ajax({
        type: "POST",
        url: base_url+'plans/ajax_get_plan_by_id', 
        data: "id="+id,
        dataType: "json",
        success: function(result) 
        {
			save_button.removeClass('btn-progress');
        	if(result['error'] == false){

				$('input:checkbox').prop("checked", false);
				if(result['data'][0].modules != ''){
					$.each(JSON.parse(result['data'][0].modules), function (key, val) {
						if(val == 1){
							$('#'+key+'_update').prop("checked", true).val(val);
							$('#'+key+'_module_update').prop("checked", true).val(val);
						}
					});
				}

	        	$("#update_id").val(result['data'][0].id);
	        	$("#title").val(result['data'][0].title);
	        	$("#price").val(result['data'][0].price);
				$("#billing_type").val(result['data'][0].billing_type);
				$("#billing_type").trigger("change");

	        	$("#cards_count").val(result['data'][0].cards);
	        	$("#custom_fields_count").val(result['data'][0].custom_fields);
	        	$("#products_services_count").val(result['data'][0].products_services);
	        	$("#portfolio_count").val(result['data'][0].portfolio);
	        	$("#testimonials_count").val(result['data'][0].testimonials);
	        	$("#gallery_count").val(result['data'][0].gallery);
	        	$("#custom_sections_count").val(result['data'][0].custom_sections);
	        	$("#team_member_count").val(result['data'][0].team_member);

	    		$("#modal-edit-plan").trigger("click");
    		}else{
    			iziToast.error({
				    title: something_wrong_try_again,
				    message: "",
				    position: 'topRight'
				});
    		}
        }        
    });
});

$("#modal-edit-plan").fireModal({
  	title: $("#modal-edit-plan-part").data('title'),
	size: 'modal-lg',
	body: $("#modal-edit-plan-part"),
	footerClass: 'bg-whitesmoke',
	autoFocus: false,
	onFormSubmit: function(modal, e, form) {
    var formData = new FormData(this);
    $.ajax({
	    type:'POST',
	    url: $(this).attr('action'),
	    data:formData,
	    cache:false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(result){
		    if(result['error'] == false){
				$('#plans_list').bootstrapTable('refresh');
				modal.modal('hide');
		    }else{
		        modal.find('.modal-body').append('<div class="alert alert-danger">'+result['message']+'</div>');
		    }
		    modal.find('.modal-body').find('.alert').delay(4000).fadeOut();    
      		form.stopProgress();  
		}
    });

    e.preventDefault();
  },
  buttons: [
    {
      text: $("#modal-edit-plan-part").data('btn'),
      submit: true,
      class: 'btn btn-primary',
      handler: function(modal) {
      }
    }
  ]
});

$("#modal-add-plan").fireModal({
	title: $("#modal-add-plan-part").data('title'),
	size: 'modal-lg',
	body: $("#modal-add-plan-part"),
	footerClass: 'bg-whitesmoke',
	autoFocus: false,
	onFormSubmit: function(modal, e, form) {
	  var formData = new FormData(this);
	  $.ajax({
		  type:'POST',
		  url: $(this).attr('action'),
		  data:formData,
		  cache:false,
		  contentType: false,
		  processData: false,
		  dataType: "json",
		  success:function(result){
			  if(result['error'] == false){
				$('#plans_list').bootstrapTable('refresh');
				modal.modal('hide');
			  }else{
				  modal.find('.modal-body').append('<div class="alert alert-danger">'+result['message']+'</div>');
			  }
			  modal.find('.modal-body').find('.alert').delay(4000).fadeOut();    
				form.stopProgress();  
		  }
	  });
  
	  e.preventDefault();
	},
	buttons: [
	  {
		text: $("#modal-add-plan-part").data('btn'),
		submit: true,
		class: 'btn btn-primary ',
		handler: function(modal) {
		}
	  }
	]
});

$(document).on('click','.delete_plan',function(e){
	e.preventDefault();
	var id = $(this).data("id");
	if(id == 1){
		swal({
			title: wait,
			text: default_plan_can_not_be_deleted,
			icon: 'info',
			dangerMode: true,
			});
	}else{
		swal({
		title: are_you_sure,
		text: you_want_to_delete_this_plan_all_users_under_this_plan_will_be_added_to_the_default_plan,
		icon: 'warning',
		dangerMode: true,
		buttons: true,
		buttons: [cancel, ok]
		})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					type: "POST",
					url: base_url+'plans/delete/'+id, 
					data: "id="+id,
					dataType: "json",
					success: function(result) 
					{	
						if(result['error'] == false){
							$('#plans_list').bootstrapTable('refresh');
						}else{
							iziToast.error({
								title: result['message'],
								message: "",
								position: 'topRight'
							});
						}
					}        
				});
			} 
		});
	}
});


$("#setting-update-form").submit(function(e) {
	e.preventDefault();
	swal({
		title: are_you_sure,
		text: you_want_to_upgrade_the_system_please_take_a_backup_before_going_further,
		icon: 'warning',
		dangerMode: true,
		buttons: true,
		buttons: [cancel, ok]
		}).then((willDelete) => {
		if (willDelete) {
			let save_button = $(this).find('.savebtn'),
			output_status = $(this).find('.result'),
			card = $('#settings-card');

			let card_progress = $.cardProgress(card, {
				spinner: true
			});
			save_button.addClass('btn-progress');
			output_status.html('');
			
				var formData = new FormData(this);
				$.ajax({
					type:'POST',
					url: $(this).attr('action'),
					data:formData,
					cache:false,
					contentType: false,
					processData: false,
					dataType: "json",
					success:function(result){
						if(result['error'] == true){
							output_status.prepend('<div class="alert alert-danger">'+result['message']+'</div>');
						}else{
							window.location.replace(base_url+"settings/migrate");
						}
						output_status.find('.alert').delay(4000).fadeOut();    
						save_button.removeClass('btn-progress');  
						card_progress.dismiss(function() {
						$('html, body').animate({
							scrollTop: output_status.offset().top
						}, 1000);
						});
					}
				});
		} 
	});
});

$(document).on('change','.filter_change',function(e){
	var value = $(this).val();
	window.location.replace(value);
});

$(document).on('change','#date_format',function(e){
    var js_value = $(this).find(':selected').data('js_value');
    $('#date_format_js').val(js_value);
});

$(document).on('change','#time_format',function(e){
    var js_value = $(this).find(':selected').data('js_value');
    $('#time_format_js').val(js_value);
});

$("#profile-form").submit(function(e) {
	e.preventDefault();
  let save_button = $(this).find('.savebtn'),
    output_status = $(this).find('.result'),
    card = $('#profile-card');

  let card_progress = $.cardProgress(card, {
    spinner: true
  });
  save_button.addClass('btn-progress');
  output_status.html('');
  
    var formData = new FormData(this);
    $.ajax({
	    type:'POST',
	    url: $(this).attr('action'),
	    data:formData,
	    cache:false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(result){
		    if(result['error'] == false){
		    	location.reload()
		    }else{
				output_status.prepend('<div class="alert alert-danger">'+result['message']+'</div>');
				output_status.find('.alert').delay(4000).fadeOut();    
				save_button.removeClass('btn-progress');  
				card_progress.dismiss(function() {
				$('html, body').animate({
					scrollTop: output_status.offset().top
				}, 1000);
				});
			}
			card_progress.dismiss(function() {
			});
		}
    });
});

$(document).on('click','#user_delete_btn',function(e){
	e.preventDefault();
    var id = $("#update_id").val();
    swal({
    title: are_you_sure,
    text: you_want_to_delete_this_user_all_related_data_with_this_user_also_will_be_deleted,
    icon: 'warning',
    dangerMode: true,
    buttons: true,
    buttons: [cancel, ok]
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
		        type: "POST",
		        url: base_url+'auth/delete_user', 
		        data: "id="+id,
		        dataType: "json",
		        success: function(result) 
		        {	
		        	if(result['error'] == false){
			        	location.reload();
		    		}else{
		    			iziToast.error({
						    title: result['message'],
						    message: "",
						    position: 'topRight'
						});
		    		}
		        }        
		    });
        } 
    });
});

$(document).on('click','#user_active_btn',function(e){
	e.preventDefault();
    var id = $("#update_id").val();
    swal({
    title: are_you_sure,
    text: you_want_to_activate_this_user,
    icon: 'warning',
    dangerMode: true,
    buttons: true,
    buttons: [cancel, ok]
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
		        type: "POST",
		        url: base_url+'auth/activate', 
		        data: "id="+id,
		        dataType: "json",
		        success: function(result) 
		        {	
		        	if(result['error'] == false){
			        	location.reload();
		    		}else{
		    			iziToast.error({
						    title: result['message'],
						    message: "",
						    position: 'topRight'
						});
		    		}
		        }        
		    });
        } 
    });
});

$(document).on('click','#user_deactive_btn',function(e){
	e.preventDefault();
    var id = $("#update_id").val();
    swal({
    title: are_you_sure,
    text: you_want_to_deactivate_this_user_this_user_will_be_not_able_to_login_after_deactivation,
    icon: 'warning',
    dangerMode: true,
    buttons: true,
    buttons: [cancel, ok]
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
		        type: "POST",
		        url: base_url+'auth/deactivate', 
		        data: "id="+id,
		        dataType: "json",
		        success: function(result) 
		        {	
		        	if(result['error'] == false){
			        	location.reload();
		    		}else{
		    			iziToast.error({
						    title: result['message'],
						    message: "",
						    position: 'topRight'
						});
		    		}
		        }        
		    });
        } 
    });
});

$(document).on('click','.edit_pages',function(e){
	e.preventDefault();

	let save_button = $(this);
  	save_button.addClass('btn-progress');

    var id = $(this).data("id");
    $.ajax({
        type: "POST",
        url: base_url+'front/get_pages/'+id, 
        data: "id="+id,
        dataType: "json",
        success: function(result) 
        {	
			save_button.removeClass('btn-progress');
			console.log(result);
        	if(result[0].id){
				$("#update_id").val(result[0].id);
				$("#content").val(result[0].content);
	    		$("#modal-edit-pages").trigger("click");
    		}else{
    			iziToast.error({
				    title: something_wrong_try_again,
				    message: "",
				    position: 'topRight'
				});
    		}
        }        
    });
});

$("#modal-edit-pages").fireModal({
  title: $("#modal-edit-pages-part").data('title'),
  body: $("#modal-edit-pages-part"),
  footerClass: 'bg-whitesmoke',
  autoFocus: false,
  onFormSubmit: function(modal, e, form) {
    var formData = new FormData(this);
    $.ajax({
	    type:'POST',
	    url: $(this).attr('action'),
	    data:formData,
	    cache:false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(result){
		    if(result['error'] == false){
		    	location.reload();
		    }else{
		        modal.find('.modal-body').append('<div class="alert alert-danger">'+result['message']+'</div>');
		    }
		    modal.find('.modal-body').find('.alert').delay(4000).fadeOut();    
      		form.stopProgress();  
		}
    });

    e.preventDefault();
  },
  buttons: [
    {
      text: $("#modal-edit-pages-part").data('btn_update'),
      submit: true,
      class: 'btn btn-primary',
      handler: function(modal) {
      }
    }
  ]
});


$(document).on('click','.modal-edit-user',function(e){
	e.preventDefault();

	let save_button = $(this);
  	save_button.addClass('btn-progress');

    var id = $(this).data("edit");
    $.ajax({
        type: "POST",
        url: base_url+'users/ajax_get_user_by_id', 
        data: "id="+id,
        dataType: "json",
        success: function(result) 
        {	
		
			save_button.removeClass('btn-progress');

        	if(result['error'] == false){
				$('#end_date').daterangepicker({
					locale: {format: date_format_js},
					singleDatePicker: true,
					startDate: moment(result['data'].current_plan_expiry),
				});
				$("#update_id").val(result['data'].id);
				$("#company").val(result['data'].company);
	        	$("#old_profile_pic").val(result['data'].profile);
	        	$("#first_name").val(result['data'].first_name);
	        	$("#last_name").val(result['data'].last_name);
				$("#phone").val(result['data'].phone);

				$("#plan_id").val(result['data'].current_plan_id);
				$("#plan_id").trigger("change");
				$("#groups").val(result['data'].group_id);
				$("#groups").trigger("change");
	            if(result['data'].active == 1){
	            	$("#user_deactive_btn").removeClass('d-none');
	            	$("#user_active_btn").addClass('d-none');
	            }else{
	            	$("#user_deactive_btn").addClass('d-none');
	            	$("#user_active_btn").removeClass('d-none');
	            }
	    		$("#modal-edit-user").trigger("click");
    		}else{
    			iziToast.error({
				    title: something_wrong_try_again,
				    message: "",
				    position: 'topRight'
				});
    		}
        }        
    });
});

$("#modal-edit-user").fireModal({
  title: $("#modal-edit-user-part").data('title'),
  body: $("#modal-edit-user-part"),
  footerClass: 'bg-whitesmoke',
  autoFocus: false,
  onFormSubmit: function(modal, e, form) {
    var formData = new FormData(this);
    $.ajax({
	    type:'POST',
	    url: $(this).attr('action'),
	    data:formData,
	    cache:false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(result){
		    if(result['error'] == false){
		    	location.reload();
		    }else{
		        modal.find('.modal-body').append('<div class="alert alert-danger">'+result['message']+'</div>');
		    }
		    modal.find('.modal-body').find('.alert').delay(4000).fadeOut();    
      		form.stopProgress();  
		}
    });

    e.preventDefault();
  },
  buttons: [
	{
		text: $("#modal-edit-user-part").data('btn_login'),
		submit: false,
		class: 'btn btn-warning',
		id: 'user_login_btn',
		handler: function(modal) {
		}
	},
  	{
      text: $("#modal-edit-user-part").data('btn_delete'),
      submit: false,
      class: 'btn btn-danger',
      id: 'user_delete_btn',
      handler: function(modal) {
      }
    },
    {
      text: $("#modal-edit-user-part").data('btn_deactive'),
      submit: false,
      class: 'btn btn-danger d-none',
      id: 'user_deactive_btn',
      handler: function(modal) {
      }
    },

    {
      text: $("#modal-edit-user-part").data('btn_active'),
      submit: false,
      class: 'btn btn-success d-none',
      id: 'user_active_btn',
      handler: function(modal) {
      }
    },
    {
      text: $("#modal-edit-user-part").data('btn_update'),
      submit: true,
      class: 'btn btn-primary',
      handler: function(modal) {
      }
    }
  ]
});

$("#modal-add-user").fireModal({
  title: $("#modal-add-user-part").data('title'),
  body: $("#modal-add-user-part"),
  footerClass: 'bg-whitesmoke',
  autoFocus: false,
  onFormSubmit: function(modal, e, form) {
    var formData = new FormData(this);
    $.ajax({
	    type:'POST',
	    url: $(this).attr('action'),
	    data:formData,
	    cache:false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(result){
		    if(result['error'] == false){
      			location.reload();
		    }else{
		        modal.find('.modal-body').append('<div class="alert alert-danger">'+result['message']+'</div>');
		    }
		    modal.find('.modal-body').find('.alert').delay(4000).fadeOut();    
      		form.stopProgress();  
		}
    });

    e.preventDefault();
  },
  buttons: [
    {
      text: $("#modal-add-user-part").data('btn'),
      submit: true,
      class: 'btn btn-primary ',
      handler: function(modal) {
      }
    }
  ]
});


$("#language-form").submit(function(e) {
	e.preventDefault();
  let save_button = $(this).find('.savebtn'),
    output_status = $(this).find('.result'),
    card = $('#language-card');

  let card_progress = $.cardProgress(card, {
    spinner: true
  });
  save_button.addClass('btn-progress');
  output_status.html('');
  
    var formData = new FormData(this);
    $.ajax({
	    type:'POST',
	    url: $(this).attr('action'),
	    data:formData,
	    cache:false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(result){
		    if(result['error'] == false){
				$('#languages_list').bootstrapTable('refresh');
		    	output_status.prepend('<div class="alert alert-success">'+result['message']+'</div>');
		    }else{
		        output_status.prepend('<div class="alert alert-danger">'+result['message']+'</div>');
		    }
		    output_status.find('.alert').delay(4000).fadeOut();    
      		save_button.removeClass('btn-progress');  
      		card_progress.dismiss(function() {
		      $('html, body').animate({
		        scrollTop: output_status.offset().top
		      }, 1000);
		    });
		}
    });
});


$("#setting-form").submit(function(e) {
	e.preventDefault();
  let save_button = $(this).find('.savebtn'),
    output_status = $(this).find('.result'),
    card = $('#settings-card');

  let card_progress = $.cardProgress(card, {
    spinner: true
  });
  save_button.addClass('btn-progress');
  output_status.html('');
  
    var formData = new FormData(this);
    $.ajax({
	    type:'POST',
	    url: $(this).attr('action'),
	    data:formData,
	    cache:false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(result){
		    if(result['error'] == false){
		    	if(result['data']['full_logo'] != undefined && result['data']['full_logo'] != ''){
		    		$('#full_logo-img').attr('src', base_url+'assets/uploads/logos/'+result['data']['full_logo']);
		    	}
		    	if(result['data']['half_logo'] != undefined && result['data']['half_logo'] != ''){
		    		$('#half_logo-img').attr('src', base_url+'assets/uploads/logos/'+result['data']['half_logo']);
		    	}
		    	if(result['data']['favicon'] != undefined && result['data']['favicon'] != ''){
		    		$('#favicon-img').attr('src', base_url+'assets/uploads/logos/'+result['data']['favicon']);
		    	}
		    	output_status.prepend('<div class="alert alert-success">'+result['message']+'</div>');
		    }else{
		        output_status.prepend('<div class="alert alert-danger">'+result['message']+'</div>');
		    }
		    output_status.find('.alert').delay(4000).fadeOut();    
      		save_button.removeClass('btn-progress');  
      		card_progress.dismiss(function() {
		      $('html, body').animate({
		        scrollTop: output_status.offset().top
		      }, 1000);
		    });
		}
    });
});

$("#home-form").submit(function(e) {
	e.preventDefault();
  let save_button = $(this).find('.savebtn'),
    output_status = $(this).find('.result'),
    card = $('#home-card');

  let card_progress = $.cardProgress(card, {
    spinner: true
  });
  save_button.addClass('btn-progress');
  output_status.html('');
  
    var formData = new FormData(this);
    $.ajax({
	    type:'POST',
	    url: $(this).attr('action'),
	    data:formData,
	    cache:false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(result){
		    if(result['error'] == false){
		    	output_status.prepend('<div class="alert alert-success">'+result['message']+'</div>');
		    }else{
		        output_status.prepend('<div class="alert alert-danger">'+result['message']+'</div>');
		    }
		    output_status.find('.alert').delay(4000).fadeOut();    
      		save_button.removeClass('btn-progress');  
      		card_progress.dismiss(function() {
		      $('html, body').animate({
		        scrollTop: output_status.offset().top
		      }, 1000);
		    });
		}
    });
});

$(document).on('change','#php_timezone',function(e){
    var gmt = $(this).find(':selected').data('gmt');
    $('#mysql_timezone').val(gmt);
});

$("#modal-forgot-password").fireModal({
  title: $("#modal-forgot-password-part").data('title'),
  body: $("#modal-forgot-password-part"),
  footerClass: 'bg-whitesmoke',
  autoFocus: false,
  onFormSubmit: function(modal, e, form) {
    var formData = new FormData(this);
    $.ajax({
	    type:'POST',
	    url: $(this).attr('action'),
	    data:formData,
	    cache:false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(result){
		    if(result['error'] == false){
		    	modal.find('.modal-body').append('<div class="alert alert-success">'+result['message']+'</div>');
		    }else{
		        modal.find('.modal-body').append('<div class="alert alert-danger">'+result['message']+'</div>');
		    }
		    modal.find('.modal-body').find('.alert').delay(4000).fadeOut();    
      		form.stopProgress();  
		}
    });

    e.preventDefault();
  },
  buttons: [
    {
      text: $("#modal-forgot-password-part").data('btn'),
      submit: true,
      class: 'btn btn-primary ',
      handler: function(modal) {
      }
    }
  ]
});

$("#register").submit(function(e) {
	e.preventDefault();
    $("input[name='token']").remove();
	var $this = $(this);
  	let save_button = $(this).find('.savebtn'),
    output_status = $(this).find('.result'),
    card = $('#register');

  	let card_progress = $.cardProgress(card, {
    	spinner: true
  	});
  	save_button.addClass('btn-progress');
  	output_status.html('');
  	
	if(site_key){
		grecaptcha.ready(function() {
			grecaptcha.execute(site_key, {action: 'register_form'}).then(function(token) {
				$($this).prepend('<input type="hidden" name="token" value="' + token + '">');
				$($this).prepend('<input type="hidden" name="action" value="register_form">');
				var formData = new FormData(document.getElementById("register"));
				$.ajax({
					type:'POST',
					url: $($this).attr('action'),
					data:formData,
					cache:false,
					contentType: false,
					processData: false,
					dataType: "json",
					success:function(result){
						card_progress.dismiss(function() {
							if(result['error'] == false){
								window.location.replace(base_url+'auth/confirmation');
							}else{
								output_status.prepend('<div class="alert alert-danger">'+result['message']+'</div>');
							}
							output_status.find('.alert').delay(4000).fadeOut();
							save_button.removeClass('btn-progress');      
							$('html, body').animate({
								scrollTop: output_status.offset().top
							}, 1000);
						});
					}
				});
			});
		});
	}else{
		var formData = new FormData(document.getElementById("register"));
		$.ajax({
			type:'POST',
			url: $($this).attr('action'),
			data:formData,
			cache:false,
			contentType: false,
			processData: false,
			dataType: "json",
			success:function(result){
				card_progress.dismiss(function() {
					if(result['error'] == false){
						window.location.replace(base_url+'auth/confirmation');
					}else{
						output_status.prepend('<div class="alert alert-danger">'+result['message']+'</div>');
					}
					output_status.find('.alert').delay(4000).fadeOut();
					save_button.removeClass('btn-progress');      
					$('html, body').animate({
						scrollTop: output_status.offset().top
					}, 1000);
				});
			}
		});
	}
  	return false;
});

$("#login").submit(function(e) {
	e.preventDefault();
  	let save_button = $(this).find('.savebtn'),
    output_status = $(this).find('.result'),
    card = $('#login');

  	let card_progress = $.cardProgress(card, {
    	spinner: true
  	});
  	save_button.addClass('btn-progress');
  	output_status.html('');
  	var formData = new FormData(this);
    $.ajax({
	    type:'POST',
	    url: $(this).attr('action'),
	    data:formData,
	    cache:false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(result){
	    	card_progress.dismiss(function() {
			    if(result['error'] == false){
					window.location.replace(base_url);
			    }else{
			        output_status.prepend('<div class="alert alert-danger">'+result['message']+'</div>');
			    }
			    output_status.find('.alert').delay(4000).fadeOut();
			    save_button.removeClass('btn-progress');      
			    $('html, body').animate({
			        scrollTop: output_status.offset().top
			    }, 1000);
		    });
		}
    });

  	return false;
});