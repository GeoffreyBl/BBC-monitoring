<a href="./serveurs.php" class="navButton flex-column">
    <p>Serveurs</p>
    <?php
    if (check_servers($db)) {
        echo "<div><i class='fas text-danger fa-exclamation-triangle'></i></div></a></div>";
    }
    ?>
</a>