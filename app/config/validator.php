<?php

return array(
  'frontend' => array(
    'order-create-multi-imei' => array(
      'service_id' => 'required',
      'imei_bulk' => 'required',
      'response_email' => 'email'
    ),
    'order-create-single-imei' => array(
      'service_id' => 'required',
      'imei1' => 'required|min:14',
      'response_email' => 'email'
    ),
    'update-profile' => array(
      'full_name' => array('required')
    ),
    'change-pass' => array(
      'old_password' => 'required',
      'password' => 'required|min:5|different:old_password',
      'password_again' => 'required|same:password'
    ),

    'change-question' => array(
      'current_answer' => 'required',
      'new_answer' => 'required',
    ),  
    'create-client' => array(
      'username' => 'required|max:50|unique:clients',
      'email' => 'required|max:50|email|unique:clients',
      'password' => 'required|min:5',
      'password_confirm' => 'required|same:password',
      'full_name' => 'required|min:3',
      'security_question' => 'required',
      'security_answer' => 'required',
      'captcha' => 'required|captcha',
    ),
    'contact-us' => array(
      'full_name' => 'required|min:3',
      'email' => 'required|email|max:50',
      'subject' => 'required',
      'content' => 'required',
      'captcha' => 'required|captcha',
    ),
    'create-comment' => array(
      'full_name' => 'required|min:3',
      'email' => 'required|email|max:50',
      'content' => 'required',
      'blog_id' => 'required',
      'captcha' => 'required|captcha'
    ),
  ),
  
  'backend' => array(
    'usergroup-update' => array(
      'group_name' => 'required|min:3',
      ),
    'job-title-create' => array(
      'job_name' => 'required|min:3',
    ),

    'department-create' => array(
      'department_name' => 'required|min:3',
    ),

    'criteria-create' => array(
      'criteria_name' => 'required|min:3',
    ),

    'role-create' => array(
      'role_name' => 'required|min:3',
    ),

    'service-update' => array(
      'service_name' => 'required|min:3',
      'delivery_time' => 'required',
      'credit' => 'required',
      ),
    'service-create' => array(
      'service_name' => 'required|min:3',
      'service_cat' => 'required',
      'service_type' => 'required',
      'delivery_time' => 'required',
      'credit' => 'required|regex:/^[0-9]+(\.[0-9]{1,2})?$/',
      ),
    'service-group-update' => array(
      'group_name' => 'required|min:3',
      ),

    'supplier-update' => array(
      'username' => 'required',
      'email' => 'required|email',
      ),

    'supplier-create' => array(
      'username' => 'required',
      'password' => 'required',
      'email' => 'required|email',
      ),
    'client-group-update' => array(
      'name' => 'required',
      ),
    'client-create' => array(
      'username' => 'required|max:50|unique:clients',
      'email' => 'required|max:50|email|unique:clients',
      'amount' => 'required|regex:/^[0-9]+(\.[0-9]{1,2})?$/',
    ),
    'client-update' => array(
      'email' => 'required|max:50|email',
      ),
    'client-financial-add-credit' => array(
      'add_credit' => 'required|regex:/^[0-9]+(\.[0-9]{1,2})?$/',
      ),
    'client-financial-rebate-credit' => array(
      'rebate_credit' => 'required|regex:/^[0-9]+(\.[0-9]{1,2})?$/',
      'invoice_id' => 'required',
      ),
    'client-bind-login-update' => array(
      'bind_login' => 'ip',
      ),
    'api-setting-update' => array(
      'api_key' => 'required'
      ),

    'vote-create' => array(
      'vote_code' => 'required',
      'title' => 'required',
      'object_vote_list' => 'required',
      'entitled_vote' => 'required',
      'voter_id' => 'required',
      'criteria_list' => 'required',
      'expiration_date' => 'required',
      'head_department' => 'required',
    ),

    'vote-update' => array(
      'object_vote_list' => 'required',
      'entitled_vote' => 'required',
      'voter_id' => 'required',
      'criteria_list' => 'required',
      'expiration_date' => 'required',
    ),

    'vote-group-update' => array(
      'vote_code' => 'required',
      'title' => 'required',
      'head_department' => 'required',
      ),

    'vote-result-mark' => array(
      'value' => 'integer|between:0,100'
      ),

    'user-create' => array(
      'email' => array('required', 'email'),
      'password' => array('required', 'min:6', 'max:255'),
      'username' => array('required', 'min:3', 'max:255'),
      'full_name' => array('min:3', 'max:255'),
    ),
    'user-update-privacy' => array(
      //'email' => array('required', 'email'),
      'password' => array('min:6', 'max:255'),
      //'username' => array('required', 'min:3', 'max:255'),
      //'full_name' => array('min:3', 'max:255'),
    ),
    'user-update-personal' => array(
      'full_name' => array('required','min:3', 'max:255'),
    ),
    'user-change-pass' => array(
      'current_password' => 'required',
      'new_password' => 'required|min:5|different:current_password',
      'confirm_password' => 'required|same:new_password'
    ),


    'user-login' => array(
      'username' => array('required', 'min:3'),
      'password' => array('required', 'min:6', 'max:255'),
    ),
    'group' => array(
      'groupname' => array('required', 'min:3', 'max:16', 'alpha'),
    ),
    'permission' => array(
      'name' => array('required', 'min:3', 'max:100'),
      'value' => array('required', 'alpha_dash', 'min:3', 'max:100'),
      'description' => array('required', 'min:3', 'max:255')
    ),
  ),
);


