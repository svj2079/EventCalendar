<?php

    class be_EventAccess
    {
        public $id;
        public $PersonID;
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
                $this->PersonID=$rec["PersonID"];
                $this->AccessType=$rec["AccessType"];
                $this->EventID=$rec["EventID"];
            }
        }

    }


    class manage_EventAccess
    {
        static function Add($PersonID, $AccessType, $EventID)
        {
            $mysql = pdodb::getInstance();
            $query = "insert into EventCalendar.EventAccess (PersonID, AccessType, EventID) values (?, ?, ?)";
            $mysql->Prepare($query);
            $mysql->ExecuteStatement(array($PersonID, $AccessType, $EventID));
            return true;

        }

        static function Update($id, $PersonID, $AccessType, $EventID)
        {
            $mysql = pdodb::getInstance();
            $query = "update EventCalendar.EventAccess set PersonID=?, AccessType=?, EventID=? where id=?";
            $mysql->Prepare($query);
            $mysql->ExecuteStatement(array($PersonID, $AccessType, $EventID, $id));
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


        static function GetPersons($PersonName)
        {
            $mysql = pdodb::getInstance();
            $query = "select * from hrmstotal.persons join hrmstotal.staff on(
                persons.PersonID = staff.PersonID and persons.person_type = staff.person_type)
                where concat(pfname,'',plname) like ?";
            $mysql->Prepare($query);
            $res = $mysql->ExecuteStatement(array("%".$PersonName."%"));
            $ret="";
            while($rec = $res->fetch())
            {
                $ret.="<option value='".$rec["PersonID"]."'>".$rec["pfname"]." ".$rec["plname"]."</option>";
            }
            return $ret;

        } 


        static function CheckUserAccessToThisEvent ($EventID, $PersonID)
        {
            $mysql = pdodb::getInstance();
            $query = "select * from EventAccess where PersonID=? and EvetnID=?";
            $mysql->Prepare($query);
            $res = $mysql->ExecuteStatement(array($PersonID,$EventID));
            if ($rec = $res->fetch())
                return $AccessType;
            else
            {
                $query = "select events.CreatorID from events where id=?";
                $mysql->Prepare($query);
                $res = $mysql->ExecuteStatement(array($EventID));
                if ($rec = $res->fetch())
                    if($rec["CreatorID"]==$PersonID)
                        return "WRITE";
           }
           return "NONE";
        }


        static function GetList($EventID)
        {
            $mysql = pdodb::getInstance();
            $query = "select id, EventAccess.PersonID, AccessType, EventID, concat(pfname,' ', plname) as FullName from EventCalendar.EventAccess 
            join hrmstotal.persons on (EventAccess.PersonID=persons.PersonID) 
            join hrmstotal.staff on (persons.PersonID = staff.PersonID and persons.person_type = staff.person_type)
                            where EventAccess.EventID =?";
            $mysql->Prepare($query);
            $res = $mysql->ExecuteStatement(array($EventID));
            $k = 0;
            while($rec = $res->fetch())
            {
                $ret[$k] = new be_EventAccess();
                $ret[$k]->id=$rec["id"];
                $ret[$k]->PersonID=$rec["PersonID"];
                $ret[$k]->AccessType=$rec["AccessType"];
                $ret[$k]->EventID=$ret["EventID"];
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