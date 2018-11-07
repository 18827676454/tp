/**
 * 自动生成 ShGoods
 *
 * Public/js/backend/sh_goods.js
 * admin @ 2017-03-08
 */


var app = new Vue({
    el:'#app',
    data :{
        sub_url : "{:url('Goods/add')}",
        name: '小明',
        goods : goods,
        ac_color : {
            1 :'red',
            2 : 'green',
            3:'yellow',
            4:'blue'
        },
        goods_type : goods_type
    },
    filters:{
        changeLevel : function (val) {
            this.ac_color = 'green';
            var str = '' ;
            str += '|';
            for(var i =0 ; i<= val ; i++){
                str += '-';
            }
            return str ;
        }
    },
    methods : {
        submit : function () {
            $.post(this.sub_url , this.goods , function (_) {
                console.log(_);
                layer.msg(_.msg);
            },'json');
        }
    }
});




UE.getEditor('goods_desc');
UE.getEditor('require');
var area_init = function ($obj) {
    $obj.empty();
    $obj.append('<option value="_NULL_">--请选择--</option>');
};
//设置一级分类
var set_cat_one = function ($obj, default_id) {
    area_init($obj);
    $.ajax({
        url: '{:url("Public/get_cat_one")}',
        async: false,
        type: 'post',
        success: function (res) {
            $.each(res, function (index, option) {
                var selected = '';
                if (default_id == option.id) {
                    selected = 'selected';
                }
                $obj.append('<option value="' + option.id + '" ' + selected + '>' + option.cat_name + '</option>');
            });
        },
        error: function () {
            layer.msg('系统内部错误，请稍后再试');
        }
    });
};
//设置二级分类
var set_cat_child = function ($obj, p_id, default_id) {
    area_init($obj);
    $.ajax({
        url: '{:url("Public/get_cat_child")}',
        type: 'post',
        async: false,
        data: {cat_id: p_id},
        success: function (res) {
            $.each(res, function (index, option) {
                var selected = '';
                if (default_id == option.id) {
                    selected = 'selected';
                }
                $obj.append('<option value="' + option.id + '" ' + selected + '>' + option.cat_name + '</option>');
            });
        },
        error: function () {
            layer.msg('系统内部错误，请稍后再试');
        }
    });
};
$(function () {
    /*分类选择*/
    ShGoods.init({attribute_url:"{:url('Goods/attr_read')}",});
    var $cat_one = $('#cat_one');
    var $cat_two = $('#cat_two');
    var $input_cat = $('#cat_id');
    set_cat_one($cat_one);
    set_cat_child($cat_two);
    $cat_one.change(function () {
        area_init($cat_two);
        var id = $(this).find("option:selected").val();
        if (id != '_NULL_') {
            $input_cat.attr('value', id);
            set_cat_child($cat_two, id, 0);
        } else {
            $input_cat.attr('value', '');
        }
    });

    $cat_two.change(function () {
        var id = $(this).find("option:selected").val();
        if (id != '_NULL_') {
            $input_cat.attr('value', id);
        } else {
            $input_cat.attr('value', '');
        }
    });
    /*图片设置*/
    $('.upload-img').click(function () {
        var imgIds = $(this).next(), imgShow = $(this).prev(), input_name = $(this).attr('data-input-name');
        var valArr = [];
        imgIds.find("input[data-input='img']").each(function (n) {
            valArr[n] = $(this).val();
        });
        layer.open({
            type: 2,
            title: '图片设置',
            area: ['400px', '400px'],
            content: '{:url("Public/upload_img")}&max=5&ids=' + valArr.join(','),
            btn: ['确定', '取消'],
            yes: function (index) {
                imgIds.empty();
                imgShow.empty();
                $(window.frames["layui-layer-iframe" + index].document).find('input[type="hidden"]').each(function (i) {
                    imgIds.append('<input data-input="img" type="hidden" name="' + input_name + '[' + i + ']" value="' + $(this).val() + '">');
                    imgShow.append('<img src="' + $(this).attr('data-url') + '">');
                });
                layer.close(index);
            }
        })
    })
})

$("#myTab li ").click(function(){
    // 获取点击的是第几个按钮
    var i = $(this).index();
    //alert(i);
    $(".tab-pane").hide();
    // 显示第i个table
    $(".tab-pane").eq(i).show();
    // 先把当前选中的按钮变为未选中
    $("#myTab .order_active").removeClass("order_active");
    // 设置当前按钮为选中状态
    $(this).addClass("order_active");
});

$(function(){
    $('#submit_btn').click(function(){
        $("form").ajaxSubmit(function(res){
            layer.msg(res.msg);
            if (res.status == 1) {
                window.location.href ="{:url('Goods/index')}";
            }
        })
    })

})
    function addParam() {
        var htm ="";
        htm+="<tr> <td> <a href='javascript:;' class='fa fa-move' title='拖动调整此显示顺序'><i class='fa fa-arrows'></i></a>&nbsp;";
        htm+="<a href='javascript:;' onclick='deleteParam(this)'style='margin-top:10px;' title='删除'><i class='fa fa-times'></i></a> </td>";
        htm+= "<td> <input name='attr_name[]' placeholder='请输入规格(如颜色)' type='text'class='form-control param_title' value=''>";
        htm+= "<td><input name='attr_value[]'  placeholder='请输入规格值(如红色，多个值之间用,间隔)' type='text' class='form-control param_value' value=''></td> </tr>";
        $('#param-items').append(htm);

    }
function deleteParam(o) {
    $(o).parent().parent().remove();
}





var ShGoods = {
    rowSpanTr:'',
    config: {},
    init: function (config) {
        var _this = this;
        this.config = config;
        _this.init_btn();
    },


    init_btn: function () {
        var _this = this;

        //商品规格
        $(document).on('change', '#shop_attr', function (e) {
            e.preventDefault();
            var type_id = $("#shop_attr").val();
            var html = "";
            var _html = "<tr>";

            $.post(_this.config.attribute_url, {type_id: type_id})
                .done(function (ret) {
                    if (typeof ret !== 'object' || ret.length <= 0) {
                        alert("亲，该类型暂无相关规格!");
                    }
                    else {
                        $(ret).each(function (k, v) {
                             html += "<th><input type='text' class='form-control'style='width:60%!important;display: inline;' name='attr_name[]' value='"+v.attr_name+"'/><a href='javascript:;' class='remove-btn' style='float: right;width: 20%;' title='删除'><i class='fa fa-times'></i></a>";
                             html +=" <a href='javascript:;' class='fa fa-move btn_add btn_arr' style='float: right;width: 20%;' title='点击添加'>[+]</a></th>";
                            _html += "<td>"
                            _html +="<input class='form-control' name='goods_attr[]' value=''>";
                            _html += "</td>";

                        });
                        _html += "<td style='text-align:center'> &nbsp;";
                        _html += "<a href='javascript:;' class='remove-btn' style='margin-top:10px;' title='删除'><i class='fa fa-times'></i></a> </td></tr>";

                        html += "</div></div></th>";
                        html += "<th class='info' style='width:150px;'><div class=''><div style='padding-bottom:10px;text-align:center;font-size:16px;'>操作 <a href='javascript:;' class='fa fa-move btn_add btn_arr'  title='点击添加'>[+]</a></div>";
                        html += "<div class='input-group'>";
                        html += "</div></div></th>";

                    }
                    $(".active-tr").html(html);
                    ShGoods.rowSpanTr = $(_html);
                    $(".rowspan-tr").append(ShGoods.rowSpanTr);
                })
                .fail(function (xhr) {
                    console.log(xhr.responseText);
                });

        });
        $(document).on('click', '.btn_add', function (e) {

            e.preventDefault();

            // 先获取a标签所在的span
            //var span = $(this).parents('thead').next();
            /*if ($(this).html() == "[+]") {*/
                var newspan = ShGoods.rowSpanTr.clone();
                newspan.find('.btn_arr').html("");
                newspan.removeClass('.btn_product');
            $(".rowspan-tr").append(newspan);
            //}
            /*else
                span.remove();*/
            //$(".rowspan-tr").append(_html);
        });
        $(document).on('click', '.remove-btn', function (e) {
            var eml = $(this).parent().parent();
            eml.remove();
        });


    },
    initAttr: function () {
        var type_id = $("#shop_attr").val();
        var html = "";
        var _html = "<tr>";
        $.post(_this.config.attribute_url, {type_id: type_id})
            .done(function (ret) {
                console.log(ret);
                if (typeof ret !== 'object' || ret.length <= 0) {
                    alert("亲，该类型暂无相关规格!");
                }
                else {
                    $(ret).each(function (k, v) {
                        var _attr = v.attr_value.split(",");
                        html += "<th style='width:80px;'>" + v.attr_name + "</th>";
                        _html += "<td>"
                        _html += "<input  type='hidden' name='arr_attr'  value='" + v.id + "'/>";
                        _html += "<select name='goods_attr[" + v.id + "][]' class='form-control " + v.id + "'><option>请选择</option>";
                        for (var i = 0; i < _attr.length; i++) {
                            _html += "<option>" + _attr[i] + "</option>";
                        }
                        _html += "</td>";

                    });
                    _html += "<td style='text-align:center'> &nbsp;";
                    _html += "<a href='javascript:;' class='remove-btn' style='margin-top:10px;' title='删除'><i class='fa fa-times'></i></a> </td></tr>";

                    html += "<span class='input-group-addon'><a href='javascript:;'class='fa fa-hand-o-down' title='批量设置' onclick='setCol('option_costprice');'></a></span></div></div></th>";
                    html += "<th class='info' style='width:150px;'><div class=''><div style='padding-bottom:10px;text-align:center;font-size:16px;'>操作 <a href='javascript:;' class='fa fa-move btn_add btn_arr'  title='点击添加'>[+]</a></div>";
                    html += "<div class='input-group'>";
                    html += "</div></div></th>";

                }
                $(".active-tr").html(html);
                ShGoods.rowSpanTr = $(_html);
                $(".rowspan-tr").append(ShGoods.rowSpanTr);
            })
            .fail(function (xhr) {
                console.log(xhr.responseText);
            });

    }


};