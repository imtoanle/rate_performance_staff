jQuery(document).ready(function() {    
   App.init(); // initlayout and core plugins
   // handle ajax links
  jQuery(document).on('click', 'a.ajaxify-child-page', function (e) {
      e.preventDefault();
      //App.scrollTop();
      redirect_url_ajax($(this).attr('href'));
      
  });


  //
  toastr.options = {
    "closeButton": true,
    "debug": false,
    "positionClass": "toast-bottom-right",
    "onclick": null,
    "showDuration": "1000",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }


  jQuery(document).on('submit', 'form.base-ajax-form', function (e) {
    e.preventDefault();
    var data = $( this ).serialize();
    $(this).find('select.select2').each(function(){
      var select2_var = $(this).val() == null ? '' : $(this).val();
      data += '&'+ $(this).attr('name') + '=' + select2_var;
    });
    
    ajax_call_custom($(this).attr('type'), $(this).attr('action'), data, function(result){
      if(typeof(result.errorMessages) != 'undefined')
      {
        showRegisterFormAjaxErrors(result.errorMessages);
      }else
      {
        if(typeof(result.redirectUrl) != 'undefined')
        {
          redirect_url_ajax(result.redirectUrl);
        }else if (typeof(result.message) != 'undefined')
        {
          removeErrorsFormValidate();
        }

        toastr[result.messageType](result.message);
      }
    });
  });

  jQuery(document).on('click', 'a.remove-item', function (e) {
    e.preventDefault();
    var itemId = $(this).attr('item-id'),
        checkboxes = $('#ajax-table-item-'+itemId+' td:first .checkboxes');

    //clear all checkbox
    clear_selected_checkbox()
    //select current checkobx
    checkboxes.parents('span').toggleClass("checked");
    checkboxes.parents('tr').toggleClass("active");
    $('#delete-modal').modal('show');
  });

  //clear checked when close modal
  $(document).on('#delete-modal hidden.bs.modal', function () {
    clear_selected_checkbox();
  })

  jQuery(document).on('click', '#delete-modal button[name="btn_submit"]', function (e) {
    e.preventDefault();
    delete_selected_row();
  });

  // checkall checkbox
  jQuery(document).on('change', '#ajax-data-table .group-checkable', function() {
    var set = jQuery(this).attr("data-set");
    var checked = jQuery(this).is(":checked");
    jQuery(set).each(function () {
      if (checked) {
        jQuery(this).attr("checked", true);
        jQuery(this).parents('span').addClass("checked");
        jQuery(this).parents('tr').addClass("active");
      } else {
        jQuery(this).attr("checked", false);
        jQuery(this).parents('span').removeClass("checked");
        jQuery(this).parents('tr').removeClass("active");
      } 
    });
    jQuery.uniform.update(set);
  });

  //click checkbox
  jQuery(document).on('change', '#ajax-data-table tbody tr .checkboxes', function() {
    toggleCheckbox($(this));
  });

  $('a.view-notify-btn').click(function(e){
    e.preventDefault();
    ajax_call_custom('GET', $(this).attr('href'), '', function(result){
      redirect_url_ajax(result.redirectUrl);
    });
  });

  
});

function ajax_call_custom(type, url, data, successCallback)
{
  if (typeof data === 'undefined') { data = ''; }
  if (typeof successCallback === 'undefined') { successCallback = null; }

  $.ajax({
    type: type,
    cache: false,
    url: url,
    data: data,
    dataType: "json",
    success: function (result) {
      if (successCallback !== null)
      {
        clear_form();
        successCallback(result);
      }
    },
    error: function (xhr) {
      var json_responsed = JSON.parse(xhr.responseText);
      toastr['error'](json_responsed.error.message);
    },
  });
}

function showRegisterFormAjaxErrors(errors) {
  var $ = jQuery;
  
  removeErrorsFormValidate();
  for(var errorType in errors)
  {
      for(var i in errors[errorType])
      {
        var html_add = '<span class="help-block">'+errors[errorType][i]+'</span>',
        select_input = $('input[name="'+errorType+'"],textarea[name="'+errorType+'"],select[name="'+errorType+'"]');
        select_input.closest('.form-group').addClass('has-error');
        if(select_input.parent().hasClass('input-group'))
          select_input.closest('.input-group').after(html_add);
        else 
          select_input.after(html_add);
      }
  }
}

function showRegisterFormAjaxErrorsNotify(errors) {
  var $ = jQuery, html_add = '';
  for(var errorType in errors)
  {
      for(var i in errors[errorType])
      {
        html_add += '<span>'+errors[errorType][i]+'</span>';
      }
  }
  toastr['error'](html_add);
}

function removeErrorsFormValidate()
{
  $('.has-error span.help-block').remove();
  $('.form-group.has-error').removeClass('has-error');
}

function toggleCheckbox(this_element)
{
  this_element.parents('span').toggleClass("checked");
  this_element.parents('tr').toggleClass("active");
  //this_element.prop("checked", !this_element.prop("checked"));
}

function delete_selected_row()
{
  var dataTableElement = $('#ajax-data-table'),
      datas = $('#ajax-data-table tr span.checked input.checkboxes').map(function(){ return $(this).val(); }).get();
  ajax_call_custom('DELETE', dataTableElement.attr('action-delete'), 'itemIds='+datas, function(result){
    if(result.messageType == 'success')
    { //delete row
      $('#ajax-data-table tr.active').each(function(i) {
        dataTableElement.dataTable().fnDeleteRow(dataTableElement.dataTable().fnGetPosition($(this).get(0)));  
      })
    ;}
    //hide modal
    $('#delete-modal').modal('hide');
    //show notice
    toastr[result.messageType](result.message);
  });  
}

function clear_selected_checkbox()
{
  $('#ajax-data-table tbody tr span.checked').removeClass('checked');
  $('#ajax-data-table tbody tr.active').removeClass('active');
}

function redirect_url_ajax(url)
{
  var pageContent = $('.page-content');
  var pageContentBody = $('.page-content .page-content-body');
  App.blockUI(pageContent, false);

  $.ajax({
      type: "GET",
      cache: false,
      url: url,
      dataType: "html",
      success: function (res) {
          App.unblockUI(pageContent);
          pageContentBody.html(res);
          App.fixContentHeight(); // fix content height
          App.initAjax(); // initialize core stuff
      },
      error: function (xhr, ajaxOptions, thrownError) {
          var json_responsed = JSON.parse(xhr.responseText);
          toastr['error'](json_responsed.error.message);
          App.unblockUI(pageContent);
      },
      async: false
  });
}

function clear_form()
{
  $('input[type=password]').val('');
}