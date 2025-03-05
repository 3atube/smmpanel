jQuery(document).ready(function ($) {
    $('#form-create').validate({
        rules: {
            'post_link': {
                required: true,
            },
            'fanpage_id': {
                required: true,
            },
            'type': {
                required: true,
            },
            'reaction': {
                required: true,
            },
            'reactions[]': {
                required: true,
            },
            'comments': {
                required: true,
                comments: true,
            },
            'reviews': {
                required: true,
                reviews: true,
            },
            'number_seeding': {
                required: true,
                min: 10,
                max: 100000
            },
            'time_to_live': {
                required: true
            },
            'time_view': {
                required: true
            },
            'price': {
                required: true,
                min: 50
            },
        },
        messages: {
            'post_link': {
                required: 'Vui lòng nhập trường này!',
            },
            'fanpage_id': {
                required: 'Vui lòng nhập trường này!',
            },
            'type': {
                required: 'Vui lòng chọn server!',
            },
            'reaction': {
                required: 'Vui lòng chọn cảm xúc!',
            },
            'reactions[]': {
                required: 'Vui lòng chọn cảm xúc!',
            },
            'comments': {
                required: 'Vui lòng nhập bình luận!'
            },
            'reviews': {
                required: 'Vui lòng nhập đánh giá!'
            },
            'number_seeding': {
                required: 'Vui lòng nhập số lượng cần tăng!',
                min: 'Vui lòng nhập số lượng lớn hơn hoặc bằng {0}.',
                max: 'Vui lòng nhập số lượng nhỏ hơn hoặc bằng {0}.',
            },
            'time_to_live': {
                required: 'Vui lòng chọn thời gian duy trì mắt!',
            },
            'time_view': {
                required: 'Vui lòng chọn thời gian xem!',
            },
            'price': {
                required: 'Vui lòng nhập giá tiền mỗi tương tác!',
                min: 'Vui lòng nhập số lượng lớn hơn hoặc bằng {0}.'
            },
        },
        submitHandler: function () {
            Swal.fire({
                title: 'Xác nhận',
                text: 'Bạn có chắc chắn muốn tạo đơn!',
                icon: 'question',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonText: 'Đồng ý',
                cancelButtonText: 'Không',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    var form = $('#form-create');
                    var formData = form.serialize();
                    var url = form.attr('action');
                    var method = form.attr('method');
                    return $.ajax({
                        type: method,
                        url: url,
                        data: formData,
                        dataType: 'json',
                        success: function (response) {
                            Swal.fire(
                                response.success ? 'Thành công' : 'Thất bại',
                                response.message,
                                response.success ? 'success' : 'error'
                            )
                        },
                        error: function (xhr, status, error) {
                            var response = JSON.parse(xhr.responseText);
                            Swal.fire(
                                'Có lỗi xảy ra',
                                response.message,
                                'error'
                            )
                        }
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            });
        }
    });

    $('#comments, #reviews').bind('input propertychange', function () {
        var price = $('#price').val();
        var number_seeding = (this.value.match(/^\s*\S/gm) || "").length;
        $('#number_seeding').val(number_seeding);
        var total = numberFormat(price * number_seeding);
        $('#number, #amount').text(number_seeding);
        $('#total').text(total);
    });

    $(document).on('click', '.btn-comment', function () {
        var comments = $(this).data('comments');
        $('#comment-text').text(comments);
    });

    $(document).on('click', '.btn-review', function () {
        var reviews = $(this).data('reviews');
        $('#review-text').text(reviews);
    });

    $('#modal-comment').on('hidden.bs.modal', function () {
        $('#comment-text').text('');
    });

    $('#modal-review').on('hidden.bs.modal', function () {
        $('#review-text').text('');
    });

    $('#number_seeding, #price').on('input', function () {
        changeTotal();
    });

    $('#guarantee, #age_max, input[type=radio][name=gender], #time_to_live, #time_view').on('change', function () {
        changeTotal();
    });

    $('input[type=radio][name=type]').on('change', function () {
        changeReaction();
        changeSection();
        changeTotal(true);
    });

    $('input[type=radio][name=type]:not(:disabled):first').prop('checked', true).change();

    $('input[type=radio][name=advanced_filter]').on('change', function () {
        if ($(this).val() == 1) {
            $('#advanced_filter_container').removeClass('d-none');
            $('#advanced_filter_container :input').prop('disabled', false);
        } else {
            $('#advanced_filter_container').addClass('d-none');
            $('#advanced_filter_container :input').prop('disabled', true);
        }
        changeTotal();
    });

    $('#age_min').on('change', function () {
        var age_min = $(this).val();
        if (age_min) {
            $('#age_max').prop('disabled', false);
            $('#age_max').val('').trigger('change');
            $('#age_max option').removeAttr('aria-hidden');
            $('#age_max option').prop('disabled', false);
            $('#age_max').children('option').filter(function () {
                return this.value && this.value < age_min;
            }).attr('aria-hidden', 'true').prop('disabled', true);
        } else {
            $('#age_max').val('').trigger('change');
            $('#age_max').prop('disabled', true);
        }
        changeTotal();
    });

    $('#service-tabs-list').on('shown.bs.tab', function (e) {
        var loaded = $(this).attr('loaded');
        if (!loaded) {
            $(this).attr('loaded', 'true');
            var url = getServiceUrl();
            var dataTable = initDataTable($('#dataTable'), columns, [[0, "desc"]], url);
        } else {
            $('#dataTable').DataTable().ajax.reload();
        }
    });

    $(document).on('click', '.btn-update', function () {
        var url = $(this).data('url');
        var _this = $(this);
        _this.addClass('fa-spin');
        $.ajax({
            type: 'POST',
            url: url,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                }
                _this.removeClass('fa-spin');
                $('#dataTable').DataTable().ajax.reload(null, false);
            },
            error: function (xhr, status, error) {
                var response = JSON.parse(xhr.responseText);
                toastr.error(response.message);
                _this.removeClass('fa-spin');
                $('#dataTable').DataTable().ajax.reload(null, false);
            }
        });
    });
});

function changeTotal(changeType = false) {
    var type = $('input[type=radio][name=type]:checked').val();
    var sitePrice = sitePrices[type];
    var price = parseInt(changeType ? sitePrice : $('#price').val());
    var newPrice = price;
    var guarantee = $('#guarantee').val();
    if (guarantee) newPrice = newPrice + price * 0.5;

    var advanced_filter = $('input[type=radio][name=advanced_filter]:checked').val();
    if (advanced_filter == 1) {
        var gender = $('input[type=radio][name=gender]:not(:disabled):checked').val();
        if (gender) newPrice = newPrice + price * 0.5;

        var age_min = $('#age_min').val();
        var age_max = $('#age_max').val();
        if (age_min || age_max) newPrice = newPrice + price * 0.5;
        if (!age_min) $('#age_max').prop('disabled', true);
    }
    newPrice = Math.ceil(newPrice);
    if (changeType) {
        var minNumber = minNumbers[type];
        $('#price').attr('min', sitePrice);
        $('#price').rules('remove', 'min');
        $('#price').rules('add', { min: sitePrice });
        $('#number_seeding').attr('min', minNumber);
        $('#number_seeding').rules('remove', 'min');
        $('#number_seeding').rules('add', { min: minNumber });
        $('#price').val(sitePrice);
    }

    var number_seeding = $('#number_seeding').val();
    var total = newPrice * number_seeding;
    var time_to_live = $('#time_to_live').val();
    if (time_to_live) total = total * time_to_live;
    var time_view = $('#time_view').val();
    if (time_view) total = total * time_view;
    total = numberFormat(total);
    $('.price').text(numberFormat(newPrice));
    $('#number').text(number_seeding);
    $('#total').text(total);
}

function changeReaction() {
    var type = $('input[type=radio][name=type]:checked').val();
    $('.reactions').find('label').each(function () {
        $(this).find('input').prop('checked', false);
        if ($(this).hasClass(type)) {
            $(this).removeClass('d-none');
            $(this).find('input').removeAttr('disabled');
        } else {
            $(this).addClass('d-none');
            $(this).find('input').attr('disabled', 'disabled');
        }
    });
    $('.reactions input:not(:disabled):first').prop('checked', true);
}

function changeSection() {
    var type = $('input[type=radio][name=type]:checked').val();
    $('.sections').find('.section').each(function () {
        if ($(this).hasClass(type)) {
            $(this).removeClass('d-none');
            $(this).find(':input').prop('disabled', false);
        } else {
            $(this).addClass('d-none');
            $(this).find(':input').prop('disabled', true);
        }
    });
}

function getServiceUrl() {
    var type = [];
    $('input[type=radio][name=type]').each(function (index) {
        type[index] = $(this).val();
    });
    type = type.map(function (value, index) {
        return 'type[' + index + ']=' + value;
    }).join('&');
    var url = listServiceUrl + '?' + type;
    return url;
}

$.validator.addMethod("comments", function (value, element) {
    var lines = value.split('\n');
    lines = lines.filter(item => item);
    /*if (lines.length < 5) {
        $.validator.messages.comments = 'Vui lòng nhập lớn hơn 5 bình luận!';
        return false;
    }*/
    for (var i = 0; i < lines.length; i++) {
        inValid = lines[i].match(/[|\\/~^:;?!&%$@*+]/);
        if (inValid) {
            $.validator.messages.comments = 'Bình luận thứ ' + (i + 1) + ' không được chứa ký tự đặc biệt: "' + inValid[0] + '"';
            return false;
        }
    }
    return true;
}, '');

$.validator.addMethod("reviews", function (value, element) {
    var lines = value.split('\n');
    lines = lines.filter(item => item);
    /*if (lines.length < 5) {
        $.validator.messages.reviews = 'Vui lòng nhập lớn hơn 5 bình luận!';
        return false;
    }*/
    for (var i = 0; i < lines.length; i++) {
        inValid = lines[i].match(/[|\\/~^:;?!&%$@*+]/);
        if (inValid) {
            $.validator.messages.reviews = 'Đánh giá thứ ' + (i + 1) + ' không được chứa ký tự đặc biệt: "' + inValid[0] + '"';
            return false;
        }
    }
    return true;
}, '');

