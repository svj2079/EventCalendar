project: EventCalendar
URL: http://localhost/EventCalendar/www/sadaf/login.php

system: C:\wamp64\bin\mariadb\mariadb10.4.10\bin>mysqldump -uroot -p eventcalendar > c:\wamp64\www\EventCalendar\EventCalendar_database.sql
laptop: D:\wampserver\www\EventCalendar\www\shares;D:\wampserver\www\EventCalendar\www\adodb;D:\wampserver\www\EventCalendar\vendor

page: NewEvent.php -> سطح اهمیت رویداد -> <td nowrap>
                    <input class="form-control sadaf-m-input" type="number" name="level" id="level" maxlength="45" value="<? echo $level ?>">
                    </td>