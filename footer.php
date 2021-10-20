<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
        <?php
        if (isset($_SESSION['full_name'])) {
            echo $_SESSION['full_name'];
        } else {
            echo '';
        }
        ?>
    </div>
    <!-- Default to the left -->
    <strong>LOGISTIC TEAMS</strong> (Always do better then yesterday).
</footer>