<div class="pagination">
    <?php
        $range = 1; // Радиус вокруг текущей страницы
        $dots_added = false;

        for ($i = 1; $i <= $total_pages; $i++) {
            if (
                $i == 1 || // первая
                $i == $total_pages || // последняя
                abs($i - $list) <= $range // рядом с текущей
            ) {
                // Активная страница
                if ($i == $list) {
                    echo "<span class='page current'>{$i}</span>";
                } else {
                    echo "<a href='/blog-kit/main/{$item}/{$i}' class='page'>{$i}</a>";
                }
                $dots_added = false;
            } elseif (!$dots_added) {
                echo "<span class='dots'>..</span>";
                $dots_added = true;
            }
        }
    ?>
</div>