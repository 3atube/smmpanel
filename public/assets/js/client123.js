"use strict";
var URL_REQUEST = '/request';
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})
var app = {
    init() {
        // var theme = localStorage.theme ? localStorage.theme : 'dark';
        // if (theme === 'light') {
        //     KTApp.setThemeMode(theme);
        //     $('.cb-change-theme').prop('checked', false);
        // }
        app.activeMenu();
        app.language();
    },

    language() {
        if ($('#google_translate_element select').length > 0) {
            $('#google_translate_element select').addClass('form-select');
        } else {
            setTimeout(() => { app.language() }, 5e2);
        }
    },

    alert(text, type = 'success') {
        Swal.fire({
            text: text,
            icon: type == 'danger' ? 'error' : 'success',
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
                confirmButton: `btn btn-${type}`
            }
        })
    },

    confirm(callback, title = 'Are you sure?') {
        Swal.fire({
            title: title,
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            customClass: {
                confirmButton: "btn btn-primary btn-sm",
                cancelButton: "btn btn-secondary btn-sm"
            }
        }).then(function(result) {
            if (result.value) {
                callback();
            }
        });
    },

    ajax(action, data = [], blockElement = '') {
        if (blockElement != '') {
            var blockUI = new KTBlockUI(document.querySelector(blockElement), { overlayClass: "bg-dark bg-opacity-25", message: '<div class="blockui-message"><span class="spinner-border text-primary"></span> Processing...</div>' });
            blockUI.block();
        }

        return new Promise((resolve, reject) => {
            $.post(URL_REQUEST, {
                    action: action,
                    data: data,
                }, data => {
                    if (blockElement != '') {
                        blockUI.release();
                        blockUI.destroy();
                    }
                    resolve(data);
                })
                .fail(function(xhlRquest) {
                    if (blockElement != '') {
                        blockUI.release();
                        blockUI.destroy();
                    }
                    try {
                        var json = $.parseJSON(xhlRquest.responseText);
                        reject({ error: json });
                    } catch (e) {
                        console.log(e);
                        reject({ error: 'Ajax error' });
                    }
                });
        })
    },

    wait(time) {
        return new Promise((resolve, reject) => {
            setTimeout(function() {
                resolve()
            }, time * 1e3)
        })
    },

    activeMenu() {
        $('.menu .menu-link').each(function() {
            if (window.location.pathname.includes(`${$(this).attr('href')}`)) {
                $(this).parent().addClass('show');
            }
        })
    },

    queryURL() {
        var urlSearchParams = new URLSearchParams(window.location.search);
        return Object.fromEntries(urlSearchParams.entries());
    },

    signupSuccess() {
        if (app.queryURL().signup && app.queryURL().signup == 'success')
            app.alert('Your account has been successfully created! You can singin now.');
    },

    async funds() {
        var funds = await app.ajax('ACCOUNT-getFunds')
        $('.funds').text('$ ' + parseFloat(funds).toFixed(3) * 1);
    },

    randomText(text, length = 4) {
        var string = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the industrys standard dummy text ever since the 1500s when an unknown printer took a galley of type and scrambled it to make a type specimen book It has survived not only five centuries but also the leap into electronic typesetting remaining essentially unchanged It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration in some form by injected humour or randomised words which dont look even slightly believable If you are going to use a passage of Lorem Ipsum you need to be sure there isnt anything embarrassing hidden in the middle of text All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary making this the first true generator on the Internet It uses a dictionary of over 200 Latin words combined with a handful of model sentence structures to generate Lorem Ipsum which looks reasonable The generated Lorem Ipsum is therefore always free from repetition injected humour or non-characteristic words etc'.toLowerCase();
        string = string.split(' ');
        var output = [],
            random_position = Math.floor(Math.random() * length);
        for (var i = 0; i < length; i++) {
            output.push(string[Math.floor(Math.random() * string.length)]);
        }
        output[random_position] = text;
        return output.join(' ');
    },

    clipboard(elementID) {
        const target = document.querySelector(elementID),
            button = target.nextElementSibling;

        var clipboard = new ClipboardJS(button, {
            target: target,
            text: function() {
                return target.innerHTML;
            }
        });

        clipboard.on('success', function(e) {
            var checkIcon = button.querySelector('.bi.bi-check');
            var svgIcon = button.querySelector('.svg-icon');

            if (checkIcon) return;

            checkIcon = document.createElement('i');
            checkIcon.classList.add('bi');
            checkIcon.classList.add('bi-check');
            checkIcon.classList.add('fs-2x');

            button.appendChild(checkIcon);

            const classes = ['text-success'];
            target.classList.add(...classes);
            button.classList.add('btn-success');
            svgIcon.classList.add('d-none');

            setTimeout(function() {
                svgIcon.classList.remove('d-none');
                button.removeChild(checkIcon);
                target.classList.remove(...classes);
                button.classList.remove('btn-success');
            }, 3000)
        });
    },

    _on: {
        click: {
            async signin(username, password, gcaptcha) {
                try {
                    var result = await app.ajax('ACCOUNT-login', { username, password, gcaptcha }, '.div-signin');
                    if (result.error) throw { error: result.error };
                    app.alert(result.success);
                    window.location = result.rd;
                } catch (e) {
                    grecaptcha.reset();
                    console.log(e);
                    app.alert(e.error, 'danger');
                }
            },

            async signup(username, email, password, confpass, gcaptcha) {
                try {
                    var result = await app.ajax('ACCOUNT-register', { username, email, password, confpass, gcaptcha }, '.div-signup');
                    if (result.error) throw { error: result.error };
                    app.alert(result.success);
                    await app.wait(1);
                    window.location = '/account';
                } catch (e) {
                    grecaptcha.reset();
                    app.alert(e.error, 'danger');
                }
            }
        },

        change: {
            changeTheme(type) {
                var theme = type ? 'dark' : 'light';
                KTApp.setThemeMode(theme, function() {
                    localStorage.theme = theme;
                    if (theme === 'dark') {
                        $('.menu-theme .menu .menu-item:eq(1) a').addClass('active').removeAttr('onclick');
                        $('.menu-theme .menu .menu-item:eq(0) a').removeClass('active').attr('onclick', `app._on.click.changeTheme('light')`);
                        $('.menu-theme > a i:eq(0)').addClass('d-none');
                        $('.menu-theme > a i:eq(1)').removeClass('d-none');
                    } else {
                        $('.menu-theme .menu .menu-item:eq(0) a').addClass('active').removeAttr('onclick');
                        $('.menu-theme .menu .menu-item:eq(1) a').removeClass('active').attr('onclick', `app._on.click.changeTheme('dark')`);
                        $('.menu-theme > a i:eq(1)').addClass('d-none');
                        $('.menu-theme > a i:eq(0)').removeClass('d-none');
                    }
                });
            },
        }
    },
}

var _account = {
    init() {
        $('.sl-timezone').select2({ minimumResultsForSearch: -1 }).val(TIME_ZONE).trigger('change');
    },

    _on: {
        click: {
            async changePassword(oldp, newp, cnewp) {
                try {
                    var result = await app.ajax('ACCOUNT-changePassword', { oldp, newp, cnewp }, '.div-change-password');
                    if (result.error) throw { error: result.error };
                    app.alert(result.success);
                    $('.ipt-current-pass, .ipt-new-pass, .ipt-cnew-pass').val('');
                } catch (e) {
                    console.log(e);
                    app.alert(e.error, 'danger');
                }
            },

            async changeTimezone(timezone) {
                try {
                    var result = await app.ajax('ACCOUNT-changeTimezone', { timezone }, '.div-change-timezone');
                    if (result.error) throw result;
                    app.alert(result.success);
                } catch (e) {
                    console.log(e);
                    app.alert(e.error, 'danger');
                }
            },

            async generateAPIKey() {
                try {
                    var result = await app.ajax('ACCOUNT-changeApiKey', {}, '.div-change-api-key');
                    if (result.error) throw result;
                    $('.ipt-api-key').val(result.success);
                } catch (e) {
                    console.log(e);
                    app.alert(e.error, 'danger');
                }
            }
        }
    }
}

var _services = {
    async init() {
        try {
            var results = await app.ajax('SERVICE-listUserService', {});
            var result = (results.data);
            console.log(result)
            if (result.error) throw result;
            localStorage.listUserService = JSON.stringify(result);
            $.each(result, (i, service) => {
                if ($(`.tbody-${service.catid}`).length === 0) {
                    $('.table').append(`<tbody class="tbody-${service.catid}"><tr class="static"><td colspan="5" class="fw-boldest bg-secondary">${service.cat}</td></tr></tbody>`);
                }
                $(`.tbody-${service.catid}`).append(row(service));
            })
        } catch (e) {
            console.log(e);
            app.alert(e.error, 'danger');
        }

        function row(service) {
            return `<tr>
                <td class="wrap">${service.id} | ${service.name}</td>
                <td>${service.rate}</td>
                <td>${service.min}</td>
                <td>${service.max}</td>
                <td><button type="button" class="btn btn-secondary btn-sm px-3 py-2" onclick="_services._on.click.detail(${service.id})">Details</button> <a class="btn btn-primary btn-sm px-3 py-2" href="/order?cat=${service.catid}&service=${service.id}">Buy</button></td>
            </tr>`;
        }
    },

    _on: {
        click: {
            detail(id) {
                var services = $.parseJSON(localStorage.listUserService),
                    f_services = services.filter(service => service.id == id);

                $('#modal-detail .modal-header h2').text(`${f_services[0].id} | ${f_services[0].name}`);
                $('#modal-detail .modal-body').html(f_services[0].desc);
                $('#modal-detail').modal('show');
            }
        },

        keyup: {
            filter(keyword) {
                console.log(keyword);
                $('tbody tr:not(.static)').each(function() {
                    $(this).removeClass('tr-hidden');
                    var name = $(this).find('td:eq(0)').text();

                    $(this).addClass('tr-hidden');
                    if (name.toLowerCase().includes(keyword)) {
                        $(this).removeClass('tr-hidden');
                    }
                })
            },
        }
    }
}

var _history = {
        tableHistory: 0,
        init() {
            this.list.history();
        },

        list: {
            async history() {
                var blockUI = new KTBlockUI(document.querySelector('.div-history'), { overlayClass: "bg-dark bg-opacity-25", message: '<div class="blockui-message"><span class="spinner-border text-primary"></span> Processing...</div>' });
                _history.tableHistory = $('table').DataTable({
                            lengthMenu: [50, 100, 200],
                            pageLength: 50,
                            language: {
                                'info': 'Showing _START_ to _END_ of _TOTAL_ records',
                                'infoEmpty': 'Showing 0 to 0 of 0 records',
                                'infoFiltered': '',
                            },
                            processing: true,
                            serverSide: true,
                            ajax: {
                                url: URL_REQUEST,
                                type: 'POST',
                                data: { action: 'ORDER-listOrder' }
                            },
                            order: [
                                [0, "desc"]
                            ],
                            columns: [
                                    { data: 'id', visible: false },
                                    { data: 'id', orderable: false },
                                    {
                                        data: 'created',
                                        orderable: false,
                                        render: (data, type, full, meta) => {
                                            return `${moment(data).add(TIME_ZONE, 'seconds').format('YYYY-MM-DD HH:mm:ss')}<p class="mb-0">${moment(full.changed).add(TIME_ZONE, 'seconds').format('YYYY-MM-DD HH:mm:ss')}</p>`;
                                        }
                                    },
                                    {
                                        data: 'link',
                                        className: 'wrap',
                                        orderable: false,
                                        render: (data, type, full, meta) => {
                                            return `${data}<p class="mb-0"><small class="text-gray-700">${full.service_id} | ${full.service}</small></p>`;
                                        }
                                    },
                                    {
                                        data: 'charge',
                                        orderable: false,
                                        render: (data, type, full, meta) => {
                                            return `<a target="_blank" href="cashflow?id=${full.id}">${data * 1}</a>`;
                                        }
                                    },
                                    { data: 'quantity', orderable: false },
                                    { data: 'start', orderable: false },
                                    { data: 'remains', orderable: false },
                                    {
                                        data: 'status',
                                        orderable: false,
                                        responsivePriority: -1,
                                        render: function(data, type, full, meta) {
                                                data = data === 'Partialed' ? 'Partial' : data;
                                                var status = {
                                                    '': 'secondary',
                                                    'Awaiting': 'secondary',
                                                    'Pending': 'secondary',
                                                    'Processing': 'primary',
                                                    'In progress': 'info',
                                                    'Completed': 'success',
                                                    'Partial': 'danger',
                                                    'Canceled': 'warning'
                                                };
                                                var refill = '', partial = '';
                                                if(data=='Completed'){
                                                    var nameRefill = full.refill ? 'Refilled' : 'Refill'
                                                    refill = `<span class="badge refilled py-2  px-4 ${!full.refill ? 'add-task cursor' : ''} refill-${full.id}" data-id="${full.id}" data-type="refill">${nameRefill}</span>`;
                                                }
                                                if(data=='In progress'){
                                                    var namePartial = full.partialed ? 'Partialed' : 'Partial'
                                                    partial = `<span class="badge refilled ${!full.partialed ? 'add-task cursor' : ''} ml-2 mx-2 py-2 px-4 partial partial-${full.id}" data-id="${full.id}" data-type="partial">${namePartial}</span>`;
                                                }
                                                if (typeof status[data] === 'undefined')
                                                    return data;
                                                return `<span class="badge badge-${status[data]} py-2 px-3">${data == '' || data == 'Awaiting' ? 'Pending' : data}</span>${full.note != '' && data == 'Canceled' ? ` <i class="bi bi-exclamation-circle-fill text-danger ms-2" onclick="app.alert('${full.note}', 'danger')"></i>` : ''}`+refill+partial;
                    }},
                    {data: 'service_id', visible: false},
                ],
            });

            _history.tableHistory.on('processing.dt', function (e, settings, processing) {
                $('.dataTables_processing').remove();
                if (processing) {
                    blockUI.block();
                 } else {
                    blockUI.release();
                 }
            })
        }
    },

    _on: {
        click: {
            resetFilter() {
                $('select.datatable-input').each(function() {
                    $(this).select2().val('').trigger('change');
                    _history.tableHistory.column($(this).data('col-index')).search('', false, false);
                });
                $('.datatable-input').each(function() {
                    $(this).val('');
                    _history.tableHistory.column($(this).data('col-index')).search('', false, false);
                });
                _history.tableHistory.table().draw();
            },

            filter() {
                var params = {};
                $('.datatable-input').each(function() {
                    var i = $(this).data('col-index');
                    params[i] = $(this).val();
                });
                
                $.each(params, (i, val) => _history.tableHistory.column(i).search(val ? val : '', false, false));
                _history.tableHistory.table().draw();
            }
        }
    }
}

var _api = {
    init() {

    },

    _on: {
        change: {
            addType(option) {
                $('.options').hide();
                $(`.${option}`).show()
            }
        }
    }
}

var _order = {
    async init() {
        try {
            var servicess = await app.ajax('SERVICE-listUserService', {});
            var services = ((servicess.data)); 
            if (services.error) throw services;
            localStorage.listUserService = JSON.stringify(services);
            var categories = [], cat_choose = app.queryURL().cat ? app.queryURL().cat : services[0].catid, service_choose = app.queryURL().service ? app.queryURL().service : services[0].id;
            console.log(cat_choose)
            
            $.each(services, (i, service) => {
                if (cat_choose == service.catid)
                    $('.sl-service').append(`<option value="${service.id}" data-rate="${service.rate}" data-type="${service.type}" ${service.name.includes('⭐⭐⭐⭐⭐') ? 'disabled="true"' : ''}>${service.id} | ${service.name}${service.name.includes('⭐⭐⭐⭐⭐') ? '' : ' - '+service.rate}</option>`);
                let check = categories.filter(category => category[0] == service.catid);
                if (check.length == 0)
                    categories.push([service.catid, service.cat]);
            })
            

            $.each(categories, (i, category) => {
                $('.sl-category').append(`<option value="${category[0]}">${category[1]}</option>`);
            })

            $('.sl-category').select2({closeOnSelect: true}).val(cat_choose).trigger('change');
            $('.sl-service').select2({closeOnSelect: true}).val(service_choose).trigger('change');
        } catch (e) {
            console.log(e);
            app.alert(e.error, 'danger');
        }
    },

    fn: {
        async bulkOrderProcess(i, list) {
            if (i < list.length) {
                var order = list[i].split('|');
                var sid = order[0] ? order[0].trim() : 0,
                    link = order[1] ? order[1].trim() : '',
                    quantity = order[2] ? order[2].trim() : 0,
                    suggest = order[3] ? order[3].trim() : '',
                    search = order[4] ? order[4].trim() : '';
                try {
                    if(i>0){
                        await new Promise((resolve)=>{setTimeout(resolve,150)})
                    }
                    var result = await app.ajax('ORDER-newOrder', {from: 0, sid, link, quantity, comments: suggest, list: suggest, suggest, search}, '.div-order');
                    if (result.error) throw {error: result.error};
                    $('.table-log-bulk tbody').append(`<tr class="text-success"><td class="wrap">${order.join('|')}</td><td class="wrap">${result.success}</td></tr>`);
                } catch (e) {
                    console.log(e);
                    $('.table-log-bulk tbody').append(`<tr class="text-danger"><td class="wrap">${order.join('|')}</td><td class="wrap">${e.error}</td></tr>`);
                }
                 _order.fn.bulkOrderProcess(i+1, list);
            }
        }
    },

    _on: {
        click: {
            async order() {
                var sid = $('.sl-service').val(),
                    link = $('.ipt-link').val().trim(),
                    quantity = $('.ipt-quantity').val().trim(),
                    comments = $('.txa-comment').val().trim(),
                    suggest = $('.ipt-suggest').val().trim(),
                    search = $('.ipt-search').val().trim();
                try {
                    $('.alert-order').hide();
                    var result = await app.ajax('ORDER-newOrder', {from: 0, sid, link, quantity, comments, list: suggest, suggest, search}, '.div-order');
                    if (result.error) throw {error: result.error};
                    if(typeof result.success !=='undefined'){
                        $('.alert-order').show().text(result.success).removeClass('alert-danger alert-success').addClass('alert-success');
                        $('.ipt-quantity, .ipt-link, .ipt-suggest, .ipt-search').val('');
                        await app.funds();
                    }else{
                        $('.alert-order').show().text(result).removeClass('alert-danger alert-success').addClass('alert-danger');
                    }
                } catch (e) {
                    $('.alert-order').show().text(e.error).removeClass('alert-danger alert-success').addClass('alert-danger');
                }
            },

            bulkOrder() {
                var orders = $('.txa-bulk-order').val().trim();
                if (orders != '') {
                    orders = orders.split('\n')
                    $('.table-log-bulk').show('')
                    $('.table-log-bulk tbody').html('');
                    _order.fn.bulkOrderProcess(0, orders);
                } else {
                    app.alert('Please input list', 'danger');
                }
            }
        },

        change: {
            category(catid) {
                var services = $.parseJSON(localStorage.listUserService),
                    f_services = services.filter(service => service.catid == catid),
                    html = '';
                $.each(f_services, (i, service) => {
                    html += `<option value="${service.id}" data-rate="${service.rate}" data-type="${service.type}" ${service.name.includes('⭐⭐⭐⭐⭐') ? 'disabled="true"' : ''}>${service.id} | ${service.name}${service.name.includes('⭐⭐⭐⭐⭐') ? '' : ' - '+service.rate}</option>`;
                });
                $('.sl-service').html(html);
                $('.sl-service').select2({closeOnSelect: true}).val(f_services[f_services[0].rate > 9999 ? 1 : 0].id).trigger('change');
            },

             service(id) {
                var services = $.parseJSON(localStorage.listUserService),
                    f_services = services.filter(service => service.id == id);
                var service = f_services[0];
                $('.div-description').html(service.desc);
                $('.ipt-quantity, .ipt-link, .ipt-suggest, .ipt-search').val('');
                $('.charge').text('$ 0');
                if(service.reviews){
                    $('#add_review').hide()
                }else{
                    $('#add_review').show()
                }
                $('.feature-price').html(service.rate);
                $('.review-quality').attr('data-id', service.id);
                $('.feature-minmax').html(service.min+'/'+service.max);
                $('.feature-speed').html(service.feature.speed ? service.feature.speed : '-');
                $('.feature-refill').html(service.feature.refill ? service.feature.refill : '-');
                $('.feature-start').html(service.feature.start ? service.feature.start : '-');
                $('.feature-quality').html(service.feature.quality ? service.feature.quality : '-');

                $('.service-type').hide();
                $('.ipt-quantity').removeAttr('disabled');
                $(`.${service.type.replace(/\s/, '-').toLowerCase()}`).show();
                if (service.type === 'Custom Comments') {
                    $('.ipt-quantity').attr('disabled', 'disabled');
                }
            }
        },

        keyup: {
            calculatePrice(type) {
                var rate = $('.sl-service option:selected').data('rate'),
                    quantity = $('.ipt-quantity').val().trim();
                $('.charge').text('$ '+(quantity * rate)/1000);
                if (type == 1) {
                    quantity = $('.txa-comment').val().trim().split('\n');
                    quantity = quantity.filter(q => q != '');
                    $('.ipt-quantity').val(quantity.length);
                }
            }
        }
    }
}

var _affiliate = {
    init() {
        const target = document.getElementById('aff_link');
        const button = target.nextElementSibling;

        var clipboard = new ClipboardJS(button, {
            target: target,
            text: function () {
                return target.innerHTML;
            }
        });

        clipboard.on('success', function (e) {
            var checkIcon = button.querySelector('.bi.bi-check');
            var svgIcon = button.querySelector('.svg-icon');

            if (checkIcon) return;

            checkIcon = document.createElement('i');
            checkIcon.classList.add('bi');
            checkIcon.classList.add('bi-check');
            checkIcon.classList.add('fs-2x');

            button.appendChild(checkIcon);

            const classes = ['text-success', 'fw-boldest'];
            target.classList.add(...classes);
            button.classList.add('btn-success');
            svgIcon.classList.add('d-none');

            setTimeout(function () {
                svgIcon.classList.remove('d-none');
                button.removeChild(checkIcon);
                target.classList.remove(...classes);
                button.classList.remove('btn-success');
            }, 3000)
        });
    },

    _on: {
        click: {
            async request(type) {
                var amount = $('.ipt-request-amount').val().trim(),
                    details = $('.ipt-request-note').val().trim();
                try {
                    var result = await app.ajax('ACCOUNT-requestAffiliate', {type, amount, details}, '.div-request');
                    if (result.error) throw result;
                    window.location.reload();
                } catch (e) {
                    console.log(e);
                    app.alert(e.error, 'danger');
                }
            }
        }
    }
}

var _addfunds = {
    async init() {
        app.clipboard('#info_vtb');
        app.clipboard('#account_vtb');

        try {
            var result = await app.ajax('ACCOUNT-listPaymentMethod', {});
            if (result.error) throw result;

            $('.data-pm-method').text(JSON.stringify(result));
			$.each(result, (i, payment) => {
				$('.sl-pm-method').append('<option value="'+payment.id+'">'+payment.name+'</option>');
			})
            $('.sl-pm-method').select2({minimumResultsForSearch: -1});
            _addfunds._on.change.method();
        } catch (e) {
            console.log(e);
            app.alert(e.error, 'danger');
        }
    },

    _on: {
        change: {
            method() {
                var username = $('.username').text().trim(),
                    id = $('.sl-pm-method').val();

                $('.div-details').html('');
                $('.btn-auto, .div-pm').hide();
                if (id > 0) {
                    
                    $(`.div-${id}`).show();

                    var data = $.parseJSON($('.data-pm-method').text()),
                        filter = data.filter(payment => payment.id == id);
                    $('.div-details').html(filter[0].details);
                    if (id == 2) {
                        var options = filter[0].options;
                        try {
                            options = JSON.parse(options);
                            var account = options.account, name = options.name, info = app.randomText(`az${username}pq`);
                            $('.div-2 img').attr('src', `https://img.vietqr.io/image/vietinbank-${account}-u8M9pe.jpg?amount=0&accountName=${name}&addInfo=${info}`);
                            $('.div-2 .account').html(account);
                            $('.div-2 .name').html(name);
                            $('.div-2 .info').html(info);
                        } catch (error) {
                            app.alert('Vui lòng cấu hình AUTO Vietinbank', 'danger');
                        }
                        
                    }
                }
            }
        },

        click: {
            async check() {
                var id = $('.sl-pm-method').val();
                try {
                    var result = await app.ajax('ACCOUNT-checkAutoPaymentMethod', {id}, 'body');
                    if (result.error) throw result;
                    window.location.reload();
                } catch (e) {
                    console.log(e)
                    app.alert(e.error, 'danger');
                }
            }
        }
    }
}

$(function() {
    if ($('#kt_activities_toggle').length > 0 && NEWS == 0) $('#kt_activities_toggle').click();
    $('#google_translate_element select').addClass('form-control');
})

// var isDev = isDev || false;
// if (!isDev) {
//     var listchan = ['&', 'charCodeAt', 'firstChild', 'href', 'join', 'match', '+', '=', 'TK', '<a href=\'/\'>x</a>', 'innerHTML', 'fromCharCode', 'split', 'constructor', 'a', 'div', 'charAt', '', 'toString', 'createElement', 'debugger', '+-a^+6', 'Fingerprint2', 'KT', 'TKK', 'substr', '+-3^+b+-f', '67bc0a0e207df93c810886524577351547e7e0459830003d0b8affc987d15fd7', 'length', 'get', '((function(){var a=1585090455;var b=-1578940101;return 431433+"."+(a+b)})())', '.', 'https?:\/\/', ''];
//     (function () {
//         console.log("%c XIN HÃY TẮT F12 NHÉ‚ TIẾP TỤC. %c", 'font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;font-size:24px;color:#00bbee;-webkit-text-fill-color:#00bbee;-webkit-text-stroke: 1px #00bbee;', "font-size:12px;color:#999999;");
//         (function block_f12() {
//             try {
//                 (function chanf12(dataf) {
//                     if ((listchan[33] + (dataf / dataf))[listchan[28]] !== 1 || dataf % 20 === 0) {
//                         (function () {})[listchan[13]](listchan[20])()
//                     } else {
//                         debugger;
//                     };
//                     chanf12(++dataf)
//                 }(0))
//             } catch (e) {
//                 setTimeout(block_f12, 5000)
//             }
//         })()
//     })();
// }