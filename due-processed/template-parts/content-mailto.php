<script>
    function dpMailTo() {
        <?php /* $args should have `left_side` and `right_side` keys */ ?>
        const parts = <?php echo json_encode($args); ?>;
        const subject = encodeURIComponent(parts.subject || 'DueProcessed.com contact');
        <?php /* to use, page must have a `#mailToLink` element */ ?>
        const link = document.getElementById('mailToLink');
        const href = link.getAttribute('href');
        const address = parts.left_side.join('') + '@' + parts.right_side.join('');
        const settings = '?subject=' + subject;
        link.setAttribute('target', '_blank');
        link.setAttribute('href', 'mailto:' + address + settings);
    }
</script>