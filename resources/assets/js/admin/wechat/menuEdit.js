$(function () {
    var type = $('#menu-type-select').val();
    init(type);
    function init(type) {
        switch (type) {
            case 'view':
                $('#menu-key').hide();
                $('#menu-url').show();
                break;
            case 'click':
                $('#menu-key').show();
                $('#menu-url').hide();
                break;
            case 'none':
                $('#menu-key,#menu-url').hide();
                break;
            default:
                $('#menu-key,#menu-url').hide();
                break;
        }
    }

    $('#menu-type-select').on('change', function () {
        var type = $(this).val();
        init(type);
    });
});
