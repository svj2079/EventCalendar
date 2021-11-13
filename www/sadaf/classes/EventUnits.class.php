<?php

    class be_EventUnit
    {
        public $id;
        public $EventID;
        public $FacCode;

        function LoadDataFromDatabase($RecID)
        {
            $query = "select * from EventCalendar.EventUnits  where  id=? ";
            $mysql = pdodb::getInstance();
            $mysql->Prepare ($query);
            $res = $mysql->ExecuteStatement (array ($RecID));
            if($rec=$res->fetch())
            {
                $this->id=$rec["id"];
                $this->EventID=$rec["EventID"];
                $this->FacCode=$rec["FacCode"];
            }
        }

    }

    class manage_EventUnits
    {
        static function Add($EventID, $FacCode)
        {
            $mysql = pdodb::getInstance();
            $query = "insert into EventCalendar.EventUnits (EventID, FacCode) values (?, ?)";
            $mysql->Prepare($query);
            $mysql->ExecuteStatement(array($EventID, $FacCode));
            return true;

        }

        static function Remove($id)
        {
            $mysql = pdodb::getInstance();
            $query = "delete from EventCalendar.EventUnits where id=?";
            $mysql->Prepare($query);
            $mysql->ExecuteStatement(array($id));
            return true;

        }

        static function GetList()
        {
            $mysql = pdodb::getInstance();
            $query = "select * from EventCalendar.EventUnits";
            $mysql->Prepare($query);
            $res = $mysql->ExecuteStatement(array());
            $k = 0;
            while($rec = $res->fetch())
            {
                $ret[$k] = new be_EventUnit();
                $ret[$k]->id=$rec["id"];
                $ret[$k]->EventID=$rec["EventID"];
                $ret[$k]->FacCode=$rec["FacCode"];
                $k++;
    
            }
            return $ret;

        }
    }