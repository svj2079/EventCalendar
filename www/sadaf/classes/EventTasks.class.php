<?php

    class be_EventTask
    {
        public $id;
        public $description;
        public $level;
        public $NotificationType;

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
                $this->NotificationType=$rec["NotificationType"];
                $this->EventID=$rec["EventID"];
            }
        }
    }


    class manage_EventTasks
    {
        static function Add($description, $level, $NotificationType , $EventID)
        {
            $mysql = pdodb::getInstance();
            $query = "insert into EventCalendar.EventTasks (description, level, NotificationType, EventID) values (?, ?, ?, ?)";
            $mysql->Prepare($query);
            $mysql->ExecuteStatement(array($description, $level, $NotificationType, $EventID));
            return true;

        }

        static function Update($id, $description, $level, $NotificationType)
        {
            $mysql = pdodb::getInstance();
            $query = "update EventCalendar.EventTasks set description=?, level=?, NotificationType=? where id=?";
            $mysql->Prepare($query);
            $mysql->ExecuteStatement(array($description, $level, $NotificationType, $id));
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

        static function GetList($EventID)
        {
            $mysql = pdodb::getInstance();
            $query = "select * from EventCalendar.EventTasks where EventID=?";
            $mysql->Prepare($query);
            $res = $mysql->ExecuteStatement(array($EventID));
            $k = 0;
            while($rec = $res->fetch())
            {
                $ret[$k] = new be_EventType();
                $ret[$k]->id=$rec["id"];
                $ret[$k]->description=$rec["description"];
                $ret[$k]->level=$rec["level"];
                $ret[$k]->NotificationType=$rec["NotificationType"];
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