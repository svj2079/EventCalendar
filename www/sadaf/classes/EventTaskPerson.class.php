<?php

    class be_EventTaskPerson
    {
        public $id;
        public $EventTaskID;
        public $CreatorID;

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
                $this->CreatorID=$rec["CreatorID"];
            }
        }
    }

    class manage_EventTaskPerson
    {
        static function Add($EventTaskID, $CreatorID)
        {
            $mysql = pdodb::getInstance();
            $query = "insert into EventCalendar.EventTaskPerson (EventTaskID, CreatorID) values (?, ?)";
            $mysql->Prepare($query);
            $mysql->ExecuteStatement(array($description));
            return true;

        }

        static function Update($id, $EventTaskID, $CreatorID)
        {
            $mysql = pdodb::getInstance();
            $query = "update EventCalendar.EventTaskPerson set EventTaskID=?, CreatorID=? where id=?";
            $mysql->Prepare($query);
            $mysql->ExecuteStatement(array($EventTaskID,  $CreatorID, $id));
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

        static function GetList()
        {
            $mysql = pdodb::getInstance();
            $query = "select * from EventCalendar.EventTaskPerson";
            $mysql->Prepare($query);
            $res = $mysql->ExecuteStatement(array());
            $k = 0;
            while($rec = $res->fetch())
            {
                $ret[$k] = new be_EventType();
                $ret[$k]->id=$rec["id"];
                $ret[$k]->EventTaskID=$rec["EventTaskID"];
                $ret[$k]->CreatorID=$rec["CreatorID"];
                $k++;
    
            }
            return $ret;   

        }
    }


?>