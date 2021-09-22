
INSERT INTO sadaf.SystemFacilities VALUES (8, 'رویداد', 2, 1, 'Event.php');
INSERT INTO sadaf.SystemFacilities VALUES (10, 'مدیریت رویداد', 2, 1, 'ManageEvent.php');
INSERT INTO sadaf.SystemFacilities VALUES (11, 'انواع رویداد', 2, 1, 'ManageEventTypes.php');
INSERT INTO sadaf.SystemFacilities VALUES (12, 'فعالیت های رویداد', 2, 1, 'ManageEventTasks.php');
INSERT INTO sadaf.SystemFacilities VALUES (13, 'فعالیت های رویداد', 2, 1, 'ManageEventTasks.php');



INSERT INTO sadaf.UserFacilities (UserID, FacilityID) VALUES ('omid',8);
INSERT INTO sadaf.UserFacilities (UserID, FacilityID) VALUES ('omid',10);
INSERT INTO sadaf.UserFacilities (UserID, FacilityID) VALUES ('omid',11);
INSERT INTO sadaf.UserFacilities (UserID, FacilityID) VALUES ('omid',12);


INSERT INTO sadaf.FacilityPages (FacilityID, PageName) VALUES (8,'/Event.php');
INSERT INTO sadaf.FacilityPages (FacilityID, PageName) VALUES (10,'/ManageEvent.php');
INSERT INTO sadaf.FacilityPages (FacilityID, PageName) VALUES (11,'/ManageEventTypes.php');
INSERT INTO sadaf.FacilityPages (FacilityID, PageName) VALUES (12,'/ManageEventTasks.php');


