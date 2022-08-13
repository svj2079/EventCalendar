<?php

    class be_EventTask
    {
        public $id;
        public $description;
        public $level;
        public $NotifyByEmail;
        public $NotifyBySms;
        public $NotifyByTask;


        function LoadDataFromDatabase($RecID)
        {
            $query = "select * from EventCalendar.EventTasks  where  id=? ";
            $mysql = pdodb::getInstance();
            $mysql->Prepare ($query);
            $res = $mysql->ExecuteStatement (array ($RecID));
            if($rec=$res->fetch())
            {
                $this->id=$rec["id"];
                $this->description=$rec["description"];
                $this->level=$rec["level"];
                $this->EventID=$rec["EventID"];
                $this->NotifyByEmail=$rec["NotifyByEmail"];
                $this->NotifyBySms=$rec["NotifyBySms"];
                $this->NotifyByTask=$rec["NotifyByTask"];
                //
            }
        }
    }


    class manage_EventTasks
    {
        static function Add($description, $level, $EventID, $NotifyByEmail, $NotifyBySms, $NotifyByTask)
        {
            $mysql = pdodb::getInstance();
            $query = "insert into EventCalendar.EventTasks (description, level, EventID, NotifyByEmail, NotifyBySms, NotifyByTask) values (?, ?, ?, ?, ?, ?)";
            $mysql->Prepare($query);
            $mysql->ExecuteStatement(array($description, $level, $EventID, $NotifyByEmail, $NotifyBySms, $NotifyByTask));
            return true;

        }

        static function Update($id, $description, $level, $NotifyByEmail, $NotifyBySms, $NotifyByTask)
        {
            $mysql = pdodb::getInstance();
            $query = "update EventCalendar.EventTasks set description=?, level=?, NotifyByEmail=?, NotifyBySms=?, NotifyByTask=? where id=?";
            $mysql->Prepare($query);
            $mysql->ExecuteStatement(array($description, $level, $NotifyByEmail, $NotifyBySms, $NotifyByTask, $id));
            return true;

        }

        static function Remove($id)
        {
            $mysql = pdodb::getInstance();
            $query = "delete from EventCalendar.EventTasks where id=?";
            $mysql->Prepare($query);
            $mysql->ExecuteStatement(array($id));
            return true; 

        }


        static function GetPersonTasks($PersonID)
        {
            $mysql = pdodb::getInstance();
            $query = "select EventTaskPerson.EventTaskID, EventTasks.description, NotifyByEmail, NotifyBySms , NotifyByTask, events.description as EventDescription , concat(substr(StartTime, 12, 5), '<b>|</b>', g2j(StartTime)) as gStartDate, concat(substr(EndTime , 12, 5), '<b>|</b>' ,g2j(EndTime)) as gEndDate, events.title as EventTitle
             from eventcalendar.events 
            join eventcalendar.EventTasks on (events.id = EventTasks.EventID)
            join eventcalendar.EventTaskPerson on (EventTaskPerson.EventTaskID = EventTasks.id)
            where EventTaskPerson.PersonID= ? and StartTime between now() and ADDDATE(now(), interval 7 DAY)";
            $mysql->Prepare($query);
            $res = $mysql->ExecuteStatement(array($PersonID));
            return $res;   
              
        }


        static function GetList($EventID)
        {
            $mysql = pdodb::getInstance();
            $query = "select * from EventCalendar.EventTasks where EventID=?";
            $mysql->Prepare($query);
            $res = $mysql->ExecuteStatement(array($EventID));
            $k = 0;
            while($rec = $res->fetch())
            {
                $ret[$k] = new be_EventTask();
                $ret[$k]->id=$rec["id"];
                $ret[$k]->description=$rec["description"];
                $ret[$k]->level=$rec["level"];
                $ret[$k]->NotifyByEmail=$rec["NotifyByEmail"];
                $ret[$k]->NotifyBySms=$rec["NotifyBySms"];
                $ret[$k]->NotifyByTask=$rec["NotifyByTask"];
                $ret[$k]->EventID=$rec["EventID"];
                $k++;
    
            }
            if(isset($ret))
                return $ret;   
            else
                return null;             
        }

     

    }




?>