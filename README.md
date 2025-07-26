1-Database Setup
Create a MySQL database called robot_actions using xampp with these two tables:

Table: pose
Table: run


2-Control Panel (index.php)
Drag sliders to set servo angles.

Click Save Pose to store it in the pose table.

Click Run to send values to the run table (status = 1).

Table below shows saved poses. You can Load or Remove them.


3-Run Command Fetch (get_run_pose.php)
Use this to get the latest pose to run.

Returns servo1–servo6 as JSON only if status = 1.

After fetching, it automatically sets status = 0.


4-Reset Status Manually (update_status.php).

Sets status = 0 in the run table.

Use only if you want to reset run state without reading it.


Flow:
Open index.php in browser.

Adjust sliders → Click Run.

requests get_run_pose.php.

status auto resets to 0.
