<?php

    class be_EventAccess
    {
        public $id;
        public $CreatorID;
        public $AccessType;
        public $EventID;

        function LoadDataFromDatabase($RecID)
        {
            $query = "select * from EventCalendar.EventAccess  where  id=? ";
            $mysql = pdodb::getInstance();
            $mysql->Prepare ($query);
            $res = $mysql->ExecuteStatement (array ($RecID));
            if($rec=$res->fetch())
            {
                $this->id=$rec["id"];
                $this->CreatorID=$rec["CreatorID"];
                $this->AccessType=$rec["AccessType"];
                $this->EventID=$rec["EventID"];
            }
        }

    }


    class manage_EventAccess
    {
        static function Add($CreatorID, $AccessType, $EventID)
        {
            $mysql = pdodb::getInstance();
            $query = "insert into EventCalendar.EventAccess (CreatorID, AccessType, EventID) values (?, ?, ?)";
            $mysql->Prepare($query);
            $mysql->ExecuteStatement(array($CreatorID, $AccessType, $EventID));
            return true;

        }

        static function Update($id, $CreatorID, $AccessType, $EventID)
        {
            $mysql = pdodb::getInstance();
            $query = "update EventCalendar.EventAccess set CreatorID=?, AccessType=?, EventID=? where id=?";
            $mysql->Prepare($query);
            $mysql->ExecuteStatement(array($CreatorID, $AccessType, $EventID, $id));
            return true; 

        }

        static function Remove($id)
        {
            $mysql = pdodb::getInstance();
            $query = "delete from EventCalendar.EventAccess where id=?";
            $mysql->Prepare($query);
            $mysql->ExecuteStatement(array($id));
            return true;

        }

        static function GetList()
        {
            $mysql = pdodb::getInstance();
            $query = "select * from EventCalendar.EventAccess";
            $mysql->Prepare($query);
            $res = $mysql->ExecuteStatement(array());
            $k = 0;
            while($rec = $res->fetch())
            {
                $ret[$k] = new be_EventAccess();
                $ret[$k]->id=$rec["id"];
                $ret[$k]->CreatorID=$rec["CreatorID"];
                $ret[$k]->AccessType=$rec["AccessType"];
                $ret[$k]->EventID=$ret["EventID"];
                $k++;
    
            }
            return $ret;

        }
    }

?>