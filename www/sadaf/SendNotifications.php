<?php

    include "header.inc.php";


        function GetList()
        {
            $mysql = pdodb::getInstance();
            $query = "select persons.PersonID, persons.mobile_phone, EventTasks.NotifyByEmail, EventTasks.NotifyBySms, EventTasks.NotifyByTask, events.title, events.StartTime from EventCalendar.events 
            join EventCalendar.EventTasks on (events.id = EventTasks.EventID) 
            join EventCalendar.EventTaskPerson on (EventTasks.id = EventTaskPerson.EventTaskID) 
            join hrmstotal.persons using (personID) 
            where StartTime between now()";
            $mysql->Prepare($query);
            $res = $mysql->ExecuteStatement(array());
            return $res;                
        }

        if ($res != null)
        for($i=0; $i<count($res); $i++)
        {
            echo "<table>";
            echo "<tr>";
            echo "<td>";
            echo $res[$i]->PersonID;
            echo "</td>";
            echo "<td>";
            echo $res[$i]->mobile_phone;
            echo "</td>";
            echo "<td>";
            echo $res[$i]->NotifyByEmail;
            echo "</td>";
            echo "<td>";
            echo $res[$i]->NotifyBySms;
            echo "</td>";
            echo "<td>";
            echo $res[$i]->NotifyByTask;
            echo "</td>";
            echo "<td>";
            echo $res[$i]->title;
            echo "</td>";
            echo "<td>";
            echo $res[$i]->StartTime;
            echo "</td>";
            echo "</tr>";
            echo "</table>";
        }

?>
