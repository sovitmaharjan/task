<script>
    var validationErrors = @json($errors->getMessages());
    $.each(validationErrors, function(i, e) {
        $(`#${i}`).css({
            "border": "1px solid #f1416c"
        });
        $(`
            <div class="text-danger">
                ${e[0]}
            </div>
        `).insertAfter($(`#${i}`));
    })
</script>
