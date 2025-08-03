(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 */ 
	$(function() {
		jQuery(document).ready(function(){
			
			if(jQuery('#bxb-sp-logs-table').length > 0){
				jQuery('#bxb-sp-logs-table').DataTable({
					lengthMenu: [
					  [20, 50, 100, -1],
					  [20, 50, 100, "All"],
					],
					pageLength: 100,
				});
			}

			if(jQuery('#bxb-rp-logs-table').length > 0){
				jQuery('#bxb-rp-logs-table').DataTable({
					lengthMenu: [
					  [20, 50, 100, -1],
					  [20, 50, 100, "All"],
					],
					pageLength: 100,
				});
			}
		});

		jQuery(document).ready(function(){
			if(jQuery('.bxb-sp-author-input').length > 0){
				jQuery('.bxb-sp-author-input').select2();
			}
		});

		jQuery(document).ready(function(){
			if(jQuery('.bxb-inline-related-posts-input').length > 0){
				jQuery('.bxb-inline-related-posts-input').select2();
			}
		});

		jQuery(document).ready(function(){
			if(jQuery('.bxb-rp-change-input').length > 0){
				jQuery('.bxb-rp-change-input').select2();
			}
		});
	});

	jQuery(".bxb-dashboard-switch").on("change", function() {
		var checked = $(this).is(":checked");
		var name = $(this).attr("name");
		var data = {
			action: 'save_status',
		};
		data[name] = checked.toString();;

		jQuery.ajax({
			type: "POST",
			url: ajaxurl,
			dataType: "json",
			data: data,
			success: function (success) {
				Swal.fire(
				  {
					position: "center",
					icon: "success",
					title: "Updated Successfully!",
					showConfirmButton: true,
				  }
				);
			},
			error: function () {
			  Swal.fire(
				{
				  position: "center",
				  icon: "error",
				  title: "An unexpected error occured!",
				  showConfirmButton: true,
				}
			  );
			},
		});
	});
	/*
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

})( jQuery );

function draft_schedule_admin(){
	var data = {
		action: 'draft_schedule_admin_save',
	};

	jQuery('input').each(function() {
		var id = jQuery(this).attr('id');
		var value = jQuery(this).val();
		data[id] = value;
	});

	jQuery('select').each(function() {
		var id = jQuery(this).attr('id');
		var value = jQuery(this).val();
		data[id] = value;
	});
	
	jQuery.ajax({
		type: "POST",
		url: ajaxurl,
		dataType: "json",
		data: data,
		success: function (success) {
			Swal.fire(
			  {
				position: "center",
				icon: "success",
				title: "Updated Successfully!",
				showConfirmButton: true,
			  }
			);
		},
		error: function () {
		  Swal.fire(
			{
			  position: "center",
			  icon: "error",
			  title: "An unexpected error occured!",
			  showConfirmButton: true,
			}
		  );
		},
	});
}

function rewrite_posts_admin(){
	var data = {
		action: 'rewrite_posts_admin_save',
	};

	jQuery('input').each(function() {
		var id = jQuery(this).attr('id');
		var value = jQuery(this).val();
		data[id] = value;
	});

	jQuery('select').each(function() {
		var id = jQuery(this).attr('id');
		var value = jQuery(this).val();
		data[id] = value;
	});
	
	jQuery.ajax({
		type: "POST",
		url: ajaxurl,
		dataType: "json",
		data: data,
		success: function (success) {
			Swal.fire(
			  {
				position: "center",
				icon: "success",
				title: "Updated Successfully!",
				showConfirmButton: true,
			  }
			);
		},
		error: function () {
		  Swal.fire(
			{
			  position: "center",
			  icon: "error",
			  title: "An unexpected error occured!",
			  showConfirmButton: true,
			}
		  );
		},
	});
}

function inline_related_posts_admin(){
	var data = {
		action: 'inline_related_posts_admin_save',
	};

	jQuery('select').each(function() {
		var id = jQuery(this).attr('id');
		var value = jQuery(this).val();
		data[id] = value;
	});
	
	jQuery.ajax({
		type: "POST",
		url: ajaxurl,
		dataType: "json",
		data: data,
		success: function (success) {
			Swal.fire(
			  {
				position: "center",
				icon: "success",
				title: "Updated Successfully!",
				showConfirmButton: true,
			  }
			);
		},
		error: function () {
		  Swal.fire(
			{
			  position: "center",
			  icon: "error",
			  title: "An unexpected error occured!",
			  showConfirmButton: true,
			}
		  );
		},
	});
}

function sp_save_settings() {
	var articles_mon = jQuery('#bxb-sp-articles-range-input-monday').val();
	var delay_mon = jQuery('#bxb-sp-delay-input-monday').val();
	var timing_mon = jQuery('#bxb-sp-timing-input-monday').val();
	var author_mon = jQuery('#bxb-sp-author-input-monday').val();
	author_mon = JSON.stringify(author_mon);

	var articles_tue = jQuery('#bxb-sp-articles-range-input-tuesday').val();
	var delay_tue = jQuery('#bxb-sp-delay-input-tuesday').val();
	var timing_tue = jQuery('#bxb-sp-timing-input-tuesday').val();
	var author_tue = jQuery('#bxb-sp-author-input-tuesday').val();
	author_tue = JSON.stringify(author_tue);

	var articles_wed = jQuery('#bxb-sp-articles-range-input-wednesday').val();
	var delay_wed = jQuery('#bxb-sp-delay-input-wednesday').val();
	var timing_wed = jQuery('#bxb-sp-timing-input-wednesday').val();
	var author_wed = jQuery('#bxb-sp-author-input-wednesday').val();
	author_wed = JSON.stringify(author_wed);

	var articles_thu = jQuery('#bxb-sp-articles-range-input-thursday').val();
	var delay_thu = jQuery('#bxb-sp-delay-input-thursday').val();
	var timing_thu = jQuery('#bxb-sp-timing-input-thursday').val();
	var author_thu = jQuery('#bxb-sp-author-input-thursday').val();
	author_thu = JSON.stringify(author_thu);

	var articles_fri = jQuery('#bxb-sp-articles-range-input-friday').val();
	var delay_fri = jQuery('#bxb-sp-delay-input-friday').val();
	var timing_fri = jQuery('#bxb-sp-timing-input-friday').val();
	var author_fri = jQuery('#bxb-sp-author-input-friday').val();
	author_fri = JSON.stringify(author_fri);

	var articles_sat = jQuery('#bxb-sp-articles-range-input-saturday').val();
	var delay_sat = jQuery('#bxb-sp-delay-input-saturday').val();
	var timing_sat = jQuery('#bxb-sp-timing-input-saturday').val();
	var author_sat = jQuery('#bxb-sp-author-input-saturday').val();
	author_sat = JSON.stringify(author_sat);

	var articles_sun = jQuery('#bxb-sp-articles-range-input-sunday').val();
	var delay_sun = jQuery('#bxb-sp-delay-input-sunday').val();
	var timing_sun = jQuery('#bxb-sp-timing-input-sunday').val();
	var author_sun = jQuery('#bxb-sp-author-input-sunday').val();
	author_sun = JSON.stringify(author_sun);

	var data = {
		action: 'sp_save_settings',
		articles_mon: articles_mon,
		delay_mon: delay_mon,
		timing_mon: timing_mon,
		author_mon: author_mon,
		articles_tue: articles_tue,
		delay_tue: delay_tue,
		timing_tue: timing_tue,
		author_tue: author_tue,
		articles_wed: articles_wed,
		delay_wed: delay_wed,
		timing_wed: timing_wed,
		author_wed: author_wed,
		articles_thu: articles_thu,
		delay_thu: delay_thu,
		timing_thu: timing_thu,
		author_thu: author_thu,
		articles_fri: articles_fri,
		delay_fri: delay_fri,
		timing_fri: timing_fri,
		author_fri: author_fri,
		articles_sat: articles_sat,
		delay_sat: delay_sat,
		timing_sat: timing_sat,
		author_sat: author_sat,
		articles_sun: articles_sun,
		delay_sun: delay_sun,
		timing_sun: timing_sun,
		author_sun: author_sun,
	}

	jQuery.ajax({
		type: "POST",
		url: ajaxurl,
		dataType: "json",
		data: data,
		success: function (success) {
			Swal.fire(
			  {
				position: "center",
				icon: "success",
				title: "Updated Successfully!",
				showConfirmButton: true,
			  }
			);
		},
		error: function () {
		  Swal.fire(
			{
			  position: "center",
			  icon: "error",
			  title: "An unexpected error occured!",
			  showConfirmButton: true,
			}
		  );
		},
	});

}

function prompt_admin(){
	var data = {
		action: 'prompt_admin_save',
	};

	jQuery('textarea').each(function() {
		var id = jQuery(this).attr('id');
		var value = jQuery(this).val();
		data[id] = value;
	});

	jQuery.ajax({
		type: "POST",
		url: ajaxurl,
		dataType: "json",
		data: data,
		success: function (success) {
			Swal.fire(
			  {
				position: "center",
				icon: "success",
				title: "Updated Successfully!",
				showConfirmButton: true,
			  }
			);
		},
		error: function () {
		  Swal.fire(
			{
			  position: "center",
			  icon: "error",
			  title: "An unexpected error occured!",
			  showConfirmButton: true,
			}
		  );
		},
	});
}

function social_media_admin(){
	var data = {
		action: 'social_media_admin_save',
	};

	jQuery('input').each(function() {
		var id = jQuery(this).attr('id');
		var value = jQuery(this).val();
		data[id] = value;
	});

	jQuery.ajax({
		type: "POST",
		url: ajaxurl,
		dataType: "json",
		data: data,
		success: function (success) {
			Swal.fire(
			  {
				position: "center",
				icon: "success",
				title: "Updated Successfully!",
				showConfirmButton: true,
			  }
			);
		},
		error: function () {
		  Swal.fire(
			{
			  position: "center",
			  icon: "error",
			  title: "An unexpected error occured!",
			  showConfirmButton: true,
			}
		  );
		},
	});
}

function ai_config_admin(){
	var data = {
		action: 'ai_config_admin_save',
	};
	jQuery('input').each(function() {
		var name = jQuery(this).attr('name');
		var value = jQuery(this).val();
		data[name] = value;
	});
	var selectedType = jQuery('input[name="rp_type"]:checked').val();
	data['rp_type'] = selectedType;

	jQuery.ajax({
		type: "POST",
		url: ajaxurl,
		dataType: "json",
		data: data,
		success: function (success) {
			Swal.fire(
			  {
				position: "center",
				icon: "success",
				title: "Updated Successfully!",
				showConfirmButton: true,
			  }
			);
		},
		error: function () {
		  Swal.fire(
			{
			  position: "center",
			  icon: "error",
			  title: "An unexpected error occured!",
			  showConfirmButton: true,
			}
		  );
		},
	});
}
function image_converter_admin(){
	var data = {
		action: 'image_converter_admin_save',
	};
	jQuery('input').each(function() {
		var name = jQuery(this).attr('name');
		var value = jQuery(this).val();
		data[name] = value;
	});

	jQuery.ajax({
		type: "POST",
		url: ajaxurl,
		dataType: "json",
		data: data,
		success: function (success) {
			Swal.fire(
			  {
				position: "center",
				icon: "success",
				title: "Updated Successfully!",
				showConfirmButton: true,
			  }
			);
		},
		error: function () {
		  Swal.fire(
			{
			  position: "center",
			  icon: "error",
			  title: "An unexpected error occured!",
			  showConfirmButton: true,
			}
		  );
		},
	});
}

function rp_save_settings() {
	var title_prompt = jQuery('#bxb-rp-title-prompt').val();
	var meta_description_prompt = jQuery('#bxb-rp-meta-description-prompt').val();
	var content_prompt = jQuery('#bxb-rp-content-prompt').val();
	var system_prompt = jQuery('#bxb-rp-system-prompt').val();
	var type = jQuery('input[name="bxb-rp-type"]:checked').val();
	var openai_key = jQuery('#bxb-rp-openai-key').val();
	var openai_model = jQuery('#bxb-rp-openai-model').val();
	var azure_api_version = jQuery('#bxb-rp-azure-api-version').val();
	var azure_api_base = jQuery('#bxb-rp-azure-api-base').val();
	var azure_api_key = jQuery('#bxb-rp-azure-api-key').val();
	var azure_engine = jQuery('#bxb-rp-azure-api-engine').val();

	var articles_mon = jQuery('#bxb-rp-articles-range-input-monday').val();
	var delay_mon = jQuery('#bxb-rp-delay-input-monday').val();
	var timing_mon = jQuery('#bxb-rp-timing-input-monday').val();
	var change_mon = jQuery('#bxb-rp-change-input-monday').val();
	change_mon = JSON.stringify(change_mon);

	var articles_tue = jQuery('#bxb-rp-articles-range-input-tuesday').val();
	var delay_tue = jQuery('#bxb-rp-delay-input-tuesday').val();
	var timing_tue = jQuery('#bxb-rp-timing-input-tuesday').val();
	var change_tue = jQuery('#bxb-rp-change-input-tuesday').val();
	change_tue = JSON.stringify(change_tue);

	var articles_wed = jQuery('#bxb-rp-articles-range-input-wednesday').val();
	var delay_wed = jQuery('#bxb-rp-delay-input-wednesday').val();
	var timing_wed = jQuery('#bxb-rp-timing-input-wednesday').val();
	var change_wed = jQuery('#bxb-rp-change-input-wednesday').val();
	change_wed = JSON.stringify(change_wed);

	var articles_thu = jQuery('#bxb-rp-articles-range-input-thursday').val();
	var delay_thu = jQuery('#bxb-rp-delay-input-thursday').val();
	var timing_thu = jQuery('#bxb-rp-timing-input-thursday').val();
	var change_thu = jQuery('#bxb-rp-change-input-thursday').val();
	change_thu = JSON.stringify(change_thu);

	var articles_fri = jQuery('#bxb-rp-articles-range-input-friday').val();
	var delay_fri = jQuery('#bxb-rp-delay-input-friday').val();
	var timing_fri = jQuery('#bxb-rp-timing-input-friday').val();
	var change_fri = jQuery('#bxb-rp-change-input-friday').val();
	change_fri = JSON.stringify(change_fri);

	var articles_sat = jQuery('#bxb-rp-articles-range-input-saturday').val();
	var delay_sat = jQuery('#bxb-rp-delay-input-saturday').val();
	var timing_sat = jQuery('#bxb-rp-timing-input-saturday').val();
	var change_sat = jQuery('#bxb-rp-change-input-saturday').val();
	change_sat = JSON.stringify(change_sat);

	var articles_sun = jQuery('#bxb-rp-articles-range-input-sunday').val();
	var delay_sun = jQuery('#bxb-rp-delay-input-sunday').val();
	var timing_sun = jQuery('#bxb-rp-timing-input-sunday').val();
	var change_sun = jQuery('#bxb-rp-change-input-sunday').val();
	change_sun = JSON.stringify(change_sun);

	var data = {
		action: 'rp_save_settings',
		articles_mon: articles_mon,
		delay_mon: delay_mon,
		timing_mon: timing_mon,
		change_mon: change_mon,
		articles_tue: articles_tue,
		delay_tue: delay_tue,
		timing_tue: timing_tue,
		change_tue: change_tue,
		articles_wed: articles_wed,
		delay_wed: delay_wed,
		timing_wed: timing_wed,
		change_wed: change_wed,
		articles_thu: articles_thu,
		delay_thu: delay_thu,
		timing_thu: timing_thu,
		change_thu: change_thu,
		articles_fri: articles_fri,
		delay_fri: delay_fri,
		timing_fri: timing_fri,
		change_fri: change_fri,
		articles_sat: articles_sat,
		delay_sat: delay_sat,
		timing_sat: timing_sat,
		change_sat: change_sat,
		articles_sun: articles_sun,
		delay_sun: delay_sun,
		timing_sun: timing_sun,
		change_sun: change_sun,
		title_prompt: title_prompt,
		meta_description_prompt: meta_description_prompt,
		content_prompt: content_prompt,
		system_prompt: system_prompt,
		type: type,
		openai_key: openai_key,
		openai_model: openai_model,
		azure_api_version: azure_api_version,
		azure_api_base: azure_api_base,
		azure_api_key: azure_api_key,
		azure_engine: azure_engine
	}

	jQuery.ajax({
		type: "POST",
		url: ajaxurl,
		dataType: "json",
		data: data,
		success: function (success) {
			Swal.fire(
			  {
				position: "center",
				icon: "success",
				title: "Updated Successfully!",
				showConfirmButton: true,
			  }
			);
		},
		error: function () {
		  Swal.fire(
			{
			  position: "center",
			  icon: "error",
			  title: "An unexpected error occured!",
			  showConfirmButton: true,
			}
		  );
		},
	  });

}

function rp_handle_type_change(src){
	if(src.value=="Azure"){
		jQuery('#bxb-rp-openai-settings').css('display', 'none');
		jQuery('#bxb-rp-azure-settings').css('display', 'block');
	} else {
		jQuery('#bxb-rp-openai-settings').css('display', 'block');
		jQuery('#bxb-rp-azure-settings').css('display', 'none');
	}
}

function test_social_media(){
	var ifttt_url = jQuery('#ifttt_url').val();
	var json_data = {
		"fb_caption": "Testing",
		"tw_caption": "Testing",
		"post_thumbnail": "https://dummyimage.com/1280x720/000/fff"
	}
	jQuery.ajax({
		type: "POST",
		url: ifttt_url,
		data: json_data,
		complete: function (response) {
			Swal.fire(
				{
					position: "center",
					icon: "success",
					title: "Send to Social Media Successfully!",
					text: "Check and delete Testing Social Media Post.",
					showConfirmButton: true,
				}
			);
		}
	});
}

function save_social_media(status){
	var data = {
		action: 'social_media_save_settings',
		social_media_html: status
	}

	jQuery.ajax({
		type: "POST",
		url: ajaxurl,
		dataType: "json",
		data: data,
		success: function (success) {
			Swal.fire(
			  {
				position: "center",
				icon: "success",
				title: "Updated Successfully!",
				showConfirmButton: true,
			  }
			);
		},
		error: function () {
		  Swal.fire(
			{
			  position: "center",
			  icon: "error",
			  title: "An unexpected error occured!",
			  showConfirmButton: true,
			}
		  );
		},
	  });
}

