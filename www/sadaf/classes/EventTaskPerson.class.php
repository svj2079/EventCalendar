<?php

    class be_EventTaskPerson
    {
        public $id;
        public $EventTaskID;
        public $PersonID;

        function LoadDataFromDatabase($RecID)
        {
            $query = "select * from EventCalendar.EventTaskPerson  where  id=? ";
            $mysql = pdodb::getInstance();
            $mysql->Prepare ($query);
            $res = $mysql->ExecuteStatement (array ($RecID));
            if($rec=$res->fetch())
            {
                $this->id=$rec["id"];
                $this->EventTaskID=$rec["EventTaskID"];
                $this->PersonID=$rec["PersonID"];
            }
        }
    }

    class manage_EventTaskPerson
    {
        static function Add($EventTaskID, $PersonID)
        {
            $mysql = pdodb::getInstance();
            $query = "insert into EventCalendar.EventTaskPerson (EventTaskID, PersonID) values (?, ?)";
            $mysql->Prepare($query);
            $mysql->ExecuteStatement(array($EventTaskID, $PersonID));
            return true;

        }

        static function Remove($id)
        {
            $mysql = pdodb::getInstance();
            $query = "delete from EventCalendar.EventTaskPerson where id=?";
            $mysql->Prepare($query);
            $mysql->ExecuteStatement(array($id));
            return true; 

        }

        static function GetList($EventTaskID)
        {
            $mysql = pdodb::getInstance();
            $query = "select id,EventTaskID, PersonID, concat(pfname,' ', plname) as FullName from EventCalendar.EventTaskPerson 
            LEFT JOIN hrmstotal.persons using (PersonID) where EventTaskID=?";
            $mysql->Prepare($query);
            $res = $mysql->ExecuteStatement(array($EventTaskID));
            $k = 0;
            while($rec = $res->fetch())
            {
                $ret[$k] = new be_EventTaskPerson();
                $ret[$k]->id=$rec["id"];
                $ret[$k]->EventTaskID=$rec["EventTaskID"];
                $ret[$k]->PersonID=$rec["PersonID"];
                $ret[$k]->FullName=$rec["FullName"];
                $k++;
    
            }
            if (isset($ret))
                return $ret;   
            else
                return null;
        }
    }


?>