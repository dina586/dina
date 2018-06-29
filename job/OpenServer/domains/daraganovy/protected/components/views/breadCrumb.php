
<ul class="b-bread-crub">
    <li><a href="/">Главная</a></li>
    <?php echo $this->delimiter;
    foreach($this->crumbs as $crumb) {
        if(isset($crumb['url'])) {
            echo "<li>".CHtml::link($crumb['name'], $crumb['url'])."</li>";
        } else {
            echo "<li>".$crumb['name']."</li>";
        }
        if(next($this->crumbs)) {
            echo $this->delimiter;
        }
    }
    ?>
</ul>
