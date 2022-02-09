<?php

    class be_EventTaskPersonNotify
    {
        public $EventTaskPersonNotifyID;
        public $NotifyType;
        public $SendDate;
        public $PersonID;
        public $EventTaskID;
        


        function LoadDataFromDatabase($RecID)
        {
            $query = "select * from EventCalendar.EventTaskPersonNotify  where  EventTaskPersonNotifyID=? ";
            $mysql = pdodb::getInstance();
            $mysql->Prepare ($query);
            $res = $mysql->ExecuteStatement (array ($RecID));
            if($rec=$res->fetch())
            {
                $this->EventTaskPersonID=$rec["EventTaskPersonNotifyID"];
                $this->NotifyType=$rec["NotifyType"];
                $this->SendDate=$rec["SendDate"];
                $this->PersonID=$rec["PersonID"];
                $this->EventTaskID=$rec["EventTaskID"];
            }
        }
    }


    class manage_EventTaskPersonNotify
    {
        static function Add($NotifyType , $PersonID, $EventTaskID)
        {
            $mysql = pdodb::getInstance();
            $query = "insert into EventCalendar.EventTaskPersonNotify (NotifyType, SendDate, PersonID, EventTaskID) values (?, now(), ?,?)";
            $mysql->Prepare($query);
            $mysql->ExecuteStatement(array($NotifyType,$PersonID, $EventTaskID));
            return true;

        }


        static function GetList($EventTaskPersonNotifyID)
        {
            $mysql = pdodb::getInstance();
            $query = "select * from EventCalendar.EventTaskPersonNotify where EventTaskPersonNotifyID=?";
            $mysql->Prepare($query);
            $res = $mysql->ExecuteStatement(array($EventTaskPersonNotifyID));
            $k = 0;
            while($rec = $res->fetch())
            {
                $ret[$k] = new be_EventTaskPersonNotify();
                $ret[$k]->EventTaskPersonID=$rec["EventTaskPersonNotifyID"];
                $ret[$k]->NotifyType=$rec["NotifyType"];
                $ret[$k]->SendDate=$rec["SendDate"];
                $k++;
    
            }
            if(isset($ret))
                return $ret;   
            else
                return null;             
        }

     

    }

    /*  SELECT * FROM eventcalendar.events 
JOIN eventcalendar.EventTasks on (events.id = EventTasks.EventID)
JOIN eventcalendar.EventTaskPerson on (EventTaskPerson.EventTaskID = EventTasks.id)
where EventTaskPerson.PersonID='100520' and StartTime between now() and ADDDATE(now(), interval 7 DAY);  */

?>


