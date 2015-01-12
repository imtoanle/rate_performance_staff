<?php 

/**
* Breadcrumb class
*/
class CustomHelper 
{
    /**
    * Create breadcrumb
    * @param array $items breadcrumb items
    * @return string
    */
    public static function getDataObjectToArray($object)
    {
        $arr = array();
        foreach ($object as $value)
        {
            $arr[$value->columnName] = $value->total;
        }
        return $arr;
    }

    public static function createArrayChartDataByMonth($array)
    {
        $arrObject = array();
        $finalArr = array();
        foreach ($array as $object) {
            $arrObject[] = self::getDataObjectToArray($object);
        }


        for($i=1; $i<=12; $i++)
        {
            $totalArr = array();
            foreach ($arrObject as $arr) {
                $totalArr[] = array_key_exists($i, $arr) ? $arr[$i] : 0;
            }
            $finalArr[$i] = $totalArr;
        }
        return $finalArr;
    }

    public static function sendMail($view, $data)
    {
        $company = Setting::find('company')->value;
        $adminSignature = View::make('emails.admin-signature', array(
            'company' => $company,
            'address' => Setting::find('address')->value,
            'email' => Setting::find('email')->value,
            'phone' => Setting::find('phone')->value,
            'skype' => Setting::find('skype')->value,
            ))->render();
        $defaultData = array_merge(array(
            'adminSignature' => $adminSignature, 
            'company' => $company),
            $data);
        $email = Mail::send($view, $defaultData,
        function($message) use ($data){
          $message->to($data['recipient'], $data['recipientName'])->subject($data['mailSubject']);
        });
        return $email;
    }

  public static function get_users_from_job_list($jobIds, $userInDepartment)
  {
    $existsUsers = array();
    foreach ($userInDepartment as $user) {
      $existsUsers[] = $user->username;
    }

    $usersInJob = array();
    foreach ($jobIds as $jobId) {
      $pattern = "^$jobId,|,$jobId,|^$jobId$|,$jobId$";
      $users = User::select('id', 'username', 'full_name')->whereRaw("job_title regexp '".$pattern."'")->get();
      $usersInJob[$jobId]['data'] = array();
      foreach ($users as $user) {
        if(!in_array($user->username, $existsUsers))
        {
          $usersInJob[$jobId]['data'][] = array(
            'id' => $user->id,
            'username' => $user->username, 
            'full_name' => $user->full_name,
          );
          $existsUsers[] = $user->username;
        }
      }
      $jobTitle = JobTitle::find($jobId);
      $usersInJob[$jobId]['jobName'] = is_object($jobTitle) ? $jobTitle->name : '';
    }
    return $usersInJob;
  }

  public static function convert_users_job_list_to_id_array($usersinJob)
  {
    $arrayUserId = [];
    foreach ($usersinJob as $jobs) {
      foreach ($jobs['data'] as $user) {
        $arrayUserId[] = $user['id'];
      }
    }
    return $arrayUserId;
  }

  public static function get_users_from_voter_list($json_voter)
  {
    /*
    if (!isset($json_voter)) return [];
    $decodeJson = json_decode($json_voter, true);
    $arrayUserId = [];
    $roleUsersArray = [];
    foreach ($decodeJson as $value) {
      $arrayUserId[$value['user_id']] = $value['role_id'];
      $roleUsersArray[$value['role_id']] = $value['user_id'];
    }
    $users = User::select('id', 'username', 'full_name', 'job_title')->whereIn('id', array_values($roleUsersArray))->get();
    $resultArr = [];
    $finalResult = [];

    foreach ($users as $user) {
      $resultArr[$arrayUserId[$user->id]][] = array(
        'id' => $user->id,
        'username' => $user->username,
        'full_name' => $user->full_name,
        'job_name' => $user->job_titles_name(),
        'role' => $arrayUserId[$user->id]
        );
    }

    foreach (array_unique(array_values($arrayUserId)) as $roleId) {
      $finalResult = array_merge($finalResult, $resultArr[$roleId]) ;
    }
  */

    /////////
    if (!isset($json_voter)) return [];
    $decodeJson = json_decode($json_voter, true);
    $allUsersInVote = [];
    $roleUsersArray = [];

    foreach ($decodeJson as $value) {
      $roleUsersArray[$value['role_id']][] = $value['user_id'];
      $allUsersInVote[] = $value['user_id'];
    }

    $users = User::select('id', 'username', 'full_name', 'job_title')->whereIn('id', $allUsersInVote)->get();

    $objectUsersInVote = [];
    foreach ($users as $user) { $objectUsersInVote[$user->id] = $user; }

    $resultArr = [];

    foreach ($roleUsersArray as $roleId => $userIdArr) {
      foreach ($userIdArr as $userId) {
        $resultArr[] = [
          'id' => $userId,
          'username' => $objectUsersInVote[$userId]->username,
          'full_name' => $objectUsersInVote[$userId]->full_name,
          'job_name' => $objectUsersInVote[$userId]->job_titles_name(),
          'role' => $roleId
        ];
      }
    }
  
    return $resultArr;
  }

  public static function get_users_from_specify_users_list($json_specify_users)
  {
    if (!isset($json_specify_users) || empty($json_specify_users) || $json_specify_users == 'null') return [];

    $decodeJson = json_decode($json_specify_users, true);
    $arrayUserId = array();

    foreach ($decodeJson as $value) {
      $arrayUserId[$value['user_id']] = $value['type_of_persion'];
    }

    $users = User::select('id', 'username', 'full_name', 'job_title')->whereIn('id', array_keys($arrayUserId))->get();
    $resultArr = [];

    foreach ($users as $user) {
      $resultArr[] = array(
        'id' => $user->id,
        'username' => $user->username,
        'full_name' => $user->full_name,
        'job_name' => $user->job_titles_name(),
        'type_of_person' => $arrayUserId[$user->id]
        );
    }

    return $resultArr;
  }

  public static function get_users_from_user_id_list($userIds)
  {
    return User::whereIn('id', $userIds)->get();
  }

  public static function get_roles_from_id($roleIds)
  {
    return Criteria::whereIn('id', $roleIds)->get();
  }

  public static function get_role_current_user($voter, $userId)
  {
    $resultArr = [];
    foreach (json_decode($voter, true) as $value) {
      if($value['user_id'] == $userId)
      {
        $role = Role::find($value['role_id']);
        $resultArr[$value['role_id']] = is_object($role) ? $role->name : '';
      }
    }
    return $resultArr;
  }

  public static function get_mark_with_role($params)
  {
    $content = isset($params['content']) ? $params['content'] : '';
    $voteResult = $params['voteResult'];
    $role_id = $params['roleId'];
    $ratingType = isset($params['ratingType']) ? $params['ratingType'] : '';

    $dataType = $content ? 'content' : 'mark';
    if (isset($voteResult) && !empty($voteResult[$dataType]))
    {
      $voteResult = $voteResult->toArray();
      $decodeData = empty($voteResult[$dataType]) ? [] : json_decode($voteResult[$dataType], true);
      foreach($decodeData as $data)
      {
        if($data['role_id'] == $role_id)
        {
          if (!isset($data[$dataType])) return;
          return $ratingType ? array_flip(Config::get('variable.rating-type'))[(int)$data[$dataType]] : $data[$dataType];
        }
      }
    }
  }

  public static function get_role_name($roleId)
  {
    $role = Role::find($roleId);
    return is_object($role) ? $role->name : '';
  }

  public static function get_user_name($userId)
  {
    $user = User::find($userId);
    return is_object($user) ? $user->full_name : '';
  }

  public static function get_users_from_job_id($jobId)
  {
    $pattern = "^$jobId,|,$jobId,|^$jobId$|,$jobId$";
    return User::whereRaw("job_title regexp '".$pattern."'")->get();
  }

  public static function get_general_result($voteId, $entitledUser, $ratingVote)
  {
    $result = GeneralResult::where('user_id', $entitledUser)->where('vote_id', $voteId)->first();
    if(is_object($result))
    {
      $general_mark = $result->mark;
    }else
    {
      $general_mark = CustomHelper::get_min_general_results($voteId, $entitledUser);
    }
    return ($ratingVote) ? array_flip(Config::get('variable.rating-type'))[(int)$general_mark] : $general_mark;
  }

  public static function get_min_general_results($voteId, $entitledUser)
  {
    $minArr = [];
    $voteResults = VoteResult::select('mark')->where('vote_id', $voteId)->where('entitled_vote_id', $entitledUser)->get();
    foreach ($voteResults as $result) {
      $minArr[] = CustomHelper::find_min_mark_from_roles($result->mark);
    }
    if(empty($minArr)) return '';
    return min($minArr);
  }

  public static function check_already_vote($vote, $voterId)
  {
    $voteResults = VoteResult::where('vote_id', $vote->id)->where('voter_id', $voterId)->get();
    if ($voteResults->count() != count(explode(",",$vote->entitled_vote)))
    {
      return "(<i style='color: red;'>Chưa chấm xong</i>)";
    }
  }

  public static function find_min_mark_from_roles($markString)
  {
    if (empty($markString))
    {
      return 100;
    }
    $minArr = [];
    foreach (json_decode($markString, true) as $mark) {
        $minArr[] = $mark['mark'];
    }
    return min($minArr);
  }

  public static function get_array_user_id_from_voter($voterString)
  {
    $decodeJson = json_decode($voterString, true);
    $arrayUserId = []; 

    foreach ($decodeJson as $value) {
      $arrayUserId[] = $value['user_id'];
    }
    return $arrayUserId;
  }

  public static function check_voted_of_vote($voteResult)
  {
    if (is_object($voteResult) && !empty($voteResult->mark) && !empty($voteResult->content)) return true;
    return false;
  }

  public static function get_array_vote_result_of_entitled_user($voteId, $entitledUser)
  {
    $voteResults = VoteResult::whereVoteId($voteId)->whereEntitledVoteId($entitledUser)->get();
    $results = [];
    foreach ($voteResults as $value) {
      $results[$value['voter_id']] = $value;
    }
    return $results;
  }
}