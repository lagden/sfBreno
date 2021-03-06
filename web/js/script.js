jQuery.noConflict();

// Mootools
// Parecido com o Growl
var Roar = new Roar({position: 'upperRight', duration: 7000});

var PublicPath;

// Domready
window.addEvent('domready',function()
{
    ajuda.flashNotice();

    var brenoTips = new Tips($$('.brenoTips'),
    {
        className:'toolTip',
        fixed:true,
        offset:{x: 0, y: 16}
    });

    var frmAccordionFormResult = $('accordionFormResult');
    if(frmAccordionFormResult)
    {
        new Fx.Accordion(frmAccordionFormResult, '#accordionFormResult > h2', '#accordionFormResult > .content',
        {
            alwaysHide: true,
            display: -1,
            onActive: function(toggler, element){
                jQuery(toggler).toggleClass('ativo',true);
            },
            onBackground: function(toggler, element){
                jQuery(toggler).toggleClass('ativo',false);
            }
        });
    }

    // Formulario de busca de Imoveis e de buca por Referencia
    ajuda.addFormValidation('frmBuscaImoveis',frmEstateSearch.handler,true);
    ajuda.addFormValidation('frmBuscaImoveisRef',frmEstateSearch.handlerRef,true);
    ajuda.addFormValidation('frmContatoImovel',frmEstateSearch.handlerContato,true);
    ajuda.addFormValidation('frmVendaImovel',frmEstateSearch.handlerVenda,true);

    // Backend Form Auth
    ajuda.addFormValidation('formValidationLogin',backendFunc.handlerAuth,true);

    // Backend Form Validation
    var backendFrm = ajuda.addFormValidation('formValidationGeneral');

    // jQuery
    (function($){

        PublicPath = ajuda.routes('publicPath');

        // Voltar
        $('button.backbutton').click(function(){
            history.back();
        });

        // Twitter
        if($('#tweets').get(0)!=undefined) getTwitterFeed("brenohomara", 4, false);

        // Init tabs
        $('.tabs').tabs();

        // Fancy Bairros
        $('button.showBairro').click(function(){
            // Fancybox
            $.fancybox({
                href        : $(this).data('href'),
                fitToView   : true,
                width       : '90%',
                height      : '90%',
                autoSize    : true,
                closeClick  : false,
                closeBtn    : true,
                openEffect  : 'elastic',
                closeEffect : 'elastic'
            });
        });

        // Fancy Bairros
        $('button.closeBairro').click(function(){
            $.fancybox.close();
        });

        // Fancy Images
        $(".showImageEstate").fancybox({
            fitToView   : true,
            width       : '90%',
            height      : '90%',
            autoSize    : true,
            openEffect  : 'elastic',
            closeEffect : 'elastic'
        });

        // Ajax Disponibilidade -> Valor
        $('#estate_filters_Disponibilidades').change(function(){
            frmEstateSearch.disponibilidade(this.value);
        }).trigger('change');

        // Ajax Sorting
        $('#sort_sorting').change(function(){
            frmEstateSearch.sorting(this.value);
        });

        // Paginação
        $('button.paginacao').live('click',function(e){
            var go=$(this).data('pagina');
            if(go) location=go;
        });

        // Backend - menu
        $('#topbarBackend').dropdown();

        // Backend - Busca
        $('button.limpar').live('click',function(e){
            location=$(this).data('url');
        });

        // Backend - List
        $('button.new').live('click',function(e){
            location=$(this).data('url');
        });

        $('button.lastedit').live('click',function(e){
            location=$(this).data('url');
        });

        $('div#tableList > table.zebra-striped > thead > tr > th').live('click',function(e){
            SortableList.sort(this);
        });

        SortableList.setSort(jQuery('div#tableList > table.zebra-striped'));

        // Backend Deletar Registro
        $('button.deletar').live('click',function(e){
            if(confirm('Deseja remover este registro?'))
            {
                var _this=this;
                $.post($(_this).data('url'),{"sf_method":"delete"},function(r)
                {
                    if(r)
                    {
                        if(r.success)
                        {
                            alert(r.msg);
                            location=jQuery(_this).data('list');
                        }
                        else ajuda.alerta(r.msg);

                        // Verifica se a sessão é válida
                        if( !r.auth )
                        {
                            alert(r.msg);
                            location.reload();
                        }
                    }
                    else alert('Erro na resposta.');
                }
                ,"json");
            }
        });

        // Backend Tagit
        var tagitFull=$.parseJSON($('#tagit_full_list').html());
        var tagitModel=$.parseJSON($('#tagit_model_list').html());
        var tag=$("#form_tags_list");
        if(tag.length>0)
        {
            tag.tagit({
                fieldName:tag.data('name'),
                availableTags:(tagitFull) ? tagitFull : [],
                setTags:(tagitModel) ? tagitModel : [],
                allowSpaces:true
            });
        }

        // Backend - User
        $('input#user_change:checkbox').bind('click custom',function(){backendFunc.changePasswd(this);});
        $('input#user_change').trigger('custom');

        // Backend - Enviar e Editar
        $('input#enviarEditar').click(function(){
            var validado = backendFrm.validate();
            if(validado)
            {
                Cookie.write('salvaEdita',1);
                $(this).parent().parent().submit();
            }
        });

        // Backend - Carga
        $('button#runCarga').click(function(){
            backendFunc.carga();
        });
    })
    (jQuery);
});

var backendFunc={
    carga:function()
    {
        ajuda.triggerAjax(true);
        ajuda.alerta('Verificando. Aguarde...');
        jQuery.post(ajuda.routes('runCarga'),{},backendFunc.cargaCallBack,'json');
    },
    cargaCallBack:function(r)
    {
        ajuda.triggerAjax();
        if(r)
        {
            ajuda.alerta(r.msg);
        }
        else ajuda.alerta('Erro na resposta.');
    },
    // Formulario de venda
    handlerAuth:function(bool,el,submit)
    {
        if(bool) backendFunc.auth();
    },
    auth:function()
    {
        ajuda.triggerAjax(true);
        ajuda.alerta('Verificando. Aguarde...');
        jQuery.post(ajuda.routes('formValidationLogin'),jQuery("#formValidationLogin").serialize(),backendFunc.authCallBack,'json');
    },
    authCallBack:function(r)
    {
        ajuda.triggerAjax();
        if(r)
        {
            if(r.success)
            {
                location=r.data.url;
            }
            else ajuda.alerta(r.msg);
        }
        else ajuda.alerta('Erro na resposta.');
    },

    changePasswd:function(el)
    {
        var passwd = jQuery('input#user_password');
        passwd.get(0).disabled = !el.checked;
        passwd.val('');
    }
}

// Backend - SortableList
var SortableList={
    sort:function(_this)
    {
        var col = jQuery(_this);
        var colField = col.data('field');
        var table = col.parent().parent().parent();
        var tableUrl = table.data('url');

        SortableList.removeClasses(table);

        var cr=Cookie.read('sorttable.menu'+tableUrl+colField);
        if(cr==null)cr='ASC';
        cr=(cr=='DESC')?'ASC':'DESC';
        Cookie.write('sorttable.menu'+tableUrl+colField,cr);

        jQuery.post(tableUrl,{"field":colField,"direction":cr,"pagina":col.data('pagina')},function(r)
        {
            if(r&&r!='reload')
            {
                table.find('tbody').empty().append(r);
                col.addClass(cr);
            }
            else if(r=='reload')
            {
                alert('Sessão expirada. Efetue o login novamente.');
                location.reload();
            }
            else ajuda.alerta('Erro na resposta.');
        }
        ,"html");
    },
    removeClasses:function(table)
    {
        table.find('thead > tr > th').each(function(idx,el){
            jQuery(el).removeClass('DESC');
            jQuery(el).removeClass('ASC');
        });
    },
    setSort:function(table)
    {
        SortableList.removeClasses(table);
        table.find('thead > tr > th[data-field='+SortableList.addslashes(table.data('field'))+']').addClass(table.data('direction'));
    },
    addslashes:function(str)
    {
        return (str + '').replace(/[\\"'.]/g, '\\$&').replace(/\u0000/g, '\\0');
    }
}

// Formulario de Busca de Imoveis
var frmEstateSearch={
    // Combo sorting da listagem de imoveis
    sorting:function(v)
    {
        ajuda.alerta('Reordenando...');
        jQuery.post(ajuda.routes('sort_sorting'),{"sort":v},frmEstateSearch.sortingCallBack,'json');
    },
    sortingCallBack:function(data)
    {
        (data.success) ? location.reload() : ajuda.alerta('Não foi possível reordenar.');
    },

    // Formulario de venda
    handlerVenda:function(bool,el,submit)
    {
        if(bool) frmEstateSearch.venda();
    },
    venda:function()
    {
        ajuda.triggerAjax(true);
        ajuda.alerta('Enviando email. Aguarde...');
        jQuery.post(ajuda.routes('frmVendaImovel'),jQuery("#frmVendaImovel").serialize(),frmEstateSearch.vendaCallBack,'json');
    },
    vendaCallBack:function(data)
    {
        ajuda.triggerAjax();
        if(data.success) $('frmVendaImovel').reset();
        ajuda.alerta(data.msg);
    },

    // Formulario de contato e de interesse
    handlerContato:function(bool,el,submit)
    {
        if(bool) frmEstateSearch.contato();
    },
    contato:function()
    {
        ajuda.triggerAjax(true);
        ajuda.alerta('Enviando email. Aguarde...');
        jQuery.post(ajuda.routes('frmContatoImovel'),jQuery("#frmContatoImovel").serialize(),frmEstateSearch.contatoCallBack,'json');
    },
    contatoCallBack:function(data)
    {
        ajuda.triggerAjax();
        if(data.success) $('frmContatoImovel').reset();
        ajuda.alerta(data.msg);
    },

    // Formulario de referencia
    handlerRef:function(bool,el,submit)
    {
        if(bool) frmEstateSearch.referencia(jQuery('#ref_referencia').val());
    },
    referencia:function(v)
    {
        ajuda.triggerAjax(true);
        ajuda.alerta('Consultando a base. Aguarde...');
        jQuery.post(ajuda.routes('frmBuscaImoveisRef'),{"referencia":v},frmEstateSearch.referenciaCallBack,'json');
    },
    referenciaCallBack:function(data)
    {
        ajuda.triggerAjax();
        ajuda.alerta('Imóvel encontrado. Aguarde...');
        (data.success) ? location=data.data.url : ajuda.alerta('Imóvel não encontrado.');
    },

    // Formulario de busca
    handler:function(bool,el,submit)
    {
        if(bool)
        {
            jQuery('#bairros_inline')
                .addClass('visuallyhidden')
                .removeAttr('style')
                .appendTo('#bairros_inline_content');

            el.submit();
        }
    },
    disponibilidade:function(v)
    {
        ajuda.triggerAjax(true);
        ajuda.alerta('Consultando a base. Aguarde...');
        jQuery.post(ajuda.routes('estate_filters_Disponibilidades'),{"disponibilidade":v},frmEstateSearch.disponibilidadeCallBack,'json');
    },
    disponibilidadeCallBack:function(data)
    {
        var c = jQuery('#estate_filters_valor');
        c.find('option').remove();
        if(data.success)
        {
            jQuery.each(data.data.combo,function(idx,v){
                c.append('<option value="'+idx+'">'+v+'</option>');
            });
        }
        else
        {
            c.append('<option value="">Indiferente</option>');
        }
        ajuda.alerta('Valores atualizados com sucesso.');
        ajuda.triggerAjax();
    }
}

// Helpers
var ajuda={
    flashNotice:function(){
        var msg = jQuery('#flash_notice').text();
        if(msg) ajuda.alerta(msg);
    },
    triggerAjax:function(act){
        var bts = jQuery('button:button, button:submit');
        (act) ? bts.css('opacity',.5).attr('disabled','disabled') : bts.css('opacity',1).removeAttr('disabled');
    },
    routes:function(r)
    {
        return jQuery('#' + r).data('url');
    },
    alerta:function(msg, titulo)
    {
        titulo = (titulo) ? titulo : 'Informação';
        Roar.alert(titulo,msg);
    },
    addFormValidation:function(f,handler,prev)
    {
        frm = $(f);
        if(frm)
        {
            if(prev)
            {
                // Evita o submit do form -> submit controlado pelo handler
                $(f).addEvent('submit',function(e){
                    e.preventDefault();
                });
            }
            return ajuda.formValidation(f,handler);
        }
    },
    formValidation:function(f,func)
    {
        frm = $(f);
        if(frm)
        {
            func = func || Function;
            Locale.use("pt-BR");

            var frmVal = new Form.Validator(frm,{
                stopOnFailure:true,
                evaluateFieldsOnBlur:false,
                evaluateFieldsOnChange:false,
                warningPrefix:'',
                errorPrefix:'',
                onElementValidate: function(isValid, field, className, warn){
                    var validator = this.getValidator(className);
                    if (!isValid && validator.getError(field)){
                        log( jQuery(field).attr('title'),validator.getError(field) );
                        ajuda.alerta(validator.getError(field),jQuery(field).attr('title'));
                    }
                },
                onFormValidate: func
            });

            frmVal.add('validate-currency-real', {
                errorMsg: 'Digite um valor em dinheiro válido. Exemplo: 1.100,00',
                test: function(element){
                    return Form.Validator.getValidator('IsEmpty').test(element) || (/^(\d{1,3}(\.\d{3})*|(\d+))(\,\d{2})?$/).test(element.get('value'))
                }
            });

            return frmVal;
        }
        else return false;
    }
};
