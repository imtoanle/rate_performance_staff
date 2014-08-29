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

  public static function get_users_from_job_list($jobIds)
  {
    $usersInJob = array();
    $existsUsers = array();
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

  public static function get_users_from_voter_list($json_voter)
  {
    $decodeJson = json_decode($json_voter, true);
    $arrayUserId = array_keys($decodeJson);
    $users = User::select('id', 'username', 'full_name', 'job_title')->whereIn('id', $arrayUserId)->get();
    $resultArr = [];
    foreach ($users as $user) {
      $resultArr[] = array(
        'id' => $user->id,
        'username' => $user->username,
        'full_name' => $user->full_name,
        'job_name' => $user->job_titles_name(),
        'role' => $decodeJson[$user->id]
        );
    }

    return $resultArr;
  }
}