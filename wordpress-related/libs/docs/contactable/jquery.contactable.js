/*
 * contactable 1.2.1 - jQuery Ajax contact form
 *
 * Copyright (c) 2009 Philip Beel (http://www.theodin.co.uk/)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php) 
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Revision: $Id: jquery.contactable.js 2010-01-18 $
 *
 */
 
//extend the plugin
(function($){

	//define the new for the plugin ans how to call it	
	$.fn.contactable = function(options) {
		//set default options  
		var defaults = {
			name: 'Name',
			email: 'Email',
			message : 'Message',
			subject : 'A contactable message',
			recievedMsg : 'Thankyou for your message',
			notRecievedMsg : 'Sorry but your message could not be sent, try again later',
			disclaimer: 'Please feel free to get in touch, we value your feedback',
			hideOnSubmit: true
			//MOD
			,action : '?'
		};

		//call in the default otions
		var options = $.extend(defaults, options);
		//act upon the element that is passed into the design    
		return this.each(function(options) {
			//construct the form
			//$(this).html('<div id="contactable"></div><form id="contactForm" method="" action=""><div id="loading"></div><div id="callback"></div><div class="holder"><p><label for="name">Name <span class="red"> * </span></label><br /><input id="name" class="contact" name="name" /></p><p><label for="email">E-Mail <span class="red"> * </span></label><br /><input id="email" class="contact" name="email" /></p><p><label for="comment">Your Feedback <span class="red"> * </span></label><br /><textarea id="comment" name="comment" class="comment" rows="4" cols="30" ></textarea></p><p><input class="submit" type="submit" value="Send"/></p><p class="disclaimer">'+defaults.disclaimer+'</p></div></form>');
			//MOD WORDPRESS:
			var self = this;
			var _pre = $(this).html();
			$(this).html('<div id="contactable"></div><form action="'+ defaults.action +'" method="post" id="contactForm"><div id="loading"></div><div id="callback"></div><div class="holder">'+ _pre +'<p><label for="author">Name</label> <span class="red">*</span><input id="author" name="author" type="text" value="" size="30" aria-required="true"></p><p><label for="email">Email</label> <span class="red">*</span><input id="email" name="email" type="text" value="" /></p><p><label for="url">Website</label><input id="url" name="url" type="text" value="" /></p><p><label for="comment">Comment</label><span class="red">*</span><textarea id="comment" name="comment" cols="45" rows="3"></textarea></p><p><input name="submit" type="submit" id="submit" value="Post comment" class="submit" /><input type="hidden" name="comment_post_ID" value="'+ defaults.postid +'" /></p></div></form>');
			//--MOD
			
			//show / hide function
			$('div#contactable').toggle(function() {
				$('#overlay').css({display: 'block'});
				$(this).animate({"marginLeft": "-=5px"}, "fast"); 
				$('#contactForm').animate({"marginLeft": "-=0px"}, "fast");
				$(this).animate({"marginLeft": "+=387px"}, "slow"); 
				$('#contactForm').animate({"marginLeft": "+=390px"}, "slow"); 
			}, 
			function() {
				$('#contactForm').animate({"marginLeft": "-=390px"}, "slow");
				$(this).animate({"marginLeft": "-=387px"}, "slow").animate({"marginLeft": "+=5px"}, "fast"); 
				$('#overlay').css({display: 'none'});
			});
			
			//validate the form 
			$("#contactForm").validate({
				//set the rules for the fild names
				rules: {
					author: {
						required: true,
						minlength: 2
					},
					email: {
						required: true,
						email: true
					},
					comment: {
						required: true
					},
					url : {
						url : true
					}
				},
				//set messages to appear inline
					messages: {
						author: "",
						email: "",
						comment: "",
						url: ""
					},			
				submitHandler: function() {
					$('.holder').hide();
					$('#loading').show();
					/*
					$.post('mail.php',{subject:defaults.subject, name:$('#name').val(), email:$('#email').val(), comment:$('#comment').val()},
					function(data){
						$('#loading').css({display:'none'}); 
						if( data == 'success') {
							$('#callback').show().append(defaults.recievedMsg);
							if(defaults.hideOnSubmit == true) {
								//hide the tab after successful submition if requested
								$('#contactForm').animate({dummy:1}, 2000).animate({"marginLeft": "-=450px"}, "slow");
								$('div#contactable').animate({dummy:1}, 2000).animate({"marginLeft": "-=447px"}, "slow").animate({"marginLeft": "+=5px"}, "fast"); 
								$('#overlay').css({display: 'none'});	
							}
						} else {
							$('#callback').show().append(defaults.notRecievedMsg);
						}
					});*/
					//console.log($(this))
					$("#contactForm").ajaxSubmit({
						success : function(){
							$('#loading').css({display:'none'}); 
							$('#callback').show().append(defaults.recievedMsg);
                            if(defaults.hideOnSubmit == true) {
                                //hide the tab after successful submition if requested
                                $('#contactForm').animate({dummy:1}, 2000).animate({"marginLeft": "-=450px"}, "slow");
                                $('div#contactable').animate({dummy:1}, 2000).animate({"marginLeft": "-=447px"}, "slow").animate({"marginLeft": "+=5px"}, "fast"); 
                                $('#overlay').css({display: 'none'});   
                            }
						},
						error : function(){
							$('#loading').css({display:'none'}); 
							$('#callback').show().append(defaults.notRecievedMsg);
						}
					});
					return false;
				}
			});
		});
	};
})(jQuery);

