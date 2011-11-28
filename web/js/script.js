// Mootools
// Parecido com o Growl
var Roar = new Roar({position: 'upperRight', duration: 7000});

// Domready
window.addEvent('domready',function()
{
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
    
    // jQuery
    (function($){
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
    })
    (jQuery);
});

// Formulario de Busca de Imoveis
var frmEstateSearch={
    sorting:function(v)
    {
        ajuda.alerta('Reordenando...');
        jQuery.post(ajuda.routes('sort_sorting'),{"sort":v},frmEstateSearch.sortingCallBack,'json');
    },
    sortingCallBack:function(data)
    {
        (data.success) ? location.reload() : ajuda.alerta('Não foi possível reordenar.');
    },
    handlerContato:function(bool,el,submit)
    {
        if(bool) frmEstateSearch.interessou();
    },
    interessou:function()
    {
        ajuda.alerta('Enviando email. Aguarde...');
        jQuery.post(ajuda.routes('frmContatoImovel'),jQuery("#frmContatoImovel").serialize(),frmEstateSearch.interessouCallBack,'json');
    },
    interessouCallBack:function(data)
    {
        ajuda.alerta(data.msg);
    },
    handlerRef:function(bool,el,submit)
    {
        if(bool) frmEstateSearch.referencia(jQuery('#ref_referencia').val());
    },
    referencia:function(v)
    {
        ajuda.alerta('Consultando a base. Aguarde...');
        jQuery.post(ajuda.routes('frmBuscaImoveisRef'),{"referencia":v},frmEstateSearch.referenciaCallBack,'json');
    },
    referenciaCallBack:function(data)
    {
        ajuda.alerta('Imóvel encontrado. Aguarde...');
        (data.success) ? location=data.data.url : ajuda.alerta('Imóvel não encontrado.');
    },
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
    }
}

// Helpers
var ajuda={
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
            ajuda.formValidation(f,handler);
            if(prev)
            {
                // Evita o submit do form -> submit controlado pelo handler
                $(f).addEvent('submit',function(e){
                    new Event(e).stop();
                    return false;
                });
            }
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
            return frmVal;
        }
        else return false;
    }
}
