<?php

    class be_Event
    {
        public $id;
        public $ShStartDate;
        public $StartDate;
        public $StartHour;
        public $StartMinute;
        public $ShEndDate;
        public $EndDate;
        public $EndHour;
        public $EndMinute;
        public $description;
        public $level;
        public $CreatorID;
        public $EventTypeID;
        public $title;

        function LoadDataFromDatabase($RecID)
        {
            $query = "select *, g2j(StartTime) as ShStartDate, 
            g2j(EndTime) as ShEndDate, 
            substr(StartTime, 12, 2) as StartHour,
            substr(StartTime, 15, 2) as StartMinute,
            substr(EndTime, 12, 2) as EndHour,
            substr(EndTime, 15, 2) as EndMinute from EventCalendar.events  where  id=? ";
            $mysql = pdodb::getInstance();
            $mysql->Prepare ($query);
            $res = $mysql->ExecuteStatement (array ($RecID));
            if($rec=$res->fetch())
            {
                $this->id=$rec["id"];
                $this->ShStartDate=$rec["ShStartDate"];
                $this->StartDate=$rec["StartDate"];
                $this->StartHour=$rec["StartHour"];
                $this->StartMinute=$rec["StartMinute"];
                $this->ShEndDate=$rec["ShEndDate"];
                $this->EndDate=$rec["EndDate"];
                $this->EndHour=$rec["EndHour"];
                $this->EndMinute=$rec["EndMinute"];
                $this->description=$rec["description"];
                $this->level=$rec["level"];
                $this->CreatorID=$rec["CreatorID"];
                $this->EventTypeID=$rec["EventTypeID"];
                $this->title=$rec["title"];
            }
        }
    }

    class manage_Event
    {
        static function Add($StartTime,$EndTime,$description,$level,$CreatorID,$EventTypeID,$title)
        {
            $mysql = pdodb::getInstance();
            $query = "insert into EventCalendar.events (StartTime,EndTime,description,level,CreatorID,EventTypeID,title) values (?,?,?,?,?,?,?)";
            $mysql->Prepare($query);
            $mysql->ExecuteStatement(array($StartTime,$EndTime,$description,$level,$CreatorID,$EventTypeID,$title));
            return true;
        }

        static function Update($id,$StartTime,$EndTime,$description,$level,$CreatorID,$EventTypeID,$title)
        {
            $mysql = pdodb::getInstance();
            $query = "update EventCalendar.events set StartTime=?, EndTime=?, description=?, level=?, CreatorID=?, EventTypeID=?, title=? where id=?";
            $mysql->Prepare($query);
            $mysql->ExecuteStatement(array($StartTime,$EndTime,$description,$level,$CreatorID,$EventTypeID, $title, $id));
            return true;
        }

        static function Remove($id)
        {
            $mysql = pdodb::getInstance();
            $query = "delete from EventCalendar.events where id=?";
            $mysql->Prepare($query);
            $mysql->ExecuteStatement(array($id));
            return true;
        }

        static function GetList()
        {
            
            $mysql = pdodb::getInstance();
            $query = "select *,sadaf.g2j(StartTime) as ShStartDate, sadaf.g2j(EndTime) as ShEndDate from EventCalendar.events";
            $mysql->Prepare($query);
            $res = $mysql->ExecuteStatement(array());
            $k = 0;
            while($rec = $res->fetch())
            {
                $ret[$k] = new be_Event();
                $ret[$k]->id=$rec["id"];
                $ret[$k]->ShStartDate=$rec["ShStartDate"];
                $ret[$k]->StartDate=$rec["StartDate"];
                $ret[$k]->StartHour=$rec["StartHour"];
                $ret[$k]->StartMinute=$rec["StartMinute"];
                $ret[$k]->ShEndDate=$rec["ShEndDate"];
                $ret[$k]->EndDate=$rec["EndDate"];
                $ret[$k]->EndHour=$rec["EndHour"];
                $ret[$k]->EndMinute=$rec["EndMinute"];
                $ret[$k]->description=$rec["description"];
                $ret[$k]->level=$rec["level"];
                $ret[$k]->CreatorID=$rec["CreatorID"];
                $ret[$k]->EventTypeID=$rec["EventTypeID"];
                $ret[$k]->title=$rec["title"];
                
                $k++;
    
            }
            return $ret;                
        }
    }

?>