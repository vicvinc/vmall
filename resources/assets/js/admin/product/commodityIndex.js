$(function () {
    var _token = $('input[name="_token"]').val();
    $('.cate-item').on('click', function(event) {
        event.stopPropagation();
        var target = event.target;
        var cateUid = $(target).attr('data-cate');
        $.get('/admin/product/cate/' + cateUid, function(resp) {
            $('#goods-list').html(resp)
        });
    });
});
