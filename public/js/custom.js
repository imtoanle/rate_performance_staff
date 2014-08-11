
/* Add here all your JS customizations */
/*
$('#create-data-form, #edit-data-form').on('submit', function()
{
  var method, action = $(this).attr("action");
  if ($(this).attr("id") == 'create-data-form')
  { method = 'POST'; }
  else { method = 'PUT'; }
  var sArray = $(this).serializeArray();
  $.ajax({
      "type": method,
      "url": action,
      "data": sArray,
      "dataType": "json"
  }).done(function(result)
  {
      if(result.dataStatus === false)
      {
          if(typeof result.message !== 'undefined')
          {
              showStatusMessage(result.message, result.messageType);
          }
          else if(typeof result.errorMessages !== 'undefined')
          {
            var offset_col = '';
            if(typeof result.offset !== 'undefined')
            { offset_col = result.offset; }   
            showRegisterFormAjaxErrors(result.errorMessages, offset_col);
          }
      }
      else
      {
          window.location = result.redirectUrl;
      }
    });
  return false;
});
*/


$('.ajax-submit-form').on('submit', function()
{
  
  var method = $(this).attr("method"), 
      action = $(this).attr("action"),
      submit_btt = $(this).find(':submit'),
      this_form = $(this);
  submit_btt.attr("value", submit_btt.data('loading-text')).attr("disabled","disabled");
  var sArray = $(this).serializeArray();
  $.ajax({
      "type": method,
      "url": action,
      "data": sArray,
      "dataType": "json"
  }).done(function(result)
  {
    if(typeof result.redirectUrl !== 'undefined')
    {
      if (result.redirectUrl == 'self')
      {
        window.location.replace(window.location.href.toString());
      }else
      {window.location.replace(result.redirectUrl);}
    }
    else
    {
      if(typeof result.message !== 'undefined')
      {
        //single error and success here
        showStatusMessage(result.message, result.messageType);
      }
      else if(typeof result.errorMessages !== 'undefined')
      {

        var offset_col = '';
        if(typeof result.offsetCol !== 'undefined') { offset_col = 'col-md-offset-'+result.offsetCol; }   
        showRegisterFormAjaxErrors(result.errorMessages, offset_col);
      }

      if(($(".ajax-alert").position().top - 80) < $(window).scrollTop()){
        $("html, body").animate({
           scrollTop: $(".ajax-alert").offset().top - 80
        }, 300);
      }

      submit_btt.attr("value", "Submit").removeAttr("disabled");
    }
    //Xoa gia tri cua o^ neu can
    if (result.clearField === true) { this_form[0].reset();  }
    });

  return false;
});


$("[data-mask]").each(function (i, el) {
  var $this = $(el),
      mask = $this.data('mask').toString(),
      opts = {
          numericInput: attrDefault($this, 'numeric', false),
          radixPoint: attrDefault($this, 'radixPoint', ''),
          rightAlignNumerics: attrDefault($this, 'numericAlign', 'left') == 'right'
      },
      placeholder = attrDefault($this, 'placeholder', ''),
      is_regex = attrDefault($this, 'isRegex', '');
  if (placeholder.length) {
      opts[placeholder] = placeholder;
  }
  switch (mask.toLowerCase()) {
  case "phone":
      mask = "(999) 999-9999";
      break;
  case "currency":
  case "rcurrency":
      var sign = attrDefault($this, 'sign', '$');;
      mask = "999,999,999.99";
      if ($this.data('mask').toLowerCase() == 'rcurrency') {
          mask += ' ' + sign;
      } else {
          mask = sign + ' ' + mask;
      }
      opts.numericInput = true;
      opts.rightAlignNumerics = false;
      opts.radixPoint = '.';
      break;
  case "email":
      mask = 'Regex';
      opts.regex = "[a-zA-Z0-9._%-]+@[a-zA-Z0-9-]+\\.[a-zA-Z]{2,4}";
      break;
  case "fdecimal":
      mask = 'decimal';
      $.extend(opts, {
          autoGroup: true,
          groupSize: 3,
          radixPoint: attrDefault($this, 'rad', '.'),
          groupSeparator: attrDefault($this, 'dec', ',')
      });
  }
  if (is_regex) {
      opts.regex = mask;
      mask = 'Regex';
  }
  $this.inputmask(mask, opts);
});

function showRegisterFormAjaxErrors(errors, offset_col) {
    var $ = jQuery;
    $('.alert-message').remove();
    $('.form-group.validate-has-error').removeClass('validate-has-error');
    $('.validate-has-error').remove();

    for(var errorType in errors)
    {
        for(var i in errors[errorType])
        {
          /*
        	var locate = $('input[name="'+errorType+'"],textarea[name="'+errorType+'"]')
        	locate.prev().after('<div class="col-sm-12 validate-has-error"><span for="'+errorType+'">'+errors[errorType][i]+'</span></div>');
            locate.closest('.form-group').addClass('validate-has-error');
            */
            
          var html_add = '<div class="'+offset_col+' validate-has-error"><span for="'+errorType+'">'+errors[errorType][i]+'</span></div>',
          //var html_add = '<label for="'+errorType+'" class="'+offset_col+' error">'+errors[errorType][i]+'</label>',
          select_input = $('input[name="'+errorType+'"],textarea[name="'+errorType+'"],select[name="'+errorType+'"]');
          select_input.closest('.form-group').addClass('validate-has-error');
          select_input.closest('.input-group').after(html_add);
        }
    }
}


function showAjaxClickResult(url, method, sData)
{
  $ = jQuery;
  $.ajax({
      "type": method,
      "url": url,
      "data": sData,
      "dataType": "json"
  }).done(function(result)
  {
    showStatusMessage(result.message, result.messageType);

    if(($(".ajax-alert").position().top - 80) < $(window).scrollTop()){
      $("html, body").animate({
         scrollTop: $(".ajax-alert").offset().top - 80
      }, 300);
    }
  });
}

function showStatusMessage(message, type) {
    var $ = jQuery;
    $('.alert-message').remove();
    $('.form-group.validate-has-error').removeClass('validate-has-error');
    $('.validate-has-error').remove();

    var html = '<div class="row alert-message">\n\
		<div class="col-md-12">\n\
			<div class="alert alert-'+type+'">'+message+'</div>\n\
		</div>\n\
	</div>';
	$('.ajax-alert').html(html).hide().fadeIn(900);
}

function attrDefault($el, data_var, default_val) {
    if (typeof $el.data(data_var) != 'undefined') {
        return $el.data(data_var);
    }
    return default_val;
}
