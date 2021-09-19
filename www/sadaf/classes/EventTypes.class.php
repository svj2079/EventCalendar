<?
    class be_EventType
    {
        public $id;
        public $description;

        function LoadDataFromDatabase($RecID)
        {
            $query = "select * from EventCalendar.EventTypes  where  id=? ";
            $mysql = pdodb::getInstance();
            $mysql->Prepare ($query);
            $res = $mysql->ExecuteStatement (array ($RecID));
            if($rec=$res->fetch())
            {
                $this->id=$rec["id"];
                $this->description=$rec["description"];
            }
        }
    
    }

    class manage_EventTypes
    {
        static function Add($description)
        {
            $mysql = pdodb::getInstance();
            $query = "insert into EventCalendar.EventTypes (description) values (?)";
            $mysql->Prepare($query);
            $mysql->ExecuteStatement(array($description));
            return true;                
        }

        static function Update($id, $description)
        {
            $mysql = pdodb::getInstance();
            $query = "update EventCalendar.EventTypes set description=? where id=?";
            $mysql->Prepare($query);
            $mysql->ExecuteStatement(array($description, $id));
            return true;                

        }

        static function Remove($id)
        {
            $mysql = pdodb::getInstance();
            $query = "delete from EventCalendar.EventTypes where id=?";
            $mysql->Prepare($query);
            $mysql->ExecuteStatement(array($id));
            return true;                

        }

        static function GetList()
        {
            $mysql = pdodb::getInstance();
            $query = "select * from EventCalendar.EventTypes";
            $mysql->Prepare($query);
            $res = $mysql->ExecuteStatement(array());
            $k = 0;
            while($rec = $res->fetch())
            {
                $ret[$k] = new be_EventType();
                $ret[$k]->id=$rec["id"];
                $ret[$k]->description=$rec["description"];
                $k++;
    
            }
            return $ret;                

        }
    }