@extends(Config::get('view.backend.master'))
@section('content')
<!-- BEGIN PAGE CONTENT-->
<div class="row">
  <div class="col-md-12">
    <blockquote>
      <p style="font-size:16px">
         Công cụ nhập nhanh thành viên vào cơ sở dữ liệu. Cho phép thêm trực tiếp thành viên từ file excel
      </p>
    </blockquote>
    <br>

    <!-- The fileinput-button span is used to style the file input field as button -->
    <span class="btn btn-success fileinput-button">
        <i class="glyphicon glyphicon-plus"></i>
        <span>{{trans('all.select-file')}}...</span>
        <!-- The file input field used as target for the file upload widget -->
        <input id="fileupload" type="file" name="users_data_file">
    </span>
    <br>
    <br>
    <!-- The global progress bar -->
    <div id="progress" class="progress">
        <div class="progress-bar progress-bar-success"></div>
    </div>
    <!-- The container for the uploaded files -->
    <div id="files" class="files"></div>


    <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title">Chú ý</h3>
      </div>
      <div class="panel-body">
        <ul>
          <li>
             Giới hạn upload của file excel là <strong>5 MB</strong>
          </li>
          <li>
             Chỉ định dạng Excel (<strong>XLS, XLSX</strong>) được cho phép tải lên.
          </li>
          <li>
             Những file đã được tải lên sẽ được xóa tự động
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- END PAGE CONTENT-->
<script>
/*jslint unparam: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    $('#fileupload').fileupload({
        url: '{{route('importUsers')}}',
        dataType: 'json',
        done: function (e, data) {
          toastr[data.result.messageType](data.result.message);
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        },
        timeout: 10000,
        async: false
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>
@stop