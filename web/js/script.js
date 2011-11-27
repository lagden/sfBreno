// Mootools
// Parecido com o Growl
var Roar = new Roar({position: 'upperRight', duration: 7000});

var brenoTips;

// Domready
window.addEvent('domready',function()
{
    brenoTips = new Tips($$('.brenoTips'),
    {
        className:'toolTip',
        fixed:true,
        offset:{x: 0, y: 16}
    });
    
    // Formulario de busca de Imoveis Validation
    var frmBuscaImoveisId = 'frmBuscaImoveis'
    var frmBuscaImoveisEl = $(frmBuscaImoveisId);
    if(frmBuscaImoveisEl)
    {
        ajuda.formValidation(frmBuscaImoveisId,frmEstateSearch.handler);
        
        // Evita o submit do form -> submit controlado pelo handler
        $(frmBuscaImoveisId).addEvent('submit',function(e){
            new Event(e).stop();
            return false;
        });
    }
    
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
        var _this = frmEstateSearch;
        ajuda.alerta('Consultando a base. Aguarde...');
        jQuery.post(ajuda.routes('estate_filters_Disponibilidades'),{"disponibilidade":v},_this.disponibilidadeCallBack,'json');
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
