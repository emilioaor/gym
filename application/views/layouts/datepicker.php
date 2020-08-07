<?php $value = isset($attr['value']) ? \DateTime::createFromFormat('Y-m-d', $attr['value'])->format('d-m-Y') : date('d-m-Y') ?>
<?php $id = isset($attr['id']) ? $attr['id'] : $attr['name'] ?>
<div
    class="bfh-datepicker"
    data-format="d-m-y"
    data-name="_<?php echo $attr['name'] ?>"
    data-placeholder="<?php echo $attr['placeholder'] ?? '' ?>"
    data-date="<?php echo $value ?>"
    id="_<?php echo $id ?>"
>
</div>
<input
        type="hidden"
        name="<?php echo $attr['name'] ?>"
>
<script>
    function update_date_name_<?php echo $attr['name'] ?>()
    {
        const date = document.querySelector('input[name="_<?php echo $attr['name'] ?>"]').value.split('-').reverse().join('-')

        document.querySelector('input[name="<?php echo $attr['name'] ?>"]').value = date;
    }

    function init_<?php echo $attr['name'] ?>() {
        window.setTimeout(function () {
            if (typeof $ !== 'undefined') {
                update_date_name_<?php echo $attr['name'] ?>();

                $('#_<?php echo $id ?> .glyphicon.glyphicon-chevron-left').addClass('fa fa-arrow-left');
                $('#_<?php echo $id ?> .glyphicon.glyphicon-chevron-right').addClass('fa fa-arrow-right');

                $('#_<?php echo $id ?>').on('change.bfhdatepicker', function (e) {
                    update_date_name_<?php echo $attr['name'] ?>();
                })
            } else {
                init_<?php echo $attr['name'] ?>();
            }
        }, 100)
    }

    init_<?php echo $attr['name'] ?>();
</script>