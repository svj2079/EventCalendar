<?php

class be_EventUnit
{
    public $id;
    public $EventID;
    public $UnitID;
    public $SubUnitID;

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
            $this->UnitID=$rec["UnitID"];
            $this->SubUnitID=$rec["SubUnitID"];
        }
    }

}

class manage_EventUnits
{
    static function Add($EventID, $UnitID, $SubUnitID)
    {
        $mysql = pdodb::getInstance();
        $query = "insert into EventCalendar.EventUnits (EventID, UnitID, SubUnitID) values (?, ?, ?)";
        $mysql->Prepare($query);
        $mysql->ExecuteStatement(array($EventID, $UnitID, $SubUnitID));
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
        $query = "select * from EventCalendar.EventUnits ";
        $mysql->Prepare($query);
        $res = $mysql->ExecuteStatement(array());
        $k = 0;
        while($rec = $res->fetch())
        {
            $ret[$k] = new be_EventUnit();
            $ret[$k]->id=$rec["id"];
            $ret[$k]->EventID=$rec["EventID"];
            $ret[$k]->UnitID=$rec["UnitID"];
            $ret[$k]->SubUnitID=$rec["SubUnitID"];
            $k++;

        }
        return $ret;

    }

    static function CreateUnitSelectOptions($SelectBoxName, $UnitID)
    {
        $ret="<select id='".$SelectBoxName."' name='".$SelectBoxName."' onchange= 'SetUnit()'>";
        $mysql = pdodb::getInstance();
        $query = "select * from baseinfo.UmStructure where StructParentID = 1";
        $mysql->Prepare($query);
        $res = $mysql->ExecuteStatement(array());
        $k = 0;
        while($rec = $res->fetch())
        {
            if($rec["StructID"]==$UnitID)
                $ret.="<option value='".$rec["StructID"]."' selected>".$rec["StructTitle"]."</option>";
            else
                $ret.="<option value='".$rec["StructID"]."'>".$rec["StructTitle"]."</option>";
        }
        $ret .= "</select>";
        return $ret;                

    }

    static function CreateSubUnitSelectOptions($SelectBoxName, $UnitID , $SubUnitID)
    {
        $ret="<select id='".$SelectBoxName."' name='".$SelectBoxName."'>";
        $mysql = pdodb::getInstance();
        $query = "select * from baseinfo.UmStructure where StructParentID = ?";
        $mysql->Prepare($query);
        $res = $mysql->ExecuteStatement(array($UnitID));
        $k = 0;
        while($rec = $res->fetch())
        {
            if($rec["StructID"]==$SubUnitID)
                $ret.="<option value='".$rec["StructID"]."' selected>".$rec["StructTitle"]."</option>";
            else
                $ret.="<option value='".$rec["StructID"]."'>".$rec["StructTitle"]."</option>";
        }
        $ret .= "</select>";
        return $ret;                

    }
}