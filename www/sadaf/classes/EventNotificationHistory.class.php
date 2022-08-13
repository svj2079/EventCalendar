<?php

    class be_EventNotificationHistory
    {
        public $EventTaskPersonNotifyID;
        public $NotifyType;
        public $SendDate;
        public $FullName;
        public $EventTaskID;
        
    }


    class manage_EventNotificationHistory
    {
        static function Add($NotifyType , $PersonID, $EventTaskID)
        {
            $mysql = pdodb::getInstance();
            $query = "insert into EventCalendar.EventTaskPersonNotify (NotifyType, SendDate, PersonID, EventTaskID) values (?, now(), ?,?)";
            $mysql->Prepare($query);
            $mysql->ExecuteStatement(array($NotifyType,$PersonID, $EventTaskID));
            return true;

        }


        static function GetList($EventTaskID)
        {
            $mysql = pdodb::getInstance();
            $query = "select *, g2j(SendDate) as gSendDate, concat(pfname , ' ' , plname) as FullName from EventCalendar.EventTaskPersonNotify 
            join hrmstotal.persons using (PersonID) where EventTaskID=? order by SendDate desc";
            $mysql->Prepare($query);
            $res = $mysql->ExecuteStatement(array($EventTaskID));
            $k = 0;
            while($rec = $res->fetch())
            {
                $ret[$k] = new be_EventNotificationHistory();
                $ret[$k]->FullName = $rec["FullName"];
                $ret[$k]->EventTaskPersonID=$rec["EventTaskPersonNotifyID"];
                $ret[$k]->NotifyType=$rec["NotifyType"];
                $ret[$k]->SendDate=$rec["gSendDate"];
                $k++;
    
            }
            if(isset($ret))
                return $ret;   
            else
                return null;             
        }

     

    }


?>


