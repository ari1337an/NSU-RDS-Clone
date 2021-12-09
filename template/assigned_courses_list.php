<div class="courses-list">

    <?php
    if (USERS::isLoggedFaculty()) {
        $current = USERS::getUserName();
        $result = $APP_DB->query("SELECT * FROM teaches WHERE who_is_teaching= '$current'");

        while ($row = $result->fetch_assoc()) {
            $course_name = $row['course_id'];
            echo "<li><a href=\"faculty_give_attendance.php\">$course_name</a></li>";
        }
    }
    ?>
</div>