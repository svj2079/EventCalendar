<?php

    class be_EventSubUnit
    {
        public $id;
        public $EventID;
        public $EduGroupCode;

        function LoadDataFromDatabase($RecID)
        {
            $query = "select * from EventCalendar.EventSubUnits  where  id=? ";
            $mysql = pdodb::getInstance();
            $mysql->Prepare ($query);
            $res = $mysql->ExecuteStatement (array ($RecID));
            if($rec=$res->fetch())
            {
                $this->id=$rec["id"];
                $this->EventID=$rec["EventID"];
                $this->EduGroupCode=$rec["EduGroupCode"];
            }
        }

    }

    class manage_EventSubUnits
    {
        static function Add($EventID, $EduGroupCode)
        {
            $mysql = pdodb::getInstance();
            $query = "insert into EventCalendar.EventSubUnits (EventID, EduGroupCode) values (?, ?)";
            $mysql->Prepare($query);
            $mysql->ExecuteStatement(array($EventID, $EduGroupCode));
            return true;

        }

        static function Remove($id)
        {
            $mysql = pdodb::getInstance();
            $query = "delete from EventCalendar.EventSubUnits where id=?";
            $mysql->Prepare($query);
            $mysql->ExecuteStatement(array($id));
            return true;

        }

        static function GetList()
        {
            $mysql = pdodb::getInstance();
            $query = "select * from EventCalendar.EventSubUnits";
            $mysql->Prepare($query);
            $res = $mysql->ExecuteStatement(array());
            $k = 0;
            while($rec = $res->fetch())
            {
                $ret[$k] = new be_EventUnit();
                $ret[$k]->id=$rec["id"];
                $ret[$k]->EventID=$rec["EventID"];
                $ret[$k]->EduGroupCode=$rec["EduGroupCode"];
                $k++;
    
            }
            return $ret;

        }
    }