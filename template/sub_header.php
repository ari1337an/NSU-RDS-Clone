<?php
function isActiveAdminHeader($id)
{
    global $template_vars;
    if ($id == $template_vars["active_id_sub_header"]) echo "class=\"active\"";
}
function isActiveStudentHeader($id)
{
    global $template_vars;
    if ($id == $template_vars["active_id_sub_header"]) echo "class=\"active\"";
}

function isActiveFacultyHeader($id)
{
    global $template_vars;
    if ($id == $template_vars["active_id_sub_header"]) echo "class=\"active\"";
}
?>

<nav>
    <div class="primary-sub-header">
        <?php if (USERS::isLoggedAdmin()) { // the admin panel sub-header 
        ?>
            <ul id="sub-header-list">
                <li <?php isActiveAdminHeader(0); ?>><a href="<?php echo $template_vars["get_hierarchy"]; ?>admin/index.php">Home</a></li>
                <li <?php isActiveAdminHeader(1); ?>><a href="<?php echo $template_vars["get_hierarchy"]; ?>admin/course_list.php">Course List</a></li>
                <li <?php isActiveAdminHeader(2); ?>><a href="<?php echo $template_vars["get_hierarchy"]; ?>admin/create_student.php">Create Student</a></li>
                <li <?php isActiveAdminHeader(3); ?>><a href="<?php echo $template_vars["get_hierarchy"]; ?>admin/create_faculty.php">Create Faculty</a></li>
                <li <?php isActiveAdminHeader(4); ?>><a href="<?php echo $template_vars["get_hierarchy"]; ?>admin/student_list.php">Student List</a></li>
                <li <?php isActiveAdminHeader(5); ?>><a href="<?php echo $template_vars["get_hierarchy"]; ?>admin/faculty_list.php">Faculty List</a></li>
                <li <?php isActiveAdminHeader(6); ?>><a href="<?php echo $template_vars["get_hierarchy"]; ?>logout.php">Logout</a></li>
            </ul>
        <?php } else if (USERS::isLoggedFaculty()) { ?>
            <ul id="sub-header-list">
                <li <?php isActiveFacultyHeader(0); ?>><a href="<?php echo $template_vars["get_hierarchy"]; ?>faculty/index.php">Home</a></li>
                <li <?php isActiveFacultyHeader(1); ?>><a href="<?php echo $template_vars["get_hierarchy"]; ?>faculty/faculty_profile.php">Profile</a></li>
                <li <?php isActiveFacultyHeader(2); ?>><a href="<?php echo $template_vars["get_hierarchy"]; ?>faculty/faculty_course_list.php">Course List</a></li>
                <li <?php isActiveFacultyHeader(3); ?>><a href="<?php echo $template_vars["get_hierarchy"]; ?>faculty/faculty_attendance.php">Attendance</a></li>
                <li <?php isActiveFacultyHeader(4); ?>><a href="<?php echo $template_vars["get_hierarchy"]; ?>faculty/faculty_grade.php">Grade</a></li>
                <li><a href="<?php echo $template_vars["get_hierarchy"]; ?>logout.php">Logout</a></li>
            </ul>
        <?php } else if (USERS::isLoggedStudent()) { ?>
            <ul id="sub-header-list">
                <li <?php isActiveStudentHeader(0); ?>><a href="<?php echo $template_vars["get_hierarchy"]; ?>student/index.php">Home</a></li>
                <li <?php isActiveStudentHeader(1); ?>><a href="<?php echo $template_vars["get_hierarchy"]; ?>student/student_profile.php">Profile</a></li>
                <li <?php isActiveStudentHeader(2); ?>><a href="<?php echo $template_vars["get_hierarchy"]; ?>student/student_advising.php">Advising</a></li>
                <li <?php isActiveStudentHeader(3); ?>><a href="<?php echo $template_vars["get_hierarchy"]; ?>student/student_attendance.php">Attendance</a></li>
                <li <?php isActiveStudentHeader(4); ?>><a href="<?php echo $template_vars["get_hierarchy"]; ?>student/student_grade.php">Grade</a></li>
                <li><a href="<?php echo $template_vars["get_hierarchy"]; ?>logout.php">Logout</a></li>
            </ul>
        <?php } ?>
    </div>
</nav>