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
        public $ForProf;
        public $ForStudent;
        public $ForStaff;
        public $UnitID;
        public $SubUnitID;

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
                $this->StartTime=$rec["StartTime"];
                $this->StartHour=$rec["StartHour"];
                $this->StartMinute=$rec["StartMinute"];
                $this->ShEndDate=$rec["ShEndDate"];
                $this->EndTime=$rec["EndTime"];
                $this->EndHour=$rec["EndHour"];
                $this->EndMinute=$rec["EndMinute"];
                $this->description=$rec["description"];
                $this->level=$rec["level"];
                $this->CreatorID=$rec["CreatorID"];
                $this->EventTypeID=$rec["EventTypeID"];
                $this->title=$rec["title"];
                $this->ForProf=$rec["ForProf"];
                $this->ForStudent=$rec["ForStudent"];
                $this->ForStaff=$rec["ForStaff"];
                $this->UnitID=$rec["UnitID"];
                $this->SubUnitID=$rec["SubUnitID"];
            }
        }
    }

    class manage_Event
    {
        static function Add($StartTime,$EndTime,$description,$level,$CreatorID,$EventTypeID,$title,$ForProf,$ForStudent,$ForStaff,$UnitID,$SubUnitID)
        {
            $mysql = pdodb::getInstance();
            $query = "insert into EventCalendar.events (StartTime,EndTime,description,level,CreatorID,EventTypeID,title,ForProf,ForStudent,ForStaff,UnitID,SubUnitID) values (?,?,?,?,?,?,?,?,?,?,?,?)";
            $mysql->Prepare($query);
            $mysql->ExecuteStatement(array($StartTime,$EndTime,$description,$level,$CreatorID,$EventTypeID,$title,$ForProf,$ForStudent,$ForStaff,$UnitID,$SubUnitID));
            return true;

        }

        static function Update($id,$StartTime,$EndTime,$description,$level,$EventTypeID,$title,$ForProf,$ForStudent,$ForStaff,$UnitID,$SubUnitID)
        {
            $mysql = pdodb::getInstance();
            $query = "update EventCalendar.events set StartTime=?, EndTime=?, description=?, level=?, EventTypeID=?, title=?, ForProf=?, ForStudent=?, ForStaff=?, UnitID=?, SubUnitID=? where id=?";
            $mysql->Prepare($query);
            $mysql->ExecuteStatement(array($StartTime,$EndTime,$description,$level,$EventTypeID, $title,$ForProf,$ForStudent,$ForStaff,$UnitID,$SubUnitID, $id));
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
            $ItemsCount = 10;
            $FromRec = 0;
                        
            $mysql = pdodb::getInstance();
            $query = "select *,sadaf.g2j(StartTime) as ShStartDate, sadaf.g2j(EndTime) as ShEndDate from EventCalendar.events limit $FromRec, $ItemsCount";
            $mysql->Prepare($query);
            $res = $mysql->ExecuteStatement(array());
            $k = 0;
            while($rec = $res->fetch())
            {
                $ret[$k] = new be_Event();
                $ret[$k]->id=$rec["id"];
                $ret[$k]->ShStartDate=$rec["ShStartDate"];
                //$ret[$k]->StartDate=$rec["StartDate"];
                //$ret[$k]->StartHour=$rec["StartHour"];
                //$ret[$k]->StartMinute=$rec["StartMinute"];
                $ret[$k]->ShEndDate=$rec["ShEndDate"];
                //$ret[$k]->EndDate=$rec["EndDate"];
                //$ret[$k]->EndHour=$rec["EndHour"];
                //$ret[$k]->EndMinute=$rec["EndMinute"];
                $ret[$k]->description=$rec["description"];
                $ret[$k]->level=$rec["level"];
                $ret[$k]->CreatorID=$rec["CreatorID"];
                $ret[$k]->EventTypeID=$rec["EventTypeID"];
                $ret[$k]->title=$rec["title"]; 
                $ret[$k]->ForProf=$rec["ForProf"];
                $ret[$k]->ForStudent=$rec["ForStudent"];
                $ret[$k]->ForStaff=$rec["ForStaff"];
                $ret[$k]->UnitID=$rec["UnitID"];
                $ret[$k]->SubUnitID=$rec["SubUnitID"];
                $k++;
    
            }
            return $ret;                
        }
    }

?>