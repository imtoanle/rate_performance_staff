<script>
jQuery(document).ready(function() { 
  jQuery("#ajax-data-table").on('click', ' a.remove-item', function (e) {
    e.preventDefault();
    var groupId = $(this).attr('item-id'),
        checkboxes = $('#ajax-table-item-'+groupId+' td:first .checkboxes');
    toggleCheckbox(checkboxes);
    $('#delete-modal').modal('show');
  });

  jQuery("#delete-modal").on('click', ' button[name="btn_submit"]', function (e) {
    e.preventDefault();
    delete_selected_row();
  });
});
</script>