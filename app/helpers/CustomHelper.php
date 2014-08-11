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

}