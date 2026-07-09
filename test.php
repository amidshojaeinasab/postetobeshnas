<div class="timeline-list">
    <?php foreach ($medicine['morning'] as $item) { ?>
        <div class="timeline-item">
            <span class="timeline-dot dot-active-primary"></span>
            <div class="timeline-label label-solid-primary">
                <?= htmlspecialchars($item['product']) ?>
            </div>
        </div>
    <?php } ?>
</div>
