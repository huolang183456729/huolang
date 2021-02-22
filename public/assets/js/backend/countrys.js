define(['jquery', 'bootstrap', 'backend', 'table', 'form','selectpage'], function ($, undefined, Backend, Table, Form,selectPage) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'countrys/index' + location.search,
                    add_url: 'countrys/add',
                    edit_url: 'countrys/edit',
                    del_url: 'countrys/del',
                    multi_url: 'countrys/multi',
                    table: 'countrys',
                }
            });

            var table = $("#table");



            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                search:false,
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'cn_name', title: __('Cn_name'), operate: 'LIKE %...%'},
                        {field: 'en_name', title: __('En_name'), operate: 'LIKE %...%'},
                        {field: 'local_name', title: __('Local_name'), operate: false},
                        {field: 'two_code', title: __('Two_code')},
                        {field: 'three_code', title: __('Three_code'), operate: false},
                        {field: 'currency_name', title: __('Currency'), operate: false},
                        {field: 'status', title: __('Status'), searchList: {"0": __('Available'), "1": __('Disavailable')}, formatter: Table.api.formatter.normal},
                        {field: 'time', title: __('Time'),visible:false, operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();

        },
        edit: function () {
            Controller.api.bindevent();

        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
                //selectPage搜索渲染
                $('#c-currency').selectPage({
                    eAjaxSuccess: function (data) {
                        data.list = typeof data.rows !== 'undefined' ? data.rows : (typeof data.list !== 'undefined' ? data.list : []);
                        data.totalRow = typeof data.total !== 'undefined' ? data.total : (typeof data.totalRow !== 'undefined' ? data.totalRow : data.list.length);
                        return data;
                    },
                    eSelect:function (data){
                        console.log(data);
                    }
                })
            }

        }
    };
    return Controller;
});