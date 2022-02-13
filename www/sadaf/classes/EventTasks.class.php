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
            $query = "select EventTaskPerson.EventTaskID, EventTasks.description, NotifyByEmail, NotifyBySms , NotifyByTask, events.description as EventDescription , StartTime, EndTime, events.title as EventTitle
             from eventcalendar.events 
            join eventcalendar.EventTasks on (events.id = EventTasks.EventID)
            join eventcalendar.EventTaskPerson on (EventTaskPerson.EventTaskID = EventTasks.id)
            where EventTaskPerson.PersonID= ? and StartTime between now() and ADDDATE(now(), interval 7 DAY)";
            $mysql->Prepare($query);
            $res = $mysql->ExecuteStatement(array($PersonID));
            return $res;   
              
        }



        static function GetCount()
        {
            $mysql = pdodb::getInstance();
            $query = "select count(*) as tcount from EventCalendar.EventTasks";
            $mysql->Prepare($query);
            $res = $mysql->ExecuteStatement(array($query));
            $rec = $res->fetch();
            return $rec["tcount"];
        }



        static function GetCountSearch($FromDate , $ToDate)
        {
            $condArray = array();
            $mysql = pdodb::getInstance();
            $query = "select count(*) as tcount from EventCalendar.EventTasks where FromDate like ? ";
            if ($FromDate != "")
            {
             $query .= " and StartTime<=? ";
             array_push($condArray, $FromDate);
            }
            if ($ToDate != "")
            {
             $query .= " and EndTime>=?";
             array_push($condArray, $ToDate);
            }
            $mysql->Prepare($query);
            $res = $mysql->ExecuteStatement($condArray);
            //echo $query;
            //echo "<br>".$FromDate."<br>".$ToDate;
            $rec = $res->fetch();
            return $rec["tcount"];
        }



        static function Search($FromDate , $ToDate, $FromRec = 0, $ItemsCount = 10)
        {
            if(! is_numeric($FromRec) || ! is_numeric($ItemsCount))
                return;
            $condArray = array();
            $mysql = pdodb::getInstance();
            $query = "select *,sadaf.g2j(StartTime) as ShStartDate, sadaf.g2j(EndTime) as ShEndDate from EventCalendar.events where title like ? ";
            if ($FromDate != "")
            {
             $query .= " and StartTime<=? ";
             array_push($condArray, $FromDate);
            }
            if ($ToDate != "")
            {
             $query .= " and EndTime>=?";
             array_push($condArray, $ToDate);
            }
            $query .= " limit ".$FromRec.",".$ItemsCount;
            $mysql->Prepare($query);
            
            
            $res = $mysql->ExecuteStatement($condArray);
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